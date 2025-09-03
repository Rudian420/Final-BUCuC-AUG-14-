<?php
/**
 * Simplified accept handler without Google Sheets integration
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    header("Location: admin-login.php");
    exit;
}

// Check POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: pending_applications.php?error=" . urlencode('Invalid request method'));
    exit;
}

// Get POST data
$action = $_POST['action'] ?? '';
$memberId = $_POST['member_id'] ?? 0;

if (empty($action) || empty($memberId)) {
    header("Location: pending_applications.php?error=" . urlencode('Missing required parameters'));
    exit;
}

try {
    // Load dependencies
    require_once 'Database/db.php';
    require_once 'config/email_config.php';
    require_once 'vendor/autoload.php';
    
    // Database connection
    $database = new Database();
    $pdo = $database->createConnection();
    
    // Get member details
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ? AND membership_status = 'New_member'");
    $stmt->execute([$memberId]);
    $member = $stmt->fetch();
    
    if (!$member) {
        header("Location: pending_applications.php?error=" . urlencode('Member not found or already processed'));
        exit;
    }
    
    if ($action === 'accept') {
        // FIRST: Try to send congratulations email
        $emailResult = ['success' => false, 'error' => 'Email function not called'];
        
        try {
            // Create PHPMailer instance
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            
            // Server settings
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = SMTP_SECURITY;
            $mail->Port = SMTP_PORT;
            
            // Recipients
            $mail->setFrom(FROM_EMAIL, FROM_NAME);
            $mail->addAddress($member['gsuite_email'], $member['full_name']);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Congratulations! Your BUCuC Application Has Been Accepted';
            $mail->Body = "
                <h2>Congratulations, " . htmlspecialchars($member['full_name']) . "!</h2>
                <p>We are pleased to inform you that your application to join BUCuC has been <strong>accepted</strong>!</p>
                <p>Welcome to our community!</p>
                <p>Best regards,<br>BUCuC Team</p>
            ";
            $mail->AltBody = "Congratulations, " . $member['full_name'] . "! Your application to join BUCuC has been accepted. Welcome to our community! Best regards, BUCuC Team";
            
            // Send email
            $result = $mail->send();
            
            if ($result) {
                $emailResult = ['success' => true, 'message' => 'Email sent successfully'];
            } else {
                $emailResult = ['success' => false, 'error' => 'Email failed to send'];
            }
            
        } catch (Exception $e) {
            $emailResult = ['success' => false, 'error' => 'Email error: ' . $e->getMessage()];
        }
        
        // ONLY update database status if email was sent successfully
        if ($emailResult['success']) {
            // Update member status to Accepted
            $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
            $updateResult = $updateStmt->execute([$memberId]);
            
            if ($updateResult) {
                $finalMessage = 'Member accepted successfully (email sent)';
                header("Location: pending_applications.php?success=" . urlencode($finalMessage));
            } else {
                header("Location: pending_applications.php?error=" . urlencode('Failed to update member status in database'));
            }
        } else {
            // Email failed - do NOT accept the member
            $errorMessage = 'Failed to send email to ' . $member['full_name'] . '. Application not accepted. Error: ' . ($emailResult['error'] ?? 'unknown error');
            header("Location: pending_applications.php?error=" . urlencode($errorMessage));
        }
        
    } elseif ($action === 'reject') {
        // Update member status to Rejected
        $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Rejected', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $updateResult = $updateStmt->execute([$memberId]);
        
        if ($updateResult) {
            header("Location: pending_applications.php?success=" . urlencode('Member rejected successfully'));
        } else {
            header("Location: pending_applications.php?error=" . urlencode('Failed to update member status in database'));
        }
    } else {
        header("Location: pending_applications.php?error=" . urlencode('Invalid action'));
    }
    
} catch (Exception $e) {
    error_log("Error in handle_application_simple.php: " . $e->getMessage());
    header("Location: pending_applications.php?error=" . urlencode('Server error: ' . $e->getMessage()));
}
?>
