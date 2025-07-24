<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';
require_once '../../../Upload.php';

unset($_SESSION['success_message'], $_SESSION['error_message']);
try {
    $db = new Database();
    $userId = SessionUser::getId();

    // Validate required fields
    if (
        empty($_POST['service_name']) ||
        empty($_POST['service_description']) ||
        empty($_POST['rate_per_hour'])
    ) {
        $_SESSION['error_message'] = "Please fill in all required fields.";
        header('Location: create.php');
        exit;
    }

    $name = trim($_POST['service_name']);
    $description = trim($_POST['service_description']);
    $ratePerHour = floatval($_POST['rate_per_hour']);

    if (empty($_FILES['service_image']['name'])) {
        $db->insert(
            "INSERT INTO service (service_provider, name, description, rate_per_hour) VALUES (?, ?, ?, ?);",
            [$userId, $name, $description, $ratePerHour]
        );
        $_SESSION['success_message'] = "Service created successfully!";
        header('Location: index.php');
        exit;
    }

    // Handle image upload
    $pathPrefix = 'uploads/service/';

    $uploader = new Upload(
        $_FILES['service_image'],
        '../../../uploads/service/'
    );
    $result = $uploader->uploadFile();

    if ($result['status']) {
        $imagePath = 'uploads/service/' . basename($result['path']);
    }

    // Insert into database
    $db->insert(
        "INSERT INTO service (service_provider, name, description, rate_per_hour, image) VALUES (?, ?, ?, ?, ?)",
        [$userId, $name, $description, $ratePerHour, $imagePath]
    );

    $_SESSION['success_message'] = "Service created successfully!";
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    error_log("Service creation error: " . $e->getMessage());
    $_SESSION['erro'] = "An internal error occurred. Please try again.";
    header('Location: create.php');
    exit;
}
