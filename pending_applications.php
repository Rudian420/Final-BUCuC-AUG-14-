<?php 
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin-login.php");
    exit(); 
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
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-pending {
            background: linear-gradient(45deg, #ffc107, #ffeb3b);
            color: #333;
        }
        
        .filters-section {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
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
            <div class="stats-row">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number" id="totalApplications">12</div>
                            <div class="stat-label">Total Applications</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number" id="pendingApplications">8</div>
                            <div class="stat-label">Pending Review</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number" id="acceptedToday">3</div>
                            <div class="stat-label">Accepted Today</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <div class="stat-number" id="rejectedToday">1</div>
                            <div class="stat-label">Rejected Today</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filters Section -->
            <div class="filters-section">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" placeholder="Search by name, ID, or email..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-light active" data-filter="all">All</button>
                            <button type="button" class="btn btn-outline-light" data-filter="pending">Pending</button>
                            <button type="button" class="btn btn-outline-light" data-filter="today">Today's Applications</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Applications Table -->
            <div class="applications-table">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" id="applicationsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>University ID</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Phone</th>
                                <th>Applied Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="applicationsTableBody">
                            <!-- Sample Data - Replace with dynamic data -->
                            <tr data-status="pending">
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <span class="text-white fw-bold">JD</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-bold">John Doe</div>
                                            <small class="text-muted">Male</small>
                                        </div>
                                    </div>
                                </td>
                                <td>20101234</td>
                                <td>john.doe@g.bracu.ac.bd</td>
                                <td>CSE</td>
                                <td>+880 1712 345678</td>
                                <td>
                                    <div>Jan 15, 2025</div>
                                    <small class="text-muted">2 days ago</small>
                                </td>
                                <td>
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-accept btn-sm" onclick="acceptApplication(1, 'John Doe')">
                                            <i class="fas fa-check me-1"></i>Accept
                                        </button>
                                        <button class="btn btn-reject btn-sm" onclick="rejectApplication(1, 'John Doe')">
                                            <i class="fas fa-times me-1"></i>Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-status="pending">
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <span class="text-white fw-bold">JS</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Jane Smith</div>
                                            <small class="text-muted">Female</small>
                                        </div>
                                    </div>
                                </td>
                                <td>20101235</td>
                                <td>jane.smith@g.bracu.ac.bd</td>
                                <td>BBA</td>
                                <td>+880 1812 345679</td>
                                <td>
                                    <div>Jan 14, 2025</div>
                                    <small class="text-muted">3 days ago</small>
                                </td>
                                <td>
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-accept btn-sm" onclick="acceptApplication(2, 'Jane Smith')">
                                            <i class="fas fa-check me-1"></i>Accept
                                        </button>
                                        <button class="btn btn-reject btn-sm" onclick="rejectApplication(2, 'Jane Smith')">
                                            <i class="fas fa-times me-1"></i>Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-status="pending">
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <span class="text-dark fw-bold">MR</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Mike Rahman</div>
                                            <small class="text-muted">Male</small>
                                        </div>
                                    </div>
                                </td>
                                <td>20101236</td>
                                <td>mike.rahman@g.bracu.ac.bd</td>
                                <td>EEE</td>
                                <td>+880 1912 345680</td>
                                <td>
                                    <div>Jan 13, 2025</div>
                                    <small class="text-muted">4 days ago</small>
                                </td>
                                <td>
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-accept btn-sm" onclick="acceptApplication(3, 'Mike Rahman')">
                                            <i class="fas fa-check me-1"></i>Accept
                                        </button>
                                        <button class="btn btn-reject btn-sm" onclick="rejectApplication(3, 'Mike Rahman')">
                                            <i class="fas fa-times me-1"></i>Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-status="pending">
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <span class="text-white fw-bold">SA</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Sarah Ahmed</div>
                                            <small class="text-muted">Female</small>
                                        </div>
                                    </div>
                                </td>
                                <td>20101237</td>
                                <td>sarah.ahmed@g.bracu.ac.bd</td>
                                <td>ENG</td>
                                <td>+880 1612 345681</td>
                                <td>
                                    <div>Jan 12, 2025</div>
                                    <small class="text-muted">5 days ago</small>
                                </td>
                                <td>
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-accept btn-sm" onclick="acceptApplication(4, 'Sarah Ahmed')">
                                            <i class="fas fa-check me-1"></i>Accept
                                        </button>
                                        <button class="btn btn-reject btn-sm" onclick="rejectApplication(4, 'Sarah Ahmed')">
                                            <i class="fas fa-times me-1"></i>Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-status="pending">
                                <td>5</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <span class="text-white fw-bold">AH</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Ali Hassan</div>
                                            <small class="text-muted">Male</small>
                                        </div>
                                    </div>
                                </td>
                                <td>20101238</td>
                                <td>ali.hassan@g.bracu.ac.bd</td>
                                <td>CSE</td>
                                <td>+880 1512 345682</td>
                                <td>
                                    <div>Jan 11, 2025</div>
                                    <small class="text-muted">6 days ago</small>
                                </td>
                                <td>
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-accept btn-sm" onclick="acceptApplication(5, 'Ali Hassan')">
                                            <i class="fas fa-check me-1"></i>Accept
                                        </button>
                                        <button class="btn btn-reject btn-sm" onclick="rejectApplication(5, 'Ali Hassan')">
                                            <i class="fas fa-times me-1"></i>Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
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
    
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
        // Application Management Functions
        function acceptApplication(id, name) {
            if (confirm(`Are you sure you want to accept ${name}'s application?`)) {
                // Show loading state
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Accepting...';
                button.disabled = true;
                
                // Simulate API call - replace with actual backend call
                setTimeout(() => {
                    // Remove the row from table
                    const row = button.closest('tr');
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    
                    setTimeout(() => {
                        row.remove();
                        updateStatistics();
                        showNotification(`${name}'s application has been accepted!`, 'success');
                    }, 300);
                }, 1000);
            }
        }
        
        function rejectApplication(id, name) {
            if (confirm(`Are you sure you want to reject ${name}'s application? This action cannot be undone.`)) {
                // Show loading state
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Rejecting...';
                button.disabled = true;
                
                // Simulate API call - replace with actual backend call
                setTimeout(() => {
                    // Remove the row from table
                    const row = button.closest('tr');
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-20px)';
                    
                    setTimeout(() => {
                        row.remove();
                        updateStatistics();
                        showNotification(`${name}'s application has been rejected.`, 'warning');
                    }, 300);
                }, 1000);
            }
        }
        
        // Update statistics
        function updateStatistics() {
            const rows = document.querySelectorAll('#applicationsTableBody tr');
            const totalApplications = rows.length;
            
            document.getElementById('totalApplications').textContent = totalApplications;
            document.getElementById('pendingApplications').textContent = totalApplications;
            
            // Show no applications message if table is empty
            if (totalApplications === 0) {
                document.querySelector('.applications-table').classList.add('d-none');
                document.getElementById('noApplicationsMessage').classList.remove('d-none');
            }
        }
        
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#applicationsTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Filter functionality
        document.querySelectorAll('[data-filter]').forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                const rows = document.querySelectorAll('#applicationsTableBody tr');
                
                rows.forEach(row => {
                    if (filter === 'all') {
                        row.style.display = '';
                    } else if (filter === 'pending') {
                        const status = row.dataset.status;
                        row.style.display = status === 'pending' ? '' : 'none';
                    } else if (filter === 'today') {
                        // For demo purposes, show all. In real implementation, filter by date
                        row.style.display = '';
                    }
                });
            });
        });
        
        // Show notification
        function showNotification(message, type = 'success') {
            // Create notification element
            const notification = document.createElement('div');
            
            // Set colors based on type
            let alertClass, backgroundColor, textColor, borderColor, iconClass;
            switch(type) {
                case 'success':
                    alertClass = 'alert-success';
                    backgroundColor = '#28a745'; // Green background
                    textColor = '#ffffff';
                    borderColor = '#1e7e34';
                    iconClass = 'check-circle';
                    break;
                case 'error':
                case 'danger':
                    alertClass = 'alert-danger';
                    backgroundColor = '#dc3545'; // Red background
                    textColor = '#ffffff';
                    borderColor = '#bd2130';
                    iconClass = 'times-circle';
                    break;
                case 'warning':
                    alertClass = 'alert-warning';
                    backgroundColor = '#ffc107'; // Yellow background
                    textColor = '#212529';
                    borderColor = '#d39e00';
                    iconClass = 'exclamation-triangle';
                    break;
                case 'info':
                    alertClass = 'alert-info';
                    backgroundColor = '#17a2b8'; // Blue background
                    textColor = '#ffffff';
                    borderColor = '#138496';
                    iconClass = 'info-circle';
                    break;
                default:
                    alertClass = 'alert-success';
                    backgroundColor = '#28a745'; // Default to green
                    textColor = '#ffffff';
                    borderColor = '#1e7e34';
                    iconClass = 'check-circle';
            }
            
            notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
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
        
        // Add smooth animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#applicationsTableBody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    row.style.transition = 'all 0.6s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            showNotification('Applications loaded successfully!', 'success');
        });
        
        // Add hover effects to action buttons
        document.addEventListener('mouseover', function(e) {
            if (e.target.classList.contains('btn-accept') || e.target.classList.contains('btn-reject')) {
                e.target.style.transform = 'translateY(-2px)';
            }
        });
        
        document.addEventListener('mouseout', function(e) {
            if (e.target.classList.contains('btn-accept') || e.target.classList.contains('btn-reject')) {
                e.target.style.transform = 'translateY(0)';
            }
        });
    </script>
</body>
</html>
