<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

ob_start();
?>

<div class="confirmation-content">
    <div class="confirmation-card">
        <div class="confirmation-header">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Booking Confirmed!</h1>
            <p>Your service has been successfully booked</p>
        </div>

        <div class="booking-details">
            <div class="booking-id">
                <span>Booking ID:</span>
                <strong>#BK123456</strong>
            </div>

            <div class="service-info">
                <img src="/webb/assets/images/plumbing-main.jpg" alt="Expert Plumbing Services">
                <div class="service-details">
                    <h2>Expert Plumbing Services</h2>
                    <p>Kathmandu Plumbing Solutions</p>
                    <div class="service-meta">
                        <div class="rating">
                            <span class="stars">★★★★★</span>
                            <span class="reviews">(210 reviews)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="details-grid">
                <div class="detail-item">
                    <span class="label">Service Type</span>
                    <span class="value">Pipe Repair</span>
                </div>
                <div class="detail-item">
                    <span class="label">Date</span>
                    <span class="value">June 15, 2025</span>
                </div>
                <div class="detail-item">
                    <span class="label">Time</span>
                    <span class="value">10:00 AM</span>
                </div>
                <div class="detail-item">
                    <span class="label">Duration</span>
                    <span class="value">2 hours (minimum)</span>
                </div>
                <div class="detail-item">
                    <span class="label">Location</span>
                    <span class="value">123 Main Street, Kathmandu</span>
                </div>
                <div class="detail-item">
                    <span class="label">Contact</span>
                    <span class="value">+977 98XXXXXXXX</span>
                </div>
            </div>

            <div class="price-summary">
                <div class="price-item">
                    <span>Base Rate</span>
                    <span>NPR 1500 / Hr</span>
                </div>
                <div class="price-item">
                    <span>Minimum Hours</span>
                    <span>2 hours</span>
                </div>
                <div class="price-item">
                    <span>Service Fee</span>
                    <span>NPR 200</span>
                </div>
                <div class="price-item total">
                    <span>Total Amount</span>
                    <span>NPR 3200</span>
                </div>
            </div>

            <div class="payment-info">
                <div class="payment-method">
                    <span class="label">Payment Method</span>
                    <span class="value">Cash on Service Completion</span>
                </div>
            </div>
        </div>

        <div class="confirmation-actions">
            <div class="action-buttons">
                <a href="/webb/user/bookings.php" class="btn-view-bookings">View My Bookings</a>
                <button class="btn-download">
                    <i class="fas fa-download"></i>
                    Download Receipt
                </button>
            </div>
            <div class="help-text">
                <p>Need help? <a href="/webb/user/support.php">Contact Support</a></p>
            </div>
        </div>
    </div>

    <div class="what-next">
        <h2>What's Next?</h2>
        <div class="steps-grid">
            <div class="step-item">
                <div class="step-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Booking Confirmed</h3>
                <p>Your booking has been confirmed and the service provider has been notified.</p>
            </div>
            <div class="step-item">
                <div class="step-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3>Provider Contact</h3>
                <p>The service provider will contact you before the scheduled time to confirm details.</p>
            </div>
            <div class="step-item">
                <div class="step-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h3>Service Delivery</h3>
                <p>The provider will arrive at your location at the scheduled time to perform the service.</p>
            </div>
            <div class="step-item">
                <div class="step-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3>Review & Rating</h3>
                <p>After service completion, you can rate and review your experience.</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/booking-confirmation.css'];
require 'layouts/provider.php';
?> 