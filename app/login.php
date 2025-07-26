<?php
require_once 'helpers/redirect-to-dashboard.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Login</title>
    <link rel="stylesheet" href="/merosewa/public/css/index.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/merosewa/public/assets/logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body>
    <div class="auth-container">
        <!-- Left side - Login Form -->
        <div class="auth-form-container">
            <a href="/merosewa/" class="back-link">
                ← Back to Home
            </a>

            <div class="logo-container">
                <img src="/merosewa/public/assets/logo.png" alt="MeroSewa Logo">
                <h1>MeroSewa</h1>
            </div>

            <div class="tab-container">
                <a href="login.php" class="tab active">Login</a>
                <a href="signup.php" class="tab">Sign Up</a>
            </div>

            <div class="welcome-text">
                <h2>Welcome Back</h2>
                <?php if (!empty($_SESSION['error'])): ?>
                    <span style="color: red; font-size: 14px; font-weight: 600;"><?= $_SESSION['error'] ?></span>
                <?php else: ?>
                    <p>Log in to access your dashboard.</p>
                <?php endif; ?>
            </div>

            <form action="login-action.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <a href="forgot-password.php" class="forgot-password">Forgot Password?</a>
                <button type="submit" class="submit-btn">Login</button>
            </form>

            <div class="terms-text">
                <p>By logging in or signing up, you agree to MeroSewa's and</p>
                <div class="terms-links">
                    <a href="/terms">Terms & Conditions</a>
                    <a href="/privacy">Privacy Policy</a>
                </div>
            </div>
        </div>

        <!-- Right side - Testimonial -->
        <div class="testimonial-container">
            <div class="testimonial">
                <p class="quote">"MeroSewa has transformed how I find local services. It's incredibly convenient and reliable. Highly recommended for anyone in Nepal!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar"></div>
                    <div class="author-info">
                        <h4>Anil Gurung</h4>
                        <p>Customer, Kathmandu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
