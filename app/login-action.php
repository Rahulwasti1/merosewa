<?php
session_start();

// For demo purposes, just set a default user session and redirect to dashboard
$_SESSION['user_id'] = 1;
$_SESSION['user_name'] = 'User';
$_SESSION['user_email'] = 'user@gmail.com';
$_SESSION['user_type'] = 'user';

// Redirect based on successful login
header("Location: user/dashboard.php");
exit();
