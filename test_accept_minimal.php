<?php
/**
 * Minimal accept test - only database update, no email
 * This will help isolate if the issue is with email or database
 */

session_start();
if (!isset($_SESSION["admin"])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Set content type for JSON response
header('Content-Type: application/json');

// Get POST data
$action = $_POST['action'] ?? '';
$memberId = $_POST['member_id'] ?? 0;

if (empty($action) || empty($memberId)) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit();
}

if ($action !== 'accept') {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit();
}

try {
    require_once 'Database/db.php';
    $database = new Database();
    $pdo = $database->createConnection();
    
    // Get member details
    $stmt = $pdo->prepare("SELECT * FROM members WHERE id = ? AND membership_status = 'New_member'");
    $stmt->execute([$memberId]);
    $member = $stmt->fetch();

    if (!$member) {
        echo json_encode(['success' => false, 'message' => 'Member not found or already processed']);
        exit();
    }

    // Update member status to Accepted
    $updateStmt = $pdo->prepare("UPDATE members SET membership_status = 'Accepted', updated_at = CURRENT_TIMESTAMP WHERE id = ?");
    $updateResult = $updateStmt->execute([$memberId]);

    if ($updateResult) {
        echo json_encode([
            'success' => true,
            'message' => 'Member accepted successfully (no email sent)',
            'member_name' => $member['full_name'],
            'email_success' => false,
            'sheets_success' => false
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update member status in database']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>
