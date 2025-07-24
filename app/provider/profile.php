<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - MeroSewa</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/layout.css">
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
                            <div class="form-group full-width">
                                <label>Bio / Description</label>
                                <textarea rows="3">Experienced electrician with over 15 years in the field, specializing in residential wiring, fault detection, and smart home installations. Committed to providing safe, efficient, and reliable service across Kathmandu Valley. I prioritize customer satisfaction and clear communication.</textarea>
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

                    <!-- Service Provider Settings Section -->
                    <div class="profile-section">
                        <div class="section-header">
                            <h2>🛠️ Service Provider Settings</h2>
                            <p>Configure your service settings, area, and availability.</p>
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Service Categories</label>
                                <select>
                                    <option>Electrician</option>
                                </select>
                                <small>You can select multiple categories (max 3)</small>
                            </div>
                            <div class="form-group">
                                <label>Service Areas</label>
                                <input type="text" value="Kathmandu, Lalitpur, Bhaktapur">
                                <small>List your areas and provide service radius if applicable by commas.</small>
                            </div>
                            <div class="form-group full-width">
                                <label>Working Hours</label>
                                <div class="working-hours-grid">
                                    <div class="day-hours">
                                        <span>Mon:</span>
                                        <input type="time" value="09:00">
                                        <span>to</span>
                                        <input type="time" value="17:00">
                                    </div>
                                    <div class="day-hours">
                                        <span>Tue:</span>
                                        <input type="time" value="09:00">
                                        <span>to</span>
                                        <input type="time" value="17:00">
                                    </div>
                                    <div class="day-hours">
                                        <span>Wed:</span>
                                        <input type="time" value="09:00">
                                        <span>to</span>
                                        <input type="time" value="17:00">
                                    </div>
                                    <div class="day-hours">
                                        <span>Thu:</span>
                                        <input type="time" value="09:00">
                                        <span>to</span>
                                        <input type="time" value="17:00">
                                    </div>
                                    <div class="day-hours">
                                        <span>Fri:</span>
                                        <input type="time" value="09:00">
                                        <span>to</span>
                                        <input type="time" value="17:00">
                                    </div>
                                </div>
                                <small>Specify your availability for each working day.</small>
                            </div>
                            <div class="form-group full-width">
                                <label>ID/License Verification Documents</label>
                                <div class="file-upload">
                                    <input type="file" id="document-upload" hidden>
                                    <label for="document-upload" class="upload-area">
                                        <span>📄</span>
                                        <p>Upload your official ID or service license for verification</p>
                                        <small>Max file size: 5MB</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="btn-primary">Save Service Provider Details</button>
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

                    <button class="btn-danger">🚪 Log Out</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/profile.js"></script>
</body>
</html> 