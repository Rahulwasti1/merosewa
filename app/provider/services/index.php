<?php
require_once '../../helpers/redirect-to-login.php';
require_once '../../models/SessionUser.php';
$username = SessionUser::getUsername();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - My Services</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/merosewa/public/assets/logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/merosewa/public/css/base.css">
    <link rel="stylesheet" href="/merosewa/public/css/layout.css">
    <link rel="stylesheet" href="../css/job-history.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php include '../includes/header.php'; ?>

            <!-- Services Content -->
            <div class="job-history-container">
                <h1>My Services</h1>
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
                <a href="create.php" class="action-card">
                    <span class="action-icon">➕</span>
                    <span>Add a Service</span>
                </a>

                <!-- Loading Indicator -->
                <div id="loading-indicator" class="loading-container" style="text-align: center; padding: 20px;">
                    <div class="spinner" style="border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 40px; height: 40px; animation: spin 2s linear infinite; margin: 0 auto;"></div>
                    <p style="margin-top: 10px; color: #666;">Loading services...</p>
                </div>

                <!-- Error Message Container -->
                <div id="error-message" class="error-container" style="display: none; text-align: center; padding: 20px; color: #d32f2f; background-color: #ffebee; border-radius: 5px; margin: 20px 0;">
                    <p>Failed to load services. Please try again.</p>
                    <button onclick="loadServices()" style="margin-top: 10px; padding: 8px 16px; background-color: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">Retry</button>
                </div>

                <!-- Services Table -->
                <div class="job-history-table" id="services-table-container" style="display: none;">
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
                        <tbody id="services-table-body">
                            <!-- Data will be populated here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .btn-link-edit {
            background: none;
            border: 1px solid #007bff;
            color: #007bff;
            padding: 4px 8px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-link-delete {
            background: none;
            border: 1px solid #ed1f11;
            color: #ed1f11;
            padding: 4px 8px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }


        .btn-link:hover {
            background-color: #007bff;
            color: white;
        }

        .service-image img {
            border: 1px solid #ddd;
        }

        .service-description {
            max-width: 250px;
            word-wrap: break-word;
        }
    </style>

    // Loading jQuery for AJAX requests
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            loadServices();
        });

        function loadServices() {
            $('#loading-indicator').show();
            $('#error-message').hide();
            $('#services-table-container').hide();

            $.ajax({
                url: 'http://localhost/merosewa/api/get-services.php',
                method: 'GET',
                dataType: 'json',
                contentType: 'application/json',
                success: function(data) {
                    if (data.success) {
                        populateServicesTable(data.services);
                    } else {
                        showError(data.message || 'Failed to load services');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    showError('Failed to load services. Please check your connection.');
                }
            });
        }

        function populateServicesTable(services) {
            var $tbody = $('#services-table-body');

            $('#loading-indicator').hide();

            if (services.length === 0) {
                $tbody.html(`
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
                        No services found. <a href="new-request.php">Add your first service</a>
                    </td>
                </tr>
            `);
            } else {
                var rows = services.map(function(service) {
                    var description = service.description.length > 100 ?
                        escapeHtml(service.description.substring(0, 100)) + '...' :
                        escapeHtml(service.description);

                    return `
                    <tr>
                        <td>${escapeHtml(service.id)}</td>
                        <td>
                            <div class="service-image">
                                <img src="/merosewa/${escapeHtml(service.image)}"
                                     alt="${escapeHtml(service.name)}"
                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            </div>
                        </td>
                        <td>
                            <div class="service-info">
                                <strong>${escapeHtml(service.name)}</strong>
                            </div>
                        </td>
                        <td>
                            <div class="service-description">${description}</div>
                        </td>
                        <td>Rs. ${parseFloat(service.rate_per_hour).toLocaleString('en-NP', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                        <td>${escapeHtml(service.service_provider)}</td>
                        <td>
                            <button class="btn-link-edit" style="margin-left: 5px;" data-id="${service.id}">✏️Edit</button>
                            <button class="btn-link-delete" data-id="${service.id}">🗑️Delete</button>
                        </td>
                    </tr>
                `;
                }).join('');

                $tbody.html(rows);

                // Attach click handlers using jQuery
                $('.btn-link-edit').off('click').on('click', function() {
                    var serviceId = $(this).data('id');
                    editService(serviceId);
                });

                $('.btn-link-delete').off('click').on('click', function() {
                    var serviceId = $(this).data('id');
                    deleteService(serviceId);
                });
            }

            $('#services-table-container').show();
        }

        function showError(message) {
            $('#loading-indicator').hide();
            $('#services-table-container').hide();
            $('#error-message').show();
            $('#error-message p').text(message);
        }

        function escapeHtml(text) {
            return $('<div>').text(text).html();
        }

        function deleteService(serviceId) {
            window.location.href = `destroy.php?id=${serviceId}`;
        }

        function editService(serviceId) {
            window.location.href = `edit.php?id=${serviceId}`;
        }
    </script>

</body>

</html>
