<?php
require_once 'helpers/redirect-to-dashboard.php';

// Validate inputs
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    header('Location: login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Guard clause: Empty fields
if (empty($email) || empty($password)) {
    $_SESSION['error'] = 'Please enter both email and password';
    header('Location: login.php');
    exit;
}

require_once '../Database.php';

try {
    $db = new Database();
    $user = $db->selectFirst("SELECT * FROM users WHERE email = ? ;", [$email]);

    // Guard clause: User not found
    if (!$user) {
        $_SESSION['error'] = 'Incorrect email';
        header('Location: login.php');
        exit;
    }

    if (!password_verify($password, $user['password_hash'])) {
        $_SESSION['error'] = 'Incorrect password';
        header('Location: login.php');
        exit;
    }
    unset($_SESSION['error']);
    // Login successful
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['full_name'],
        'email' => $user['email'],
        'role' => $user['role'],
        'authenticated' => true
    ];

    // Redirect based on role (example)
    $redirect = match ($user['role']) {
        'ADMIN' => 'admin/dashboard.php',
        'SERVICE_PROVIDER' => 'provider/dashboard.php',
        default => 'consumer/dashboard.php'
    };

    header("Location: $redirect");
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error. Please try again.';
    header('Location: login.php');
    exit;
}
