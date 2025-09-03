<?php
session_start();
if (!isset($_SESSION["admin"])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Set content type for JSON response
header('Content-Type: application/json');

require_once 'Database/db.php';
require_once 'config/email_config.php';
require_once 'vendor/autoload.php';

// Try to include Google Sheets integration, but don't fail if it's missing
if (file_exists('Action/google_sheets_integration.php')) {
    require_once 'Action/google_sheets_integration.php';
} else {
    // Define fallback functions if Google Sheets integration is missing
    function sendToGoogleSheets($member) {
        return ['success' => false, 'message' => 'Google Sheets integration not available'];
    }
    
    function logGoogleSheetsOperation($action, $data, $result) {
        // Do nothing if Google Sheets integration is not available
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get POST data
$action = $_POST['action'] ?? '';
$memberId = $_POST['member_id'] ?? 0;

if (empty($action) || empty($memberId)) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit();
}

try {
    $database = new Database();
    $pdo = $database->createConnection();

    if ($action === 'reject') {
        // Delete member from database
        $stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
        $result = $stmt->execute([$memberId]);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Member application rejected and removed successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove member from database']);
        }
    } elseif ($action === 'accept') {
        // First, get member details
        $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ? AND membership_status = 'New_member'");
        $stmt->execute([$memberId]);
        $member = $stmt->fetch();

        if (!$member) {
            echo json_encode(['success' => false, 'message' => 'Member not found or already processed']);
            exit();
        }

        // Update member status to Accepted
        $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $updateResult = $updateStmt->execute([$memberId]);

        if ($updateResult) {
            // Send congratulations email
            $emailResult = ['success' => false, 'error' => 'Email function not called'];
            try {
                $emailResult = sendCongratulationsEmail($member);
            } catch (Exception $e) {
                $emailResult = ['success' => false, 'error' => 'Email error: ' . $e->getMessage()];
            }

            // Send data to Google Sheets (optional)
            $sheetsResult = ['success' => false, 'message' => 'Google Sheets not attempted'];
            try {
                if (function_exists('sendToGoogleSheets')) {
                    $sheetsResult = sendToGoogleSheets($member);
                }
            } catch (Exception $e) {
                $sheetsResult = ['success' => false, 'message' => 'Google Sheets error: ' . $e->getMessage()];
            }

            // Log the Google Sheets operation for debugging (if function exists)
            if (function_exists('logGoogleSheetsOperation')) {
                try {
                    logGoogleSheetsOperation('accept_member', $member, $sheetsResult);
                } catch (Exception $e) {
                    // Ignore logging errors
                }
            }

            // Determine response message based on both email and sheets results
            $messages = [];
            if ($emailResult['success']) {
                $messages[] = 'congratulations email sent';
            } else {
                $messages[] = 'email failed: ' . ($emailResult['error'] ?? 'unknown error');
            }

            if ($sheetsResult['success']) {
                $messages[] = 'data added to Google Sheets';
            } else {
                $messages[] = 'Google Sheets: ' . ($sheetsResult['message'] ?? 'not available');
            }

            $finalMessage = 'Member accepted successfully';
            if (!empty($messages)) {
                $finalMessage .= ' (' . implode(', ', $messages) . ')';
            }

            echo json_encode([
                'success' => true, 
                'message' => $finalMessage,
                'email_success' => $emailResult['success'],
                'sheets_success' => $sheetsResult['success']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update member status in database']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action specified']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}

function sendCongratulationsEmail($member)
{
    try {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_SECURITY === 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = SMTP_PORT;

        // Recipients
        $mail->setFrom(FROM_EMAIL, FROM_NAME);
        $mail->addAddress($member['gsuite_email'], $member['full_name']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Congratulations! Welcome to BRAC University Cultural Club';

        $mail->Body = generateEmailTemplate($member);
        $mail->AltBody = generatePlainTextEmail($member);

        $mail->send();
        return ['success' => true];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

function generateEmailTemplate($member)
{
    // Get venue information
    $venueInfo = getLatestVenueInfo();

    $template = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to BUCUC</title>
        <style>
            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                line-height: 1.7;
                color: #2c3e50;
                max-width: 650px;
                margin: 0 auto;
                padding: 25px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
            }
            .container {
                background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
                padding: 40px;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1), 0 8px 16px rgba(0,0,0,0.06);
                border: 1px solid rgba(255,255,255,0.2);
                backdrop-filter: blur(10px);
                position: relative;
                overflow: hidden;
            }
            .container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
                border-radius: 20px 20px 0 0;
            }
            .header {
                text-align: center;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
                color: white;
                padding: 35px 25px;
                border-radius: 16px;
                margin-bottom: 30px;
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
                position: relative;
                overflow: hidden;
            }
            .header::before {
                content:"";
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
                animation: shimmer 3s ease-in-out infinite;
            }
            @keyframes shimmer {
                0%, 100% { transform: rotate(0deg); }
                50% { transform: rotate(180deg); }
            }
            .header h1 {
                margin: 0;
                font-size: 28px;
                font-weight: 700;
                text-shadow: 0 2px 4px rgba(0,0,0,0.2);
                position: relative;
                z-index: 1;
            }
            .header p {
                margin: 10px 0 0 0;
                font-size: 16px;
                opacity: 0.95;
                position: relative;
                z-index: 1;
            }
            .content {
                padding: 25px 0;
                position: relative;
                z-index: 1;
            }
            .content p {
                margin-bottom: 20px;
                font-size: 15px;
            }
            .content h3 {
                color: #2c3e50;
                font-size: 20px;
                margin: 30px 0 15px 0;
                font-weight: 600;
                border-bottom: 2px solid #e9ecef;
                padding-bottom: 8px;
            }
            .content ul {
                margin: 20px 0;
                padding-left: 25px;
            }
            .content li {
                margin-bottom: 12px;
                line-height: 1.6;
            }
            .highlight {
                background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
                padding: 25px;
                border-left: 5px solid #28a745;
                margin: 25px 0;
                border-radius: 0 12px 12px 0;
                box-shadow: 0 5px 15px rgba(40, 167, 69, 0.1);
                position: relative;
            }
            .highlight::before {
                content: "✨";
                position: absolute;
                top: -10px;
                right: 20px;
                font-size: 20px;
                background: white;
                padding: 5px;
                border-radius: 50%;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            .highlight p {
                margin: 0;
                font-weight: 500;
            }
            .footer {
                text-align: center;
                padding: 30px 0 20px 0;
                color: #6c757d;
                border-top: 2px solid #e9ecef;
                margin-top: 30px;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-radius: 0 0 20px 20px;
                margin: 30px -40px -40px -40px;
                padding: 30px 40px 20px 40px;
            }
      .btn {
        display: inline-block;
        padding: 14px 28px;
        background: #ffffff;
        color: #2c3e50;
        text-decoration: none;
        border-radius: 25px;
        margin: 12px 8px 12px 0;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(44, 62, 80, 0.15);
        border: 2px solid #e9ecef;
        position: relative;
        overflow: hidden;
      }
      .btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
          90deg,
          transparent,
          rgba(44, 62, 80, 0.1),
          transparent
        );
        transition: left 0.6s ease;
      }
      .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(44, 62, 80, 0.25);
        background: #2c3e50;
        color: #ffffff;
        border-color: #2c3e50;
      }
      .btn:hover::before {
        left: 100%;
      }
      .btn:active {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(44, 62, 80, 0.2);
      }
            .social-links {
                margin: 25px 0;
            }
            .social-links a {
                display: block;
                margin-bottom: 10px;
            }
            .venue-highlight {
                background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
                border-left: 5px solid #ffc107;
                border-radius: 0 12px 12px 0;
                box-shadow: 0 5px 15px rgba(255, 193, 7, 0.1);
            }
            .venue-highlight h3 {
                color: #856404;
                margin-top: 0;
                border-bottom: none;
                padding-bottom: 0;
            }
            .venue-highlight ul {
                margin-bottom: 0;
            }
            .venue-highlight li {
                margin-bottom: 8px;
            }
            .strong-text {
                font-weight: 600;
                color: #2c3e50;
            }
            .emoji {
                font-size: 18px;
                margin-right: 8px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            
            <div class="content">
                <p>Dear <strong>' . htmlspecialchars($member['full_name']) . '</strong>,</p>
                
                <div class="highlight">
                    <p><strong>Congratulations!</strong> You\'ve successfully completed all recruitment steps and are now <strong>an official member of the BRAC University Cultural Club (BUCuC)</strong>. We\'re thrilled to have you on board and can\'t wait to see the dedication and creativity you bring to the club!</p>
                </div>
                
                
                <h3>Your Application Details:</h3>
                <ul>
                    <li><strong>Name:</strong> ' . htmlspecialchars($member['full_name']) . '</li>
                    <li><strong>University ID:</strong> ' . htmlspecialchars($member['university_id']) . '</li>
                    <li><strong>Department:</strong> ' . htmlspecialchars($member['department']) . '</li>
                    <li><strong>First Priority:</strong> ' . htmlspecialchars($member['firstPriority']) . '</li>
                    <li><strong>Second Priority:</strong> ' . htmlspecialchars($member['secondPriority']) . '</li>
                    <li><strong>Facebook: </strong><a href=' . $member['facebook_url'] . '>Facebook URL </a> ' . '</li>
                </ul>
                <p><strong>To stay updated on all upcoming activities and announcements, make sure to follow BUCuC on our social media platforms:</strong></p>
                
                <div class="social-links">
                    <a href="https://www.facebook.com/bucuc" class="btn">BUCuC Official Page</a>
                    <a href="https://www.facebook.com/groups/86555568937" class="btn">BUCuC Official Group</a>
                    <a href="https://www.instagram.com/bucuclive/" class="btn">BUCuC Official Instagram</a>
                    <a href="https://www.youtube.com/@bracuniversityculturalclub717" class="btn">BUCuC Official Youtube</a>
                </div>
                <p>Now, it\'s time for your Orientation — a must-attend event where you\'ll meet your fellow members, learn more about BUCuC, and kickstart your journey with us!</p>';


    // Add venue information if available
    if ($venueInfo) {
        $template .= '
                <div class="highlight venue-highlight">
                    <h3>📍 Upcoming Event/Meeting</h3>
                    <ul>
                        <li><strong>Venue:</strong> ' . htmlspecialchars($venueInfo['venue_name']) . '</li>
                        <li><strong>Location:</strong> ' . htmlspecialchars($venueInfo['venue_location']) . '</li>
                        <li><strong>Date:</strong> ' . date('F j, Y', strtotime($venueInfo['venue_dateTime'])) . '</li>
                        <li><strong>Time:</strong> ' . htmlspecialchars($venueInfo['venue_startingTime'] . ' - ' . $venueInfo['venue_endingTime'] . ' ' . $venueInfo['venu_ampm']) . '</li>
                    </ul>
                </div>
                ';
    }

    $template .= '<p><strong>Your presence is MANDATORY, and we promise it\'ll be worth it! Looking forward to seeing you there!</strong></p>
                <p><strong>You will be added to a Messenger group after the orientation for smooth communication. If you are not added within the next few days after that, please reach out to the HR team directly.</strong></p>
                
                <p>Welcome to the BUCuC family!</p>

                <p><strong>Work • Bond • Glow</strong></p>

                
                <p>Best regards,<br>
                <strong style="color:#DC143C">Rudian Ahmed </strong>(01601946311),<br><strong style="color:#DC143C">Secretary of Human Resources</strong>,<br> BRAC University Cultural Club</p>
            </div>
            
            <div class="footer">
                <p>This is an automated email. Please do not reply to this message.</p>
                <p>For any questions, contact us at: hr.bucuc@gmail.com</p>
            </div>
        </div>
    </body>
    </html>';

    return $template;
}

function generatePlainTextEmail($member)
{
    $venueInfo = getLatestVenueInfo();

    $text = "Congratulations " . $member['full_name'] . "!\n\n" .
        "Your application to join the BRAC University Cultural Club has been ACCEPTED!\n\n" .
        "Your Details:\n" .
        "Name: " . $member['full_name'] . "\n" .
        "University ID: " . $member['university_id'] . "\n" .
        "Department: " . $member['department'] . "\n" .
        "First Priority: " . $member['firstPriority'] . "\n" .
        "Second Priority: " . $member['secondPriority'] . "\n\n" .
        "What's Next?\n" .
        "As a member of BUCUC, you can now:\n" .
        "- Participate in all cultural events and competitions\n" .
        "- Join various committees based on your interests\n" .
        "- Attend exclusive workshops and training sessions\n" .
        "- Network with fellow cultural enthusiasts\n" .
        "- Contribute to organizing amazing cultural programs\n\n";

    // Add venue information if available
    if ($venueInfo) {
        $text .= "UPCOMING EVENT/MEETING:\n" .
            "Venue: " . $venueInfo['venue_name'] . "\n" .
            "Location: " . $venueInfo['venue_location'] . "\n" .
            "Date: " . date('F j, Y', strtotime($venueInfo['venue_dateTime'])) . "\n" .
            "Time: " . $venueInfo['venue_startingTime'] . ' - ' . $venueInfo['venue_endingTime'] . ' ' . $venueInfo['venu_ampm'] . "\n\n";
    }

    $text .= "Welcome to BUCUC!\n\n" .
        "Best regards,\n" .
        "BRAC University Cultural Club";

    return $text;
}

function getLatestVenueInfo()
{
    try {
        $database = new Database();
        $pdo = $database->createConnection();

        // Get the latest venue information
        $stmt = $pdo->query("SELECT * FROM venuInfo ORDER BY venue_id DESC LIMIT 1");
        $venue = $stmt->fetch();

        return $venue ? $venue : null;
    } catch (Exception $e) {
        // Return null if there's an error or no venue info
        return null;
    }
}
