<?php
/**
 * Debug version of accept handler to show what's happening
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

echo "<h2>Debug Accept Handler</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px;'>";

echo "<h3>Request Method: " . $_SERVER['REQUEST_METHOD'] . "</h3>";
echo "<h3>POST Data:</h3>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<h3>GET Data:</h3>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

// Check admin session
if (!isset($_SESSION["admin"])) {
    echo "<p style='color: red;'>❌ No admin session. Please log in first.</p>";
    echo "<p><a href='admin-login.php'>Go to Login</a></p>";
    exit;
}

echo "<p style='color: green;'>✅ Admin session exists</p>";

// Check POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<p style='color: red;'>❌ Invalid request method. Must be POST.</p>";
    echo "<p>Current method: " . $_SERVER['REQUEST_METHOD'] . "</p>";
    exit;
}

echo "<p style='color: green;'>✅ Request method is POST</p>";

// Get POST data
$action = $_POST['action'] ?? '';
$memberId = $_POST['member_id'] ?? 0;

echo "<h3>Action: " . htmlspecialchars($action) . "</h3>";
echo "<h3>Member ID: " . htmlspecialchars($memberId) . "</h3>";

if (empty($action) || empty($memberId)) {
    echo "<p style='color: red;'>❌ Missing required parameters</p>";
    echo "<p>Action: '" . htmlspecialchars($action) . "'</p>";
    echo "<p>Member ID: '" . htmlspecialchars($memberId) . "'</p>";
    exit;
}

echo "<p style='color: green;'>✅ Required parameters present</p>";

try {
    // Load dependencies
    require_once 'Database/db.php';
    require_once 'config/email_config.php';
    require_once 'vendor/autoload.php';
    
    echo "<p style='color: green;'>✅ Dependencies loaded</p>";
    
    // Database connection
    $database = new Database();
    $pdo = $database->createConnection();
    
    echo "<p style='color: green;'>✅ Database connected</p>";
    
    // Get member details
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ? AND membership_status = 'New_member'");
    $stmt->execute([$memberId]);
    $member = $stmt->fetch();
    
    if (!$member) {
        echo "<p style='color: red;'>❌ Member not found or already processed</p>";
        exit;
    }
    
    echo "<p style='color: green;'>✅ Member found: " . htmlspecialchars($member['full_name']) . "</p>";
    echo "<p>G-Suite Email: " . htmlspecialchars($member['gsuite_email']) . "</p>";
    
    if ($action === 'accept') {
        echo "<h3>Processing Accept Action</h3>";
        
        // Test email sending
        echo "<h4>Testing Email Sending:</h4>";
        
        // Include the email function
        if (file_exists('handle_application.php')) {
            ob_start();
            include 'handle_application.php';
            ob_end_clean();
            
            if (function_exists('sendCongratulationsEmail')) {
                echo "<p style='color: green;'>✅ Email function exists</p>";
                
                $emailResult = sendCongratulationsEmail($member);
                
                if ($emailResult['success']) {
                    echo "<p style='color: green;'>✅ Email sent successfully!</p>";
                    
                    // Update database
                    $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
                    $updateResult = $updateStmt->execute([$memberId]);
                    
                    if ($updateResult) {
                        echo "<p style='color: green;'>✅ Member status updated to 'Accepted'</p>";
                        echo "<p><strong>SUCCESS:</strong> Member accepted successfully!</p>";
                    } else {
                        echo "<p style='color: red;'>❌ Failed to update member status</p>";
                    }
                } else {
                    echo "<p style='color: red;'>❌ Email failed to send</p>";
                    echo "<p>Error: " . htmlspecialchars($emailResult['error'] ?? 'Unknown error') . "</p>";
                }
            } else {
                echo "<p style='color: red;'>❌ Email function not found</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ handle_application.php not found</p>";
        }
        
    } elseif ($action === 'reject') {
        echo "<h3>Processing Reject Action</h3>";
        
        // Update member status to Rejected
        $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Rejected', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $updateResult = $updateStmt->execute([$memberId]);
        
        if ($updateResult) {
            echo "<p style='color: green;'>✅ Member rejected successfully</p>";
        } else {
            echo "<p style='color: red;'>❌ Failed to update member status</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Invalid action: " . htmlspecialchars($action) . "</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "</div>";
?>
