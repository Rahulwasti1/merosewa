<?php
// api/get-services.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../app/helpers/redirect-to-login.php';
require_once '../app/models/SessionUser.php';
require_once '../Database.php';

try {
    // Initialize database connection
    $db = new Database();

    // Fetch services for the current user
    $userId = SessionUser::getId();
    $services = $db->selectAll(
        "SELECT
            b.id,
            u.full_name as consumer_name,
            b.message,
            b.status,
            b.booking_date,
            s.name as service_name,
            s.rate_per_hour as service_hourly_rate
        FROM
            booking AS b
        JOIN
            service AS s ON s.id = b.service
        JOIN
            users as u ON b.consumer = u.id
        WHERE s.service_provider = ?
        ORDER BY
            b.booking_date DESC;",
        [$userId]
    );

    // Return success response
    echo json_encode([
        'success' => true,
        'bookings' => $services,
        'count' => count($services)
    ]);
} catch (Exception $e) {
    // Log error (in production, log to file instead of displaying)
    error_log("Something Went Wrong::::::: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal server error occurred while fetching bookings'
    ]);
}
