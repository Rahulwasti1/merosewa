<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - MeroSewa</title>
    <link rel="stylesheet" href="/merosewa/public/css/base.css">
    <link rel="stylesheet" href="/merosewa/public/css/layout.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <!-- Profile Content -->
            <div class="profile-container">
                <h1>Your Profile & Settings</h1>

                <div class="profile-content">
                    <!-- Profile Picture Section -->
                    <div class="profile-picture">
                        <div class="picture-container">
                            <img src="../assets/profile.jpg" alt="Aaryan Sharma">
                        </div>
                        <div class="profile-status">
                            <span class="badge service-provider">Service Provider</span>
                            <button class="btn-outline">Edit Profile</button>
                        </div>
                    </div>

                    <!-- Personal Details Section -->
                    <div class="profile-section">
                        <div class="section-header">
                            <h2>👤 Personal Details</h2>
                            <p>Manage your personal information and how it appears to others.</p>
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" value="Aaryan Sharma">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" value="aaryan.sharma@merosewa.com">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" value="+977 9812345678">
                            </div>
                        </div>
                        <button class="btn-primary">Save Personal Details</button>
                    </div>

                    <!-- Identity Verification Section -->
                    <div class="profile-section">
                        <div class="section-header">
                            <h2>🔒 Identity Verification</h2>
                            <p>Show others you're a verified professional and build trust.</p>
                        </div>
                        <button class="btn-primary">Get Verified Badge</button>
                    </div>



                    <!-- Security & Preferences Section -->
                    <div class="profile-section">
                        <div class="section-header">
                            <h2>🔐 Security & Preferences</h2>
                            <p>Manage your account security and notification settings.</p>
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password">
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password">
                            </div>
                        </div>
                        <button class="btn-primary">Change Password</button>

                        <div class="preferences">
                            <div class="preference-item">
                                <div>
                                    <h3>Availability Status</h3>
                                    <p>Toggle to show your availability to receive new service requests.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <div>
                                    <h3>Email Notifications</h3>
                                    <p>Receive important updates and alerts via email.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
