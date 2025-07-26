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
    $stats = $db->selectAll(
        "SELECT
        (SELECT COUNT(*) FROM job) AS total_jobs,
        (SELECT COUNT(*) FROM users) AS total_users,
        (SELECT COUNT(*) FROM service) AS total_services"
    );

    // Return success response
    echo json_encode([
        'success' => true,
        'stats' => $stats
    ]);
} catch (Exception $e) {
    // Log error (in production, log to file instead of displaying)
    error_log("Something Went Wrong::::::: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal server error occurred while calculating stats'
    ]);
}
