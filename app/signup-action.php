<?php
require_once 'helpers/redirect-to-dashboard.php';


// Validate inputs
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: signup.php');
    exit;
}

if (!isset($_POST['full_name']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirm_password']) || !isset($_POST['role'])) {
    header('Location: signup.php');
    exit;
}

$fullName = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$confirmPassword = trim($_POST['confirm_password'] ?? '');
$role = trim($_POST['role'] ?? '');


// Guard clause: Empty fields
if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword) || empty($role)) {
    $_SESSION['error'] = 'Please fill in all fields';
    header('Location: signup.php');
    exit;
}

switch ($role) {
    case 'service_provider':
        $role = 'SERVICE_PROVIDER';
        break;
    case 'consumer':
        $role = 'CONSUMER';
        break;
    default:
        $_SESSION['error'] = 'Invalid role selected';
        header('Location: signup.php');
        exit;
}
if ($password !== $confirmPassword) {
    $_SESSION['error'] = 'Passwords do not match';
    header('Location: signup.php');
    exit;
}

require_once '../Database.php';

try {
    $db = new Database();
    $user = $db->selectFirst("SELECT * FROM users WHERE email = ? ;", [$email]);
    // Guard clause: User not found
    if ($user) {
        $_SESSION['error'] = 'User with the email already exists';
        header('Location: signup.php');
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $id = $db->insert("INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?);", [
        $fullName,
        $email,
        $passwordHash,
        $role
    ]);

    // signup successful
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => $id,
        'username' => $fullName,
        'email' => $email,
        'role' => $role,
        'authenticated' => true
    ];

    // Redirect based on role (example)
    $redirect = match ($role) {
        'ADMIN' => 'admin/dashboard.php',
        'SERVICE_PROVIDER' => 'provider/dashboard.php',
        default => 'consumer/dashboard.php'
    };
    header("Location: $redirect");
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error. Please try again.';
    header('Location: signup.php');
    exit;
}
