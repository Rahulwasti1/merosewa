<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

ob_start();
?>

<div class="job-history-content">
    <div class="job-history-header">
    <h1>Job History</h1>
    <div class="history-filters">
            <div class="filter-group">
                <label for="date">Date Range</label>
                <select id="date">
            <option value="all">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
        </select>
            </div>
            <div class="filter-group">
                <label for="service">Service Type</label>
                <select id="service">
                    <option value="all">All Services</option>
                    <option value="plumbing">Plumbing</option>
                    <option value="electrical">Electrical</option>
                    <option value="cleaning">Cleaning</option>
                    <option value="painting">Painting</option>
        </select>
    </div>
            <div class="filter-group">
                <label for="rating">Rating</label>
                <select id="rating">
                    <option value="all">All Ratings</option>
                    <option value="5">5 Stars</option>
                    <option value="4">4+ Stars</option>
                    <option value="3">3+ Stars</option>
                    <option value="2">2+ Stars</option>
                    <option value="1">1+ Star</option>
                </select>
        </div>
        </div>
    </div>
    
    <div class="job-history-list">
        <!-- Completed Job with Review -->
        <div class="job-card">
            <div class="job-service">
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

            <div class="job-info">
                <div class="info-item">
                    <i class="fas fa-calendar"></i>
                    <span>June 15, 2025</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span>10:00 AM - 12:00 PM</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>123 Main Street, Kathmandu</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>NPR 3,200</span>
                </div>
            </div>

            <div class="job-review">
                <div class="review-header">
                    <div class="review-rating">
                        <span class="stars">★★★★★</span>
                        <span class="date">Reviewed on June 16, 2025</span>
                    </div>
                    <button class="btn-edit-review">Edit Review</button>
                </div>
                <p class="review-text">Excellent service! The plumber was very professional and fixed the issue quickly. Would definitely recommend their services to others.</p>
                <div class="review-photos">
                    <img src="/webb/assets/images/review-1.jpg" alt="Review Photo 1">
                    <img src="/webb/assets/images/review-2.jpg" alt="Review Photo 2">
                </div>
            </div>

            <div class="job-actions">
                <button class="btn-rebook">Book Again</button>
            </div>
        </div>

        <!-- Completed Job without Review -->
        <div class="job-card">
            <div class="job-service">
                <img src="/webb/assets/images/cleaning.jpg" alt="Home Cleaning Services">
                <div class="service-details">
                    <h2>Home Cleaning Services</h2>
                    <p>Clean Home Solutions</p>
                    <div class="service-meta">
                        <div class="rating">
                            <span class="stars">★★★★☆</span>
                            <span class="reviews">(180 reviews)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="job-info">
                <div class="info-item">
                    <i class="fas fa-calendar"></i>
                    <span>June 10, 2025</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <span>2:00 PM - 5:00 PM</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>456 Park Avenue, Lalitpur</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>NPR 4,500</span>
                </div>
            </div>

            <div class="job-review pending">
                <div class="review-prompt">
                    <i class="fas fa-star"></i>
                    <p>Share your experience with others</p>
                    <button class="btn-write-review">Write a Review</button>
                </div>
            </div>

            <div class="job-actions">
                <button class="btn-rebook">Book Again</button>
            </div>
        </div>
    </div>

    <div class="job-history-pagination">
        <button class="btn-prev" disabled>
            <i class="fas fa-chevron-left"></i>
            Previous
        </button>
        <div class="page-numbers">
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <span>...</span>
            <button>10</button>
        </div>
        <button class="btn-next">
            Next
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/job-history.css'];
$additional_js = ['/webb/user/assets/js/job-history.js'];
require 'layouts/provider.php';
?> 