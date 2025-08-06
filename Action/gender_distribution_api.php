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
    // Check if members table exists
    $checkTable = "SHOW TABLES LIKE 'members'";
    $tableCheck = $conn->prepare($checkTable);
    $tableCheck->execute();
    
    if (!$tableCheck->fetch()) {
        // Return dummy data if table doesn't exist
        echo json_encode([
            'success' => true,
            'data' => [
                ['gender' => 'Male', 'count' => 3, 'color' => '#36A2EB'],
                ['gender' => 'Female', 'count' => 4, 'color' => '#FF6384'],
                ['gender' => 'Other', 'count' => 1, 'color' => '#9966FF']
            ],
            'summary' => [
                'total_males' => 3,
                'total_females' => 4,
                'total_others' => 1,
                'total_members' => 8
            ],
            'message' => 'Using dummy data - members table not found'
        ]);
        exit();
    }
    
    // Get total gender distribution across all event categories
    $sql = "SELECT 
                gender_tracking,
                COUNT(*) as count
            FROM members 
            WHERE status = 'active' AND gender_tracking IS NOT NULL
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
    
    // If no data found, create dummy data
    if (empty($data)) {
        $chartData = [
            ['gender' => 'Male', 'count' => 3, 'color' => '#36A2EB'],
            ['gender' => 'Female', 'count' => 4, 'color' => '#FF6384'],
            ['gender' => 'Other', 'count' => 1, 'color' => '#9966FF']
        ];
    } else {
        foreach ($data as $row) {
            $gender = $row['gender_tracking'];
            $count = (int)$row['count'];
            
            $chartData[] = [
                'gender' => $gender,
                'count' => $count,
                'color' => $genderColors[$gender] ?? '#999999'
            ];
        }
    }
    
    // Get summary statistics
    if (empty($data)) {
        // Use dummy summary data
        $summary = [
            'total_males' => 3,
            'total_females' => 4,
            'total_others' => 1,
            'total_members' => 8
        ];
        $message = 'Using dummy data - no active members found';
    } else {
        $summarySql = "SELECT 
                            SUM(CASE WHEN gender_tracking = 'Male' THEN 1 ELSE 0 END) as total_males,
                            SUM(CASE WHEN gender_tracking = 'Female' THEN 1 ELSE 0 END) as total_females,
                            SUM(CASE WHEN gender_tracking = 'Other' THEN 1 ELSE 0 END) as total_others,
                            COUNT(*) as total_members
                        FROM members 
                        WHERE status = 'active' AND gender_tracking IS NOT NULL";
        
        $summaryStmt = $conn->prepare($summarySql);
        $summaryStmt->execute();
        $summaryData = $summaryStmt->fetch(PDO::FETCH_ASSOC);
        
        $summary = [
            'total_males' => (int)$summaryData['total_males'],
            'total_females' => (int)$summaryData['total_females'],
            'total_others' => (int)$summaryData['total_others'],
            'total_members' => (int)$summaryData['total_members']
        ];
        $message = 'Data loaded successfully';
    }
    
    $response = [
        'success' => true,
        'data' => $chartData,
        'summary' => $summary,
        'message' => $message
    ];
    
    echo json_encode($response);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?> 