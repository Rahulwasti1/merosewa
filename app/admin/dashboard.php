<?php
require_once '../helpers/redirect-to-login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Admin Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/merosewa/public/assets/logo.png">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/merosewa/public/css/base.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="/merosewa/app/provider/css/dashboard.css">
    <link rel="stylesheet" href="/merosewa/app/provider/css/profile.css">
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <?php include 'includes/header.php'; ?>

            <div class="dashboard-content">
                <h1>Dashboard Overview</h1>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <h3>Total Users</h3>
                            <span class="icon">👥</span>
                        </div>
                        <div class="stat-value" id="total-users">0</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <h3>Total Jobs</h3>
                            <span class="icon">📝</span>
                        </div>
                        <div class="stat-value" id="total-jobs">0</div>
                    </div>


                    <div class="stat-card">
                        <div class="stat-header">
                            <h3>Total Services</h3>
                            <span class="icon">📋</span>
                        </div>
                        <div class="stat-value" id="total-services">0</div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="section">
                    <div class="section-header">
                        <h2>Recent Bookings</h2>
                        <p>Overview of the latest service bookings.</p>
                    </div>

                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <h2>Quick Actions</h2>
                        <div class="actions-grid">
                            <a href="jobs.php" class="action-card">
                                <span class="action-icon">📝</span>
                                <span>Jobs</span>
                            </a>
                            <a href="users.php" class="action-card">
                                <span class="action-icon">👥</span>
                                <span>Users</span>
                            </a>
                            <a href="services.php" class="action-card">
                                <span class="action-icon">📋</span>
                                <span>Services</span>
                            </a>
                        </div>
                    </div>
                </div>
                <section class="profile-container">
                    <?php
                    require_once '../../Database.php';
                    $db = new Database();
                    $userId = SessionUser::getId();
                    $userDetails = $db->selectFirst("SELECT * FROM users WHERE id = ?;", [$userId]);
                    ?>
                    <h1>Your Profile & Settings</h1>

                    <div class="profile-content">
                        <!-- Profile Picture Section -->
                        <div class="profile-picture">
                            <div class="picture-container">
                                <img src="<?= '/merosewa/' . $userDetails['profile_picture'] ?>" alt="Aaryan Sharma">
                            </div>
                            <div class="profile-status">
                                <span class="badge service-provider"><?= $userDetails['role'] ?></span>
                            </div>
                        </div>

                        <!-- Personal Details Section -->
                        <form action="update-profile.php" method="post" enctype="multipart/form-data" class="profile-section">
                            <div class="section-header">
                                <h2>👤 Personal Details</h2>
                                <p>Manage your personal information and how it appears to others.</p>
                                <!-- Success and Error Messages -->
                                <?php if (isset($_SESSION['success_message'])): ?>
                                    <span style="color: green; display: block; margin: 10px 0;">
                                        <?= htmlspecialchars($_SESSION['success_message']) ?>
                                    </span>
                                    <?php unset($_SESSION['success_message']); // Clear the message
                                    ?>
                                <?php elseif (isset($_SESSION['error_message'])): ?>
                                    <span style="color: red; display: block; margin: 10px 0;">
                                        <?= htmlspecialchars($_SESSION['error_message']) ?>
                                    </span>
                                    <?php unset($_SESSION['error_message']); // Clear the message
                                    ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="full_name" value="<?= $userDetails['full_name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email Address(Email cannot be changed)</label>
                                    <input type="email" value="<?= $userDetails['email'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Profile Photo</label>
                                    <input type="file"
                                        name="profile_photo" id="profile_photo"
                                        accept="image/*">
                                </div>
                            </div>
                            <button type="submit" class="btn-primary">Save Personal Details</button>
                        </form>
                        <!-- Security & Preferences Section -->
                        <form action="update-password.php" method="post" class="profile-section">
                            <div class="section-header">
                                <h2>🔐 Security & Preferences</h2>
                                <p>Manage your account security and notification settings.</p>
                                <!-- Success and Error Messages -->
                                <?php if (isset($_SESSION['pw_success_message'])): ?>
                                    <span style="color: green; display: block; margin: 10px 0;">
                                        <?= htmlspecialchars($_SESSION['pw_success_message']) ?>
                                    </span>
                                    <?php unset($_SESSION['pw_success_message']); // Clear the message
                                    ?>
                                <?php elseif (isset($_SESSION['pw_error_message'])): ?>
                                    <span style="color: red; display: block; margin: 10px 0;">
                                        <?= htmlspecialchars($_SESSION['pw_error_message']) ?>
                                    </span>
                                    <?php unset($_SESSION['pw_error_message']); // Clear the message
                                    ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" name="old_password">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="confirm_password">
                                </div>
                            </div>
                            <button type="submit" class="btn-primary">Change Password</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            loadBookings();
        });

        function loadBookings() {
            $.ajax({
                url: 'http://localhost/merosewa/api/getStats.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        populateAnalytics(response.stats);
                    } else {
                        $('#total-jobs').text(0);
                        $('#total-users').text(0);
                        $('#total-services').text(0);
                    }
                },
                error: function() {
                    $('#total-jobs').text(0);
                    $('#total-users').text(0);
                    $('#total-services').text(0);
                }
            });
        }
        populateAnalytics = (stats) => {
            const data = stats[0];
            $('#total-jobs').text(data.total_jobs);
            $('#total-users').text(data.total_users);
            $('#total-services').text(data.total_services);
        }
    </script>

</body>

</html>
