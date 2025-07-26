<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['page_title'] ?? 'MeroSewa' ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/merosewa/app/consumer/assets/css/style.css">
    <link rel="stylesheet" href="/merosewa/app/consumer/assets/css/sidebar.css">

    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
    <div class="layout-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="/merosewa/public/assets/logo.png" alt="MeroSewa" class="logo-img">
                <span class="logo-text">MeroSewa</span>
            </div>

            <nav class="nav-menu">
                <?php
                $current_uri = $_SERVER['REQUEST_URI'];
                ?>
                <a href="/merosewa/app/consumer/dashboard.php"
                    class="<?php echo strpos($current_uri, 'dashboard.php') !== false ? 'active nav-link' : 'nav-link'; ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>

                <a href="/merosewa/app/consumer/services/"
                    class="<?php echo strpos($current_uri, '/services/') !== false ? 'active nav-link' : 'nav-link'; ?>">
                    <i class="fas fa-tools"></i>
                    <span>Services</span>
                </a>

                <a href="/merosewa/app/consumer/bookings/"
                    class="<?php echo strpos($current_uri, '/bookings/') !== false ? 'active nav-link' : 'nav-link'; ?>">
                    <i class="fas fa-calendar-alt"></i>
                    <span>My Bookings</span>
                </a>

                <a href="/merosewa/app/consumer/jobs/"
                    class="<?php echo strpos($current_uri, '/jobs/') !== false ? 'active nav-link' : 'nav-link'; ?>">
                    <i class="fas fa-history"></i>
                    <span>Job History</span>
                </a>

                <a href="/merosewa/app/consumer/feedbacks/"
                    class="<?php echo strpos($current_uri, '/feedback/') !== false ? 'active nav-link' : 'nav-link'; ?>">
                    <i class="fa-solid fa-comment"></i>
                    <span>Feedbacks</span>
                </a>

                <a href="/merosewa/app/consumer/profile/"
                    class="<?php echo strpos($current_uri, '/profile/') !== false ? 'active nav-link' : 'nav-link'; ?>">
                    <i class="fas fa-user-circle"></i>
                    <span>Profile</span>
                </a>

                <div class="nav-divider"></div>

                <a href="/merosewa/app/logout-action.php" class="nav-link nav-link-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main content area -->
        <main class="main-content">
            <?php echo $content; ?>
        </main>
    </div>

    <!-- Custom JS -->
    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>
