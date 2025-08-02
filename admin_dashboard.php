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
                <a href="#" class="nav-item" data-section="admin-management">
                    <i class="fas fa-user-shield"></i>
                    Admin Management
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
        </div>
        
        <!-- Admin Management Section -->
        <div class="admin-management-section" id="admin-management-section" style="display: none;">
            <div class="chart-header">
                <h3 class="chart-title">Admin Management</h3>
                <button class="btn btn-primary" id="addAdminBtn">
                    <i class="fas fa-plus"></i> Add New Admin
                </button>
            </div>
            
            <div class="admin-list">
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
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

        <!-- Add Admin Modal -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title" id="addAdminModalLabel">Add New Admin</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addAdminForm">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="newAdminUsername" class="form-label">Username</label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" id="newAdminUsername" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="newAdminEmail" class="form-label">Email</label>
                                <input type="email" class="form-control bg-dark text-light border-secondary" id="newAdminEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="newAdminPassword" class="form-label">Password</label>
                                <input type="password" class="form-control bg-dark text-light border-secondary" id="newAdminPassword" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="newAdminRole" class="form-label">Role</label>
                                <select class="form-select bg-dark text-light border-secondary" id="newAdminRole" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Admin</button>
                        </div>
                    </form>
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
    </div>
    
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
                document.querySelectorAll('.chart-controls button').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const period = this.dataset.period;
                updateMemberChart(period);
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
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
                
                const section = this.dataset.section;
                
                // Hide all sections
                document.querySelectorAll('.stats-grid, .charts-section, .activities-section, .admin-management-section').forEach(el => {
                    el.style.display = 'none';
                });
                
                // Show selected section
                if (section === 'overview') {
                    document.querySelector('.stats-grid').style.display = 'grid';
                    document.querySelector('.charts-section').style.display = 'grid';
                    document.querySelector('.activities-section').style.display = 'block';
                } else if (section === 'admin-management') {
                    document.getElementById('admin-management-section').style.display = 'block';
                    loadAdminList();
                } else {
                    showNotification(`Navigating to ${section} section...`, 'success');
                }
            });
        });
        
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
        
        // Admin Management Functions
        function loadAdminList() {
            fetch('admin_actions.php?action=get_admins')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayAdminList(data.admins);
                    } else {
                        showNotification('Failed to load admin list', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error loading admin list', 'error');
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
                    <td><span class="badge bg-${admin.role === 'super_admin' ? 'danger' : 'primary'}">${admin.role}</span></td>
                    <td><span class="badge bg-${admin.status === 'active' ? 'success' : 'secondary'}">${admin.status}</span></td>
                    <td>${new Date(admin.created_at).toLocaleDateString()}</td>
                    <td>
                        <button class="btn btn-sm btn-warning me-1" onclick="editAdmin(${admin.id})" ${admin.id == 1 ? 'disabled' : ''}>
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteAdmin(${admin.id})" ${admin.id == 1 ? 'disabled' : ''}>
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function deleteAdmin(adminId) {
            if (confirm('Are you sure you want to delete this admin? This action cannot be undone.')) {
                fetch('admin_actions.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=delete_admin&admin_id=${adminId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Admin deleted successfully', 'success');
                        loadAdminList();
                    } else {
                        showNotification(data.message || 'Failed to delete admin', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting admin', 'error');
                });
            }
        }

        function editAdmin(adminId) {
            // For now, just show a notification. You can implement edit functionality later
            showNotification('Edit functionality will be implemented soon', 'info');
        }

        // Add Admin Modal Event Listeners
        document.getElementById('addAdminBtn').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('addAdminModal'));
            modal.show();
        });

        document.getElementById('addAdminForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'add_admin');
            
            fetch('admin_actions.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Admin added successfully', 'success');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addAdminModal'));
                    modal.hide();
                    this.reset();
                    loadAdminList();
                } else {
                    showNotification(data.message || 'Failed to add admin', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error adding admin', 'error');
            });
        });

        // Initialize everything when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initCharts();
            showNotification('Dashboard loaded successfully!', 'success');
        });
    </script>
</body>
</html> 