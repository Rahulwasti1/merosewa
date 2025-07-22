<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Sign Up</title>
    <link rel="stylesheet" href="/merosewa/public/css/index.css">
</head>

<body>
    <div class="auth-container">
        <!-- Left side - Sign Up Form -->
        <div class="auth-form-container">
            <a href="/merosewa/" class="back-link">
                ← Back to Home
            </a>

            <div class="logo-container">
                <img src="/merosewa/public/assets/logo.png" alt="MeroSewa Logo">
                <h1>MeroSewa</h1>
            </div>

            <div class="tab-container">
                <a href="login.php" class="tab">Login</a>
                <a href="signup.php" class="tab active">Sign Up</a>
            </div>

            <form action="signup-action.php" method="POST" class="auth-form">
                <?php if (!empty($_SESSION['error'])): ?>
                    <span style="color: red; font-size: 14px; font-weight: 600;"><?= $_SESSION['error'] ?></span>
                <?php endif; ?>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Janak Bhandari" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="janak.bhandari@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
                </div>

                <div class="role-selection">
                    <label>Select Your Role</label>
                    <div class="role-options">
                        <label class="role-option">
                            <input type="radio" name="role" value="consumer" checked>
                            <span>Consumer</span>
                        </label>
                        <label class="role-option">
                            <input type="radio" name="role" value="service_provider">
                            <span>Service Provider</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Sign Up</button>
            </form>
        </div>

        <!-- Right side - Testimonial -->
        <div class="testimonial-container">
            <div class="testimonial">
                <p class="quote">"MeroSewa made booking an electrician incredibly simple and hassle-free! Within minutes, I was able to find a reliable professional who arrived on time and fixed the issue efficiently. It's the perfect solution for anyone in Kathmandu looking for quick, trustworthy, and affordable home repair services. Highly recommended!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar"></div>
                    <div class="author-info">
                        <h4>Ramesh Shrestha</h4>
                        <p>Customer, Kathmandu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
