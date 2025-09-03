<?php
/**
 * Test if the form is working correctly
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    die("Error: No admin session. Please log in first.");
}

echo "<h2>Test Form Working</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px;'>";

echo "<h3>Request Method: " . $_SERVER['REQUEST_METHOD'] . "</h3>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>✅ Form submitted successfully as POST!</h3>";
    echo "<h3>POST Data:</h3>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    $action = $_POST['action'] ?? '';
    $memberId = $_POST['member_id'] ?? 0;
    
    if ($action === 'accept' && $memberId > 0) {
        echo "<p style='color: green;'><strong>SUCCESS:</strong> Form data is correct!</p>";
        echo "<p>Action: " . htmlspecialchars($action) . "</p>";
        echo "<p>Member ID: " . htmlspecialchars($memberId) . "</p>";
        
        // Test the actual accept functionality
        try {
            require_once 'Database/db.php';
            require_once 'config/email_config.php';
            require_once 'vendor/autoload.php';
            
            $database = new Database();
            $pdo = $database->createConnection();
            
            $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ? AND membership_status = 'New_member'");
            $stmt->execute([$memberId]);
            $member = $stmt->fetch();
            
            if ($member) {
                echo "<p style='color: green;'>✅ Member found: " . htmlspecialchars($member['full_name']) . "</p>";
                
                // Test email function
                if (file_exists('handle_application.php')) {
                    ob_start();
                    include 'handle_application.php';
                    ob_end_clean();
                    
                    if (function_exists('sendCongratulationsEmail')) {
                        $emailResult = sendCongratulationsEmail($member);
                        
                        if ($emailResult['success']) {
                            echo "<p style='color: green;'>✅ Email sent successfully!</p>";
                            
                            // Update database
                            $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
                            $updateResult = $updateStmt->execute([$memberId]);
                            
                            if ($updateResult) {
                                echo "<p style='color: green;'><strong>🎉 COMPLETE SUCCESS:</strong> Member accepted successfully!</p>";
                            } else {
                                echo "<p style='color: red;'>❌ Failed to update database</p>";
                            }
                        } else {
                            echo "<p style='color: red;'>❌ Email failed: " . htmlspecialchars($emailResult['error'] ?? 'Unknown error') . "</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>❌ Email function not found</p>";
                    }
                } else {
                    echo "<p style='color: red;'>❌ handle_application.php not found</p>";
                }
            } else {
                echo "<p style='color: red;'>❌ Member not found or already processed</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Invalid form data</p>";
    }
} else {
    echo "<h3>Test Form:</h3>";
    echo "<form method='POST' action='test_form_working.php' style='margin: 20px 0;'>";
    echo "<input type='hidden' name='action' value='accept'>";
    echo "<input type='hidden' name='member_id' value='1'>";
    echo "<button type='submit' style='background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px;'>Test Accept Form</button>";
    echo "</form>";
}

echo "</div>";
?>
