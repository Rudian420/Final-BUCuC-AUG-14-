<?php
/**
 * Comprehensive diagnostic script to find the exact cause of 500 error
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    die("Error: No admin session. Please log in first.");
}

echo "<h2>500 Error Diagnostic</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px;'>";

try {
    echo "<h3>Step 1: Basic Environment</h3>";
    echo "✅ PHP Version: " . phpversion() . "<br>";
    echo "✅ Admin session exists<br>";
    
    echo "<h3>Step 2: File Existence Check</h3>";
    $files = [
        'Database/db.php',
        'config/email_config.php', 
        'vendor/autoload.php',
        'handle_application.php'
    ];
    
    foreach ($files as $file) {
        if (file_exists($file)) {
            echo "✅ $file exists<br>";
        } else {
            echo "❌ $file missing<br>";
        }
    }
    
    echo "<h3>Step 3: Load Dependencies</h3>";
    require_once 'Database/db.php';
    echo "✅ Database file loaded<br>";
    
    require_once 'config/email_config.php';
    echo "✅ Email config loaded<br>";
    
    require_once 'vendor/autoload.php';
    echo "✅ PHPMailer loaded<br>";
    
    echo "<h3>Step 4: Database Connection</h3>";
    $database = new Database();
    $pdo = $database->createConnection();
    echo "✅ Database connected<br>";
    
    echo "<h3>Step 5: Find Test Member</h3>";
    $stmt = $pdo->prepare("SELECT * FROM members WHERE membership_status = 'New_member' LIMIT 1");
    $stmt->execute();
    $member = $stmt->fetch();
    
    if (!$member) {
        echo "❌ No pending members found<br>";
        echo "<p>Please add a test member first by visiting the signup page.</p>";
        exit;
    }
    
    echo "✅ Test member found: " . htmlspecialchars($member['full_name']) . "<br>";
    echo "G-Suite Email: " . htmlspecialchars($member['gsuite_email']) . "<br>";
    
    echo "<h3>Step 6: Test Email Configuration</h3>";
    echo "SMTP Host: " . SMTP_HOST . "<br>";
    echo "SMTP Port: " . SMTP_PORT . "<br>";
    echo "SMTP Security: " . SMTP_SECURITY . "<br>";
    echo "SMTP Username: " . SMTP_USERNAME . "<br>";
    echo "SMTP Password: " . (SMTP_PASSWORD ? "***hidden***" : "NOT SET") . "<br>";
    echo "From Email: " . FROM_EMAIL . "<br>";
    echo "From Name: " . FROM_NAME . "<br>";
    
    echo "<h3>Step 7: Test PHPMailer Instance</h3>";
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    echo "✅ PHPMailer instance created<br>";
    
    echo "<h3>Step 8: Test SMTP Configuration</h3>";
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = SMTP_SECURITY;
    $mail->Port = SMTP_PORT;
    echo "✅ SMTP settings configured<br>";
    
    echo "<h3>Step 9: Test Email Recipients</h3>";
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    $mail->addAddress($member['gsuite_email'], $member['full_name']);
    echo "✅ Recipients set<br>";
    
    echo "<h3>Step 10: Test Email Content</h3>";
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from BUCuC System';
    $mail->Body = '<h2>Test Email</h2><p>This is a test email to verify the system is working.</p>';
    $mail->AltBody = 'This is a test email to verify the system is working.';
    echo "✅ Email content set<br>";
    
    echo "<h3>Step 11: Test Email Sending</h3>";
    echo "<h4>Attempting to send email...</h4>";
    
    // Enable verbose debug output
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    
    $result = $mail->send();
    
    if ($result) {
        echo "✅ Email sent successfully!<br>";
        echo "<p style='color: green;'><strong>SUCCESS:</strong> The email system is working correctly!</p>";
    } else {
        echo "❌ Email failed to send<br>";
        echo "<p style='color: red;'><strong>ERROR:</strong> This is likely the cause of your 500 error.</p>";
    }
    
    echo "<h3>Step 12: Test handle_application.php</h3>";
    if (file_exists('handle_application.php')) {
        echo "✅ handle_application.php exists<br>";
        
        // Check if the file is readable
        if (is_readable('handle_application.php')) {
            echo "✅ handle_application.php is readable<br>";
            
            // Try to include it
            try {
                ob_start();
                include 'handle_application.php';
                ob_end_clean();
                echo "✅ handle_application.php can be included<br>";
            } catch (Exception $e) {
                echo "❌ Error including handle_application.php: " . $e->getMessage() . "<br>";
            }
        } else {
            echo "❌ handle_application.php is not readable<br>";
        }
    } else {
        echo "❌ handle_application.php not found<br>";
    }
    
    echo "<h3>Step 13: Test Google Sheets Function</h3>";
    if (function_exists('sendToGoogleSheets')) {
        echo "✅ Google Sheets function exists<br>";
    } else {
        echo "⚠️ Google Sheets function not found (this is optional)<br>";
    }
    
    echo "<h3>Step 14: Test Email Function</h3>";
    if (function_exists('sendCongratulationsEmail')) {
        echo "✅ Email function exists<br>";
    } else {
        echo "❌ Email function not found<br>";
    }
    
    echo "<h3>🎯 Diagnostic Summary</h3>";
    echo "<p>All tests completed. If any test shows ❌, that's likely the cause of your 500 error.</p>";
    
} catch (Exception $e) {
    echo "<h3>❌ Error Found:</h3>";
    echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>This is likely the cause of your 500 error.</p>";
    
    // Show more details about the error
    echo "<h4>Error Details:</h4>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "</div>";
?>
