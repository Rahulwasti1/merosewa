<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Reset Password</title>
    <link rel="stylesheet" href="/merosewa/public/css/index.css">
</head>

<body>
    <div class="auth-container">
        <div class="auth-form-container password-reset">
            <div class="logo-container">
                <img src="/merosewa/public/assets/logo.png" alt="MeroSewa Logo">
                <h1>Reset Your Password</h1>
            </div>

            <p class="reset-instructions">
                Enter your email or phone number linked to your
                account to receive a password reset link or code.
            </p>

            <form class="auth-form">
                <div class="form-group">
                    <label for="email_phone">Email or Phone Number</label>
                    <input type="text" id="email_phone" name="email_phone"
                        placeholder="e.g., example@merosewa.com or 98XXXXXXXX" required>
                </div>

                <button type="submit" class="submit-btn">Send Reset Link</button>
            </form>

            <a href="/merosewa/app/login.php" class="back-to-login">Back to Login</a>
        </div>
    </div>
</body>

</html>
