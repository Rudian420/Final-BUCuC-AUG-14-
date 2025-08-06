<?php 
session_start();
print_r($_SESSION);
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
    <title>Admin Dashboard - BRAC University Cultural Club</title>
    
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/templatemo-festava-live.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="AdminCss/Dashboard.css">
</head>
<body>
    <!-- Mobile Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="images/logo.png" alt="BUCuC Logo">
                <h3>BUCuC</h3>
            </div>
            <p class="sidebar-subtitle">Admin Dashboard</p>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Dashboard</div>
                <a href="#" class="nav-item active" data-section="overview">
                    <i class="fas fa-tachometer-alt"></i>
                    Overview
                </a>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Management</div>
                <a href="#" class="nav-item" data-section="members">
                    <i class="fas fa-users"></i>
                    Members
                </a>
                <a href="#" class="nav-item" data-section="events">
                    <i class="fas fa-calendar-alt"></i>
                    Events
                </a>
                <a href="#" class="nav-item" data-section="performances">
                    <i class="fas fa-music"></i>
                    Performances
                </a>
                <a href="#" class="nav-item" data-section="analytics">
                    <i class="fas fa-chart-line"></i>
                    Analytics
                </a>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Settings</div>
                <a href="#" class="nav-item" data-section="general">
                    <i class="fas fa-cog"></i>
                    General
                </a>
                <a href="#" class="nav-item" data-section="profile">
                    <i class="fas fa-user-cog"></i>
                    Profile
                </a>
                <?php if ($_SESSION['admin_role'] === 'main_admin'): ?>
                <a href="#" class="nav-item" data-section="admin-management">
                    <i class="fas fa-users-cog"></i>
                    Admin Management
                </a>
                <?php endif; ?>
                <a href="logout.php" class="nav-item" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="header-left">
                <h1>Cultural Club Dashboard</h1>
                <p>Welcome back, <?php echo $_SESSION['username']; ?>! Here's what's happening with your club.</p>
            </div>
            
            <div class="header-right">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search..." id="searchInput">
                </div>
                
                <div class="user-profile" id="userProfile">
                    <div class="user-avatar">A</div>
                    <span>
                <?php 

                    $nameParts = explode(" ", $_SESSION["username"]);
                
                    echo htmlspecialchars($nameParts[0]);
                    ?>
                
            </span>

                </div>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card" data-stat="members">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">1,247</div>
                <div class="stat-label">Total Members</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +12% this month
                </div>
            </div>
            
            <div class="stat-card" data-stat="events">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-number">24</div>
                <div class="stat-label">Events This Month</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +3 new events
                </div>
            </div>
            
            <div class="stat-card" data-stat="performances">
                <div class="stat-icon">
                    <i class="fas fa-music"></i>
                </div>
                <div class="stat-number">156</div>
                <div class="stat-label">Performances</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +8% this week
                </div>
            </div>
            
                         <div class="stat-card" data-stat="sponsors">
                 <div class="stat-icon">
                     <i class="fas fa-handshake"></i>
                 </div>
                 <div class="stat-number">৳12,45,000</div>
                 <div class="stat-label">Total Sponsors</div>
                 <div class="stat-change positive">
                     <i class="fas fa-arrow-up"></i>
                     +15% this quarter
                 </div>
             </div>
        </div>
        
        <!-- Charts Section -->
        <div class="charts-section">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Member Growth</h3>
                                         <div class="chart-controls">
                         <button class="active" data-period="1Y">1Y</button>
                         <button data-period="2Y">2Y</button>
                         <button data-period="3Y">3Y</button>
                     </div>
                </div>
                                 <div style="position: relative; height: 420px; width: 100%;">
                     <canvas id="memberGrowthChart"></canvas>
                 </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Event Categories</h3>
                </div>
                                 <div style="position: relative; height: 420px; width: 100%;">
                     <canvas id="eventCategoriesChart"></canvas>
                 </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Gender Distribution by Event Category</h3>
                </div>
                <div style="position: relative; height: 420px; width: 100%;">
                    <canvas id="genderDistributionChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Recent Activities -->
        <div class="activities-section">
            <div class="chart-header">
                <h3 class="chart-title">Recent Activities</h3>
            </div>
            
            <div class="activity-item" data-activity="member">
                <div class="activity-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="activity-content">
                    <h4>New Member Registration</h4>
                    <p>Sarah Ahmed joined the Music Club</p>
                </div>
                <div class="activity-time">2 hours ago</div>
            </div>
            
            <div class="activity-item" data-activity="event">
                <div class="activity-icon">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div class="activity-content">
                    <h4>Event Created</h4>
                    <p>Pop Night event scheduled for next week</p>
                </div>
                <div class="activity-time">4 hours ago</div>
            </div>
            
            <div class="activity-item" data-activity="performance">
                <div class="activity-icon">
                    <i class="fas fa-music"></i>
                </div>
                <div class="activity-content">
                    <h4>Performance Added</h4>
                    <p>Rock Band performance added to upcoming event</p>
                </div>
                <div class="activity-time">6 hours ago</div>
            </div>
            
            <div class="activity-item" data-activity="analytics">
                <div class="activity-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="activity-content">
                    <h4>Analytics Updated</h4>
                    <p>Monthly performance report generated</p>
                </div>
                <div class="activity-time">1 day ago</div>
            </div>
        </div>

        <!-- Admin Management Section (Only visible to Main Admin) -->
        <?php if ($_SESSION['admin_role'] === 'main_admin'): ?>
        <div class="admin-management-section" id="admin-management-section" style="display: none; margin-top: 2rem;">
            <div class="chart-header">
                <h3 class="chart-title">Admin Account Management</h3>
                <button class="btn btn-primary" id="addAdminBtn">
                    <i class="fas fa-plus"></i> Add New Admin
                </button>
            </div>
            
            <div class="admin-list-container">
                <div class="table-responsive">
                    <table class="table table-dark table-hover" id="adminTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="adminTableBody">
                            <!-- Admin data will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Admin Management Modals -->
    <?php if ($_SESSION['admin_role'] === 'main_admin'): ?>
    <!-- Add Admin Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="addAdminModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Add New Admin
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addAdminForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="newAdminName" class="form-label">Admin Name</label>
                            <input type="text" class="form-control bg-dark text-light border-secondary" id="newAdminName" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="newAdminEmail" class="form-label">Gmail Address</label>
                            <input type="email" class="form-control bg-dark text-light border-secondary" id="newAdminEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="newAdminPassword" class="form-label">Password</label>
                            <input type="password" class="form-control bg-dark text-light border-secondary" id="newAdminPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="newAdminRole" class="form-label">Role</label>
                            <select class="form-select bg-dark text-light border-secondary" id="newAdminRole" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="main_admin">Main Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="editAdminModalLabel">
                        <i class="fas fa-user-edit me-2"></i>Edit Admin Password
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAdminForm">
                    <div class="modal-body">
                        <input type="hidden" id="editAdminId" name="admin_id">
                        <div class="mb-3">
                            <label class="form-label">Admin Name</label>
                            <input type="text" class="form-control bg-dark text-light border-secondary" id="editAdminName" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control bg-dark text-light border-secondary" id="editAdminEmail" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editAdminPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control bg-dark text-light border-secondary" id="editAdminPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control bg-dark text-light border-secondary" id="confirmPassword" required>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-key me-2"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Admin Modal -->
    <div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-labelledby="deleteAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-danger">
                    <h5 class="modal-title" id="deleteAdminModalLabel">
                        <i class="fas fa-user-times me-2"></i>Delete Admin
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteAdminId" name="admin_id">
                    <p>Are you sure you want to delete the admin account for:</p>
                    <div class="alert alert-danger">
                        <strong id="deleteAdminName"></strong><br>
                        <small id="deleteAdminEmail"></small>
                    </div>
                    <p class="text-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        This action cannot be undone!
                    </p>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash me-2"></i>Delete Admin
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Notification -->
    <div class="notification" id="notification"></div>
    
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
        let memberChart;
        let eventChart;
        
        // Initialize Charts
        function initCharts() {
                         // Member Growth Chart - styled like the image
             const memberCtx = document.getElementById('memberGrowthChart').getContext('2d');
             memberChart = new Chart(memberCtx, {
                 type: 'line',
                 data: {
                     labels: ['Fall 2024', 'Spring 2025', 'Summer 2025'],
                     datasets: [{
                         label: 'Members',
                         data: [1180, 1250, 0],
                         borderColor: '#51cf66',
                         backgroundColor: 'rgba(81, 207, 102, 0.1)',
                         borderWidth: 2,
                         fill: false,
                         tension: 0.4,
                         pointBackgroundColor: '#51cf66',
                         pointBorderColor: '#51cf66',
                         pointRadius: 4,
                         pointHoverRadius: 6
                     }]
                 },
                 options: {
                     responsive: true,
                     maintainAspectRatio: false,
                     layout: {
                         padding: {
                             top: 10,
                             bottom: 20,
                             left: 10,
                             right: 10
                         }
                     },
                     interaction: {
                         intersect: false,
                         mode: 'index'
                     },
                     plugins: {
                         legend: {
                             display: false
                         },
                         tooltip: {
                             backgroundColor: 'rgba(0, 0, 0, 0.8)',
                             titleColor: '#fff',
                             bodyColor: '#fff',
                             borderColor: '#51cf66',
                             borderWidth: 1,
                             cornerRadius: 8,
                             displayColors: false,
                             callbacks: {
                                 label: function(context) {
                                     return `Members: ${context.parsed.y}`;
                                 }
                             }
                         }
                     },
                     scales: {
                         y: {
                             beginAtZero: true,
                             min: 0,
                             max: 1300,
                             grid: {
                                 color: 'rgba(255, 255, 255, 0.1)',
                                 drawBorder: false
                             },
                             ticks: {
                                 color: '#fff',
                                 font: {
                                     size: 12
                                 },
                                 stepSize: 100
                             }
                         },
                                                   x: {
                              grid: {
                                  display: false
                              },
                              ticks: {
                                  color: '#fff',
                                  font: {
                                      size: 10
                                  },
                                  maxRotation: 45,
                                  minRotation: 45
                              }
                          }
                     },
                     elements: {
                         point: {
                             hoverBackgroundColor: '#51cf66',
                             hoverBorderColor: '#fff',
                             hoverBorderWidth: 2
                         }
                     }
                 }
             });
            
            // Event Categories Chart
            const eventCtx = document.getElementById('eventCategoriesChart').getContext('2d');
            eventChart = new Chart(eventCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Music', 'Dance', 'Drama', 'Art', 'Poetry'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            '#f3d35c',
                            '#e76f2c',
                            '#28a745',
                            '#17a2b8',
                            '#6f42c1'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 10,
                            bottom: 20,
                            left: 10,
                            right: 10
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#ccc',
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        }
        
        // Initialize Gender Distribution Chart
        function initGenderDistributionChart() {
            const genderCtx = document.getElementById('genderDistributionChart').getContext('2d');
            
            // Fetch data from API
            fetch('Action/gender_distribution_api.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        createGenderChart(genderCtx, data.data);
                    }
                })
                .catch(error => {
                    console.error('Error loading gender distribution data:', error);
                    // Fallback data
                    createGenderChart(genderCtx, [
                        {gender: 'Male', count: 2, color: '#36A2EB'},
                        {gender: 'Female', count: 3, color: '#FF6384'},
                        {gender: 'Other', count: 1, color: '#9966FF'}
                    ]);
                });
        }
        
        // Create Gender Distribution Chart
        function createGenderChart(ctx, data) {
            const labels = data.map(item => item.gender);
            const counts = data.map(item => item.count);
            const colors = data.map(item => item.color);
            
            if (window.genderChart) {
                window.genderChart.destroy();
            }
            
            window.genderChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: counts,
                        backgroundColor: colors,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 10,
                            bottom: 20,
                            left: 10,
                            right: 10
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#ccc',
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#51cf66',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    const gender = context.label;
                                    const count = context.parsed;
                                    const genderIcon = gender === 'Male' ? '♂' : gender === 'Female' ? '♀' : '⚧';
                                    return `${gender}: ${count} ${genderIcon}`;
                                }
                            }
                        }
                    },
                    cutout: '60%'
                }
            });
        }
        
        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification ${type} show`;
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
        
        // Mobile Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
        });
        
        // Chart Controls
        document.querySelectorAll('.chart-controls button').forEach(button => {
            button.addEventListener('click', function() {
                const parent = this.closest('.chart-controls');
                parent.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const period = this.dataset.period;
                
                if (period) {
                    updateMemberChart(period);
                }
            });
        });
        
                 // Update member chart based on period
         function updateMemberChart(period) {
             let labels, data;
             
             switch(period) {
                 case '1Y':
                     labels = ['Fall 2024', 'Spring 2025', 'Summer 2025'];
                     data = [1180, 1250, 0];
                     break;
                 case '2Y':
                     labels = ['Spring 2023', 'Summer 2023', 'Fall 2023', 'Spring 2024', 'Summer 2024', 'Fall 2024', 'Spring 2025', 'Summer 2025'];
                     data = [850, 920, 980, 1050, 1120, 1180, 1250, 0];
                     break;
                 case '3Y':
                     labels = ['Spring 2022', 'Summer 2022', 'Fall 2022', 'Spring 2023', 'Summer 2023', 'Fall 2023', 'Spring 2024', 'Summer 2024', 'Fall 2024', 'Spring 2025', 'Summer 2025'];
                     data = [720, 780, 820, 850, 920, 980, 1050, 1120, 1180, 1250, 0];
                     break;
             }
             
             memberChart.data.labels = labels;
             memberChart.data.datasets[0].data = data;
             memberChart.update();
         }
         

        
        // Navigation items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (this.getAttribute('href') === 'logout.php') return;
                
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
                
                const section = this.dataset.section;
                showSection(section);
                showNotification(`Navigating to ${section} section...`, 'success');
            });
        });

        function showSection(sectionName) {
            // Hide all sections
            document.querySelectorAll('.main-content > div').forEach(div => {
                if (div.id && div.id.includes('section')) {
                    div.style.display = 'none';
                }
            });
            
            // Show the selected section
            const targetSection = document.getElementById(sectionName + '-section');
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        }
        
        // Stats cards
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('click', function() {
                const stat = this.dataset.stat;
                showNotification(`Viewing detailed ${stat} statistics...`, 'success');
            });
        });
        
        // Activity items
        document.querySelectorAll('.activity-item').forEach(item => {
            item.addEventListener('click', function() {
                const activity = this.dataset.activity;
                showNotification(`Viewing ${activity} details...`, 'success');
            });
        });
        
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            if (query.length > 2) {
                showNotification(`Searching for "${query}"...`, 'success');
            }
        });
        
        // User profile
        document.getElementById('userProfile').addEventListener('click', function() {
            showNotification('Opening user profile...', 'success');
        });
        
        // Initialize everything when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initCharts();
            initGenderDistributionChart();
            showNotification('Dashboard loaded successfully!', 'success');
            
            // Initialize admin management if user is main admin
            <?php if ($_SESSION['admin_role'] === 'main_admin'): ?>
            initAdminManagement();
            <?php endif; ?>
        });

        // Admin Management Functions
        <?php if ($_SESSION['admin_role'] === 'main_admin'): ?>
        function initAdminManagement() {
            // Load admin list when admin management section is shown
            document.querySelector('[data-section="admin-management"]').addEventListener('click', function() {
                loadAdminList();
            });
            
            // Add admin button
            document.getElementById('addAdminBtn').addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('addAdminModal'));
                modal.show();
            });
            
            // Add admin form submission
            document.getElementById('addAdminForm').addEventListener('submit', function(e) {
                e.preventDefault();
                createAdmin();
            });
            
            // Edit admin form submission
            document.getElementById('editAdminForm').addEventListener('submit', function(e) {
                e.preventDefault();
                updateAdminPassword();
            });
            
            // Confirm delete button
            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                deleteAdmin();
            });
        }

        function loadAdminList() {
            fetch('Action/admin_management.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_admins'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayAdminList(data.data);
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to load admin list', 'error');
            });
        }

        function displayAdminList(admins) {
            const tbody = document.getElementById('adminTableBody');
            tbody.innerHTML = '';
            
            admins.forEach(admin => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${admin.id}</td>
                    <td>${admin.username}</td>
                    <td>${admin.email}</td>
                    <td>
                        <span class="badge ${admin.role === 'main_admin' ? 'bg-danger' : 'bg-primary'}">
                            ${admin.role === 'main_admin' ? 'Main Admin' : 'Admin'}
                        </span>
                    </td>
                    <td>
                        <span class="badge ${admin.status === 'active' ? 'bg-success' : 'bg-secondary'}">
                            ${admin.status}
                        </span>
                    </td>
                    <td>${new Date(admin.created_at).toLocaleDateString()}</td>
                    <td>
                        <button class="btn btn-sm btn-warning me-1" onclick="editAdmin(${admin.id}, '${admin.username}', '${admin.email}')">
                            <i class="fas fa-key"></i>
                        </button>
                        ${admin.id != <?php echo $_SESSION['admin_id']; ?> ? 
                            `<button class="btn btn-sm btn-danger" onclick="deleteAdminPrompt(${admin.id}, '${admin.username}', '${admin.email}')">
                                <i class="fas fa-trash"></i>
                            </button>` : 
                            '<span class="text-muted">Current User</span>'
                        }
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function createAdmin() {
            const formData = new FormData(document.getElementById('addAdminForm'));
            formData.append('action', 'create_admin');
            
            fetch('Action/admin_management.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    document.getElementById('addAdminForm').reset();
                    bootstrap.Modal.getInstance(document.getElementById('addAdminModal')).hide();
                    loadAdminList();
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to create admin', 'error');
            });
        }

        function editAdmin(adminId, username, email) {
            document.getElementById('editAdminId').value = adminId;
            document.getElementById('editAdminName').value = username;
            document.getElementById('editAdminEmail').value = email;
            document.getElementById('editAdminPassword').value = '';
            document.getElementById('confirmPassword').value = '';
            
            const modal = new bootstrap.Modal(document.getElementById('editAdminModal'));
            modal.show();
        }

        function updateAdminPassword() {
            const password = document.getElementById('editAdminPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                showNotification('Passwords do not match', 'error');
                return;
            }
            
            const formData = new FormData(document.getElementById('editAdminForm'));
            formData.append('action', 'update_password');
            
            fetch('Action/admin_management.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    bootstrap.Modal.getInstance(document.getElementById('editAdminModal')).hide();
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to update password', 'error');
            });
        }

        function deleteAdminPrompt(adminId, username, email) {
            document.getElementById('deleteAdminId').value = adminId;
            document.getElementById('deleteAdminName').textContent = username;
            document.getElementById('deleteAdminEmail').textContent = email;
            
            const modal = new bootstrap.Modal(document.getElementById('deleteAdminModal'));
            modal.show();
        }

        function deleteAdmin() {
            const adminId = document.getElementById('deleteAdminId').value;
            const formData = new FormData();
            formData.append('action', 'delete_admin');
            formData.append('admin_id', adminId);
            
            fetch('Action/admin_management.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    bootstrap.Modal.getInstance(document.getElementById('deleteAdminModal')).hide();
                    loadAdminList();
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to delete admin', 'error');
            });
        }
        <?php endif; ?>
    </script>
</body>
</html> 