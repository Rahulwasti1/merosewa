<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="/merosewa/public/assets/logo.png" alt="MeroSewa">
        <span>MeroSewa</span>
    </div>
    <nav>

        <a href="/merosewa/app/provider/dashboard.php" <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'class="active"' : ''; ?>>
            <span>📊</span>
            <span>Dashboard</span>
        </a>
        <a href="/merosewa/app/provider/services/" <?php echo basename($_SERVER['PHP_SELF']) == 'service-catalogue.php' ? 'class="active"' : ''; ?>>
            <span>📜</span>
            <span>My Services</span>
        </a>
        <a href="service-requests.php" <?php echo basename($_SERVER['PHP_SELF']) == 'service-requests.php' ? 'class="active"' : ''; ?>>
            <span>📝</span>
            <span>Service Requests</span>
        </a>
        <a href="bookings.php" <?php echo basename($_SERVER['PHP_SELF']) == 'bookings.php' ? 'class="active"' : ''; ?>>
            <span>📅</span>
            <span>Bookings</span>
        </a>
        <a href="reviews.php" <?php echo basename($_SERVER['PHP_SELF']) == 'reviews.php' ? 'class="active"' : ''; ?>>
            <span>⭐</span>
            <span>Feedback</span>
        </a>
        <a href="job-history.php" <?php echo basename($_SERVER['PHP_SELF']) == 'job-history.php' ? 'class="active"' : ''; ?>>
            <span>📋</span>
            <span>Job History</span>
        </a>
        <a href="profile.php" <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'class="active"' : ''; ?>>
            <span>👤</span>
            <span>Profile</span>
        </a>
    </nav>
</div>
