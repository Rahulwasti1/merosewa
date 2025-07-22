<?php

// Check if user is logged in and is a service provider
session_start();
// if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'provider') {
//     header('Location: login.php');
//     exit();
// }

// Get service request data

// Add your service request queries here

// Start output buffering
ob_start();
?>

<div class="service-requests-content">
    <h1>Service Requests</h1>

    <div class="requests-filters">
        <select name="status" id="status-filter">
            <option value="all">All Requests</option>
            <option value="pending">Pending</option>
            <option value="accepted">Accepted</option>
            <option value="rejected">Rejected</option>
        </select>

        <select name="service_type" id="service-filter">
            <option value="all">All Services</option>
            <option value="cleaning">Cleaning</option>
            <option value="plumbing">Plumbing</option>
            <option value="electrical">Electrical</option>
        </select>

        <input type="date" id="date-filter" name="date">

        <button class="filter-btn">Apply Filters</button>
    </div>

    <div class="requests-list">
        <!-- New Request -->
        <div class="request-card">
            <div class="request-header">
                <h3>House Deep Cleaning</h3>
                <span class="status pending">Pending</span>
            </div>
            <div class="request-details">
                <p><i class="far fa-user"></i> Customer: Mike Wilson</p>
                <p><i class="far fa-calendar"></i> Date: Oct 20, 2023</p>
                <p><i class="far fa-clock"></i> Time: 10:00 AM</p>
                <p><i class="fas fa-map-marker-alt"></i> Location: Kathmandu, Nepal</p>
                <p><i class="fas fa-info-circle"></i> Special Requirements: Pet-friendly cleaning products only</p>
            </div>
            <div class="request-actions">
                <button class="btn accept">Accept Request</button>
                <button class="btn reject">Reject</button>
                <button class="btn details">View Details</button>
            </div>
        </div>

        <!-- Accepted Request -->
        <div class="request-card">
            <div class="request-header">
                <h3>Regular House Cleaning</h3>
                <span class="status accepted">Accepted</span>
            </div>
            <div class="request-details">
                <p><i class="far fa-user"></i> Customer: Sarah Brown</p>
                <p><i class="far fa-calendar"></i> Date: Oct 22, 2023</p>
                <p><i class="far fa-clock"></i> Time: 2:00 PM</p>
                <p><i class="fas fa-map-marker-alt"></i> Location: Lalitpur, Nepal</p>
                <p><i class="fas fa-info-circle"></i> Notes: Weekly cleaning service</p>
            </div>
            <div class="request-actions">
                <button class="btn contact">Contact Customer</button>
                <button class="btn reschedule">Reschedule</button>
                <button class="btn details">View Details</button>
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
?>
