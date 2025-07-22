<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

ob_start();
?>

<div class="service-details-content">
    <!-- Service Overview -->
    <section class="service-overview">
        <div class="service-images">
            <div class="main-image">
                <img src="/webb/assets/images/plumbing-main.jpg" alt="Expert Plumbing Services">
            </div>
            <div class="thumbnail-images">
                <img src="/webb/assets/images/plumbing-1.jpg" alt="Plumbing Work 1">
                <img src="/webb/assets/images/plumbing-2.jpg" alt="Plumbing Work 2">
                <img src="/webb/assets/images/plumbing-3.jpg" alt="Plumbing Work 3">
                <img src="/webb/assets/images/plumbing-4.jpg" alt="Plumbing Work 4">
            </div>
        </div>

        <div class="service-info">
            <div class="service-header">
                <h1>Expert Plumbing Services</h1>
                <div class="service-meta">
                    <div class="rating">
                        <span class="stars">★★★★★</span>
                        <span class="reviews">(210 reviews)</span>
                    </div>
                    <span class="price">NPR 1500 / Hr</span>
                </div>
            </div>

            <div class="provider-info">
                <img src="/webb/assets/images/provider-avatar.jpg" alt="Provider" class="provider-avatar">
                <div class="provider-details">
                    <h3>Kathmandu Plumbing Solutions</h3>
                    <p>Professional Plumbing Services</p>
                    <div class="provider-stats">
                        <span>5 years experience</span>
                        <span>•</span>
                        <span>500+ jobs completed</span>
                    </div>
                </div>
            </div>

            <div class="service-description">
                <h2>About This Service</h2>
                <p>Professional plumbing services for all your needs. We specialize in repairs, installations, and maintenance for both residential and commercial properties. Our team of experienced plumbers ensures quality workmanship and reliable solutions.</p>
                
                <h3>Services Offered:</h3>
                <ul>
                    <li>Pipe repair and replacement</li>
                    <li>Drain cleaning and maintenance</li>
                    <li>Water heater installation and repair</li>
                    <li>Bathroom and kitchen plumbing</li>
                    <li>Emergency plumbing services</li>
                    <li>Water leak detection and repair</li>
                </ul>
            </div>

            <div class="booking-options">
                <button class="btn-book">Book Now</button>
                <button class="btn-contact">Contact Provider</button>
            </div>
        </div>
    </section>

    <!-- Service Details Tabs -->
    <section class="service-details-tabs">
        <div class="tabs-header">
            <button class="tab-btn active" data-tab="reviews">Reviews</button>
            <button class="tab-btn" data-tab="portfolio">Portfolio</button>
            <button class="tab-btn" data-tab="faq">FAQ</button>
        </div>

        <!-- Reviews Tab -->
        <div class="tab-content active" id="reviews">
            <div class="reviews-summary">
                <div class="rating-overview">
                    <div class="rating-big">
                        <span class="rating-number">4.8</span>
                        <div class="rating-stars">★★★★★</div>
                        <span class="total-reviews">210 reviews</span>
                    </div>
                    <div class="rating-bars">
                        <div class="rating-bar">
                            <span>5 stars</span>
                            <div class="bar-container">
                                <div class="bar" style="width: 80%"></div>
                            </div>
                            <span>180</span>
                        </div>
                        <div class="rating-bar">
                            <span>4 stars</span>
                            <div class="bar-container">
                                <div class="bar" style="width: 15%"></div>
                            </div>
                            <span>20</span>
                        </div>
                        <div class="rating-bar">
                            <span>3 stars</span>
                            <div class="bar-container">
                                <div class="bar" style="width: 5%"></div>
                            </div>
                            <span>8</span>
                        </div>
                        <div class="rating-bar">
                            <span>2 stars</span>
                            <div class="bar-container">
                                <div class="bar" style="width: 0%"></div>
                            </div>
                            <span>2</span>
                        </div>
                        <div class="rating-bar">
                            <span>1 star</span>
                            <div class="bar-container">
                                <div class="bar" style="width: 0%"></div>
                            </div>
                            <span>0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reviews-list">
                <div class="review-item">
                    <div class="review-header">
                        <img src="/webb/assets/images/user-avatar.jpg" alt="User" class="user-avatar">
                        <div class="review-meta">
                            <h4>John Doe</h4>
                            <div class="rating">★★★★★</div>
                            <span class="review-date">2 days ago</span>
                        </div>
                    </div>
                    <p class="review-text">Excellent service! The plumber was professional, punctual, and fixed our leaking pipe quickly. Highly recommended!</p>
                    <div class="review-images">
                        <img src="/webb/assets/images/review-1.jpg" alt="Review Image">
                        <img src="/webb/assets/images/review-2.jpg" alt="Review Image">
                    </div>
                </div>

                <!-- More review items -->
            </div>
        </div>

        <!-- Portfolio Tab -->
        <div class="tab-content" id="portfolio">
            <div class="portfolio-grid">
                <div class="portfolio-item">
                    <img src="/webb/assets/images/portfolio-1.jpg" alt="Portfolio Work">
                    <div class="portfolio-overlay">
                        <h4>Bathroom Renovation</h4>
                        <p>Complete plumbing installation</p>
                    </div>
                </div>
                <!-- More portfolio items -->
            </div>
        </div>

        <!-- FAQ Tab -->
        <div class="tab-content" id="faq">
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>What are your working hours?</h4>
                        <span class="toggle-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>We are available 24/7 for emergency services. Regular working hours are from 8 AM to 6 PM, Monday through Saturday.</p>
                    </div>
                </div>
                <!-- More FAQ items -->
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/service-details.css'];
$additional_js = ['/webb/user/assets/js/service-details.js'];
require 'layouts/provider.php';
?> 