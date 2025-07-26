<?php

require_once '../../helpers/redirect-to-login.php';

$id = (int) $_GET['id'] ?? null;
if (empty($id)) {
    header('Location: index.php');
    exit();
}
require_once '../../../Database.php';
$db = new Database();
$service = $db->selectFirst("SELECT * FROM service WHERE id = ?", [$id]);

if (!$service) {
    header('Location: Location: index.php');
    exit();
}

$pageTitle = 'Edit Service Details';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <title>MeroSewa - Edit Service</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/merosewa/public/assets/logo.png">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="p-8 bg-gray-50">
        <section class="bg-gray-50">
            <div class="flex flex-col w-full items-center justify-center px-6 py-8 mx-auto">
                <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-lg xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-2xl font-bold leading-tight tracking-tight text-red-700 md:text-2xl">
                            Update Service Information
                        </h1>
                        <!-- Success and Error Messages -->
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <span style="color: green; display: block; margin: 10px 0;">
                                <?= htmlspecialchars($_SESSION['success_message']) ?>
                            </span>
                            <?php unset($_SESSION['success_message']); // Clear the message
                            ?>
                        <?php elseif (isset($_SESSION['error_message'])): ?>
                            <span style="color: red; display: block; margin: 10px 0;">
                                <?= htmlspecialchars($_SESSION['error_message']) ?>
                            </span>
                            <?php unset($_SESSION['error_message']); // Clear the message
                            ?>
                        <?php endif; ?>
                        <form action="<?= 'update.php?id=' . $service['id'] ?>" method="post" enctype="multipart/form-data" class="space-y-4 md:space-y-6">

                            <!-- Current Service Image -->
                            <div class="text-center mb-6"> <!-- Only this div is centered -->
                                <label class="block mb-2 text-sm font-medium text-gray-900">Current Service Image</label>
                                <img src="/merosewa/<?= htmlspecialchars($service['image']) ?>"
                                    alt="<?= htmlspecialchars($service['name']) ?>"
                                    class="w-32 h-32 object-cover rounded-lg border border-gray-300 mx-auto mb-3"> <!-- mx-auto centers the image -->
                            </div>
                            <div>
                                <label for="service_image" class="block mb-2 text-sm font-medium text-gray-900">Update Service Image</label>
                                <input type="file"
                                    name="service_image"
                                    id="service_image"
                                    accept="image/*"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                            </div>

                            <!-- Service Name -->
                            <div>
                                <label for="service_name" class="block mb-2 text-sm font-medium text-gray-900">Service Name</label>
                                <input type="text"
                                    name="service_name"
                                    id="service_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    value="<?= htmlspecialchars($service['name'] ?? '') ?>"
                                    required>
                            </div>

                            <!-- Service Description -->
                            <div>
                                <label for="service_description" class="block mb-2 text-sm font-medium text-gray-900">Service Description</label>
                                <textarea name="service_description"
                                    id="service_description"
                                    rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Describe your service in detail..."
                                    required><?= htmlspecialchars($service['description'] ?? '') ?></textarea>
                            </div>

                            <!-- Hourly Rate -->
                            <div>
                                <label for="rate_per_hour" class="block mb-2 text-sm font-medium text-gray-900">Rate per Hour (NPR)</label>
                                <input type="number"
                                    name="rate_per_hour"
                                    id="rate_per_hour"
                                    step="0.01"
                                    min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    value="<?= htmlspecialchars($service['rate_per_hour'] ?? '') ?>"
                                    required>
                            </div>

                            <!-- Hidden field for service ID -->
                            <input type="hidden" name="service_id" value="<?= $service['id'] ?>">

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Update Service
                            </button>

                            <!-- Cancel Button -->
                            <a href="index.php"
                                class="block w-full text-center text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                Back
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
