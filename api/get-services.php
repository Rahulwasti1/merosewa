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

    // Get current user's services
    $userId = SessionUser::getId();

    if (!$userId) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'User not authenticated'
        ]);
        exit;
    }

    // Fetch services for the current user
    $services = $db->selectAll(
        "SELECT id, service_provider, name, description, rate_per_hour, image FROM service WHERE service_provider = ? ORDER BY id DESC",
        [$userId]
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
