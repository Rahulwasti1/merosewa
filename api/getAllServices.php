<?php
// api/get-services.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');


require_once '../Database.php';

try {
    // Initialize database connection
    $db = new Database();

    $services = $db->selectAll(
        "SELECT
            s.id,
            u.full_name as service_provider,
            s.name,
            s.description,
            s.rate_per_hour,
            s.image
        FROM
            service AS s
        JOIN
            users AS u ON s.service_provider = u.id
        ORDER BY
            s.id DESC;"
    );

    // Return success response
    echo json_encode([
        'success' => true,
        'services' => $services,
        'count' => count($services)
    ]);
} catch (Exception $e) {
    // Log error (in production, log to file instead of displaying)
    error_log("Error in get-services.php: " . $e->getMessage());

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal server error occurred while fetching services'
    ]);
}
