<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

ob_start();
?>

<div class="booking-content">
    <div class="booking-header">
        <h1>Book Service</h1>
        <p>Complete your booking for Expert Plumbing Services</p>
    </div>

    <div class="booking-layout">
        <!-- Booking Form -->
        <div class="booking-form">
            <form id="bookingForm">
                <!-- Service Details -->
                <section class="booking-section">
                    <h2>Service Details</h2>
                    <div class="form-group">
                        <label for="serviceType">Type of Service</label>
                        <select id="serviceType" name="serviceType" required>
                            <option value="">Select service type</option>
                            <option value="repair">Pipe Repair</option>
                            <option value="installation">New Installation</option>
                            <option value="maintenance">Regular Maintenance</option>
                            <option value="emergency">Emergency Service</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Describe your requirement</label>
                        <textarea id="description" name="description" rows="4" placeholder="Please provide details about the service you need..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Add Photos (optional)</label>
                        <div class="photo-upload">
                            <input type="file" id="photos" name="photos[]" multiple accept="image/*">
                            <div class="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Drop files here or click to upload</span>
                            </div>
                        </div>
                        <div id="photoPreview" class="photo-preview"></div>
                    </div>
                </section>

                <!-- Schedule -->
                <section class="booking-section">
                    <h2>Schedule</h2>
                    <div class="form-group">
                        <label>Select Date</label>
                        <div class="calendar-picker">
                            <div class="calendar-header">
                                <button type="button" class="prev-month">←</button>
                                <span>June 2025</span>
                                <button type="button" class="next-month">→</button>
                            </div>
                            <div class="calendar-grid">
                                <div class="calendar-days">
                                    <span>Su</span>
                                    <span>Mo</span>
                                    <span>Tu</span>
                                    <span>We</span>
                                    <span>Th</span>
                                    <span>Fr</span>
                                    <span>Sa</span>
                                </div>
                                <div class="calendar-dates">
                                    <!-- Calendar dates will be populated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Select Time Slot</label>
                        <div class="time-slots">
                            <label class="time-slot">
                                <input type="radio" name="timeSlot" value="09:00">
                                <span>9:00 AM</span>
                            </label>
                            <label class="time-slot">
                                <input type="radio" name="timeSlot" value="10:00">
                                <span>10:00 AM</span>
                            </label>
                            <label class="time-slot">
                                <input type="radio" name="timeSlot" value="11:00">
                                <span>11:00 AM</span>
                            </label>
                            <label class="time-slot">
                                <input type="radio" name="timeSlot" value="12:00">
                                <span>12:00 PM</span>
                            </label>
                            <label class="time-slot">
                                <input type="radio" name="timeSlot" value="13:00">
                                <span>1:00 PM</span>
                            </label>
                            <label class="time-slot">
                                <input type="radio" name="timeSlot" value="14:00">
                                <span>2:00 PM</span>
                            </label>
                            <label class="time-slot">
                                <input type="radio" name="timeSlot" value="15:00">
                                <span>3:00 PM</span>
                            </label>
                            <label class="time-slot">
                                <input type="radio" name="timeSlot" value="16:00">
                                <span>4:00 PM</span>
                            </label>
                        </div>
                    </div>
                </section>

                <!-- Location -->
                <section class="booking-section">
                    <h2>Service Location</h2>
                    <div class="form-group">
                        <label for="address">Full Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter your address" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="city">City</label>
                            <select id="city" name="city" required>
                                <option value="">Select city</option>
                                <option value="kathmandu">Kathmandu</option>
                                <option value="lalitpur">Lalitpur</option>
                                <option value="bhaktapur">Bhaktapur</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" id="area" name="area" placeholder="Enter your area" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="landmark">Landmark (optional)</label>
                        <input type="text" id="landmark" name="landmark" placeholder="Enter a nearby landmark">
                    </div>
                </section>

                <!-- Contact -->
                <section class="booking-section">
                    <h2>Contact Details</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="terms" required>
                            <span>I agree to the terms and conditions</span>
                        </label>
                    </div>
                </section>
            </form>
        </div>

        <!-- Booking Summary -->
        <div class="booking-summary">
            <div class="summary-card">
                <h2>Booking Summary</h2>

                <div class="service-preview">
                    <img src="/webb/assets/images/plumbing-main.jpg" alt="Expert Plumbing Services">
                    <div class="service-info">
                        <h3>Expert Plumbing Services</h3>
                        <p>Kathmandu Plumbing Solutions</p>
                        <div class="rating">
                            <span class="stars">★★★★★</span>
                            <span class="reviews">(210 reviews)</span>
                        </div>
                    </div>
                </div>

                <div class="summary-details">
                    <div class="summary-item">
                        <span>Base Rate</span>
                        <span>NPR 1500 / Hr</span>
                    </div>
                    <div class="summary-item">
                        <span>Minimum Hours</span>
                        <span>2 hours</span>
                    </div>
                    <div class="summary-item">
                        <span>Service Fee</span>
                        <span>NPR 200</span>
                    </div>
                    <div class="summary-item total">
                        <span>Total Amount</span>
                        <span>NPR 3200</span>
                    </div>
                </div>

                <div class="summary-notes">
                    <p>* Final amount may vary based on actual service duration</p>
                    <p>* Payment will be collected after service completion</p>
                </div>

                <button type="submit" form="bookingForm" class="btn-confirm">Confirm Booking</button>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/booking.css'];
$additional_js = ['/webb/user/assets/js/booking.js'];
require 'layouts/provider.php';
?>
