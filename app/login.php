<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="auth-container">
        <!-- Left side - Login Form -->
        <div class="auth-form-container">
            <a href="index.php" class="back-link">
                ← Back to Home
            </a>

            <div class="logo-container">
                <img src="assets/logo.png" alt="MeroSewa Logo">
                <h1>MeroSewa</h1>
            </div>

            <div class="tab-container">
                <a href="login.php" class="tab active">Login</a>
                <a href="signup.php" class="tab">Sign Up</a>
            </div>

            <div class="welcome-text">
                <h2>Welcome Back</h2>
                <p>Log in to access your dashboard.</p>
            </div>

            <form action="login_process.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="role-selection">
                    <label>Select Your Role</label>
                    <div class="role-options">
                        <label class="role-option">
                            <input type="radio" name="role" value="customer" checked>
                            <span>Customer</span>
                        </label>
                        <label class="role-option">
                            <input type="radio" name="role" value="provider">
                            <span>Service Provider</span>
                        </label>
                    </div>
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
