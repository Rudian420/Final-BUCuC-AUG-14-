<?php
session_start();
require_once '../Database/db.php';

header('Content-Type: application/json');

// Check if user is admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Access denied']);
    exit();
}

$database = new Database();
$conn = $database->createConnection();

try {
    // Get total gender distribution across all event categories
    $sql = "SELECT 
                gender_tracking,
                COUNT(*) as count
            FROM members 
            WHERE status = 'active'
            GROUP BY gender_tracking
            ORDER BY count DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Format data for Chart.js - total gender counts only
    $chartData = [];
    $genderColors = [
        'Male' => '#36A2EB',    // Blue
        'Female' => '#FF6384',   // Pink
        'Other' => '#9966FF'     // Purple
    ];
    
    foreach ($data as $row) {
        $gender = $row['gender_tracking'];
        $count = (int)$row['count'];
        
        $chartData[] = [
            'gender' => $gender,
            'count' => $count,
            'color' => $genderColors[$gender] ?? '#999999'
        ];
    }
    
    // Get summary statistics
    $summarySql = "SELECT 
                        SUM(CASE WHEN gender_tracking = 'Male' THEN 1 ELSE 0 END) as total_males,
                        SUM(CASE WHEN gender_tracking = 'Female' THEN 1 ELSE 0 END) as total_females,
                        SUM(CASE WHEN gender_tracking = 'Other' THEN 1 ELSE 0 END) as total_others,
                        COUNT(*) as total_members
                    FROM members 
                    WHERE status = 'active'";
    
    $summaryStmt = $conn->prepare($summarySql);
    $summaryStmt->execute();
    $summary = $summaryStmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $chartData,
        'summary' => [
            'total_males' => (int)$summary['total_males'],
            'total_females' => (int)$summary['total_females'],
            'total_others' => (int)$summary['total_others'],
            'total_members' => (int)$summary['total_members']
        ]
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?> 