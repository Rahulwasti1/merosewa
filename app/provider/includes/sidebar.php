<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="/merosewa/public/assets/logo.png" alt="MeroSewa">
        <span>MeroSewa</span>
    </div>
    <nav>
        <?php
        $current_uri = $_SERVER['REQUEST_URI'];
        ?>
        <a href="/merosewa/app/provider/dashboard.php"
            class="<?php echo strpos($current_uri, 'dashboard.php') !== false ? 'active' : ''; ?>">
            <span>📊</span>
            <span>Dashboard</span>
        </a>
        <a href="/merosewa/app/provider/services/"
            class="<?php echo strpos($current_uri, '/services/') !== false ? 'active' : ''; ?>">
            <span>📜</span>
            <span>My Services</span>
        </a>
        <a href="/merosewa/app/provider/bookings/"
            class="<?php echo strpos($current_uri, '/bookings/') !== false ? 'active' : ''; ?>">
            <span>📅</span>
            <span>Bookings</span>
        </a>
        <a href="reviews.php"
            class="<?php echo strpos($current_uri, 'dashboard.php') !== false ? 'active' : ''; ?>">
            <span>⭐</span>
            <span>Feedback</span>
        </a>
        <a href="job-history.php"
            class="<?php echo strpos($current_uri, 'dashboard.php') !== false ? 'active' : ''; ?>">
            <span>📋</span>
            <span>Job History</span>
        </a>
        <a href="profile.php"
            class="<?php echo strpos($current_uri, 'dashboard.php') !== false ? 'active' : ''; ?>">
            <span>👤</span>
            <span>Profile</span>
        </a>
    </nav>
</div>
