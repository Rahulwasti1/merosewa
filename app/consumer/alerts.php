<?php
require_once '../app/config/config.php';
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';

// Check if user is logged in and is a service provider
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'provider') {
    header('Location: login.php');
    exit();
}

// Get alerts data
$db = new Database();
// Add your alerts queries here

// Start output buffering
ob_start();
?>

<div class="alerts-content">
    <h1>Alerts & Notifications</h1>

    <div class="alerts-filters">
        <select name="type" id="type-filter">
            <option value="all">All Notifications</option>
            <option value="bookings">Booking Alerts</option>
            <option value="reviews">Review Alerts</option>
            <option value="system">System Alerts</option>
        </select>

        <select name="status" id="status-filter">
            <option value="all">All Status</option>
            <option value="unread">Unread</option>
            <option value="read">Read</option>
        </select>

        <button class="filter-btn">Apply Filters</button>
        <button class="mark-all-read">Mark All as Read</button>
    </div>

    <div class="alerts-list">
        <!-- Unread Alert -->
        <div class="alert-card unread">
            <div class="alert-icon booking">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="alert-content">
                <h3>New Booking Request</h3>
                <p>You have a new booking request for House Cleaning service from John Doe.</p>
                <span class="alert-time">2 hours ago</span>
            </div>
            <div class="alert-actions">
                <button class="btn view">View</button>
                <button class="btn mark-read">Mark as Read</button>
            </div>
        </div>

        <!-- Read Alert -->
        <div class="alert-card">
            <div class="alert-icon review">
                <i class="fas fa-star"></i>
            </div>
            <div class="alert-content">
                <h3>New Review Received</h3>
                <p>Sarah Johnson left a 5-star review for your Deep Cleaning service.</p>
                <span class="alert-time">1 day ago</span>
            </div>
            <div class="alert-actions">
                <button class="btn view">View Review</button>
            </div>
        </div>

        <!-- System Alert -->
        <div class="alert-card">
            <div class="alert-icon system">
                <i class="fas fa-bell"></i>
            </div>
            <div class="alert-content">
                <h3>Profile Verification Required</h3>
                <p>Please complete your profile verification by uploading the required documents.</p>
                <span class="alert-time">2 days ago</span>
            </div>
            <div class="alert-actions">
                <button class="btn verify">Verify Now</button>
            </div>
        </div>
    </div>

    <div class="pagination">
        <button class="prev-btn">Previous</button>
        <span class="page-info">Page 1 of 3</span>
        <button class="next-btn">Next</button>
    </div>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/alerts.css'];
require 'layouts/provider.php';
?>
