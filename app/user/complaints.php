<?php
require_once '../app/config/config.php';
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';

// Check if user is logged in and is a service provider
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

// Get complaints data
$db = new Database();
// Add your complaints queries here

// Start output buffering
ob_start();
?>

<div class="complaints-content">
    <h1>Submit New Complaint</h1>
    <p>Please provide details about your issue.</p>
    
    <div class="complaint-form">
        <form id="complaintForm">
            <div class="form-group">
                <label for="complaintType">Complaint Type</label>
                <select id="complaintType" name="complaintType" required>
                    <option value="">Select a complaint type</option>
                    <option value="service_quality">Service Quality</option>
                    <option value="provider_behavior">Provider Behavior</option>
                    <option value="booking_issues">Booking Issues</option>
                    <option value="payment_issues">Payment Issues</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bookingId">Booking ID (Optional)</label>
                <input type="text" id="bookingId" name="bookingId" placeholder="e.g., MEROSW-20240715-001">
            </div>

            <div class="form-group">
                <label for="issueDescription">Issue Description</label>
                <textarea id="issueDescription" name="issueDescription" placeholder="Describe your issue in detail. Please include relevant dates, times, and names." required></textarea>
            </div>

            <div class="form-group">
                <label>Upload Supporting Documents (Optional)</label>
                <div class="upload-area">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Drag and drop files here or click to browse</p>
                    <p class="file-info">Max file size: 5MB</p>
                    <input type="file" id="documents" name="documents" multiple>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Submit Complaint</button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/complaints.css'];
$additional_js = ['/webb/user/assets/js/complaints.js'];
require 'layouts/provider.php';
?> 