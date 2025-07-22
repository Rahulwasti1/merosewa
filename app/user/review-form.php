<?php
require_once '../app/config/config.php';
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

$db = new Database();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave a Review - MeroSewa</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/review-form.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="assets/logo.png" alt="MeroSewa">
                <span>MeroSewa</span>
            </div>
            <nav>
                <a href="dashboard.php">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="../services.php">
                    <i class="fas fa-tools"></i>
                    <span>Services</span>
                </a>
                <a href="../alerts.php">
                    <i class="fas fa-bell"></i>
                    <span>Alerts</span>
                </a>
                <a href="bookings.php">
                    <i class="fas fa-calendar"></i>
                    <span>Bookings</span>
                </a>
                <a href="job-history.php" class="active">
                    <i class="fas fa-history"></i>
                    <span>Job History</span>
                </a>
                <a href="complaints.php">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Complaints</span>
                </a>
                <a href="profile.php">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </nav>
            <div class="user-actions">
                <a href="../logout.php" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header>
                <div class="search-bar">
                    <input type="text" placeholder="Search services, providers...">
                </div>
                <div class="header-right">
                    <div class="notifications">
                        <span>🔔</span>
                        <span class="badge">3</span>
                    </div>
                    <div class="profile-icon">
                        <img src="assets/profile.jpg" alt="Profile">
                    </div>
                </div>
            </header>

            <!-- Review Form Content -->
            <div class="review-form-container">
                <h1>Leave a Review</h1>
                
                <form action="submit-review.php" method="POST" enctype="multipart/form-data">
                    <!-- Service Details -->
                    <div class="form-section">
                        <h2>Service Details</h2>
                        <p class="section-desc">Please review the details of the service you are rating.</p>
                        
                        <div class="service-info">
                            <div class="info-item">
                                <h3 id="service-name"></h3>
                                <p id="provider-name"></p>
                                <p id="service-date"></p>
                                <p id="service-id"></p>
                            </div>
                            <div class="service-image">
                                <!-- Service image will be displayed here -->
                            </div>
                        </div>
                    </div>

                    <!-- Rating Section -->
                    <div class="form-section">
                        <h2>Your Rating</h2>
                        <p class="section-desc">How would you rate your experience with this service?</p>
                        
                        <div class="rating-stars">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5">⭐</label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4">⭐</label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3">⭐</label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2">⭐</label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1">⭐</label>
                        </div>
                    </div>

                    <!-- Feedback Section -->
                    <div class="form-section">
                        <h2>Your Feedback</h2>
                        <p class="section-desc">Share your detailed thoughts about the service.</p>
                        
                        <textarea name="feedback" rows="6" placeholder="Tell us more about your experience...
- What did you like most about the service?
- Were there any areas for improvement?
- How was the service provider's professionalism?
- Would you recommend this service to others?"></textarea>
                    </div>

                    <!-- Photo Upload Section -->
                    <div class="form-section">
                        <h2>Add Photos (Optional)</h2>
                        <p class="section-desc">Upload up to 5 photos related to the service.</p>
                        
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-placeholder">
                                <span>📸</span>
                                <p>Drag & drop files here, or click to upload</p>
                                <p class="upload-info">PNG, JPG, up to 5MB each</p>
                            </div>
                            <input type="file" name="photos[]" multiple accept="image/png,image/jpeg" class="file-input">
                        </div>
                        <div id="preview-container" class="preview-container"></div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" onclick="history.back()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/review-form.js"></script>
</body>
</html>

<?php
$content = ob_get_clean();
$additional_css = ['/user/css/review-form.css'];
$additional_js = ['/user/js/review-form.js'];
require '../app/views/layouts/provider.php';
?> 