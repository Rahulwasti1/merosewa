<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';
$_SESSION['page_title'] = "MeroSewa - My Profile";

$db = new Database();
$userId = SessionUser::getId();
$userDetails = $db->selectFirst("SELECT * FROM users WHERE id = ?;", [$userId]);
ob_start();
?>
<!-- Profile Content -->
<div class="profile-container">
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

    <?php
    $content = ob_get_clean();
    $additional_css = ['/merosewa/public/css/base.css', '/merosewa/public/css/layout.css', '/merosewa/app/provider/css/profile.css'];
    require '../layouts/provider.php';
    ?>
