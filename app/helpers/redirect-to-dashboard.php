<?php
session_start();
if (isset($_SESSION['user']) && $_SESSION['user']['authenticated'] === true) {
    $redirect = match ($_SESSION['user']['role']) {
        'ADMIN' => 'admin/dashboard.php',
        'SERVICE_PROVIDER' => 'provider/dashboard.php',
        default => 'consumer/dashboard.php'
    };
    header("Location: /merosewa/app/$redirect");
    exit();
}
