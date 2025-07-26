<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
require_once '../../../Database.php';

$db = new Database();

unset($_SESSION['success_message'], $_SESSION['error_message']);
$jobId = $_GET['id'] ?? null;
if (null === $jobId) {
    $_SESSION['error_message'] = "Invalid Job ID.";
    header('Location: index.php');
    exit;
}

$userId = SessionUser::getId();
$jobDetails = $db->selectFirst(
    "SELECT
        s.name as service_name,
        p.full_name as provider_name
    FROM job as j
    JOIN booking as b ON b.id =j.booking
    JOIN service as s ON b.service = s.id
    JOIN users as p ON p.id = s.service_provider
    WHERE b.consumer = ? AND j.id = ?
    LIMIT 1;",
    [$userId, $jobId]
);

if (!$jobDetails) {
    $_SESSION['error_message'] = "Job not found.";
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Leave a Feedback</title>
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
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            How did you like <?= htmlspecialchars($jobDetails['provider_name'] ?? '') ?>'s service <?= htmlspecialchars($jobDetails['service_name'] ?? '') ?>?
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
                        <form action="store.php?id=<?= $jobId ?>" method="post" enctype="multipart/form-data" class="space-y-4 md:space-y-6">
                            <!-- Booking Date Picker -->
                            <div class="mb-4">
                                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Feedback *</label>
                                <textarea
                                    name="feedback"
                                    id="message"
                                    rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                    placeholder="Write about your service experience..." required></textarea>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Submit
                            </button>

                            <!-- Cancel Button -->
                            <a href="/merosewa/app/provider/bookings/"
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
