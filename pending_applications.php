<?php 
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin-login.php");
    exit(); 
}

require_once 'Database/db.php';

// Fetch members data
try {
    $database = new Database();
    $pdo = $database->createConnection();
    
    // Get all members (you can add WHERE clause for specific status if needed)
    $stmt = $pdo->query("SELECT * FROM members ORDER BY created_at DESC");
    $members = $stmt->fetchAll();
    
    // Calculate statistics
    $totalApplications = count($members);
    $pendingApplications = count(array_filter($members, function($member) {
        return $member['membership_status'] == 'New_member';
    }));
    
    // For demo purposes, let's assume some recent statistics
    $acceptedToday = 0;
    $rejectedToday = 0;
    
    // Get today's applications
    $today = date('Y-m-d');
    foreach ($members as $member) {
        if (date('Y-m-d', strtotime($member['created_at'])) == $today) {
            if ($member['membership_status'] == 'Accepted') {
                $acceptedToday++;
            }
        }
    }
    
} catch (Exception $e) {
    $members = [];
    $totalApplications = 0;
    $pendingApplications = 0;
    $acceptedToday = 0;
    $rejectedToday = 0;
    $error_message = "Error fetching data: " . $e->getMessage();
}

// Function to get initials from full name
function getInitials($name) {
    $words = explode(' ', trim($name));
    $initials = '';
    foreach ($words as $word) {
        if (!empty($word)) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
    }
    return substr($initials, 0, 2); // Limit to 2 characters
}

// Function to format date
function formatDate($date) {
    $datetime = new DateTime($date);
    return $datetime->format('M d, Y');
}

// Function to get time ago
function getTimeAgo($date) {
    $datetime = new DateTime($date);
    $now = new DateTime();
    $diff = $now->diff($datetime);
    
    if ($diff->days == 0) {
        return 'Today';
    } elseif ($diff->days == 1) {
        return '1 day ago';
    } else {
        return $diff->days . ' days ago';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Applications - BRAC University Cultural Club</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/templatemo-festava-live.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <link rel="stylesheet" href="AdminCss/Dashboard.css">
    
    <style>
        .applications-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 2rem 0;
        }
        
        .applications-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin: 0 1rem;
        }
        
        .applications-title {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        
        .applications-subtitle {
            color: #ccc;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            text-align: center;
        }
        
        .back-btn {
            position: absolute;
            top: 2rem;
            left: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            text-decoration: none;
            transform: translateX(-3px);
        }
        
        .applications-table {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .table-dark {
            --bs-table-bg: transparent;
        }
        
        .table-dark thead th {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-weight: 600;
        }
        
        .table-dark td {
            border-color: rgba(255, 255, 255, 0.1);
            color: #ccc;
            vertical-align: middle;
        }
        
        .table-dark tbody tr:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .truncate {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .btn-accept {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-accept:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(40, 167, 69, 0.3);
            color: white;
        }
        
        .btn-reject {
            background: linear-gradient(45deg, #dc3545, #e74c3c);
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(220, 53, 69, 0.3);
            color: white;
        }
        
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .status-pending {
            background: linear-gradient(45deg, #ffc107, #ffeb3b);
            color: #333;
        }
        
        .status-accepted {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: #fff;
        }
        
        .search-box {
            position: relative;
            max-width: 300px;
        }
        
        .search-box input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 25px;
            padding: 0.8rem 1rem 0.8rem 3rem;
        }
        
        .search-box input::placeholder {
            color: #ccc;
        }
        
        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
        }
        
        .stats-row {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #51cf66;
        }
        
        .stat-label {
            color: #ccc;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
        
        /* Clear All Applications Button Styling */
        .btn-clear-all {
            background: linear-gradient(45deg, #dc3545, #b52d3c);
            border: none;
            border-radius: 30px;
            padding: 1rem 2rem;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-clear-all:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
            color: white;
            background: linear-gradient(45deg, #c82333, #a02834);
        }
        
        .btn-clear-all:active {
            transform: translateY(-1px);
        }
        
        .btn-clear-all::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-clear-all:hover::before {
            left: 100%;
        }
        
        /* Set Venue Button Styling */
        .btn-set-venue {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            border-radius: 30px;
            padding: 1rem 2rem;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }
        
        .btn-set-venue:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
            color: white;
            background: linear-gradient(45deg, #218838, #1e7e34);
            text-decoration: none;
        }
        
        .btn-set-venue:active {
            transform: translateY(-1px);
        }
        
        .btn-set-venue::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-set-venue:hover::before {
            left: 100%;
        }
        
        .clear-all-warning {
            color: #ffc107;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            opacity: 0.9;
        }
        
        .clear-all-section {
            background: rgba(220, 53, 69, 0.1);
            border: 2px dashed rgba(220, 53, 69, 0.3);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        /* Modal Styling */
        .modal-content {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
        }
        
        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        
        .modal-body {
            color: #ccc;
        }
        
        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #dc3545;
            color: #fff;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        
        .form-control::placeholder {
            color: #999;
        }
        
        @media (max-width: 768px) {
            .applications-card {
                margin: 0 0.5rem;
                padding: 1.5rem;
            }
            
            .applications-title {
                font-size: 2rem;
            }
            
            .table-responsive {
                font-size: 0.85rem;
            }
            
            .btn-accept, .btn-reject {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
            
            .btn-clear-all {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <a href="admin_dashboard.php" class="back-btn">
        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
    </a>
    
    <!-- Applications Container -->
    <div class="applications-container">
        <div class="applications-card">
            <h1 class="applications-title">
                <i class="fas fa-user-plus mb-3"></i><br>
                Pending Applications
            </h1>
            <p class="applications-subtitle">
                Review and manage member applications
            </p>
            
            <!-- Statistics Row -->
        
            
            <!-- Clear All Applications and Set Venue Section -->
            <div class="clear-all-section text-center mb-4">
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <button class="btn btn-clear-all" id="clearAllBtn" onclick="showClearAllModal()">
                        <i class="fas fa-trash-alt me-2"></i>Clear
                    </button>
                    <a href="set_venue.php" class="btn btn-set-venue">
                        <i class="fas fa-map-marker-alt me-2"></i>Set Venue
                    </a>
                </div>
                <p class="clear-all-warning mt-2">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    <strong>Warning:</strong> Clear will permanently delete ALL applications from the database!
                </p>
            </div>
            
            <!-- Applications Table -->
            <div class="applications-table">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" id="applicationsTable">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>University ID</th>
                                <th>Email</th>
                                <th>G-Suite Email</th>
                                <th>Department</th>
                                <th>Phone</th>
                                <th>Semester</th>
                                <th>Gender</th>
                                <th>Facebook</th>
                                <th>Priorities</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="applicationsTableBody">
                            <?php if (!empty($members)): ?>
                                <?php 
                                // Array of background colors for avatar circles
                                $bgColors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info', 'bg-danger', 'bg-secondary'];
                                $colorIndex = 0;
                                
                                foreach ($members as $member): 
                                    $bgColor = $bgColors[$colorIndex % count($bgColors)];
                                    $textColor = ($bgColor == 'bg-warning') ? 'text-dark' : 'text-white';
                                    $colorIndex++;
                                    
                                    $initials = getInitials($member['full_name']);
                                    $statusClass = ($member['membership_status'] == 'New_member') ? 'pending' : 'accepted';
                                    $statusText = ($member['membership_status'] == 'New_member') ? 'Pending' : 'Accepted';
                                    $statusIcon = ($member['membership_status'] == 'New_member') ? 'clock' : 'check-circle';
                                ?>
                                <tr data-status="<?php echo htmlspecialchars($statusClass); ?>">
                                    <td class="truncate"><?php echo htmlspecialchars($member['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($member['university_id']); ?></td>
                                    <td><?php echo htmlspecialchars($member['email']); ?></td>
                                    <td><?php echo htmlspecialchars($member['gsuite_email']); ?></td>
                                    <td><?php echo htmlspecialchars($member['department']); ?></td>
                                    <td><?php echo htmlspecialchars($member['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($member['semester']); ?></td>
                                    <td><?php echo htmlspecialchars($member['gender']); ?></td>
                                    <td><a href="<?php echo htmlspecialchars($member['facebook_url']); ?>" target="_blank">Facebook</a></td>
                                    <td><?php echo htmlspecialchars($member['firstPriority'] . ', ' . $member['secondPriority']); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $statusClass; ?>">
                                            <i class="fas fa-<?php echo $statusIcon; ?> me-1"></i><?php echo $statusText; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($member['membership_status'] == 'New_member'): ?>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-accept btn-sm" data-member-id="<?php echo $member['id']; ?>" data-member-name="<?php echo htmlspecialchars($member['full_name']); ?>">
                                                <i class="fas fa-check me-1"></i>Accept
                                            </button>
                                            <button class="btn btn-reject btn-sm" data-member-id="<?php echo $member['id']; ?>" data-member-name="<?php echo htmlspecialchars($member['full_name']); ?>">
                                                <i class="fas fa-times me-1"></i>Reject
                                            </button>
                                        </div>
                                        <?php else: ?>
                                        <span class="text-success">
                                            <i class="fas fa-check-circle me-1"></i>Processed
                                        </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                        No members found in the database.
                                        <?php if (isset($error_message)): ?>
                                            <br><small class="text-danger"><?php echo htmlspecialchars($error_message); ?></small>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- No Applications Message -->
            <div class="text-center mt-4 d-none" id="noApplicationsMessage">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No Applications Found</h4>
                <p class="text-muted">There are no pending applications matching your criteria.</p>
            </div>
        </div>
    </div>
    
    <!-- Clear All Applications Modal -->
    <div class="modal fade" id="clearAllModal" tabindex="-1" aria-labelledby="clearAllModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="clearAllModalLabel">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Confirm Clear All Applications
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                        <i class="fas fa-skull-crossbones fa-2x me-3"></i>
                        <div>
                            <strong>DANGER ZONE!</strong><br>
                            This action will permanently delete ALL applications from the database.
                        </div>
                    </div>
                    
                    <p><strong>What will be deleted:</strong></p>
                    <ul class="text-warning">
                        <li>All pending applications</li>
                        <li>All accepted applications</li>
                        <li>All member data including names, emails, phone numbers</li>
                        <li>All application history</li>
                    </ul>
                    
                    <p><strong class="text-danger">This action CANNOT be undone!</strong></p>
                    
                    <p>To confirm this destructive action, please type exactly:<br>
                    <code class="text-warning">CLEAR ALL APPLICATIONS</code></p>
                    
                    <input type="text" class="form-control mt-2" id="confirmationInput" 
                           placeholder="Type: CLEAR ALL APPLICATIONS">
                    
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            This operation will be logged for audit purposes.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmClearAllBtn" disabled>
                        <i class="fas fa-trash-alt me-1"></i>Clear All Applications
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
        // Handle Accept Button Click
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-accept') || e.target.closest('.btn-accept')) {
                const button = e.target.closest('.btn-accept');
                const memberId = button.getAttribute('data-member-id');
                const memberName = button.getAttribute('data-member-name');
                
                if (confirm(`Are you sure you want to accept ${memberName}'s application?\n\nThis will:\n- Update their status to 'Accepted'\n- Send a congratulations email to their G-Suite address`)) {
                    handleAction('accept', memberId, memberName, button);
                }
            }
        });
        
        // Handle Reject Button Click
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-reject') || e.target.closest('.btn-reject')) {
                const button = e.target.closest('.btn-reject');
                const memberId = button.getAttribute('data-member-id');
                const memberName = button.getAttribute('data-member-name');
                
                if (confirm(`Are you sure you want to reject ${memberName}'s application?\n\nWARNING: This will permanently delete their record from the database!\n\nThis action cannot be undone.`)) {
                    handleAction('reject', memberId, memberName, button);
                }
            }
        });
        
        // Handle Accept/Reject Actions
        function handleAction(action, memberId, memberName, button) {
            // Show loading state
            const originalContent = button.innerHTML;
            const loadingText = action === 'accept' ? 
                '<i class="fas fa-spinner fa-spin me-1"></i>Accepting...' : 
                '<i class="fas fa-spinner fa-spin me-1"></i>Rejecting...';
            
            button.innerHTML = loadingText;
            button.disabled = true;
            
            // Make AJAX request
            fetch('Action/application_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: action,
                    member_id: parseInt(memberId)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    showNotification(data.message, 'success');
                    
                    // Remove the row from the table or update it
                    const row = button.closest('tr');
                    if (action === 'reject') {
                        // Animate row removal
                        row.style.transition = 'all 0.3s ease';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(-20px)';
                        
                        setTimeout(() => {
                            row.remove();
                            updateStatistics();
                        }, 300);
                    } else if (action === 'accept') {
                        // Update the row to show accepted status
                        const statusCell = row.querySelector('.status-badge');
                        const actionCell = row.querySelector('td:last-child');
                        
                        statusCell.className = 'status-badge status-accepted';
                        statusCell.innerHTML = '<i class="fas fa-check-circle me-1"></i>Accepted';
                        
                        actionCell.innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-1"></i>Processed</span>';
                        
                        // Update row data status
                        row.setAttribute('data-status', 'accepted');
                        
                        updateStatistics();
                    }
                } else {
                    // Show error notification
                    showNotification(data.message, 'error');
                    
                    // Restore button
                    button.innerHTML = originalContent;
                    button.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred while processing the request.', 'error');
                
                // Restore button
                button.innerHTML = originalContent;
                button.disabled = false;
            });
        }
        
        // Update Statistics
        function updateStatistics() {
            const rows = document.querySelectorAll('#applicationsTableBody tr[data-status]');
            const totalApplications = rows.length;
            const pendingApplications = document.querySelectorAll('#applicationsTableBody tr[data-status="pending"]').length;
            
            document.getElementById('totalApplications').textContent = totalApplications;
            document.getElementById('pendingApplications').textContent = pendingApplications;
            
            // Show no applications message if no rows left
            if (totalApplications === 0) {
                document.querySelector('.applications-table').style.display = 'none';
                document.getElementById('noApplicationsMessage').classList.remove('d-none');
            }
        }
        
        // Show Notification
        function showNotification(message, type = 'success') {
            // Remove any existing notifications
            const existingNotifications = document.querySelectorAll('.notification-toast');
            existingNotifications.forEach(notif => notif.remove());
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'notification-toast alert alert-dismissible fade show position-fixed';
            
            // Set colors and icon based on type
            let backgroundColor, textColor, borderColor, iconClass;
            switch(type) {
                case 'success':
                    backgroundColor = '#28a745';
                    textColor = '#ffffff';
                    borderColor = '#1e7e34';
                    iconClass = 'check-circle';
                    break;
                case 'error':
                case 'danger':
                    backgroundColor = '#dc3545';
                    textColor = '#ffffff';
                    borderColor = '#bd2130';
                    iconClass = 'times-circle';
                    break;
                case 'warning':
                    backgroundColor = '#ffc107';
                    textColor = '#212529';
                    borderColor = '#d39e00';
                    iconClass = 'exclamation-triangle';
                    break;
                case 'info':
                    backgroundColor = '#17a2b8';
                    textColor = '#ffffff';
                    borderColor = '#138496';
                    iconClass = 'info-circle';
                    break;
                default:
                    backgroundColor = '#28a745';
                    textColor = '#ffffff';
                    borderColor = '#1e7e34';
                    iconClass = 'check-circle';
            }
            
            notification.style.cssText = `
                top: 20px;
                right: 20px;
                z-index: 1050;
                max-width: 350px;
                box-shadow: 0 8px 15px rgba(0,0,0,0.2);
                background-color: ${backgroundColor} !important;
                color: ${textColor} !important;
                border-left: 4px solid ${borderColor} !important;
                border-radius: 8px;
                padding: 12px 16px;
            `;
            
            notification.innerHTML = `
                <i class="fas fa-${iconClass} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: brightness(0) invert(${textColor === '#ffffff' ? '1' : '0'});"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }
        
        // Show Clear All Modal
        function showClearAllModal() {
            const modal = new bootstrap.Modal(document.getElementById('clearAllModal'));
            modal.show();
            
            // Reset modal state
            document.getElementById('confirmationInput').value = '';
            document.getElementById('confirmClearAllBtn').disabled = true;
        }
        
        // Handle confirmation input
        document.getElementById('confirmationInput').addEventListener('input', function(e) {
            const confirmBtn = document.getElementById('confirmClearAllBtn');
            const inputValue = e.target.value.trim();
            
            if (inputValue === 'CLEAR ALL APPLICATIONS') {
                confirmBtn.disabled = false;
                confirmBtn.classList.remove('btn-danger');
                confirmBtn.classList.add('btn-warning');
                confirmBtn.innerHTML = '<i class="fas fa-check me-1"></i>Confirmed - Clear All Applications';
            } else {
                confirmBtn.disabled = true;
                confirmBtn.classList.remove('btn-warning');
                confirmBtn.classList.add('btn-danger');
                confirmBtn.innerHTML = '<i class="fas fa-trash-alt me-1"></i>Clear';
            }
        });
        
        // Handle Clear All Confirmation
        document.getElementById('confirmClearAllBtn').addEventListener('click', function() {
            const confirmationText = document.getElementById('confirmationInput').value.trim();
            
            if (confirmationText !== 'CLEAR ALL APPLICATIONS') {
                showNotification('Please type "CLEAR ALL APPLICATIONS" exactly to confirm.', 'error');
                return;
            }
            
            // Show loading state
            const button = this;
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Clearing All Applications...';
            button.disabled = true;
            
            // Make AJAX request
            fetch('Action/clear_all_applications.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'clear_all_applications',
                    confirmation: confirmationText
                })
            })
            .then(response => {
                // First check if the response is ok
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.text(); // Get as text first
            })
            .then(text => {
                // Try to parse as JSON
                let data;
                try {
                    data = JSON.parse(text);
                } catch (parseError) {
                    console.error('Response is not valid JSON:', text);
                    throw new Error('Server returned invalid response: ' + text.substring(0, 100));
                }
                
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('clearAllModal'));
                    modal.hide();
                    
                    // Show success notification and reload page
                    showNotification(data.message, 'success');
                    
                    // Simply reload the page to show updated state
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    
                } else {
                    // Show error notification with details if available
                    let errorMessage = data.message;
                    if (data.error_details) {
                        errorMessage += ' (Debug: ' + data.error_details + ')';
                    }
                    showNotification(errorMessage, 'error');
                }
                
                // Restore button
                button.innerHTML = originalContent;
                button.disabled = false;
            })
            .catch(error => {
                console.error('Clear all error:', error);
                showNotification('Error: ' + error.message, 'error');
                
                // Restore button
                button.innerHTML = originalContent;
                button.disabled = false;
            });
        });
    </script>
    
</body>
</html>
