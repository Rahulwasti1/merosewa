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
        <a href="/merosewa/app/provider/jobs/"
            class="<?php echo strpos($current_uri, '/jobs/') !== false ? 'active' : ''; ?>">
            <span>📋</span>
            <span>My Jobs</span>
        </a>
        <a href="/merosewa/app/provider/profile/"
            class="<?php echo strpos($current_uri, '/profile/') !== false ? 'active' : ''; ?>">
            <span>👤</span>
            <span>Profile</span>
        </a>
    </nav>
</div>
