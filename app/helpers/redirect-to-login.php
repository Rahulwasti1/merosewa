<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['authenticated'] !== true) {
    header("Location: /merosewa/login.php");
    exit();
}

$role = $_SESSION['user']['role'];
$requestUri = $_SERVER['REQUEST_URI'];

// Define correct dashboard based on role
$dashboardPath = match ($role) {
    'ADMIN' => '/merosewa/app/admin/dashboard.php',
    'SERVICE_PROVIDER' => '/merosewa/app/provider/dashboard.php',
    default => '/merosewa/app/consumer/dashboard.php'
};

// Restrict cross-role access and redirect
if (str_contains($requestUri, '/provider/') && $role !== 'SERVICE_PROVIDER') {
    header("Location: $dashboardPath");
    exit();
}

if (str_contains($requestUri, '/admin/') && $role !== 'ADMIN') {
    header("Location: $dashboardPath");
    exit();
}

if (str_contains($requestUri, '/consumer/') && $role !== 'CONSUMER') {
    header("Location: $dashboardPath");
    exit();
}
