<?php
session_start();
require 'Database/db.php';

// Check if user is logged in as admin
if (!isset($_SESSION["admin"])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

$database = new Database();
$conn = $database->createConnection();

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    
    if ($action === 'get_admins') {
        getAdmins($conn);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'add_admin':
            addAdmin($conn);
            break;
        case 'delete_admin':
            deleteAdmin($conn);
            break;
        case 'edit_admin':
            editAdmin($conn);
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
}

function getAdmins($conn) {
    try {
        $sql = "SELECT id, username, email, role, status, created_at FROM adminpanel ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode(['success' => true, 'admins' => $admins]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function addAdmin($conn) {
    try {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'admin';
        
        // Validation
        if (empty($username) || empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            return;
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            return;
        }
        
        if (strlen($password) < 6) {
            echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters long']);
            return;
        }
        
        // Check if username or email already exists
        $checkSql = "SELECT id FROM adminpanel WHERE username = :username OR email = :email";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':username', $username);
        $checkStmt->bindParam(':email', $email);
        $checkStmt->execute();
        
        if ($checkStmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'Username or email already exists']);
            return;
        }
        
        // Insert new admin
        $sql = "INSERT INTO adminpanel (username, email, password, role, status) VALUES (:username, :email, :password, :role, 'active')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Admin added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add admin']);
        }
        
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function deleteAdmin($conn) {
    try {
        $adminId = (int)($_POST['admin_id'] ?? 0);
        
        // Prevent deletion of the first admin (ID 1)
        if ($adminId == 1) {
            echo json_encode(['success' => false, 'message' => 'Cannot delete the primary admin account']);
            return;
        }
        
        // Prevent self-deletion
        if ($adminId == $_SESSION['admin_id'] ?? 0) {
            echo json_encode(['success' => false, 'message' => 'Cannot delete your own account']);
            return;
        }
        
        $sql = "DELETE FROM adminpanel WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $adminId);
        
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Admin deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Admin not found or already deleted']);
        }
        
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function editAdmin($conn) {
    // This function can be implemented later for editing admin details
    echo json_encode(['success' => false, 'message' => 'Edit functionality not implemented yet']);
}
?> 