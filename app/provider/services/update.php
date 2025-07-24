<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';
require_once '../../../Upload.php';

// Clear old session messages on new request
unset($_SESSION['success_message'], $_SESSION['error_message']);
try {
    $db = new Database();
    $userId = SessionUser::getId();

    $serviceId = (int) ($_GET['id'] ?? $_POST['service_id'] ?? 0);
    if ($serviceId <= 0) {
        $_SESSION['error_message'] = "Invalid service ID.";
        header('Location: index.php');
        exit;
    }

    // Fetch the existing service
    $existingService = $db->selectFirst("SELECT * FROM service WHERE id = ? AND service_provider = ?", [$serviceId, $userId]);
    if (!$existingService) {
        $_SESSION['error_message'] = "Service not found or you are not authorized.";
        header('Location: index.php');
        exit;
    }

    // Validate required fields
    if (
        empty($_POST['service_name']) ||
        empty($_POST['service_description']) ||
        empty($_POST['rate_per_hour'])
    ) {
        $_SESSION['error_message'] = "Please fill in all required fields.";
        header("Location: edit.php?id=$serviceId");
        exit;
    }

    $name = trim($_POST['service_name']);
    $description = trim($_POST['service_description']);
    $ratePerHour = floatval($_POST['rate_per_hour']);

    // If new image is uploaded
    if (empty($_FILES['service_image']['name'])) {
        $db->update(
            "UPDATE service SET name = ?, description = ?, rate_per_hour = ? WHERE id = ? AND service_provider = ?",
            [$name, $description, $ratePerHour,  $serviceId, $userId]
        );
        $_SESSION['success_message'] = "Service created successfully!";
        header('Location: index.php');
        exit;
    }
    // Handle image upload
    $pathPrefix = 'uploads/service/';
    $oldImagePath = "../../../" . $existingService['image'];
    $uploader = new Upload(
        $_FILES['service_image'],
        '../../../uploads/service/'
    );
    $result = $uploader->uploadFile();
    if ($result['status']) {
        if (
            !empty($oldImagePath) &&
            strpos($oldImagePath, 'uploads/service/default.jpg') === false &&
            file_exists($oldImagePath)
        ) {
            unlink($oldImagePath); // Delete the image file
        }
        $imagePath = 'uploads/service/' . basename($result['path']);
    }

    // Update the database
    $db->update(
        "UPDATE service SET name = ?, description = ?, rate_per_hour = ?, image = ? WHERE id = ? AND service_provider = ?",
        [$name, $description, $ratePerHour, $imagePath, $serviceId, $userId]
    );

    $_SESSION['success_message'] = "Service updated successfully!";
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    error_log("Service update error: " . $e->getMessage());
    $_SESSION['error_message'] = "An internal error occurred. Please try again.";
    header("Location: edit.php?id=$serviceId");
    exit;
}
