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

<div class="services-container">
    <!-- Left Sidebar Filter -->
    <aside class="services-filter">
        <h2>Filter Services</h2>
        
        <!-- Categories -->
        <div class="filter-section">
            <h3>Categories</h3>
            <ul class="filter-list">
                <li><a href="#" class="active">Plumbing</a></li>
                <li><a href="#">Electrical</a></li>
                <li><a href="#">Cleaning</a></li>
                <li><a href="#">Carpentry</a></li>
                <li><a href="#">Painting</a></li>
                <li><a href="#">Appliance Repair</a></li>
                <li><a href="#">Gardening</a></li>
                <li><a href="#">Pest Control</a></li>
                <li><a href="#">Tutor</a></li>
                <li><a href="#">Laundry</a></li>
            </ul>
        </div>

        <!-- Price Range -->
        <div class="filter-section">
            <h3>Price Range</h3>
            <div class="price-range">
                <div class="range-slider">
                    <input type="range" min="0" max="5000" value="0" class="range-min">
                    <input type="range" min="0" max="5000" value="5000" class="range-max">
                </div>
                <div class="range-values">
                    <span>NPR 0</span>
                    <span>NPR 5000</span>
                </div>
            </div>
        </div>

        <!-- Ratings -->
        <div class="filter-section">
            <h3>Ratings</h3>
            <ul class="filter-list">
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>& Up</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>& Up</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span>& Up</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Location -->
        <div class="filter-section">
            <h3>Location</h3>
            <div class="location-search">
                <input type="text" placeholder="Enter locality...">
                <select>
                    <option value="">Select City</option>
                    <option value="kathmandu">Kathmandu</option>
                    <option value="lalitpur">Lalitpur</option>
                    <option value="bhaktapur">Bhaktapur</option>
                </select>
            </div>
        </div>

        <!-- Availability Calendar -->
        <div class="filter-section">
            <h3>Availability</h3>
            <div class="calendar">
                <div class="calendar-header">
                    <button><i class="fas fa-chevron-left"></i></button>
                    <span>June 2025</span>
                    <button><i class="fas fa-chevron-right"></i></button>
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
                        <!-- First row -->
                        <span>1</span>
                        <span>2</span>
                        <span>3</span>
                        <span>4</span>
                        <span>5</span>
                        <span>6</span>
                        <span>7</span>
                        <!-- Second row -->
                        <span>8</span>
                        <span>9</span>
                        <span>10</span>
                        <span>11</span>
                        <span>12</span>
                        <span>13</span>
                        <span>14</span>
                        <!-- Third row -->
                        <span>15</span>
                        <span>16</span>
                        <span>17</span>
                        <span>18</span>
                        <span>19</span>
                        <span>20</span>
                        <span>21</span>
                        <!-- Fourth row -->
                        <span>22</span>
                        <span>23</span>
                        <span>24</span>
                        <span>25</span>
                        <span>26</span>
                        <span>27</span>
                        <span>28</span>
                        <!-- Fifth row -->
                        <span>29</span>
                        <span>30</span>
                        <span class="next-month">1</span>
                        <span class="next-month">2</span>
                        <span class="next-month">3</span>
                        <span class="next-month">4</span>
                        <span class="next-month">5</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Actions -->
        <div class="filter-actions">
            <button class="btn-apply">Apply Filters</button>
            <button class="btn-clear">Clear Filters</button>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="services-content">
        <h2>All Services (12)</h2>
        <div class="services-list">
            <!-- Service Item -->
            <div class="service-item">
                <div class="service-image">
                    <img src="/webb/assets/images/plumbing.jpg" alt="Expert Plumbing Services">
                </div>
                <div class="service-content">
                    <h3>Expert Plumbing Services</h3>
                    <p class="provider">Kathmandu Plumbing Solutions</p>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span>4.9 (210 reviews)</span>
                    </div>
                    <div class="service-footer">
                        <span class="price">NPR 1500/Hr</span>
                        <a href="#service-1" class="btn-details">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Service Item -->
            <div class="service-item">
                <div class="service-image">
                    <img src="/webb/assets/images/electrical.jpg" alt="Residential Electrical Repairs">
                </div>
                <div class="service-content">
                    <h3>Residential Electrical Repairs</h3>
                    <p class="provider">Bright Sparks Nepal</p>
                    <div class="rating">
                        <div class="stars">★★★★★</div>
                        <span>4.8 (180 reviews)</span>
                    </div>
                    <div class="service-footer">
                        <span class="price">NPR 1200/Hr</span>
                        <a href="#service-2" class="btn-details">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Add more service items as needed -->
        </div>

        <!-- Service Modal -->
        <div id="service-1" class="service-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Expert Plumbing Services</h3>
                    <a href="#" class="modal-close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="service-features">
                        <ul>
                            <li>24/7 Emergency Services</li>
                            <li>Leak Detection & Repair</li>
                            <li>Pipe Installation</li>
                            <li>Drain Cleaning</li>
                            <li>Water Heater Services</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <a href="booking.php?service=plumbing" class="btn-book">Book Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Modal 2 -->
        <div id="service-2" class="service-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Residential Electrical Repairs</h3>
                    <a href="#" class="modal-close">&times;</a>
                </div>
                <div class="modal-body">
                    <div class="service-features">
                        <ul>
                            <li>Electrical Troubleshooting</li>
                            <li>Wiring Installation & Repair</li>
                            <li>Circuit Breaker Services</li>
                            <li>Lighting Installation</li>
                            <li>Emergency Electrical Services</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <a href="booking.php?service=electrical" class="btn-book">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php
$content = ob_get_clean();
$additional_css = ['/webb/user/assets/css/services.css'];
$additional_js = ['/webb/user/assets/js/services.js'];
require 'layouts/provider.php';
?> 