<?php
/**
 * Test version of accept handler - no email sending
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
        // Test version - just update database without email
        $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $updateResult = $updateStmt->execute([$memberId]);
        
        if ($updateResult) {
            $finalMessage = 'Member accepted successfully (TEST VERSION - no email sent)';
            header("Location: pending_applications.php?success=" . urlencode($finalMessage));
        } else {
            header("Location: pending_applications.php?error=" . urlencode('Failed to update member status in database'));
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
    error_log("Error in handle_application_test.php: " . $e->getMessage());
    header("Location: pending_applications.php?error=" . urlencode('Server error: ' . $e->getMessage()));
}
?>
