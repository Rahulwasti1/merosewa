<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/merosewa/app/models/SessionUser.php';
$username = SessionUser::getUserName();
?>

<!-- Header -->
<header>
    <div>
        <h2>
            Hello, <?= htmlspecialchars($username ?? 'User') ?>
        </h2>
    </div>
    <div class="header-right">
        <div class="notifications">
            <span>🔔</span>
            <span class="badge">3</span>
        </div>
        <a href="/merosewa/app/logout-action.php" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>
</header>
