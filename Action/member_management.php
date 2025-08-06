<?php
session_start();
require_once '../Database/db.php';

// Check if user is admin
if (!isset($_SESSION["admin"])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

header('Content-Type: application/json');

$database = new Database();
$conn = $database->createConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'get_pending_members':
            getPendingMembers($conn);
            break;
        
        case 'accept_member':
            acceptMember($conn, $_POST['member_id'] ?? '');
            break;
        
        case 'reject_member':
            rejectMember($conn, $_POST['member_id'] ?? '');
            break;
        
        case 'toggle_application_system':
            toggleApplicationSystem($conn, $_POST['enabled'] ?? '');
            break;
        
        case 'get_application_status':
            getApplicationStatus($conn);
            break;
        
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

function getPendingMembers($conn) {
    try {
        $sql = "SELECT id, full_name, university_id, email, department, phone, semester, 
                gender, date_of_birth, membership_status, event_category, motivation,
                created_at, application_status 
                FROM members 
                WHERE application_status = 'pending' 
                ORDER BY created_at DESC";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode(['success' => true, 'data' => $members]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function acceptMember($conn, $memberId) {
    if (empty($memberId)) {
        echo json_encode(['success' => false, 'message' => 'Member ID is required']);
        return;
    }
    
    try {
        // Get member details for email
        $getMemberSql = "SELECT full_name, email FROM members WHERE id = :member_id";
        $getMemberStmt = $conn->prepare($getMemberSql);
        $getMemberStmt->bindParam(':member_id', $memberId);
        $getMemberStmt->execute();
        $member = $getMemberStmt->fetch();
        
        if (!$member) {
            echo json_encode(['success' => false, 'message' => 'Member not found']);
            return;
        }
        
        // Update member status
        $sql = "UPDATE members 
                SET application_status = 'accepted', 
                    admin_action_at = NOW(), 
                    admin_action_by = :admin_id 
                WHERE id = :member_id";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':member_id', $memberId);
        $stmt->bindParam(':admin_id', $_SESSION['admin_id']);
        
        if ($stmt->execute()) {
            // Send acceptance email
            sendAcceptanceEmail($member['email'], $member['full_name']);
            echo json_encode(['success' => true, 'message' => 'Member accepted successfully and email sent']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to accept member']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function rejectMember($conn, $memberId) {
    if (empty($memberId)) {
        echo json_encode(['success' => false, 'message' => 'Member ID is required']);
        return;
    }
    
    try {
        // Delete the member record
        $sql = "DELETE FROM members WHERE id = :member_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':member_id', $memberId);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Member rejected and removed successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to reject member']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function toggleApplicationSystem($conn, $enabled) {
    try {
        $value = ($enabled === 'true') ? 'true' : 'false';
        
        $sql = "INSERT INTO application_settings (setting_name, setting_value) 
                VALUES ('application_system_enabled', :value) 
                ON DUPLICATE KEY UPDATE setting_value = :value, updated_at = NOW()";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':value', $value);
        
        if ($stmt->execute()) {
            $status = ($value === 'true') ? 'enabled' : 'disabled';
            echo json_encode(['success' => true, 'message' => "Application system $status successfully"]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update application system status']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function getApplicationStatus($conn) {
    try {
        $sql = "SELECT setting_value FROM application_settings WHERE setting_name = 'application_system_enabled'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        
        $enabled = ($result && $result['setting_value'] === 'true') ? true : false;
        echo json_encode(['success' => true, 'enabled' => $enabled]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function sendAcceptanceEmail($to_email, $full_name) {
    // Using PHPMailer
    require_once '../vendor/autoload.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'arafat.haque.biswas@g.bracu.ac.bd';
        $mail->Password   = 'your_app_password'; // Use app password for Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Recipients
        $mail->setFrom('arafat.haque.biswas@g.bracu.ac.bd', 'BRAC University Cultural Club');
        $mail->addAddress($to_email, $full_name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to BRAC University Cultural Club!';
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #e76f2c, #f3d35c); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
                .footer { text-align: center; margin-top: 20px; color: #666; font-size: 14px; }
                .button { display: inline-block; background: #e76f2c; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🎉 Welcome to BUCuC! 🎉</h1>
                </div>
                <div class='content'>
                    <h2>Dear $full_name,</h2>
                    <p>Congratulations! Your application to join the <strong>BRAC University Cultural Club</strong> has been <strong>accepted</strong>!</p>
                    
                    <p>We are thrilled to have you as part of our vibrant community of artists, performers, and cultural enthusiasts. Your journey with us promises to be filled with creativity, friendship, and unforgettable experiences.</p>
                    
                    <h3>What's Next?</h3>
                    <ul>
                        <li>🎭 Join our upcoming events and workshops</li>
                        <li>🤝 Connect with fellow club members</li>
                        <li>🎨 Showcase your talents in our performances</li>
                        <li>📚 Access exclusive club resources and materials</li>
                    </ul>
                    
                    <p>Keep an eye on your email for updates about our upcoming events, meetings, and opportunities to get involved!</p>
                    
                    <a href='https://www.facebook.com/bucuc' class='button'>Join Our Facebook Group</a>
                </div>
                <div class='footer'>
                    <p>Best regards,<br>
                    <strong>BRAC University Cultural Club</strong><br>
                    Email: bucuc@support.ac.bd<br>
                    Facebook: @bucuc</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->AltBody = "Dear $full_name,\n\nCongratulations! Your application to join the BRAC University Cultural Club has been accepted!\n\nWe look forward to your participation in our upcoming events.\n\nBest regards,\nBRAC University Cultural Club";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>
