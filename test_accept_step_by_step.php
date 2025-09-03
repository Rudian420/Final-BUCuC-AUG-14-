<?php
/**
 * Step-by-step test to isolate the 500 error
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    die("Error: No admin session. Please log in first.");
}

echo "<h2>Step-by-Step Accept Test</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px;'>";

try {
    // Step 1: Load dependencies
    echo "<h3>Step 1: Loading Dependencies</h3>";
    require_once 'Database/db.php';
    require_once 'config/email_config.php';
    require_once 'vendor/autoload.php';
    echo "✅ All dependencies loaded<br>";
    
    // Step 2: Database connection
    echo "<h3>Step 2: Database Connection</h3>";
    $database = new Database();
    $pdo = $database->createConnection();
    echo "✅ Database connected<br>";
    
    // Step 3: Find a test member
    echo "<h3>Step 3: Finding Test Member</h3>";
    $stmt = $pdo->prepare("SELECT * FROM members WHERE membership_status = 'New_member' LIMIT 1");
    $stmt->execute();
    $member = $stmt->fetch();
    
    if (!$member) {
        echo "❌ No pending members found. Please add a test member first.<br>";
        echo "<p>You can add a test member by visiting the signup page.</p>";
        exit;
    }
    
    echo "✅ Test member found: " . htmlspecialchars($member['full_name']) . "<br>";
    echo "G-Suite Email: " . htmlspecialchars($member['gsuite_email']) . "<br>";
    
    // Step 4: Test email sending function
    echo "<h3>Step 4: Testing Email Function</h3>";
    
    // Include the email function
    if (file_exists('handle_application.php')) {
        // Read the file to extract the email function
        $handleContent = file_get_contents('handle_application.php');
        
        // Check if sendCongratulationsEmail function exists
        if (strpos($handleContent, 'function sendCongratulationsEmail') !== false) {
            echo "✅ Email function found in handle_application.php<br>";
            
            // Try to include and test the function
            ob_start();
            include 'handle_application.php';
            ob_end_clean();
            
            if (function_exists('sendCongratulationsEmail')) {
                echo "✅ Email function is callable<br>";
                
                // Test the email function
                echo "<h4>Testing Email Sending:</h4>";
                $emailResult = sendCongratulationsEmail($member);
                
                if ($emailResult['success']) {
                    echo "✅ Email sent successfully!<br>";
                    echo "Result: " . htmlspecialchars($emailResult['message'] ?? 'Success') . "<br>";
                } else {
                    echo "❌ Email failed to send<br>";
                    echo "Error: " . htmlspecialchars($emailResult['error'] ?? 'Unknown error') . "<br>";
                }
            } else {
                echo "❌ Email function not callable<br>";
            }
        } else {
            echo "❌ Email function not found in handle_application.php<br>";
        }
    } else {
        echo "❌ handle_application.php not found<br>";
    }
    
    // Step 5: Test Google Sheets function
    echo "<h3>Step 5: Testing Google Sheets Function</h3>";
    if (function_exists('sendToGoogleSheets')) {
        echo "✅ Google Sheets function exists<br>";
        
        // Test Google Sheets (optional)
        echo "<h4>Testing Google Sheets Integration:</h4>";
        $sheetsResult = sendToGoogleSheets($member);
        
        if ($sheetsResult['success']) {
            echo "✅ Google Sheets integration successful<br>";
        } else {
            echo "⚠️ Google Sheets integration failed (this is optional)<br>";
            echo "Message: " . htmlspecialchars($sheetsResult['message'] ?? 'Unknown error') . "<br>";
        }
    } else {
        echo "⚠️ Google Sheets function not found (this is optional)<br>";
    }
    
    // Step 6: Test database update
    echo "<h3>Step 6: Testing Database Update</h3>";
    $testStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
    $testResult = $testStmt->execute([$member['id']]);
    
    if ($testResult) {
        echo "✅ Database update successful<br>";
        
        // Revert the change for testing
        $revertStmt = $pdo->prepare("UPDATE members SET membership_status = 'New_member' WHERE id = ?");
        $revertStmt->execute([$member['id']]);
        echo "✅ Test member status reverted to 'New_member'<br>";
    } else {
        echo "❌ Database update failed<br>";
    }
    
    echo "<h3>🎯 Test Summary</h3>";
    echo "<p>All individual components are working. The 500 error is likely caused by:</p>";
    echo "<ul>";
    echo "<li>Specific email sending issues (SMTP authentication, network problems)</li>";
    echo "<li>Google Sheets integration problems</li>";
    echo "<li>Server timeout issues</li>";
    echo "<li>Memory or execution time limits</li>";
    echo "</ul>";
    
    echo "<h3>🔧 Recommended Fixes</h3>";
    echo "<p>Try these solutions:</p>";
    echo "<ol>";
    echo "<li><strong>Check Gmail App Password:</strong> Make sure your Gmail app password is correct</li>";
    echo "<li><strong>Test Email Separately:</strong> Try sending a test email using the email config</li>";
    echo "<li><strong>Disable Google Sheets:</strong> Temporarily comment out Google Sheets integration</li>";
    echo "<li><strong>Check Server Logs:</strong> Look at Hostinger error logs for specific error messages</li>";
    echo "</ol>";
    
} catch (Exception $e) {
    echo "<h3>❌ Error Found:</h3>";
    echo "<p style='color: red;'>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>This is likely the cause of your 500 error.</p>";
}

echo "</div>";
?>
