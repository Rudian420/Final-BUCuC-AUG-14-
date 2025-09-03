<?php
/**
 * Simple email test to verify Gmail configuration
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    die("Error: No admin session. Please log in first.");
}

echo "<h2>Simple Email Test</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px;'>";

try {
    // Load dependencies
    require_once 'config/email_config.php';
    require_once 'vendor/autoload.php';
    
    echo "<h3>Email Configuration:</h3>";
    echo "SMTP Host: " . SMTP_HOST . "<br>";
    echo "SMTP Port: " . SMTP_PORT . "<br>";
    echo "SMTP Security: " . SMTP_SECURITY . "<br>";
    echo "SMTP Username: " . SMTP_USERNAME . "<br>";
    echo "SMTP Password: " . (SMTP_PASSWORD ? "***hidden***" : "NOT SET") . "<br>";
    echo "From Email: " . FROM_EMAIL . "<br>";
    echo "From Name: " . FROM_NAME . "<br>";
    
    echo "<h3>Testing Email Sending:</h3>";
    
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
    
    // Enable verbose debug output
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    
    // Recipients
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress('hr.bucuc@gmail.com', 'Test Recipient'); // Send to yourself for testing
    
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from BUCuC System';
    $mail->Body = '<h2>Test Email</h2><p>This is a test email to verify the email configuration is working correctly.</p><p>If you receive this email, the system is working properly!</p>';
    $mail->AltBody = 'This is a test email to verify the email configuration is working correctly. If you receive this email, the system is working properly!';
    
    // Send email
    $result = $mail->send();
    
    if ($result) {
        echo "<h3>✅ Email Sent Successfully!</h3>";
        echo "<p>Check your Gmail inbox for the test email.</p>";
    } else {
        echo "<h3>❌ Email Failed to Send</h3>";
        echo "<p>Check the debug output above for error details.</p>";
    }
    
} catch (Exception $e) {
    echo "<h3>❌ Error:</h3>";
    echo "<p style='color: red;'>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>This error is likely causing the 500 error in the accept button.</p>";
}

echo "</div>";
?>