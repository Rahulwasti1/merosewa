<?php
require_once '../app/config/config.php';
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

// Get user data
$db = new Database();
// Add your profile data queries here

// Start output buffering
ob_start();
?>

<div class="profile-container">
    <!-- Left Navigation -->
    <div class="profile-nav">
        <a href="#" class="nav-item active">
            <i class="fas fa-user"></i>
            Personal Information
        </a>
    </div>

    <!-- Main Content -->
    <div class="profile-content">
        <div class="profile-section">
            <h2>Personal Information</h2>
            <p class="section-description">Manage your basic profile details.</p>

            <form id="profile-form">
                <!-- Profile Photo -->
                <div class="profile-photo"></div>
                <div class="photo-actions">
                    <button type="button" class="btn-change-photo">
                        <i class="fas fa-arrow-up-from-bracket"></i>
                        Change Photo
                    </button>
                    <button type="button" class="btn-remove-photo">
                        <i class="fas fa-trash"></i>
                        Remove
                    </button>
                </div>
                <p class="photo-hint">Recommended: Square JPG, PNG. Max size 1MB</p>

                <!-- Form Fields -->
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" value="Prakash">
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" value="Shrestha">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" value="prakash.shrestha@example.com" disabled>
                    <p class="field-hint">Contact support to change email address</p>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="form-control" value="+977 9841234567">
                    <p class="field-hint">Used for booking notifications</p>
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="form-control" rows="4">Passionate about connecting people with quality home services.</textarea>
                    <div class="character-count">138 characters remaining</div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="button" class="btn-view-profile">
                        <i class="fas fa-eye"></i>
                        View Public Profile
                    </button>
                    <div class="primary-actions">
                        <button type="button" class="btn-cancel">Cancel</button>
                        <button type="submit" class="btn-save">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/profile.css'];
$additional_js = ['/webb/user/assets/js/profile.js'];
require 'layouts/provider.php';
?> 