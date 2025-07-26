<?php
require_once 'includes/header.php';
require_once 'Database.php';
$db = new Database();

$adminUsers = $db->selectAll("SELECT role FROM users WHERE role = 'ADMIN';");
if (empty($adminUsers)) {
    $db->insert("INSERT INTO users(full_name,role, email, password_hash) VALUES('Admin User','ADMIN', 'admin@merosewa.com', ?);", [password_hash('qwertyuiop', PASSWORD_DEFAULT)]);
}
?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="hero-title">Your Local Services,<br>Just a Click Away</h1>
            <p class="hero-subtitle">Connect with pre-verified Nepali service providers for your home & business needs. Fast, reliable, and hassle-free.</p>
            <div class="button-group">
                <a href="/merosewa/app/login.php" class="button button-primary">Get Started Now</a>
                <a href="/merosewa/app/login.php" class="button button-secondary">Become a Provider</a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            <div class="steps-container">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Find Services</h3>
                    <p class="step-description">Browse our curated selection of verified local service providers in your area</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Book & Connect</h3>
                    <p class="step-description">Schedule your service instantly and connect with skilled professionals</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Relax & Enjoy</h3>
                    <p class="step-description">Experience quality service delivery with our satisfaction guarantee</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <h2 class="section-title">Popular Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <svg class="service-icon" viewBox="0 0 24 24">
                        <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm0-2l12 12h-4v8h-8v-6h-4v6H4v-8H0L12 1z" />
                    </svg>
                    <h3 class="service-title">Plumbing</h3>
                    <p class="service-description">Professional plumbing solutions for your home and office</p>
                </div>
                <div class="service-card">
                    <svg class="service-icon" viewBox="0 0 24 24">
                        <path d="M7 2v11h3v9l7-12h-4l4-8z" />
                    </svg>
                    <h3 class="service-title">Electrical</h3>
                    <p class="service-description">Expert electrical services by certified technicians</p>
                </div>
                <div class="service-card">
                    <svg class="service-icon" viewBox="0 0 24 24">
                        <path d="M19.36 2.72L20.78 4.14L15.06 9.85C16.13 11.39 16.28 13.24 15.38 14.44L9.06 8.12C10.26 7.22 12.11 7.37 13.65 8.44L19.36 2.72M5.93 17.57C3.92 15.56 2.69 13.16 2.35 10.92L7.23 8.83L14.67 16.27L12.58 21.15C10.34 20.81 7.94 19.58 5.93 17.57Z" />
                    </svg>
                    <h3 class="service-title">Cleaning</h3>
                    <p class="service-description">Premium cleaning services for all spaces</p>
                </div>
                <div class="service-card">
                    <svg class="service-icon" viewBox="0 0 24 24">
                        <path d="M13 9V3H21V9H13M3 13V3H11V13H3M13 21V11H21V21H13M3 21V15H11V21H3Z" />
                    </svg>
                    <h3 class="service-title">Carpentry</h3>
                    <p class="service-description">Custom woodwork and repairs by skilled artisans</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            <div class="testimonial-card">
                <p class="testimonial-text">"MeroSewa has transformed how I find services. Quick, professional, and incredibly reliable. The quality of service providers is outstanding!"</p>
                <p class="testimonial-author">Deepak Sharma</p>
                <p class="testimonial-role">Verified Customer</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Ready to Get Started?</h2>
            <p class="cta-description">Join thousands of satisfied customers who trust MeroSewa for their service needs</p>
            <div class="button-group">
                <a href="/merosewa/app/register.php" class="button button-secondary">Register as Customer</a>
                <a href="/merosewa/app/provider/register.php" class="button button-secondary">Become a Provider</a>
            </div>
        </div>
    </section>
</main>

<?php
require_once 'includes/footer.php';
?>
