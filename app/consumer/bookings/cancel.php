<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
unset($_SESSION['success_message'], $_SESSION['error_message']);
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $_SESSION['error_message'] = "Invalid booking ID.";
    header("Location: index.php");
    exit;
}

$bookingId = (int) $_GET['id'];
$consumerId = SessionUser::getId();

try {
    $db = new Database();
    $booking =  $db->selectFirst("SELECT id FROM booking WHERE id = ? AND consumer = ? LIMIT 1;", [$bookingId, $consumerId]);
    if (!$booking) {
        $_SESSION['error_message'] = "Booking not found.";
        header("Location: index.php");
        exit;
    }


    $rowCount =  $db->update("UPDATE booking SET status = 'CANCELLED' WHERE id = ? AND consumer = ? LIMIT 1;", [$bookingId, $consumerId]);

    if ($rowCount < 1) {
        $_SESSION['error_message'] = "Failed to cancel the booking.";
        header("Location: index.php");
        exit;
    }

    $_SESSION['success_message'] = "Booking cancelled successfully.";
    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Database error occurred.";
    header("Location: index.php");
    exit;
}
