<?php
require_once '../helpers/redirect-to-login.php';
require_once 'service-catalogue-actions.php';

$services = getServicesFromSession();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job History - MeroSewa</title>
    <link rel="stylesheet" href="/merosewa/public/css/base.css">
    <link rel="stylesheet" href="/merosewa/public/css/layout.css">
    <link rel="stylesheet" href="css/job-history.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <!-- Job History Content -->
            <div class="job-history-container">
                <h1>My Services</h1>
                <!-- Job History Table -->
                <div class="job-history-table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Service Name</th>
                                <th>Description</th>
                                <th>Rate per Hour</th>
                                <th>Provider ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($services)): ?>
                                <?php foreach ($services as $service): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($service['id']) ?></td>
                                        <td>
                                            <div class="service-image">
                                                <img src="/merosewa/<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['name']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="service-info">
                                                <strong><?= htmlspecialchars($service['name']) ?></strong>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="service-description">
                                                <?= htmlspecialchars(substr($service['description'], 0, 100)) ?>...
                                            </div>
                                        </td>
                                        <td>Rs. <?= number_format($service['rate_per_hour'], 2) ?></td>
                                        <td><?= htmlspecialchars($service['service_provider']) ?></td>
                                        <td>
                                            <button class="btn-link" onclick="viewService(<?= $service['id'] ?>)">View Details</button>
                                            <button class="btn-link" onclick="editService(<?= $service['id'] ?>)" style="margin-left: 5px;">Edit</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                                        No services found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="btn-icon" disabled>←</button>
                    <button class="btn-page active">1</button>
                    <button class="btn-page">2</button>
                    <button class="btn-page">3</button>
                    <button class="btn-icon">→</button>
                    <span class="pagination-info">Showing 1 to 5 of 12 results</span>
                </div>
            </div>
        </div>
    </div>

    <script src="js/job-history.js"></script>
</body>

</html>
