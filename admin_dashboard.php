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
                <a href="#" class="nav-item" data-section="applications">
                    <i class="fas fa-user-plus"></i>
                    Applications
                    <span class="badge bg-warning ms-2" id="pendingApplicationsBadge" style="display: none;">0</span>
                </a>
                <a href="#" class="nav-item" data-section="events">
                    <i class="fas fa-calendar-alt"></i>
                    Events
                </a>
                <a href="#" class="nav-item" data-section="dashboard-update">
                    <i class="fas fa-cogs"></i>
                    Dashboard Updates
                </a>
             
              
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Settings</div>
               
            
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
                <div class="stat-number" id="totalMembersCount">Loading...</div>
                <div class="stat-label">Total Members</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    <span id="activeMembersCount">Active: Loading...</span>
                </div>
            </div>
            
            <div class="stat-card" data-stat="applications">
                <div class="stat-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="stat-number" id="pendingApplicationsCount">Loading...</div>
                <div class="stat-label">Pending Applications</div>
                <div class="stat-change" id="applicationsChange">
                    <i class="fas fa-clock"></i>
                    Awaiting Review
                </div>
            </div>
            
            <div class="stat-card" data-stat="categories">
                <div class="stat-icon">
                    <i class="fas fa-music"></i>
                </div>
                <div class="stat-number">5</div>
                <div class="stat-change positive">
                    <i class="fas fa-palette"></i>
                    Music, Dance, Drama, Art, Poetry
                </div>
            </div>
            
            <div class="stat-card" data-stat="gender">
                <div class="stat-icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <div class="stat-number" id="genderRatio">Loading...</div>
                <div class="stat-label">Gender Distribution</div>
                <div class="stat-change positive">
                    <i class="fas fa-chart-pie"></i>
                    <span id="genderBreakdown">Loading...</span>
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

        <div class="applications-section" id="applications-section" style="display: none; margin-top: 2rem;">
            <div class="chart-header">
                <h3 class="chart-title">Member Applications</h3>
                <div class="d-flex gap-3 align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="applicationSystemToggle">
                        <label class="form-check-label text-white" for="applicationSystemToggle">
                            Application System
                        </label>
                    </div>
                    <button class="btn btn-primary" id="refreshApplicationsBtn">
                        <i class="fas fa-sync-alt"></i> Refresh
                    </button>
                </div>
            </div>
            
            <div class="applications-container">
                <div class="alert alert-info" id="noApplicationsMessage" style="display: none;">
                    <i class="fas fa-info-circle me-2"></i>
                    No pending applications found.
                </div>
                
                <div class="row" id="applicationsList">
                    <!-- Applications will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Dashboard Update Section -->
        <div class="dashboard-update-section" id="dashboard-update-section" style="display: none; margin-top: 2rem;">
            <div class="chart-header">
                <h3 class="chart-title">Dashboard Data Management</h3>
                <div class="d-flex gap-3 align-items-center">
                    <p class="text-muted mb-0">Update dashboard statistics and data for testing and management purposes</p>
                    <button class="btn btn-secondary btn-sm" id="testModalBtn" style="margin-right: 10px;">
                        <i class="fas fa-bug"></i> Test Modal
                    </button>
                    <button class="btn btn-primary" id="refreshDashboardStatsBtn">
                        <i class="fas fa-sync-alt"></i> Refresh Data
                    </button>
                </div>
            </div>
            
            <div class="row mt-4">
                <!-- Total Members Update -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="update-card">
                        <div class="update-card-header">
                            <h5><i class="fas fa-users me-2 text-warning"></i>Total Members</h5>
                            <span class="current-value" id="currentMembersValue">Loading...</span>
                        </div>
                        <div class="update-card-body">
                            <button class="btn btn-primary btn-sm" onclick="openUpdateModal('members')">
                                <i class="fas fa-edit me-1"></i> Update Members
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pending Applications Update -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="update-card">
                        <div class="update-card-header">
                            <h5><i class="fas fa-user-plus me-2 text-info"></i>Pending Applications</h5>
                            <span class="current-value" id="currentApplicationsValue">Loading...</span>
                        </div>
                        <div class="update-card-body">
                            <button class="btn btn-info btn-sm" onclick="openUpdateModal('applications')">
                                <i class="fas fa-edit me-1"></i> Update Applications
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Performance Data Update -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="update-card">
                        <div class="update-card-header">
                            <h5><i class="fas fa-chart-line me-2 text-success"></i>Performance Metrics</h5>
                            <span class="current-value" id="currentPerformanceValue">5 Categories</span>
                        </div>
                        <div class="update-card-body">
                            <button class="btn btn-success btn-sm" onclick="openUpdateModal('performance')">
                                <i class="fas fa-edit me-1"></i> Update Performance
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Gender Distribution Update -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="update-card">
                        <div class="update-card-header">
                            <h5><i class="fas fa-balance-scale me-2 text-warning"></i>Gender Distribution</h5>
                            <span class="current-value" id="currentGenderValue">Loading...</span>
                        </div>
                        <div class="update-card-body">
                            <button class="btn btn-warning btn-sm" onclick="openUpdateModal('gender')">
                                <i class="fas fa-edit me-1"></i> Update Distribution
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- Dashboard Update Modal -->
    <div class="modal fade" id="dashboardUpdateModal" tabindex="-1" aria-labelledby="dashboardUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="dashboardUpdateModalLabel">
                        <i class="fas fa-cogs me-2"></i>Update Dashboard Data
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="dashboardUpdateForm">
                    <div class="modal-body">
                        <input type="hidden" id="updateType" name="update_type">
                        
                        <!-- Members Update Form -->
                        <div id="membersUpdateForm" class="update-form-section" style="display: none;">
                            <h6 class="text-warning mb-3"><i class="fas fa-users me-2"></i>Update Total Members</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="memberOperation" class="form-label">Operation</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="memberOperation" name="operation">
                                        <option value="add">Add Members</option>
                                        <option value="remove">Remove Members</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="memberAmount" class="form-label">Amount</label>
                                    <input type="number" class="form-control bg-dark text-light border-secondary" id="memberAmount" name="amount" min="1" max="100" value="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="memberCategory" class="form-label">Category</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="memberCategory" name="category">
                                        <option value="Music">Music</option>
                                        <option value="Dance">Dance</option>
                                        <option value="Drama">Drama</option>
                                        <option value="Art">Art</option>
                                        <option value="Poetry">Poetry</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="memberGender" class="form-label">Gender (for new members)</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="memberGender" name="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="memberName" class="form-label">Member Name (optional, for add operation)</label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" id="memberName" name="member_name" placeholder="Leave empty for auto-generated name">
                            </div>
                            <div class="mb-3">
                                <label for="memberEmail" class="form-label">Member Email (optional, for add operation)</label>
                                <input type="email" class="form-control bg-dark text-light border-secondary" id="memberEmail" name="member_email" placeholder="Leave empty for auto-generated email">
                            </div>
                        </div>

                        <!-- Applications Update Form -->
                        <div id="applicationsUpdateForm" class="update-form-section" style="display: none;">
                            <h6 class="text-info mb-3"><i class="fas fa-user-plus me-2"></i>Update Pending Applications</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="applicationOperation" class="form-label">Operation</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="applicationOperation" name="operation">
                                        <option value="add">Add Applications</option>
                                        <option value="remove">Remove Applications</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="applicationAmount" class="form-label">Amount</label>
                                    <input type="number" class="form-control bg-dark text-light border-secondary" id="applicationAmount" name="amount" min="1" max="50" value="1">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="applicationCategory" class="form-label">Category</label>
                                <select class="form-select bg-dark text-light border-secondary" id="applicationCategory" name="category">
                                    <option value="Music">Music</option>
                                    <option value="Dance">Dance</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Art">Art</option>
                                    <option value="Poetry">Poetry</option>
                                </select>
                            </div>
                        </div>

                        <!-- Performance Update Form -->
                        <div id="performanceUpdateForm" class="update-form-section" style="display: none;">
                            <h6 class="text-success mb-3"><i class="fas fa-chart-line me-2"></i>Update Performance Metrics</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="performanceOperation" class="form-label">Operation</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="performanceOperation" name="operation">
                                        <option value="add">Add/Increase Metric</option>
                                        <option value="remove">Decrease Metric</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="performanceValue" class="form-label">Value</label>
                                    <input type="number" class="form-control bg-dark text-light border-secondary" id="performanceValue" name="value" min="1" max="1000" value="1">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="performanceType" class="form-label">Metric Type</label>
                                <select class="form-select bg-dark text-light border-secondary" id="performanceType" name="metric_type">
                                    <option value="events">Events</option>
                                    <option value="participation">Participation</option>
                                    <option value="achievements">Achievements</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="performanceDescription" class="form-label">Description</label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" id="performanceDescription" name="description" placeholder="e.g., Annual Cultural Show, Monthly Workshop" required>
                            </div>
                        </div>

                        <!-- Gender Distribution Update Form -->
                        <div id="genderUpdateForm" class="update-form-section" style="display: none;">
                            <h6 class="text-warning mb-3"><i class="fas fa-balance-scale me-2"></i>Update Gender Distribution</h6>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="genderOperation" class="form-label">Operation</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="genderOperation" name="operation">
                                        <option value="add">Add Members</option>
                                        <option value="remove">Remove Members</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="genderType" class="form-label">Gender</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="genderType" name="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="genderAmount" class="form-label">Amount</label>
                                    <input type="number" class="form-control bg-dark text-light border-secondary" id="genderAmount" name="amount" min="1" max="100" value="1">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="genderCategory" class="form-label">Category</label>
                                <select class="form-select bg-dark text-light border-secondary" id="genderCategory" name="category">
                                    <option value="Music">Music</option>
                                    <option value="Dance">Dance</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Art">Art</option>
                                    <option value="Poetry">Poetry</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Apply Changes
                        </button>
                    </div>
                </form>
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
            
            // Event Categories Chart - Load real data
            const eventCtx = document.getElementById('eventCategoriesChart').getContext('2d');
            initEventCategoriesChart(eventCtx);
        }
        
        // Initialize Gender Distribution Chart
        function initGenderDistributionChart() {
            const chartContainer = document.getElementById('genderDistributionChart');
            if (!chartContainer) {
                console.error('Gender distribution chart container not found');
                return;
            }
            
            const genderCtx = chartContainer.getContext('2d');
            
            // Show loading state
            showNotification('Loading gender distribution data...', 'info');
            
            // Fetch data from API
            fetch('Action/gender_distribution_api.php', {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Gender distribution API response:', data);
                    if (data.success && data.data && data.data.length > 0) {
                        createGenderChart(genderCtx, data.data);
                        showNotification(data.message || 'Gender distribution loaded successfully', 'success');
                    } else {
                        console.warn('No gender data available, using fallback');
                        createFallbackGenderChart(genderCtx);
                        showNotification('Using sample data - no member data available', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error loading gender distribution data:', error);
                    createFallbackGenderChart(genderCtx);
                    showNotification('Failed to load data, using sample data', 'warning');
                });
        }
        
        // Create Gender Distribution Chart
        function createGenderChart(ctx, data) {
            try {
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
                
                console.log('Gender distribution chart created successfully');
            } catch (error) {
                console.error('Error creating gender chart:', error);
                createFallbackGenderChart(ctx);
            }
        }
        
        // Create fallback gender chart with dummy data
        function createFallbackGenderChart(ctx) {
            const fallbackData = [
                {gender: 'Male', count: 3, color: '#36A2EB'},
                {gender: 'Female', count: 4, color: '#FF6384'},
                {gender: 'Other', count: 1, color: '#9966FF'}
            ];
            
            createGenderChart(ctx, fallbackData);
        }

        // Initialize Event Categories Chart with real data
        function initEventCategoriesChart() {
            const chartContainer = document.getElementById('eventCategoriesChart');
            if (!chartContainer) {
                console.error('Event categories chart container not found');
                return;
            }
            
            const eventCtx = chartContainer.getContext('2d');
            
            // Fetch data from new API
            fetch('Action/event_statistics_api.php', {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Event categories API response:', data);
                    if (data.success && data.data && data.data.length > 0) {
                        createEventCategoriesChart(eventCtx, data.data);
                        showNotification(data.message || 'Event categories loaded successfully', 'success');
                    } else {
                        console.warn('No event category data available, using fallback');
                        createFallbackEventChart(eventCtx);
                        showNotification('Using sample data - no category data available', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error loading event categories data:', error);
                    createFallbackEventChart(eventCtx);
                    showNotification('Failed to load category data, using sample data', 'warning');
                });
        }

        // Create Event Categories Chart
        function createEventCategoriesChart(ctx, data) {
            try {
                const labels = data.map(item => item.category);
                const counts = data.map(item => item.count);
                const colors = data.map(item => item.color);
                
                if (window.eventChart) {
                    window.eventChart.destroy();
                }
                
                window.eventChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: counts,
                            backgroundColor: colors,
                            borderWidth: 0,
                            borderColor: '#fff'
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
                                        const category = context.label;
                                        const count = context.parsed;
                                        const dataPoint = data[context.dataIndex];
                                        let tooltip = `${category}: ${count} members`;
                                        if (dataPoint.male_count !== undefined) {
                                            tooltip += `\nMale: ${dataPoint.male_count}, Female: ${dataPoint.female_count}`;
                                            if (dataPoint.other_count > 0) {
                                                tooltip += `, Other: ${dataPoint.other_count}`;
                                            }
                                        }
                                        return tooltip;
                                    }
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
                
                console.log('Event categories chart created successfully');
            } catch (error) {
                console.error('Error creating event categories chart:', error);
                createFallbackEventChart(ctx);
            }
        }

        // Create fallback event categories chart with dummy data
        function createFallbackEventChart(ctx) {
            const fallbackData = [
                {category: 'Music', count: 35, color: '#f3d35c'},
                {category: 'Dance', count: 25, color: '#e76f2c'},
                {category: 'Drama', count: 20, color: '#28a745'},
                {category: 'Art', count: 15, color: '#17a2b8'},
                {category: 'Poetry', count: 5, color: '#6f42c1'}
            ];
            
            createEventCategoriesChart(ctx, fallbackData);
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
            initEventCategoriesChart();
            initMemberApplications();
            loadMemberStatistics();
            showNotification('Dashboard loaded successfully!', 'success');
            
            // Initialize admin management if user is main admin
            <?php if ($_SESSION['admin_role'] === 'main_admin'): ?>
            initAdminManagement();
            <?php endif; ?>
            
            // Initialize dashboard updates
            initDashboardUpdates();
            
            // Make functions globally available for debugging
            window.debugDashboard = {
                openUpdateModal: openUpdateModal,
                loadCurrentDashboardStats: loadCurrentDashboardStats,
                setupUpdateButtons: setupUpdateButtons,
                testModal: function() {
                    console.log('Testing modal functionality...');
                    openUpdateModal('members');
                }
            };
            
            console.log('Dashboard initialization complete. Use window.debugDashboard.testModal() to test modal.');
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

        // Member Applications Management Functions
        function initMemberApplications() {
            // Load applications when applications section is shown
            document.querySelector('[data-section="applications"]').addEventListener('click', function() {
                loadPendingApplications();
                loadApplicationSystemStatus();
            });
            
            // Application system toggle
            document.getElementById('applicationSystemToggle').addEventListener('change', function() {
                toggleApplicationSystem(this.checked);
            });
            
            // Refresh applications button
            document.getElementById('refreshApplicationsBtn').addEventListener('click', function() {
                loadPendingApplications();
            });
            
            // Load initial status and pending count
            loadApplicationSystemStatus();
            loadPendingApplicationsCount();
        }

        function loadApplicationSystemStatus() {
            fetch('Action/member_management.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_application_status'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('applicationSystemToggle').checked = data.enabled;
                }
            })
            .catch(error => {
                console.error('Error loading application status:', error);
            });
        }

        function toggleApplicationSystem(enabled) {
            const formData = new FormData();
            formData.append('action', 'toggle_application_system');
            formData.append('enabled', enabled ? 'true' : 'false');
            
            fetch('Action/member_management.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                    // Revert toggle if failed
                    document.getElementById('applicationSystemToggle').checked = !enabled;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to update application system', 'error');
                // Revert toggle if failed
                document.getElementById('applicationSystemToggle').checked = !enabled;
            });
        }

        function loadPendingApplications() {
            fetch('Action/member_management.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_pending_members'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayPendingApplications(data.data);
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to load applications', 'error');
            });
        }

        function loadPendingApplicationsCount() {
            fetch('Action/member_management.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_pending_members'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const count = data.data.length;
                    const badge = document.getElementById('pendingApplicationsBadge');
                    if (count > 0) {
                        badge.textContent = count;
                        badge.style.display = 'inline-block';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            })
            .catch(error => {
                console.error('Error loading applications count:', error);
            });
        }

        function displayPendingApplications(applications) {
            const applicationsList = document.getElementById('applicationsList');
            const noApplicationsMessage = document.getElementById('noApplicationsMessage');
            
            applicationsList.innerHTML = '';
            
            if (applications.length === 0) {
                noApplicationsMessage.style.display = 'block';
                return;
            }
            
            noApplicationsMessage.style.display = 'none';
            
            applications.forEach(app => {
                const applicationCard = document.createElement('div');
                applicationCard.className = 'col-lg-6 col-md-8 col-12 mb-4';
                applicationCard.innerHTML = `
                    <div class="card bg-dark text-light border-secondary h-100">
                        <div class="card-header border-secondary">
                            <h5 class="mb-0">
                                <i class="fas fa-user me-2 text-warning"></i>
                                ${app.full_name}
                            </h5>
                            <small class="text-muted">Applied: ${new Date(app.created_at).toLocaleDateString()}</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-2"><strong>ID:</strong> ${app.university_id}</p>
                                    <p class="mb-2"><strong>Email:</strong> ${app.email}</p>
                                    <p class="mb-2"><strong>Department:</strong> ${app.department}</p>
                                    <p class="mb-2"><strong>Semester:</strong> ${app.semester}</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-2"><strong>Phone:</strong> ${app.phone}</p>
                                    <p class="mb-2"><strong>Gender:</strong> ${app.gender}</p>
                                    <p class="mb-2"><strong>Status:</strong> ${app.membership_status}</p>
                                    <p class="mb-2"><strong>Category:</strong> ${app.event_category}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="mb-2"><strong>Motivation:</strong></p>
                                <p class="text-muted small">${app.motivation}</p>
                            </div>
                        </div>
                        <div class="card-footer border-secondary">
                            <div class="d-flex gap-2 justify-content-end">
                                <button class="btn btn-success btn-sm" onclick="acceptApplication(${app.id})">
                                    <i class="fas fa-check me-1"></i> Accept
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="rejectApplication(${app.id}, '${app.full_name}')">
                                    <i class="fas fa-times me-1"></i> Reject
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                applicationsList.appendChild(applicationCard);
            });
        }

        function acceptApplication(memberId) {
            if (!confirm('Are you sure you want to accept this application? An email will be sent to the member.')) {
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'accept_member');
            formData.append('member_id', memberId);
            
            fetch('Action/member_management.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    loadPendingApplications();
                    loadPendingApplicationsCount();
                    loadMemberStatistics(); // Refresh statistics
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to accept application', 'error');
            });
        }

        function rejectApplication(memberId, memberName) {
            if (!confirm(`Are you sure you want to reject ${memberName}'s application? This will permanently delete their information.`)) {
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'reject_member');
            formData.append('member_id', memberId);
            
            fetch('Action/member_management.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    loadPendingApplications();
                    loadPendingApplicationsCount();
                    loadMemberStatistics(); // Refresh statistics
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to reject application', 'error');
            });
        }

        // Load member statistics from the new database structure
        function loadMemberStatistics() {
            fetch('Action/member_management.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_member_statistics'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    updateStatisticsDisplay(data.data);
                } else {
                    console.warn('Failed to load member statistics, using fallback');
                    updateStatisticsDisplay({
                        total_members: 0,
                        active_members: 0,
                        pending_applications: 0,
                        total_males: 0,
                        total_females: 0,
                        total_others: 0
                    });
                }
            })
            .catch(error => {
                console.error('Error loading member statistics:', error);
                showNotification('Failed to load member statistics', 'warning');
            });
        }

        // Update statistics display with real data
        function updateStatisticsDisplay(stats) {
            // Update total members
            document.getElementById('totalMembersCount').textContent = stats.total_members || 0;
            document.getElementById('activeMembersCount').textContent = `Active: ${stats.active_members || 0}`;
            
            // Update pending applications
            const pendingCount = stats.pending_applications || 0;
            document.getElementById('pendingApplicationsCount').textContent = pendingCount;
            
            // Update applications change indicator
            const applicationsChange = document.getElementById('applicationsChange');
            if (pendingCount > 0) {
                applicationsChange.className = 'stat-change';
                applicationsChange.innerHTML = '<i class="fas fa-clock"></i> Needs Attention';
            } else {
                applicationsChange.className = 'stat-change positive';
                applicationsChange.innerHTML = '<i class="fas fa-check"></i> All Reviewed';
            }
            
            // Update gender distribution
            const totalGender = (stats.total_males || 0) + (stats.total_females || 0) + (stats.total_others || 0);
            if (totalGender > 0) {
                const malePercent = Math.round((stats.total_males / totalGender) * 100);
                const femalePercent = Math.round((stats.total_females / totalGender) * 100);
                const otherPercent = Math.round((stats.total_others / totalGender) * 100);
                
                document.getElementById('genderRatio').textContent = `${malePercent}/${femalePercent}/${otherPercent}%`;
                document.getElementById('genderBreakdown').textContent = `M: ${stats.total_males}, F: ${stats.total_females}, O: ${stats.total_others}`;
            } else {
                document.getElementById('genderRatio').textContent = 'No Data';
                document.getElementById('genderBreakdown').textContent = 'No members yet';
            }
        }

        // Dashboard Update Management Functions
        function initDashboardUpdates() {
            console.log('Initializing dashboard updates...');
            
            // Load dashboard update section when selected
            const dashboardUpdateNav = document.querySelector('[data-section="dashboard-update"]');
            if (dashboardUpdateNav) {
                dashboardUpdateNav.addEventListener('click', function() {
                    console.log('Dashboard update section clicked');
                    setTimeout(() => {
                        loadCurrentDashboardStats();
                        setupUpdateButtons(); // Ensure buttons are set up when section is shown
                    }, 200);
                });
            } else {
                console.warn('Dashboard update navigation not found');
            }
            
            // Dashboard update form submission
            const updateForm = document.getElementById('dashboardUpdateForm');
            if (updateForm) {
                updateForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    console.log('Form submitted');
                    submitDashboardUpdate();
                });
            } else {
                console.error('Dashboard update form not found during initialization');
            }
            
            // Refresh button click handler
            const refreshBtn = document.getElementById('refreshDashboardStatsBtn');
            if (refreshBtn) {
                refreshBtn.addEventListener('click', function() {
                    console.log('Refresh button clicked');
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        refreshAllDashboardData();
                        this.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh Data';
                        this.disabled = false;
                    }, 1000);
                });
            } else {
                console.warn('Refresh button not found during initialization');
            }
            
            // Test modal button click handler
            const testModalBtn = document.getElementById('testModalBtn');
            if (testModalBtn) {
                testModalBtn.addEventListener('click', function() {
                    console.log('Test modal button clicked');
                    showNotification('Testing modal functionality...', 'info');
                    openUpdateModal('members');
                });
            } else {
                console.warn('Test modal button not found during initialization');
            }
            
            // Set up update buttons immediately
            setupUpdateButtons();
        }

        // Function to set up update button click handlers
        function setupUpdateButtons() {
            console.log('Setting up update buttons...');
            
            // Wait for DOM to be ready
            setTimeout(() => {
                // Update Members button
                const membersBtn = document.querySelector('.update-card button[onclick*="members"]');
                if (membersBtn) {
                    membersBtn.onclick = null; // Remove old onclick
                    membersBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        console.log('Members update button clicked');
                        openUpdateModal('members');
                    });
                    console.log('Members button setup complete');
                } else {
                    console.warn('Members update button not found');
                }
                
                // Update Applications button
                const applicationsBtn = document.querySelector('.update-card button[onclick*="applications"]');
                if (applicationsBtn) {
                    applicationsBtn.onclick = null; // Remove old onclick
                    applicationsBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        console.log('Applications update button clicked');
                        openUpdateModal('applications');
                    });
                    console.log('Applications button setup complete');
                } else {
                    console.warn('Applications update button not found');
                }
                
                // Update Performance button
                const performanceBtn = document.querySelector('.update-card button[onclick*="performance"]');
                if (performanceBtn) {
                    performanceBtn.onclick = null; // Remove old onclick
                    performanceBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        console.log('Performance update button clicked');
                        openUpdateModal('performance');
                    });
                    console.log('Performance button setup complete');
                } else {
                    console.warn('Performance update button not found');
                }
                
                // Update Gender button
                const genderBtn = document.querySelector('.update-card button[onclick*="gender"]');
                if (genderBtn) {
                    genderBtn.onclick = null; // Remove old onclick
                    genderBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        console.log('Gender update button clicked');
                        openUpdateModal('gender');
                    });
                    console.log('Gender button setup complete');
                } else {
                    console.warn('Gender update button not found');
                }
            }, 100);
        }

        function loadCurrentDashboardStats() {
            console.log('Loading current dashboard stats...');
            
            fetch('Action/dashboard_update_management.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_current_stats'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Dashboard stats API response:', data);
                if (data.success && data.data) {
                    updateCurrentStatsDisplay(data.data);
                } else {
                    console.error('API returned failure:', data);
                    showNotification(data.message || 'Failed to load current statistics', 'error');
                    
                    // Set fallback values
                    updateCurrentStatsDisplay({
                        members: {
                            total_members: 0,
                            active_members: 0,
                            pending_applications: 0,
                            total_males: 0,
                            total_females: 0,
                            total_others: 0
                        },
                        categories: [],
                        performance: []
                    });
                }
            })
            .catch(error => {
                console.error('Error loading dashboard stats:', error);
                showNotification('Failed to load current statistics: ' + error.message, 'error');
                
                // Set fallback values
                updateCurrentStatsDisplay({
                    members: {
                        total_members: 0,
                        active_members: 0,
                        pending_applications: 0,
                        total_males: 0,
                        total_females: 0,
                        total_others: 0
                    },
                    categories: [],
                    performance: []
                });
            });
        }

        function updateCurrentStatsDisplay(stats) {
            console.log('Updating current stats display with:', stats);
            
            // Update members count
            if (stats && stats.members) {
                const members = stats.members;
                
                // Update total members display
                const totalMembers = parseInt(members.total_members) || 0;
                const activeMembers = parseInt(members.active_members) || 0;
                document.getElementById('currentMembersValue').textContent = 
                    `${totalMembers} Total (${activeMembers} Active)`;
                
                // Update pending applications display
                const pendingApps = parseInt(members.pending_applications) || 0;
                document.getElementById('currentApplicationsValue').textContent = 
                    `${pendingApps} Pending`;
                
                // Update gender distribution display
                const totalMales = parseInt(members.total_males) || 0;
                const totalFemales = parseInt(members.total_females) || 0;
                const totalOthers = parseInt(members.total_others) || 0;
                const totalGender = totalMales + totalFemales + totalOthers;
                
                if (totalGender > 0) {
                    const malePercent = Math.round((totalMales / totalGender) * 100);
                    const femalePercent = Math.round((totalFemales / totalGender) * 100);
                    const otherPercent = Math.round((totalOthers / totalGender) * 100);
                    document.getElementById('currentGenderValue').textContent = 
                        `${malePercent}% M, ${femalePercent}% F, ${otherPercent}% O`;
                } else {
                    document.getElementById('currentGenderValue').textContent = 'No Data';
                }
                
                // Update performance display based on categories
                if (stats.categories && stats.categories.length > 0) {
                    document.getElementById('currentPerformanceValue').textContent = 
                        `${stats.categories.length} Active Categories`;
                } else {
                    document.getElementById('currentPerformanceValue').textContent = '5 Categories';
                }
            } else {
                console.warn('No stats.members data available:', stats);
                // Set default values
                document.getElementById('currentMembersValue').textContent = '0 Total (0 Active)';
                document.getElementById('currentApplicationsValue').textContent = '0 Pending';
                document.getElementById('currentGenderValue').textContent = 'No Data';
                document.getElementById('currentPerformanceValue').textContent = '5 Categories';
            }
        }

        function openUpdateModal(type) {
            console.log('Opening update modal for type:', type);
            
            try {
                // Clean up any existing modal instances first
                cleanupModalState();
                
                // Check if modal exists
                const modalElement = document.getElementById('dashboardUpdateModal');
                if (!modalElement) {
                    console.error('Dashboard update modal not found');
                    showNotification('Modal not found. Please refresh the page.', 'error');
                    return;
                }
                
                // Hide all form sections
                const formSections = document.querySelectorAll('.update-form-section');
                console.log('Found form sections:', formSections.length);
                formSections.forEach(section => {
                    section.style.display = 'none';
                });
                
                // Set update type
                const updateTypeField = document.getElementById('updateType');
                if (!updateTypeField) {
                    console.error('Update type field not found');
                    showNotification('Form configuration error. Please refresh the page.', 'error');
                    return;
                }
                updateTypeField.value = type;
                
                // Show relevant form section and update modal title
                let modalTitle = 'Update Dashboard Data';
                let sectionId = '';
                
                switch(type) {
                    case 'members':
                        modalTitle = 'Update Total Members';
                        sectionId = 'membersUpdateForm';
                        break;
                    case 'applications':
                        modalTitle = 'Update Pending Applications';
                        sectionId = 'applicationsUpdateForm';
                        break;
                    case 'performance':
                        modalTitle = 'Update Performance Metrics';
                        sectionId = 'performanceUpdateForm';
                        break;
                    case 'gender':
                        modalTitle = 'Update Gender Distribution';
                        sectionId = 'genderUpdateForm';
                        break;
                    default:
                        console.error('Unknown modal type:', type);
                        showNotification('Unknown update type: ' + type, 'error');
                        return;
                }
                
                // Update modal title
                const modalLabel = document.getElementById('dashboardUpdateModalLabel');
                if (modalLabel) {
                    modalLabel.innerHTML = `<i class="fas fa-cogs me-2"></i>${modalTitle}`;
                } else {
                    console.warn('Modal label not found');
                }
                
                // Show the relevant form section
                const formSection = document.getElementById(sectionId);
                if (formSection) {
                    formSection.style.display = 'block';
                    console.log('Showing form section:', sectionId);
                } else {
                    console.error('Form section not found:', sectionId);
                    showNotification('Form section not found: ' + sectionId, 'error');
                    return;
                }
                
                // Set up close button handlers before showing modal
                setupModalCloseHandlers(modalElement);
                
                // Show modal
                console.log('Attempting to show modal...');
                
                // Check if Bootstrap is available
                if (typeof bootstrap === 'undefined') {
                    console.error('Bootstrap is not loaded, using fallback');
                    showModalFallback(modalElement);
                    return;
                }
                
                // Try to create and show the modal with Bootstrap
                try {
                    // Create modal with proper options
                    const modal = new bootstrap.Modal(modalElement, {
                        backdrop: true,  // Allow backdrop clicks to close
                        keyboard: true,  // Allow ESC key to close
                        focus: true
                    });
                    
                    // Store modal instance for later cleanup
                    window.currentModal = modal;
                    
                    // Show the modal
                    modal.show();
                    
                    // Add event listeners
                    modalElement.addEventListener('shown.bs.modal', function() {
                        console.log('Modal successfully shown with Bootstrap');
                        showNotification('Update form opened', 'success');
                    }, { once: true });
                    
                    modalElement.addEventListener('hidden.bs.modal', function() {
                        console.log('Modal was hidden');
                        cleanupModalState();
                    }, { once: true });
                    
                } catch (bootstrapError) {
                    console.error('Bootstrap modal error:', bootstrapError);
                    showModalFallback(modalElement);
                }
                
            } catch (error) {
                console.error('Error opening modal:', error);
                showNotification('Error opening update form: ' + error.message, 'error');
            }
        }
        
        function setupModalCloseHandlers(modalElement) {
            console.log('Setting up modal close handlers');
            
            // Remove any existing handlers first
            const closeButtons = modalElement.querySelectorAll('[data-bs-dismiss="modal"]');
            closeButtons.forEach(btn => {
                // Clone the button to remove all event listeners
                const newBtn = btn.cloneNode(true);
                btn.parentNode.replaceChild(newBtn, btn);
                
                // Add new click handler
                newBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Close button clicked');
                    closeModal();
                });
            });
            
            // Add escape key handler
            const escapeHandler = function(e) {
                if (e.key === 'Escape' && modalElement.classList.contains('show')) {
                    console.log('Escape key pressed');
                    closeModal();
                }
            };
            
            document.addEventListener('keydown', escapeHandler);
            
            // Store handler for cleanup
            modalElement._escapeHandler = escapeHandler;
        }
        
        function showModalFallback(modalElement) {
            console.log('Using fallback modal display method');
            
            modalElement.classList.add('show');
            modalElement.style.display = 'block';
            modalElement.style.paddingRight = '17px'; // Compensate for scrollbar
            modalElement.setAttribute('aria-hidden', 'false');
            modalElement.setAttribute('role', 'dialog');
            modalElement.setAttribute('tabindex', '-1');
            
            document.body.classList.add('modal-open');
            document.body.style.paddingRight = '17px'; // Compensate for scrollbar
            
            // Add backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            backdrop.id = 'modal-backdrop-fallback';
            backdrop.style.zIndex = '9998';
            
            // Add backdrop click handler
            backdrop.addEventListener('click', function() {
                console.log('Backdrop clicked');
                closeModal();
            });
            
            document.body.appendChild(backdrop);
            
            showNotification('Update form opened (fallback mode)', 'warning');
        }
        
        function closeModal() {
            console.log('Closing modal');
            
            const modalElement = document.getElementById('dashboardUpdateModal');
            if (!modalElement) {
                console.error('Modal element not found during close');
                return;
            }
            
            // Try Bootstrap method first
            if (window.currentModal) {
                try {
                    window.currentModal.hide();
                    return;
                } catch (error) {
                    console.warn('Bootstrap modal close failed, using fallback:', error);
                }
            }
            
            // Fallback method
            closeModalFallback();
        }
        
        function cleanupModalState() {
            console.log('Cleaning up modal state');
            
            const modalElement = document.getElementById('dashboardUpdateModal');
            if (modalElement) {
                // Remove escape key handler
                if (modalElement._escapeHandler) {
                    document.removeEventListener('keydown', modalElement._escapeHandler);
                    delete modalElement._escapeHandler;
                }
                
                // Clean up Bootstrap instance
                if (window.currentModal) {
                    try {
                        window.currentModal.dispose();
                    } catch (error) {
                        console.warn('Error disposing modal:', error);
                    }
                    delete window.currentModal;
                }
                
                // Reset modal element state
                modalElement.classList.remove('show');
                modalElement.style.display = 'none';
                modalElement.style.paddingRight = '';
                modalElement.setAttribute('aria-hidden', 'true');
                modalElement.removeAttribute('role');
                modalElement.removeAttribute('tabindex');
            }
            
            // Clean up body classes and backdrop
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
            
            const existingBackdrop = document.getElementById('modal-backdrop-fallback');
            if (existingBackdrop) {
                existingBackdrop.remove();
            }
            
            // Remove any remaining backdrops
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                backdrop.remove();
            });
        }

        function submitDashboardUpdate() {
            const form = document.getElementById('dashboardUpdateForm');
            const formData = new FormData(form);
            const updateType = document.getElementById('updateType').value;
            
            // Set the appropriate action based on update type
            let action = '';
            switch(updateType) {
                case 'members':
                    action = 'update_total_members';
                    break;
                case 'applications':
                    action = 'update_pending_applications';
                    break;
                case 'performance':
                    action = 'update_performance_data';
                    break;
                case 'gender':
                    action = 'update_gender_distribution';
                    break;
            }
            
            formData.append('action', action);
            
            // Show loading notification
            showNotification('Processing update...', 'info');
            
            fetch('Action/dashboard_update_management.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    closeModal();
                    
                    // Force refresh all dashboard data with a small delay to ensure database changes are committed
                    setTimeout(() => {
                        refreshAllDashboardData();
                    }, 500);
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to update dashboard data', 'error');
            });
        }

        // Fallback modal close function
        function closeModalFallback() {
            console.log('Closing modal using fallback method');
            const modalElement = document.getElementById('dashboardUpdateModal');
            const backdrop = document.getElementById('modal-backdrop-fallback');
            
            if (modalElement) {
                modalElement.classList.remove('show');
                modalElement.style.display = 'none';
                modalElement.setAttribute('aria-hidden', 'true');
            }
            
            if (backdrop) {
                backdrop.remove();
            }
            
            document.body.classList.remove('modal-open');
            showNotification('Update form closed', 'info');
        }
        
        // Comprehensive refresh function for all dashboard data
        function refreshAllDashboardData() {
            console.log('Refreshing all dashboard data...');
            
            // 1. Refresh main dashboard statistics (Total Members, Pending Applications, etc.)
            loadMemberStatistics();
            
            // 2. Refresh dashboard update section current values
            loadCurrentDashboardStats();
            
            // 3. Refresh all charts
            setTimeout(() => {
                initGenderDistributionChart();
                initEventCategoriesChart();
            }, 200);
            
            // 4. Refresh applications if in applications section
            if (document.getElementById('applications-section').style.display !== 'none') {
                setTimeout(() => {
                    loadPendingApplications();
                    loadPendingApplicationsCount();
                }, 300);
            }
            
            // 5. Show final confirmation
            setTimeout(() => {
                showNotification('Dashboard data refreshed successfully!', 'success');
            }, 800);
        }
    </script>
</body>
</html>
