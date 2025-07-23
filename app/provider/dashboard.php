<?php
require_once '../helpers/redirect-to-login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS - Dashboard - MeroSewa</title>
    <link rel="stylesheet" href="/merosewa/public/css/base.css">
    <link rel="stylesheet" href="/merosewa/public/css/layout.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <div class="dashboard-container">

        <?php require_once 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <?php require_once 'includes/header.php'; ?>

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

                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <h2>Quick Actions</h2>
                        <div class="actions-grid">
                            <a href="add-booking.php" class="action-card">
                                <span class="action-icon">📝</span>
                                <span>Job History</span>
                            </a>
                            <a href="new-request.php" class="action-card">
                                <span class="action-icon">➕</span>
                                <span>Add a Service</span>
                            </a>
                            <a href="manage-customers.php" class="action-card">
                                <span class="action-icon">👥</span>
                                <span>View Bookings</span>
                            </a>
                            <a href="service-catalog.php" class="action-card">
                                <span class="action-icon">📋</span>
                                <span>Service Catalog</span>
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
