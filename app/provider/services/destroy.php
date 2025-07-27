<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';

// Clear old session messages on new request
unset($_SESSION['success_message'], $_SESSION['error_message']);
try {
    $userId = SessionUser::getId();
    $serviceId = (int) ($_GET['id'] ?? 0);

    if ($serviceId <= 0) {
        $_SESSION['error_message'] = "Invalid service ID.";
        header('Location: index.php');
        exit;
    }

    $db = new Database();

    // Fetch service for validation
    $service = $db->selectFirst("SELECT * FROM service WHERE id = ? AND service_provider = ?", [$serviceId, $userId]);
    if (!$service) {
        $_SESSION['error_message'] = "Service not found or unauthorized access.";
        header('Location: index.php');
        exit;
    }

    // Delete service image if not default and file exists
    $imagePath = "../../../" . $service['image'];
    if (
        !empty($service['image']) &&
        strpos($service['image'], 'uploads/service/default.jpg') === false &&
        file_exists($imagePath)
    ) {
        unlink($imagePath); // Delete the image file
    }

    // Delete from DB
    $db->delete("DELETE FROM service WHERE id = ? AND service_provider = ?", [$serviceId, $userId]);

    $_SESSION['success_message'] = "Service deleted successfully.";
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    error_log("Delete service error: " . $e->getMessage());
    $_SESSION['error_message'] = "Failed to delete service. Please try again.";
    header('Location: index.php');
    exit;
}
