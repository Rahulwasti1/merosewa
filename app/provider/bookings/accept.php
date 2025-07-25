<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';


unset($_SESSION['success_message'], $_SESSION['error_message']);
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $_SESSION['error_message'] = "Invalid booking ID.";
    header("Location: index.php");
    exit;
}

$bookingId = (int) $_GET['id'];
$userId = SessionUser::getId();

try {
    $db = new Database();
    $booking =  $db->selectFirst(
        "SELECT
            b.id
        FROM
            booking as b
        JOIN service as s ON s.id = b.service
        WHERE s.service_provider = ?
        AND b.id = ?
        LIMIT 1;
        ",
        [$userId, $bookingId]
    );
    if (!$booking) {
        $_SESSION['error_message'] = "Booking not found.";
        header("Location: index.php");
        exit;
    }


    $rowCount =  $db->update(
        "UPDATE booking as b
        JOIN service as s ON s.id = b.service
        SET b.status = 'ACCEPTED'
        WHERE b.id = ?
        AND s.service_provider = ?;
        ",
        [$bookingId, $userId]
    );

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
