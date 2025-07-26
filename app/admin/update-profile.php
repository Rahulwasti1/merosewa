<?php
require_once '../helpers/redirect-to-login.php';
require_once '../models/SessionUser.php';
require_once '../../Database.php';
require_once '../../Upload.php';

// Clear old session messages on new request
unset($_SESSION['success_message'], $_SESSION['error_message']);
try {
    $db = new Database();
    $userId = SessionUser::getId();

    // Fetch the existing service
    $existingUser = $db->selectFirst("SELECT * FROM users WHERE id = ?;", [$userId]);
    if (!$existingUser) {
        $_SESSION['error_message'] = "Service not found or you are not authorized.";
        header('Location: dashboard.php');
        exit;
    }

    // Validate required fields
    if (
        (empty($_POST['full_name']) && empty($_FILES['profile_photo'])) || !empty($_POST['email'])
    ) {
        $_SESSION['error_message'] = "Malformed request body.";
        header("Location: dashboard.php");
        exit;
    }
    $full_name = $existingUser['full_name'];
    if (!empty($_POST['full_name'])) {
        $full_name = trim($_POST['full_name']);
    }

    // If new image is uploaded
    if (empty($_FILES['profile_photo']['name'])) {
        $db->update(
            "UPDATE users SET full_name = ? WHERE id = ?;",
            [$full_name, $userId]
        );
        $_SESSION['success_message'] = "Profile Successfully Updated!";
        header('Location: dashboard.php');
        exit;
    }
    // Handle image upload
    $pathPrefix = 'uploads/profile/';
    $oldImagePath = "../../" . $existingUser['profile_picture'];
    $uploader = new Upload(
        $_FILES['profile_photo'],
        '../../uploads/profile/'
    );
    $result = $uploader->uploadFile();
    if (!$result['status']) {
        $_SESSION['error_message'] = $result['message'];
        header('Location: dashboard.php');
        exit;
    }

    if (
        !empty($oldImagePath) &&
        strpos($oldImagePath, 'uploads/profile/default.jpg') === false &&
        file_exists($oldImagePath)
    ) {
        unlink($oldImagePath); // Delete the image file
    }
    $imagePath = 'uploads/profile/' . basename($result['path']);


    // Update the database
    $db->update(
        "UPDATE users SET full_name = ?, profile_picture = ? WHERE id = ?;",
        [$full_name, $imagePath, $userId]
    );

    $_SESSION['success_message'] = "Profile Successfully Updated!";
    header('Location: dashboard.php');
    exit;
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header("Location: dashboard.php");
    exit;
}
