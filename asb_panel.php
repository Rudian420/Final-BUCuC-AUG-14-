<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASB Members - Styled</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    
    <style>
        /* Main Container Styling */
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
        
        /* Table Styling */
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
            padding: 1rem;
        }
        
        .table-dark td {
            border-color: rgba(255, 255, 255, 0.1);
            color: #ccc;
            vertical-align: middle;
            padding: 1rem;
        }
        
        .table-dark tbody tr:hover {
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        /* Avatar Styling */
        .member-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        /* Status Badge Styling */
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
        
        .status-accepted {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: #fff;
        }
        
        .status-asb {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: #fff;
        }
        
        /* Statistics Row */
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
        
        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #ccc;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        /* Responsive Design */
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
            
            .stat-number {
                font-size: 1.5rem;
            }
        }
        
        /* Custom Select Styling */
        .custom-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .custom-select:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }
        
        .custom-select:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }
        
        .custom-select option {
            background: #1a1a2e;
            color: #fff;
            padding: 0.5rem;
        }
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }
        
        .table-responsive::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        
        .table-responsive::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }
        
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div class="applications-container">
        <div class="applications-card">
            <h1 class="applications-title">
                <i class="fas fa-users mb-3"></i><br>
                ASB Members
            </h1>
            <p class="applications-subtitle">
                Active Student Body Member Directory
            </p>
            
            <!-- Statistics Row -->
            <div class="stats-row">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="stat-item">
                            <div class="stat-number" id="totalMembers">0</div>
                            <div class="stat-label">Total Members</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="stat-item">
                            <div class="stat-number" id="activePanels">0</div>
                            <div class="stat-label">Active Panels</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="stat-item">
                            <div class="stat-number" id="lastUpdated">Loading...</div>
                            <div class="stat-label">Last Updated</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Loading State -->
            <div class="text-center mb-4" id="loadingState">
                <div class="loading-spinner me-2"></div>
                <span class="text-light">Loading member data...</span>
            </div>
            
            <!-- Members Table -->
            <div class="applications-table" id="membersTableContainer" style="display: none;">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0" id="membersTable">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Student ID</th>
                                <th>G-Suite Email</th>
                                <th>Panel</th>
                                <th>Update Position</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            
            <!-- Empty State -->
            <div class="empty-state d-none" id="emptyState">
                <i class="fas fa-users-slash"></i>
                <h4>No Members Found</h4>
                <p>Unable to load member data at this time.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Function to get initials from full name
        function getInitials(name) {
            const words = name.split(' ').filter(word => word.length > 0);
            return words.map(word => word.charAt(0).toUpperCase()).join('').substring(0, 2);
        }
        
        // Function to get random avatar color
        function getAvatarColor(index) {
            const colors = [
                'linear-gradient(45deg, #007bff, #0056b3)',
                'linear-gradient(45deg, #28a745, #20c997)',
                'linear-gradient(45deg, #ffc107, #ffeb3b)',
                'linear-gradient(45deg, #17a2b8, #138496)',
                'linear-gradient(45deg, #dc3545, #c82333)',
                'linear-gradient(45deg, #6f42c1, #5a32a3)'
            ];
            return colors[index % colors.length];
        }
        
        // Function to update statistics
        function updateStatistics(data) {
            const totalMembers = data.length;
            const uniquePanels = [...new Set(data.map(member => member.panel))].filter(panel => panel).length;
            
            document.getElementById('totalMembers').textContent = totalMembers;
            document.getElementById('activePanels').textContent = uniquePanels;
            document.getElementById('lastUpdated').textContent = new Date().toLocaleTimeString();
        }
        
        // Function to handle position updates
        function updatePosition(studentId, position) {
            if (!position) return;
            
            console.log(`Updating position for student ${studentId} to ${position}`);
            
            // You can add your update logic here
            // For example, make an AJAX call to update the database
            
            // Show notification
            showNotification(`Position updated to ${position} for student ${studentId}`, 'success');
        }
        
        // Show Notification Function
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
        
        // Main data loading function
        const sheetUrl = "https://docs.google.com/spreadsheets/d/e/2PACX-1vS10OiVKg-emsE3HeMukI18ioBJ9bPIb90UtDNkVyk-kAsTGn_xbX5ZoAnYf4hrP1vWa-brAuVGGu1g/pub?output=csv";

        fetch(sheetUrl)
            .then(response => response.text())
            .then(csvText => {
                const rows = csvText.split("\n").map(row => row.split(","));
                const headers = rows[0].map(h => h.trim().replace(/^\uFEFF/, ""));
                
                console.log("Detected headers:", headers);
                
                const data = rows.slice(1)
                    .filter(row => row.some(cell => cell && cell.trim())) // Filter out empty rows
                    .map(row => {
                        let obj = {};
                        headers.forEach((header, i) => {
                            obj[header] = row[i]?.trim() || "";
                        });
                        return obj;
                    });

                const processedData = data.map(student => {
                    const name = student[headers[0]] || 'Unknown';
                    const student_id = student[headers[1]] || 'N/A';
                    const gsuite = student[headers[2]] || 'N/A';
                    let panel = student[headers[3]] || 'N/A';

                    if (panel.includes("~")) {
                        const parts = panel.split("~");
                        panel = parts[1].trim().toUpperCase();
                    } else {
                        panel = panel.trim().toUpperCase();
                    }

                    return { name, student_id, gsuite, panel };
                });

                // Populate table
                const tbody = document.querySelector("#membersTable tbody");
                tbody.innerHTML = ''; // Clear existing content
                
                processedData.forEach((member, index) => {
                    const initials = getInitials(member.name);
                    const avatarColor = getAvatarColor(index);
                    
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="member-avatar me-3" style="background: ${avatarColor};">
                                    ${initials}
                                </div>
                                <div>
                                    <div class="fw-bold">${member.name}</div>
                                </div>
                            </div>
                        </td>
                        <td>${member.student_id}</td>
                        <td>${member.gsuite}</td>
                        <td>
                            <span class="status-badge status-asb">
                                <i class="fas fa-star me-1"></i>${member.panel}
                            </span>
                        </td>
                        <td>
                            <select class="custom-select" onchange="updatePosition('${member.student_id}', this.value)">
                                <option value="">Select Position</option>
                                <option value="GB">GB</option>
                                <option value="ASB">ASB</option>
                                <option value="SB">SB</option>
                            </select>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
                
                // Update statistics
                updateStatistics(processedData);
                
                // Hide loading, show table
                document.getElementById('loadingState').style.display = 'none';
                document.getElementById('membersTableContainer').style.display = 'block';
            })
            .catch(err => {
                console.error('Error loading data:', err);
                
                // Hide loading, show empty state
                document.getElementById('loadingState').style.display = 'none';
                document.getElementById('emptyState').classList.remove('d-none');
            });
    </script>
</body>
</html>