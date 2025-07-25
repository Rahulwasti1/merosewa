<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../../Database.php';

$db = new Database();

$serviceId = $_GET['id'] ?? null;

if (null == $serviceId) {
    header("Location: /merosewa/app/consumer/services/");
    exit;
}

$service = $db->selectFirst(
    "SELECT
            *
        FROM
            service
        WHERE
            id = ?;",
    [$serviceId]
);
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
                            Booking for <?= htmlspecialchars($service['name'] ?? '') ?>
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
                        <form action="store.php?id=<?= $serviceId ?>" method="post" enctype="multipart/form-data" class="space-y-4 md:space-y-6">
                            <div class="text-center mb-6">
                                <img src="/merosewa/<?= htmlspecialchars($service['image']) ?>"
                                    alt="<?= htmlspecialchars($service['name']) ?>"
                                    class="w-32 h-32 object-cover rounded-lg border border-gray-300 mx-auto mb-3">
                                <p class="text-gray-700 text-sm">Price: <span class="font-semibold text-green-600">NPR <?= htmlspecialchars($service['rate_per_hour']) ?>/Hr</span></p>
                            </div>

                            <!-- Booking Date Picker -->
                            <div class="mb-4">
                                <label for="booking_date" class="block mb-2 text-sm font-medium text-gray-900">Booking Date *</label>
                                <input type="date"
                                    name="booking_date"
                                    id="booking_date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                    required>
                            </div>

                            <!-- Booking Message -->
                            <div class="mb-4">
                                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Message *</label>
                                <textarea
                                    name="message"
                                    id="message"
                                    rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                    placeholder="Write a message for the provider..." required></textarea>
                            </div>


                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Book Now
                            </button>

                            <!-- Cancel Button -->
                            <a href="/merosewa/app/consumer/services"
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
