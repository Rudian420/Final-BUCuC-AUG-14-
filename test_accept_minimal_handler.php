<?php
/**
 * Minimal accept handler to test basic functionality
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    die("Error: No admin session. Please log in first.");
}

// Check POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Error: Invalid request method. Must be POST.");
}

// Get POST data
$action = $_POST['action'] ?? '';
$memberId = $_POST['member_id'] ?? 0;

echo "<h2>Minimal Accept Handler Test</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px;'>";

echo "<h3>Request Data:</h3>";
echo "Action: " . htmlspecialchars($action) . "<br>";
echo "Member ID: " . htmlspecialchars($memberId) . "<br>";

if (empty($action) || empty($memberId)) {
    die("Error: Missing required parameters");
}

if ($action !== 'accept') {
    die("Error: Invalid action");
}

try {
    // Test database connection
    echo "<h3>Testing Database Connection:</h3>";
    require_once 'Database/db.php';
    $database = new Database();
    $pdo = $database->createConnection();
    echo "✅ Database connection successful<br>";
    
    // Test member lookup
    echo "<h3>Testing Member Lookup:</h3>";
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ? AND membership_status = 'New_member'");
    $stmt->execute([$memberId]);
    $member = $stmt->fetch();
    
    if (!$member) {
        die("Error: Member not found or already processed");
    }
    
    echo "✅ Member found: " . htmlspecialchars($member['full_name']) . "<br>";
    echo "G-Suite Email: " . htmlspecialchars($member['gsuite_email']) . "<br>";
    
    // Test email configuration
    echo "<h3>Testing Email Configuration:</h3>";
    require_once 'config/email_config.php';
    echo "✅ Email config loaded<br>";
    echo "SMTP Host: " . SMTP_HOST . "<br>";
    echo "SMTP Username: " . SMTP_USERNAME . "<br>";
    
    // Test PHPMailer
    echo "<h3>Testing PHPMailer:</h3>";
    require_once 'vendor/autoload.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    echo "✅ PHPMailer instance created<br>";
    
    echo "<h3>✅ All Tests Passed!</h3>";
    echo "<p>The basic functionality should work. The 500 error might be caused by:</p>";
    echo "<ul>";
    echo "<li>Specific email sending issues</li>";
    echo "<li>Google Sheets integration problems</li>";
    echo "<li>File permission issues</li>";
    echo "<li>Server configuration differences</li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<h3>❌ Error Found:</h3>";
    echo "<p style='color: red;'>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>This is likely the cause of your 500 error.</p>";
}

echo "</div>";
?>
