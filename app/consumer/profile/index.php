<?php
require_once '../../helpers/redirect-to-login.php';
$_SESSION['page_title'] = "MeroSewa - My Profile";
ob_start();
?>
<!-- Profile Content -->
<div class="profile-container">
    <h1>Your Profile & Settings</h1>
    <form action="">
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
    </form>
    <!-- Identity Verification Section -->
    <div class="profile-section">
        <div class="section-header">
            <h2>🔒 Identity Verification</h2>
            <p>Show others you're a verified professional and build trust.</p>
        </div>
        <button class="btn-primary">Get Verified Badge</button>
    </div>
    <!-- Security & Preferences Section -->
    <form class="profile-section">
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
    </form>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/merosewa/public/css/base.css', '/merosewa/public/css/layout.css', '/merosewa/app/provider/css/profile.css'];
require '../layouts/provider.php';
?>
