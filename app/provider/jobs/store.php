<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';


unset($_SESSION['success_message'], $_SESSION['error_message']);
$bookingId = $_GET['id'] ?? null;
if (null === $bookingId) {
    $_SESSION['error_message'] = "Invalid booking ID.";
    header('Location: /merosewa/app/provider/bookings/');
    exit;
}

if (empty($_POST['duration'])) {
    $_SESSION['error_message'] = "Please fill in all required fields.";
    header("Location: create.php?id=$bookingId");
    exit;
}

$userId = SessionUser::getId();


$db = new Database();
$booking =  $db->selectFirst(
    "SELECT
            b.id as booking_id,
            s.rate_per_hour as hourly_rate
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
    header('Location: /merosewa/app/provider/bookings/');
    exit;
}
$duration = $_POST['duration'];
$earning = ($duration / 60) * $booking['hourly_rate'];
try {
    $db->getConnection()->beginTransaction();
    $rowCount =  $db->update(
        "UPDATE booking as b
        JOIN service as s ON s.id = b.service
        SET b.status = 'COMPLETED'
        WHERE b.id = ?
        AND s.service_provider = ?;
        ",
        [$bookingId, $userId]
    );

    if ($rowCount < 1) {
        throw new Exception("Failed to mark booking as completed.");
    }

    $inserted = $db->insert(
        "INSERT INTO
            job(booking, duration, earnings)
        VALUES(?, ?, ?);",
        [$bookingId, $duration, $earning]
    );

    if (!$inserted) {
        throw new Exception("Failed to insert job record.");
    }
    $db->getConnection()->commit();

    $_SESSION['success_message'] = "Job successfully completed.";
    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    $db->getConnection()->rollBack();
    $_SESSION['error_message'] = $e->getMessage();
    header("Location: create.php?id=$bookingId");
    exit;
}
