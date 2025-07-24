<?php
require_once '../../helpers/redirect-to-login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Add a Service</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/merosewa/public/assets/logo.png">

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
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            Create New Service
                        </h1>
                        <?php if (isset($_SESSION['error_message'])): ?>
                            <span style="color: red; display: block; margin: 10px 0;">
                                <?= htmlspecialchars($_SESSION['error_message']) ?>
                            </span>
                            <?php unset($_SESSION['error_message']); // Clear the message
                            ?>
                        <?php endif; ?>

                        <form action="store.php" method="post" enctype="multipart/form-data" class="space-y-4 md:space-y-6">

                            <!-- Service Image -->
                            <div>
                                <label for="service_image" class="block mb-2 text-sm font-medium text-gray-900">Service Image</label>
                                <input type="file"
                                    name="service_image"
                                    id="service_image"
                                    accept="image/*"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                <p class="text-xs text-gray-500 mt-1">Optional: Upload an image for your service (JPG, PNG, GIF)</p>
                            </div>

                            <!-- Service Name -->
                            <div>
                                <label for="service_name" class="block mb-2 text-sm font-medium text-gray-900">Service Name *</label>
                                <input type="text"
                                    name="service_name"
                                    id="service_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="e.g., Plumbing Repair, House Cleaning, etc."
                                    value="<?= htmlspecialchars($_POST['service_name'] ?? '') ?>"
                                    required>
                            </div>

                            <!-- Service Description -->
                            <div>
                                <label for="service_description" class="block mb-2 text-sm font-medium text-gray-900">Service Description *</label>
                                <textarea name="service_description"
                                    id="service_description"
                                    rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Describe your service in detail. Include what's included, your experience, and any special features..."
                                    required><?= htmlspecialchars($_POST['service_description'] ?? '') ?></textarea>
                            </div>

                            <!-- Hourly Rate -->
                            <div>
                                <label for="rate_per_hour" class="block mb-2 text-sm font-medium text-gray-900">Rate per Hour (NPR) *</label>
                                <input type="number"
                                    name="rate_per_hour"
                                    id="rate_per_hour"
                                    step="0.01"
                                    min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="e.g., 500.00"
                                    value="<?= htmlspecialchars($_POST['rate_per_hour'] ?? '') ?>"
                                    required>
                                <p class="text-xs text-gray-500 mt-1">Enter your hourly rate in Nepali Rupees</p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Create Service
                            </button>

                            <!-- Cancel Button -->
                            <a href="index.php"
                                class="block w-full text-center text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                Cancel
                            </a>
                        </form>

                        <div class="text-xs text-gray-500 mt-4">
                            <p><strong>Note:</strong> Fields marked with * are required. Make sure to provide accurate information as this will be visible to potential customers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
