<?php
/**
 * Simple email test for Hostinger
 * This will test if your Gmail configuration works
 */

session_start();
if (!isset($_SESSION["admin"])) {
    die("Please log in as admin first");
}

require_once 'config/email_config.php';
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

echo "<h2>Simple Email Test</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px;'>";

// Test email sending
$mail = new PHPMailer(true);

try {
    echo "<h3>Testing Email Configuration...</h3>";
    
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
    $mail->addAddress(SMTP_USERNAME, 'Test Recipient'); // Send to yourself

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from BUCuC - Hostinger';
    $mail->Body = '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
            .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
            .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>🎉 Email Test Successful!</h1>
            </div>
            <div class="content">
                <div class="success">
                    <h3>✅ Your BUCuC email system is working!</h3>
                    <p>This test email confirms that your application acceptance emails will be delivered successfully.</p>
                </div>

                <h3>Test Details:</h3>
                <ul>
                    <li><strong>Sent from:</strong> ' . FROM_EMAIL . '</li>
                    <li><strong>SMTP Server:</strong> ' . SMTP_HOST . ':' . SMTP_PORT . '</li>
                    <li><strong>Security:</strong> ' . strtoupper(SMTP_SECURITY) . '</li>
                    <li><strong>Timestamp:</strong> ' . date('Y-m-d H:i:s') . '</li>
                </ul>

                <p>Your accept button should now work perfectly!</p>
            </div>
        </div>
    </body>
    </html>';

    $mail->AltBody = "Test Email from BUCuC - Hostinger\n\nThis test email confirms that your application acceptance emails will be delivered successfully.\n\nTimestamp: " . date('Y-m-d H:i:s');

    $mail->send();
    
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4>✅ Success!</h4>";
    echo "<p>Test email sent successfully to: <strong>" . SMTP_USERNAME . "</strong></p>";
    echo "<p>Check your Gmail inbox to confirm delivery.</p>";
    echo "<p><strong>Your accept button should now work perfectly!</strong></p>";
    echo "</div>";

} catch (Exception $e) {
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4>❌ Error!</h4>";
    echo "<p><strong>Message could not be sent.</strong></p>";
    echo "<p><strong>Mailer Error:</strong> {$mail->ErrorInfo}</p>";
    echo "</div>";

    echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h4>🔧 Troubleshooting Tips:</h4>";
    echo "<ul>";
    echo "<li>Verify your Gmail credentials in <code>config/email_config.php</code></li>";
    echo "<li>Ensure your Gmail account has 2-Step Verification enabled</li>";
    echo "<li>Make sure you're using an App Password (not your regular password)</li>";
    echo "<li>Check if your Gmail account allows 'Less secure app access'</li>";
    echo "</ul>";
    echo "</div>";
}

echo "</div>";
?>
