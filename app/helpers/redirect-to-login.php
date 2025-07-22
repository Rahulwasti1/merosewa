<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['authenticated'] !== true) {
    header("Location: /merosewa/login.php");
    exit();
}
