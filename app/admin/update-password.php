<?php
require_once '../helpers/redirect-to-login.php';
require_once '../models/SessionUser.php';
require_once '../../Database.php';
require_once '../../Upload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}
// Clear old session messages on new request
unset($_SESSION['pw_success_message'], $_SESSION['pw_error_message']);
try {
    $db = new Database();
    $userId = SessionUser::getId();

    // Fetch the existing service
    $existingUser = $db->selectFirst("SELECT * FROM users WHERE id = ?;", [$userId]);
    if (!$existingUser) {
        $_SESSION['pw_error_message'] = "User not found.";
        header('Location: dashboard.php');
        exit;
    }

    // Validate required fields
    if (
        empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['confirm_password'])
    ) {
        $_SESSION['pw_error_message'] = "Malformed request body.";
        header("Location: dashboard.php");
        exit;
    }
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!password_verify($oldPassword, $existingUser['password_hash'])) {
        $_SESSION['pw_error_message'] = 'Incorrect Password.';
        header('Location: dashboard.php');
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        $_SESSION['pw_error_message'] = 'New password and pasword confirmation do not match..';
        header('Location: dashboard.php');
        exit;
    }

    $db->update(
        "UPDATE users SET password_hash = ? WHERE id = ?;",
        [password_hash($newPassword, PASSWORD_DEFAULT), $userId]
    );

    $_SESSION['pw_success_message'] = "Password Successfully Updated!";
    header('Location: dashboard.php');
    exit;
} catch (Exception $e) {
    $_SESSION['pw_error_message'] = $e->getMessage();
    header("Location: dashboard.php");
    exit;
}
