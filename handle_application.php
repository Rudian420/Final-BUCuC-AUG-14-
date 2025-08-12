<?php 
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin-login.php");
    exit(); 
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: pending_applications.php?error=" . urlencode('Invalid request method'));
    exit();
}

require_once 'Database/db.php';
require_once 'config/email_config.php';
require_once 'vendor/autoload.php';
require_once 'Action/google_sheets_integration.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get POST data
$action = $_POST['action'] ?? '';
$memberId = $_POST['member_id'] ?? 0;

if (empty($action) || empty($memberId)) {
    header("Location: pending_applications.php?error=" . urlencode('Missing required parameters'));
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
            header("Location: pending_applications.php?success=" . urlencode('Member application rejected and removed successfully'));
        } else {
            header("Location: pending_applications.php?error=" . urlencode('Failed to remove member from database'));
        }
        
    } elseif ($action === 'accept') {
        // First, get member details
        $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ? AND membership_status = 'New_member'");
        $stmt->execute([$memberId]);
        $member = $stmt->fetch();
        
        if (!$member) {
            header("Location: pending_applications.php?error=" . urlencode('Member not found or already processed'));
            exit();
        }
        
        // Update member status to Accepted
        $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $updateResult = $updateStmt->execute([$memberId]);
        
        if ($updateResult) {
            // Send congratulations email
            $emailResult = sendCongratulationsEmail($member);
            
            // Send data to Google Sheets
            $sheetsResult = sendToGoogleSheets($member);
            
            // Log the Google Sheets operation for debugging
            logGoogleSheetsOperation('accept_member', $member, $sheetsResult);
            
            // Determine response message based on both email and sheets results
            $messages = [];
            if ($emailResult['success']) {
                $messages[] = 'congratulations email sent';
            } else {
                $messages[] = 'email failed: ' . $emailResult['error'];
            }
            
            if ($sheetsResult['success']) {
                $messages[] = 'data added to Google Sheets';
            } else {
                $messages[] = 'Google Sheets error: ' . $sheetsResult['message'];
            }
            
            $finalMessage = 'Member accepted successfully';
            if (!empty($messages)) {
                $finalMessage .= ' (' . implode(', ', $messages) . ')';
            }
            
            header("Location: pending_applications.php?success=" . urlencode($finalMessage));
        } else {
            header("Location: pending_applications.php?error=" . urlencode('Failed to update member status in database'));
        }
        
    } else {
        header("Location: pending_applications.php?error=" . urlencode('Invalid action specified'));
    }
    
} catch (Exception $e) {
    header("Location: pending_applications.php?error=" . urlencode('Server error: ' . $e->getMessage()));
}

function sendCongratulationsEmail($member) {
    $mail = new PHPMailer(true);
    
    try {
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
        return ['success' => false, 'error' => $mail->ErrorInfo];
    }
}

function generateEmailTemplate($member) {
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
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f4f4f4;
            }
            .container {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            .header {
                text-align: center;
                background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
                color: white;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
            }
            .content {
                padding: 20px 0;
            }
            .highlight {
                background-color: #e8f5e8;
                padding: 15px;
                border-left: 4px solid #28a745;
                margin: 20px 0;
            }
            .footer {
                text-align: center;
                padding: 20px 0;
                color: #666;
                border-top: 1px solid #eee;
                margin-top: 20px;
            }
            .btn {
                display: inline-block;
                padding: 12px 24px;
                background-color: #28a745;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin: 10px 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>🎉 Congratulations!</h1>
                <p>Welcome to BRAC University Cultural Club</p>
            </div>
            
            <div class="content">
                <p>Dear <strong>' . htmlspecialchars($member['full_name']) . '</strong>,</p>
                
                <div class="highlight">
                    <p><strong>Great news!</strong> Your application to join the BRAC University Cultural Club has been <strong>ACCEPTED</strong>!</p>
                </div>
                
                <p>We are thrilled to welcome you as a new member of our cultural community. Your passion for arts and culture makes you a perfect fit for our club.</p>
                
                <h3>Your Application Details:</h3>
                <ul>
                    <li><strong>Name:</strong> ' . htmlspecialchars($member['full_name']) . '</li>
                    <li><strong>University ID:</strong> ' . htmlspecialchars($member['university_id']) . '</li>
                    <li><strong>Department:</strong> ' . htmlspecialchars($member['department']) . '</li>
                    <li><strong>First Priority:</strong> ' . htmlspecialchars($member['firstPriority']) . '</li>
                    <li><strong>Second Priority:</strong> ' . htmlspecialchars($member['secondPriority']) . '</li>
                </ul>
                
                <h3>What\'s Next?</h3>
                <p>As a member of BUCUC, you can now:</p>
                <ul>
                    <li>Participate in all cultural events and competitions</li>
                    <li>Join various committees based on your interests</li>
                    <li>Attend exclusive workshops and training sessions</li>
                    <li>Network with fellow cultural enthusiasts</li>
                    <li>Contribute to organizing amazing cultural programs</li>
                </ul>
                
                <p>We will contact you soon with more details about upcoming events and orientation sessions.</p>
                ';
                
                // Add venue information if available
                if ($venueInfo) {
                    $template .= '
                <div class="highlight" style="background-color: #fff3cd; border-left: 4px solid #ffc107; margin: 20px 0;">
                    <h3 style="color: #856404; margin-top: 0;">📍 Upcoming Event/Meeting</h3>
                    <ul style="margin-bottom: 0;">
                        <li><strong>Venue:</strong> ' . htmlspecialchars($venueInfo['venue_name']) . '</li>
                        <li><strong>Location:</strong> ' . htmlspecialchars($venueInfo['venue_location']) . '</li>
                        <li><strong>Date:</strong> ' . date('F j, Y', strtotime($venueInfo['venue_dateTime'])) . '</li>
                        <li><strong>Time:</strong> ' . htmlspecialchars($venueInfo['venue_startingTime'] . ' - ' . $venueInfo['venue_endingTime'] . ' ' . $venueInfo['venu_ampm']) . '</li>
                    </ul>
                </div>
                ';
                }
                
                $template .= '
                <p>Once again, congratulations on becoming part of the BUCUC family!</p>
                
                <p>Best regards,<br>
                <strong>BRAC University Cultural Club</strong><br>
                Administrative Team</p>
            </div>
            
            <div class="footer">
                <p>This is an automated email. Please do not reply to this message.</p>
                <p>For any questions, contact us at: bucuc@bracu.ac.bd</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $template;
}

function generatePlainTextEmail($member) {
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

function getLatestVenueInfo() {
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
?>
