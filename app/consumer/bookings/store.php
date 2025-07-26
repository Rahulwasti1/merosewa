<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /merosewa/app/consumer/services');
    exit;
}
unset($_SESSION['success_message'], $_SESSION['error_message']);

try {
    $db = new Database();
    $userId = SessionUser::getId();

    $serviceId = (int) ($_GET['id'] ?? $_POST['service_id'] ?? 0);
    if ($serviceId <= 0) {
        $_SESSION['error_message'] = "Invalid service ID.";
        header('Location: /merosewa/app/consumer/services');
        exit;
    }
    // Validate required fields
    if (empty($_POST['booking_date']) || empty($_POST['message'])) {
        $_SESSION['error_message'] = "Booking date is required.";
        header("Location: /merosewa/app/consumer/services");
        exit;
    }

    $bookingDate = $_POST['booking_date'];
    $message = trim($_POST['message'] ?? '');

    // Validate future date
    $today = date('Y-m-d');
    if ($bookingDate < $today) {
        $_SESSION['error_message'] = "Booking date must be in the future.";
        header("Location: create.php?id=$serviceId");
        exit;
    }

    // Check if service exists
    $service = $db->selectFirst(
        "SELECT
            *
        FROM
            service
        WHERE
            id = ?;",
        [$serviceId]
    );

    if (!$service) {
        $_SESSION['error_message'] = "Selected service does not exist.";
        header("Location: create.php?id=" . $serviceId);
        exit;
    }

    // Insert booking with default status 'pending'
    $db->insert(
        "INSERT INTO
            booking (
                service,
                consumer,
                booking_date,
                status,
                message)
         VALUES (?, ?, ?, 'PENDING', ?)",
        [$serviceId, $userId, $bookingDate, $message]
    );

    $_SESSION['success_message'] = "Booking request sent successfully!";
    header("Location: index.php");
    exit;
} catch (Exception $e) {
    error_log("Booking creation error: " . $e->getMessage());
    $_SESSION['error_message'] = "An internal error occurred. Please try again.";
    header("Location: create.php?id=" . ($_POST['service_id'] ?? ''));
    exit;
}
