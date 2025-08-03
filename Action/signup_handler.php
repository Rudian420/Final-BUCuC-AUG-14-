<?php
session_start();
require_once '../Database/db.php';

header('Content-Type: application/json');

$database = new Database();
$conn = $database->createConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form data
        $fullName = trim($_POST['signup-name']);
        $universityId = trim($_POST['signup-id']);
        $email = trim($_POST['signup-main-email']);
        $gsuiteEmail = trim($_POST['signup-gsuite-email'] ?? '');
        $password = $_POST['signup-password'];
        $department = trim($_POST['signup-department']);
        $phone = trim($_POST['signup-phone']);
        $semester = $_POST['signup-semester'];
        $gender = $_POST['signup-gender'];
        $dateOfBirth = $_POST['signup-dob'];
        $facebookUrl = trim($_POST['signup-facebook'] ?? '');
        $membershipStatus = $_POST['membership-status'];
        $motivation = trim($_POST['signup-motivation']);
        $eventCategory = trim($_POST['signup-event-category']);
        
        // Validation
        if (empty($fullName) || empty($universityId) || empty($email) || empty($password) || 
            empty($department) || empty($phone) || empty($semester) || empty($gender) || 
            empty($dateOfBirth) || empty($membershipStatus) || empty($motivation) || empty($eventCategory)) {
            echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
            exit();
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email format']);
            exit();
        }
        
        if (strlen($password) < 6) {
            echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters long']);
            exit();
        }
        
        // Check if email already exists
        $checkEmailSql = "SELECT id FROM members WHERE email = :email";
        $checkEmailStmt = $conn->prepare($checkEmailSql);
        $checkEmailStmt->bindParam(':email', $email);
        $checkEmailStmt->execute();
        
        if ($checkEmailStmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Email already registered']);
            exit();
        }
        
        // Check if university ID already exists
        $checkIdSql = "SELECT id FROM members WHERE university_id = :university_id";
        $checkIdStmt = $conn->prepare($checkIdSql);
        $checkIdStmt->bindParam(':university_id', $universityId);
        $checkIdStmt->execute();
        
        if ($checkIdStmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'University ID already registered']);
            exit();
        }
        
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new member
        $sql = "INSERT INTO members (
            full_name, university_id, email, gsuite_email, password, department, 
            phone, semester, gender, date_of_birth, facebook_url, membership_status, 
            event_category, gender_tracking, motivation
        ) VALUES (
            :full_name, :university_id, :email, :gsuite_email, :password, :department,
            :phone, :semester, :gender, :date_of_birth, :facebook_url, :membership_status, 
            :event_category, :gender_tracking, :motivation
        )";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':university_id', $universityId);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gsuite_email', $gsuiteEmail);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':semester', $semester);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':date_of_birth', $dateOfBirth);
        $stmt->bindParam(':facebook_url', $facebookUrl);
        $stmt->bindParam(':membership_status', $membershipStatus);
        $stmt->bindParam(':event_category', $eventCategory);
        $stmt->bindParam(':gender_tracking', $gender);
        $stmt->bindParam(':motivation', $motivation);
        
        if ($stmt->execute()) {
            echo json_encode([
                'success' => true, 
                'message' => 'Registration successful! You can now login with your email and password.'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Registration failed. Please try again.']);
        }
        
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error. Please try again.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 