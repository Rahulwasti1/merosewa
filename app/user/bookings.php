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

// Get bookings data
$db = new Database();
// Add your bookings queries here

// Start output buffering
ob_start();
?>

<div class="bookings-dashboard">
    <h1>My Bookings Dashboard</h1>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Active Bookings</span>
                <span class="stat-value">3</span>
                <span class="stat-desc">Currently in progress</span>
            </div>
            <i class="fas fa-spinner"></i>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Upcoming Bookings</span>
                <span class="stat-value">2</span>
                <span class="stat-desc">Next 30 days</span>
            </div>
            <i class="fas fa-calendar"></i>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Completed Services</span>
                <span class="stat-value">25</span>
                <span class="stat-desc">Total completed lifetime</span>
            </div>
            <i class="fas fa-check-circle"></i>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bookings-header">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search bookings...">
        </div>
        <div class="filter-dropdown">
            <button class="btn-filter">
                Filter by Status
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
    </div>

    <!-- Upcoming & Active Bookings -->
    <section class="bookings-section">
        <h2>Upcoming & Active Bookings</h2>
        
        <div class="booking-cards">
            <!-- Upcoming Booking 1 -->
            <div class="booking-card">
                <div class="service-image"></div>
                <div class="booking-details">
                    <div class="booking-header">
                        <h3>Full Home Deep Cleaning</h3>
                        <span class="status-badge upcoming">Upcoming</span>
                    </div>
                    <p class="service-provider">Service provided by Sparkle Clean Pro</p>
                    <div class="booking-time">
                        <div class="time-item">
                            <i class="far fa-calendar"></i>
                            <span>October 26, 2024</span>
                        </div>
                        <div class="time-item">
                            <i class="far fa-clock"></i>
                            <span>10:00 AM - 1:00 PM</span>
                        </div>
                    </div>
                    <div class="booking-actions">
                        <button class="btn-view">View Details</button>
                        <button class="btn-cancel">Cancel</button>
                        <button class="btn-reschedule">Reschedule</button>
                    </div>
                </div>
            </div>

            <!-- Upcoming Booking 2 -->
            <div class="booking-card">
                <div class="service-image"></div>
                <div class="booking-details">
                    <div class="booking-header">
                        <h3>AC Repair & Servicing</h3>
                        <span class="status-badge upcoming">Upcoming</span>
                    </div>
                    <p class="service-provider">Service provided by Cool Air Experts</p>
                    <div class="booking-time">
                        <div class="time-item">
                            <i class="far fa-calendar"></i>
                            <span>November 2, 2024</span>
                        </div>
                        <div class="time-item">
                            <i class="far fa-clock"></i>
                            <span>02:00 PM - 04:00 PM</span>
                        </div>
                    </div>
                    <div class="booking-actions">
                        <button class="btn-view">View Details</button>
                        <button class="btn-cancel">Cancel</button>
                        <button class="btn-reschedule">Reschedule</button>
                    </div>
                </div>
            </div>

            <!-- Active Booking -->
            <div class="booking-card">
                <div class="service-image"></div>
                <div class="booking-details">
                    <div class="booking-header">
                        <h3>Plumbing Leak Fix</h3>
                        <span class="status-badge active">Active</span>
                    </div>
                    <p class="service-provider">Service provided by Rapid Pipes Solutions</p>
                    <div class="booking-time">
                        <div class="time-item">
                            <i class="far fa-calendar"></i>
                            <span>October 25, 2024</span>
                        </div>
                        <div class="time-item">
                            <i class="far fa-clock"></i>
                            <span>09:00 AM - 11:00 AM</span>
                        </div>
                    </div>
                    <div class="booking-actions">
                        <button class="btn-view">View Details</button>
                        <button class="btn-complete">Confirm Completion</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Past Bookings History -->
    <section class="bookings-section">
        <h2>Past Bookings History</h2>
        
        <div class="bookings-table">
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Provider</th>
                        <th>Date Completed</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Electrical Wiring Check</td>
                        <td>ElectroSpark Services</td>
                        <td>October 15, 2024</td>
                        <td><span class="status completed">Completed</span></td>
                        <td>$75.00</td>
                        <td><button class="btn-actions"><i class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                    <tr>
                        <td>Garden Maintenance</td>
                        <td>Green Thumb Landscaping</td>
                        <td>October 10, 2024</td>
                        <td><span class="status completed">Completed</span></td>
                        <td>$60.00</td>
                        <td><button class="btn-actions"><i class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                    <tr>
                        <td>Refrigerator Repair</td>
                        <td>Appliance Fixers</td>
                        <td>October 5, 2024</td>
                        <td><span class="status cancelled">Cancelled</span></td>
                        <td>$0.00</td>
                        <td><button class="btn-actions"><i class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                    <tr>
                        <td>Pest Control Service</td>
                        <td>Bug Busters Nepal</td>
                        <td>September 28, 2024</td>
                        <td><span class="status completed">Completed</span></td>
                        <td>$90.00</td>
                        <td><button class="btn-actions"><i class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                    <tr>
                        <td>Carpet Cleaning</td>
                        <td>Spotless Floors Inc.</td>
                        <td>September 20, 2024</td>
                        <td><span class="status completed">Completed</span></td>
                        <td>$55.00</td>
                        <td><button class="btn-actions"><i class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                    <tr>
                        <td>Washing Machine Repair</td>
                        <td>Quick Fix Appliances</td>
                        <td>September 12, 2024</td>
                        <td><span class="status completed">Completed</span></td>
                        <td>$85.00</td>
                        <td><button class="btn-actions"><i class="fas fa-ellipsis-v"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/bookings.css'];
$additional_js = ['/webb/user/assets/js/bookings.js'];
require 'layouts/provider.php';
?> 