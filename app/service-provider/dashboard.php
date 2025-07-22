<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS - Dashboard - MeroSewa</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../assets/logo.png" alt="MeroSewa">
                <span>MeroSewa</span>
            </div>
            <nav>
                <a href="dashboard.php" class="active">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="service-requests.php">
                    <span>📝</span>
                    <span>Service Requests</span>
                </a>
                <a href="service-requests.php">
                    <span>📅</span>
                    <span>Bookings</span>
                </a>
                <a href="service-requests.php">
                    <span>✅</span>
                    <span>Completion</span>
                </a>
                <a href="reviews.php">
                    <span>⭐</span>
                    <span>Reviews</span>
                </a>
                <a href="complaints.php">
                    <span>⚠️</span>
                    <span>Complaints</span>
                </a>
                <a href="job-history.php">
                    <span>📋</span>
                    <span>History</span>
                </a>
                <a href="profile.php">
                    <span>👤</span>
                    <span>Profile</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <div class="header-right">
                    <div class="notifications">
                        <span>🔔</span>
                        <span class="badge">3</span>
                    </div>
                    <a href="logout.php" class="logout">
                        <span>🚪</span>
                        <span>Logout</span>
                    </a>
                    <div class="profile-icon">
                        <img src="../assets/profile.jpg" alt="Profile">
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Stats Overview -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <h3>Today's Bookings</h3>
                            <span class="trend positive">+15% from yesterday</span>
                        </div>
                        <div class="stat-value">1,245</div>
                        <div class="stat-footer">completed today</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <h3>New Service Requests</h3>
                            <span class="trend positive">+8% from last week</span>
                        </div>
                        <div class="stat-value">78</div>
                        <div class="stat-footer">pending this hour</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <h3>Today's Earnings</h3>
                            <span class="trend positive">+12% from previous day</span>
                        </div>
                        <div class="stat-value">$18,500</div>
                        <div class="stat-footer">total revenue</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <h3>Active Services</h3>
                            <span class="trend neutral">stable over 24 hours</span>
                        </div>
                        <div class="stat-value">2,300</div>
                        <div class="stat-footer">running currently</div>
                    </div>
                </div>

                <!-- Activity and Actions -->
                <div class="dashboard-grid">
                    <!-- Recent Activity -->
                    <div class="dashboard-card">
                        <h2>Recent Activity</h2>
                        <div class="activity-list">
                            <div class="activity-item">
                                <span class="activity-icon">📝</span>
                                <div class="activity-details">
                                    <p>New booking from John Doe for installation</p>
                                    <span class="activity-time">2 min ago</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <span class="activity-icon">💰</span>
                                <div class="activity-details">
                                    <p>Payment confirmed for service ID 9876</p>
                                    <span class="activity-time">5 min ago</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <span class="activity-icon">🚨</span>
                                <div class="activity-details">
                                    <p>Urgent request from Jane Smith for repair</p>
                                    <span class="activity-time">10 min ago</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <span class="activity-icon">✅</span>
                                <div class="activity-details">
                                    <p>Service maintenance completed for Server A</p>
                                    <span class="activity-time">1 hour ago</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <span class="activity-icon">👤</span>
                                <div class="activity-details">
                                    <p>New customer signed up: Emily White</p>
                                    <span class="activity-time">2 hours ago</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Actions -->
                    <div class="dashboard-card">
                        <h2>Pending Actions</h2>
                        <div class="pending-list">
                            <div class="pending-item">
                                <div class="pending-details">
                                    <span class="pending-icon">⚠️</span>
                                    <p>Unassigned service request ID 1024</p>
                                </div>
                                <button class="btn btn-primary">Assign</button>
                            </div>
                            <div class="pending-item">
                                <div class="pending-details">
                                    <span class="pending-icon">⏰</span>
                                    <p>Overdue payment from Client A</p>
                                </div>
                                <button class="btn btn-primary">Remind</button>
                            </div>
                            <div class="pending-item">
                                <div class="pending-details">
                                    <span class="pending-icon">⭐</span>
                                    <p>Review feedback for Technician B</p>
                                </div>
                                <button class="btn btn-primary">Review</button>
                            </div>
                            <div class="pending-item">
                                <div class="pending-details">
                                    <span class="pending-icon">👤</span>
                                    <p>Approve new user registration</p>
                                </div>
                                <button class="btn btn-primary">Approve</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="dashboard-grid">
                    <!-- Weekly Booking Trend -->
                    <div class="dashboard-card">
                        <h2>Weekly Booking Trend</h2>
                        <p class="chart-subtitle">Bookings over the last 7 days</p>
                        <div class="chart-container" id="bookingTrendChart">
                            <!-- Chart will be rendered here -->
                        </div>
                    </div>

                    <!-- Service Categories -->
                    <div class="dashboard-card">
                        <h2>Service Request Categories</h2>
                        <p class="chart-subtitle">Breakdown of service requests by type</p>
                        <div class="chart-container" id="categoriesChart">
                            <!-- Chart will be rendered here -->
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h2>Quick Actions</h2>
                    <div class="actions-grid">
                        <a href="add-booking.php" class="action-card">
                            <span class="action-icon">📝</span>
                            <span>Add Booking</span>
                        </a>
                        <a href="new-request.php" class="action-card">
                            <span class="action-icon">➕</span>
                            <span>New Request</span>
                        </a>
                        <a href="manage-customers.php" class="action-card">
                            <span class="action-icon">👥</span>
                            <span>Manage Customers</span>
                        </a>
                        <a href="service-catalog.php" class="action-card">
                            <span class="action-icon">📋</span>
                            <span>Service Catalog</span>
                        </a>
                        <a href="generate-report.php" class="action-card">
                            <span class="action-icon">📊</span>
                            <span>Generate Report</span>
                        </a>
                        <a href="assign-technician.php" class="action-card">
                            <span class="action-icon">👨‍🔧</span>
                            <span>Assign Technician</span>
                        </a>
                        <a href="bulk-notifications.php" class="action-card">
                            <span class="action-icon">🔔</span>
                            <span>Send Bulk Notifications</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html> 