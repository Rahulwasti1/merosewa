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
    $jobs = $db->selectAll(
        "SELECT
            j.id as id,
            j.duration as duration,
            j.earnings as earnings,
            b.booking_date as booking_date,
            b.status as status,
            s.name as service_name,
            c.full_name as customer_name,
            f.body as feedback
        FROM
            job AS j
        JOIN
            booking AS b ON j.booking = b.id
        JOIN
            service as s ON s.id = b.service
        LEFT JOIN
            feedback as f ON f.id = j.feedback
        JOIN
            users as c on c.id = b.consumer
        WHERE s.service_provider  = ?
        ORDER BY
            b.booking_date DESC;",
        [$userId]
    );

    // Return success response
    echo json_encode([
        'success' => true,
        'jobs' => $jobs
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
