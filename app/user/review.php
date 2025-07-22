<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

ob_start();
?>

<div class="review-content">
    <div class="review-header">
        <h1>Write a Review</h1>
        <p>Share your experience with Expert Plumbing Services</p>
    </div>

    <div class="review-layout">
        <!-- Service Info -->
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

        <!-- Review Form -->
        <form id="reviewForm" class="review-form">
            <!-- Rating Section -->
            <div class="form-section">
                <h3>Your Rating</h3>
                <div class="rating-input">
                    <div class="stars">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5">★</label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4">★</label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3">★</label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2">★</label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1">★</label>
                    </div>
                    <span class="rating-text">Select your rating</span>
                </div>
            </div>

            <!-- Review Text Section -->
            <div class="form-section">
                <h3>Your Review</h3>
                <div class="form-group">
                    <label for="reviewTitle">Title your review</label>
                    <input type="text" id="reviewTitle" name="reviewTitle" placeholder="Summarize your experience" required>
                </div>
                <div class="form-group">
                    <label for="reviewText">Write your detailed review</label>
                    <textarea id="reviewText" name="reviewText" rows="5" placeholder="Share the details of your experience" required></textarea>
                    <div class="text-counter">0/1000 characters</div>
                </div>
            </div>

            <!-- Service Quality Section -->
            <div class="form-section">
                <h3>Service Quality</h3>
                <div class="quality-grid">
                    <div class="quality-item">
                        <label>Punctuality</label>
                        <div class="rating-input small">
                            <div class="stars">
                                <input type="radio" id="punctuality5" name="punctuality" value="5">
                                <label for="punctuality5">★</label>
                                <input type="radio" id="punctuality4" name="punctuality" value="4">
                                <label for="punctuality4">★</label>
                                <input type="radio" id="punctuality3" name="punctuality" value="3">
                                <label for="punctuality3">★</label>
                                <input type="radio" id="punctuality2" name="punctuality" value="2">
                                <label for="punctuality2">★</label>
                                <input type="radio" id="punctuality1" name="punctuality" value="1">
                                <label for="punctuality1">★</label>
                            </div>
                        </div>
                    </div>
                    <div class="quality-item">
                        <label>Professionalism</label>
                        <div class="rating-input small">
                            <div class="stars">
                                <input type="radio" id="professionalism5" name="professionalism" value="5">
                                <label for="professionalism5">★</label>
                                <input type="radio" id="professionalism4" name="professionalism" value="4">
                                <label for="professionalism4">★</label>
                                <input type="radio" id="professionalism3" name="professionalism" value="3">
                                <label for="professionalism3">★</label>
                                <input type="radio" id="professionalism2" name="professionalism" value="2">
                                <label for="professionalism2">★</label>
                                <input type="radio" id="professionalism1" name="professionalism" value="1">
                                <label for="professionalism1">★</label>
                            </div>
                        </div>
                    </div>
                    <div class="quality-item">
                        <label>Value for Money</label>
                        <div class="rating-input small">
                            <div class="stars">
                                <input type="radio" id="value5" name="value" value="5">
                                <label for="value5">★</label>
                                <input type="radio" id="value4" name="value" value="4">
                                <label for="value4">★</label>
                                <input type="radio" id="value3" name="value" value="3">
                                <label for="value3">★</label>
                                <input type="radio" id="value2" name="value" value="2">
                                <label for="value2">★</label>
                                <input type="radio" id="value1" name="value" value="1">
                                <label for="value1">★</label>
                            </div>
                        </div>
                    </div>
                    <div class="quality-item">
                        <label>Communication</label>
                        <div class="rating-input small">
                            <div class="stars">
                                <input type="radio" id="communication5" name="communication" value="5">
                                <label for="communication5">★</label>
                                <input type="radio" id="communication4" name="communication" value="4">
                                <label for="communication4">★</label>
                                <input type="radio" id="communication3" name="communication" value="3">
                                <label for="communication3">★</label>
                                <input type="radio" id="communication2" name="communication" value="2">
                                <label for="communication2">★</label>
                                <input type="radio" id="communication1" name="communication" value="1">
                                <label for="communication1">★</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Photo Upload Section -->
            <div class="form-section">
                <h3>Add Photos</h3>
                <div class="photo-upload">
                    <input type="file" id="photos" name="photos[]" multiple accept="image/*">
                    <div class="upload-placeholder">
                        <i class="fas fa-camera"></i>
                        <p>Click to upload or drag and drop</p>
                        <span>Maximum 5 photos (PNG, JPG)</span>
                    </div>
                    <div id="photoPreview" class="photo-preview"></div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="form-section submit-section">
                <div class="form-actions">
                    <button type="button" class="btn-cancel">Cancel</button>
                    <button type="submit" class="btn-submit">Submit Review</button>
                </div>
                <p class="terms-note">By submitting this review, you agree to our review guidelines and terms of service</p>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/review.css'];
$additional_js = ['/webb/user/assets/js/review.js'];
require 'layouts/provider.php';
?> 