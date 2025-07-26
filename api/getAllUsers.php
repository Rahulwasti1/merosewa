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
    $users = $db->selectAll(
        "SELECT
            id,
            full_name,
            email,
            role,
            profile_picture
        FROM
            users;"
    );

    // Return success response
    echo json_encode([
        'success' => true,
        'users' => $users
    ]);
} catch (Exception $e) {
    // Log error (in production, log to file instead of displaying)
    error_log("Something Went Wrong::::::: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal server error occurred while fetching users'
    ]);
}
