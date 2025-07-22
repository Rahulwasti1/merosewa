<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['authenticated'] !== true) {
    header("Location: /merosewa/login.php");
    exit();
}
ob_start();
?>

<div class="dashboard-content">
    <h1>Welcome, <?php echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : 'User'; ?>!</h1>
    <p class="subtitle">Your dashboard at a glance. Find services, manage bookings, and explore offers.</p>

    <div class="quick-links">
        <h2>Quick Links</h2>
        <div class="links-grid">
            <a href="/merosewa/app/consumer/services.php" class="quick-link">
                <i class="fas fa-tools"></i>
                <span>Book a Service</span>
            </a>
            <a href="/merosewa/app/consumer/bookings.php" class="quick-link">
                <i class="fas fa-calendar"></i>
                <span>View Bookings</span>
            </a>
            <a href="/merosewa/app/consumer/complaints.php" class="quick-link">
                <i class="fas fa-exclamation-circle"></i>
                <span>Submit Request</span>
            </a>
            <a href="/merosewa/app/consumer/alerts.php" class="quick-link">
                <i class="fas fa-bell"></i>
                <span>Check Alerts</span>
            </a>
        </div>
    </div>

    <div class="current-bookings">
        <h2>Current Bookings</h2>
        <div class="bookings-list">
            <div class="booking-item confirmed">
                <div class="booking-info">
                    <h3>Plumbing Repair</h3>
                    <p>Ram Services • July 20, 2025 at 10:00 AM</p>
                </div>
                <span class="status">Confirmed</span>
                <a href="#" class="view-details"><i class="fas fa-chevron-right"></i></a>
            </div>

            <div class="booking-item pending">
                <div class="booking-info">
                    <h3>House Cleaning</h3>
                    <p>Laxmi Cleaning • Oct 17, 2025 at 02:00 PM</p>
                </div>
                <span class="status">Pending</span>
                <a href="#" class="view-details"><i class="fas fa-chevron-right"></i></a>
            </div>

            <div class="booking-item confirmed">
                <div class="booking-info">
                    <h3>Electrical Wiring</h3>
                    <p>Hari Electric • Aug 30, 2025 at 09:00 AM</p>
                </div>
                <span class="status">Confirmed</span>
                <a href="#" class="view-details"><i class="fas fa-chevron-right"></i></a>
            </div>

            <div class="booking-item completed">
                <div class="booking-info">
                    <h3>Car Mechanic</h3>
                    <p>Shyam Auto • May 05, 2025 at 11:30 AM</p>
                </div>
                <span class="status">Completed</span>
                <a href="#" class="view-details"><i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>

    <div class="promotional-offers">
        <h2>Promotional Offers</h2>
        <div class="offers-grid">
            <div class="offer-card">
                <h3>Dashain Cleaning Discount!</h3>
                <p>Get 20% off on all deep cleaning services during Dashain festival.</p>
                <a href="#" class="btn-learn-more">Learn More</a>
            </div>

            <div class="offer-card">
                <h3>First Time User Offer</h3>
                <p>Save 15% off your first service booking with code: NEW15</p>
                <a href="#" class="btn-learn-more">Learn More</a>
            </div>

            <div class="offer-card">
                <h3>Refer a Friend, Get Rs. 500!</h3>
                <p>Invite friends and earn rewards on their first booking.</p>
                <a href="#" class="btn-learn-more">Learn More</a>
            </div>
        </div>
    </div>

    <div class="recommended-services">
        <h2>Recommended Services</h2>
        <div class="services-list">
            <a href="#" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-snowflake"></i>
                </div>
                <div class="service-info">
                    <h3>AC Repair & Servicing</h3>
                    <p>Home Appliances</p>
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>

            <a href="#" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="service-info">
                    <h3>Laptop & Mobile Repair</h3>
                    <p>Electronics</p>
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>

            <a href="#" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-broom"></i>
                </div>
                <div class="service-info">
                    <h3>Deep House Cleaning</h3>
                    <p>Cleaning</p>
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>

            <a href="#" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-bug"></i>
                </div>
                <div class="service-info">
                    <h3>Pest Control</h3>
                    <p>Home Maintenance</p>
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>

            <a href="#" class="service-item">
                <div class="service-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="service-info">
                    <h3>Tutor for Kids</h3>
                    <p>Education</p>
                </div>
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();


$additional_css = ['/merosewa/app/consumer/assets/css/dashboard.css'];
require 'layouts/provider.php';
?>
