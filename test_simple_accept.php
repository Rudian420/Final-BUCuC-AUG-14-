<?php
/**
 * Simple test to verify the accept functionality works
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    die("Error: No admin session. Please log in first.");
}

echo "<h2>Simple Accept Test</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px;'>";

try {
    // Load dependencies
    require_once 'Database/db.php';
    require_once 'config/email_config.php';
    require_once 'vendor/autoload.php';
    
    // Database connection
    $database = new Database();
    $pdo = $database->createConnection();
    
    // Find a test member
    $stmt = $pdo->prepare("SELECT * FROM members WHERE membership_status = 'New_member' LIMIT 1");
    $stmt->execute();
    $member = $stmt->fetch();
    
    if (!$member) {
        echo "❌ No pending members found. Please add a test member first.<br>";
        exit;
    }
    
    echo "✅ Test member found: " . htmlspecialchars($member['full_name']) . "<br>";
    echo "G-Suite Email: " . htmlspecialchars($member['gsuite_email']) . "<br>";
    
    // Test the email function
    echo "<h3>Testing Email Function:</h3>";
    
    // Include the email function
    if (file_exists('handle_application.php')) {
        ob_start();
        include 'handle_application.php';
        ob_end_clean();
        
        if (function_exists('sendCongratulationsEmail')) {
            echo "✅ Email function exists<br>";
            
            // Test the email function
            echo "<h4>Testing Email Sending:</h4>";
            $emailResult = sendCongratulationsEmail($member);
            
            if ($emailResult['success']) {
                echo "✅ Email sent successfully!<br>";
                echo "Result: " . htmlspecialchars($emailResult['message'] ?? 'Success') . "<br>";
                
                // Update database
                $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
                $updateResult = $updateStmt->execute([$member['id']]);
                
                if ($updateResult) {
                    echo "✅ Member status updated to 'Accepted'<br>";
                    echo "<p style='color: green;'><strong>SUCCESS:</strong> Member accepted successfully!</p>";
                } else {
                    echo "❌ Failed to update member status<br>";
                }
            } else {
                echo "❌ Email failed to send<br>";
                echo "Error: " . htmlspecialchars($emailResult['error'] ?? 'Unknown error') . "<br>";
            }
        } else {
            echo "❌ Email function not found<br>";
        }
    } else {
        echo "❌ handle_application.php not found<br>";
    }
    
} catch (Exception $e) {
    echo "<h3>❌ Error Found:</h3>";
    echo "<p style='color: red;'>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>This is likely the cause of your 500 error.</p>";
}

echo "</div>";
?>
