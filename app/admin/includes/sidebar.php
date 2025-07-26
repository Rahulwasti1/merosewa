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
        <a href="dashboard.php" class="<?php echo strpos($current_uri, 'dashboard.php') !== false ? 'active' : ''; ?>">
            <span class="icon">📊</span>
            <span>Dashboard</span>
        </a>
        <a href="users.php" class="<?php echo strpos($current_uri, 'users.php') !== false ? 'active' : ''; ?>">
            <span class="icon">👥</span>
            <span>Users</span>
        </a>
        <a href="jobs.php" class="<?php echo strpos($current_uri, 'jobs.php') !== false ? 'active' : ''; ?>">
            <span class="icon">📝</span>
            <span>Jobs</span>
        </a>
        <a href="services.php" class="<?php echo strpos($current_uri, 'services.php') !== false ? 'active' : ''; ?>">
            <span class="icon">📋</span>
            <span>Services</span>
        </a>
    </nav>
</div>
