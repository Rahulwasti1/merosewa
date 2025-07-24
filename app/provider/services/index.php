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

    <script>
        // Load services when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadServices();
        });

        function loadServices() {
            // Show loading indicator
            document.getElementById('loading-indicator').style.display = 'block';
            document.getElementById('error-message').style.display = 'none';
            document.getElementById('services-table-container').style.display = 'none';

            // Make AJAX request
            fetch('http://localhost/merosewa/api/get-services.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        populateServicesTable(data.services);
                    } else {
                        showError(data.message || 'Failed to load services');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('Failed to load services. Please check your connection.');
                });
        }

        function populateServicesTable(services) {
            const tbody = document.getElementById('services-table-body');

            // Hide loading indicator
            document.getElementById('loading-indicator').style.display = 'none';

            if (services.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
                            No services found. <a href="new-request.php">Add your first service</a>
                        </td>
                    </tr>
                `;
            } else {
                tbody.innerHTML = services.map(service => `
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
                            <div class="service-description">
                                ${escapeHtml(service.description.substring(0, 100))}${service.description.length > 100 ? '...' : ''}
                            </div>
                        </td>
                        <td>Rs. ${parseFloat(service.rate_per_hour).toLocaleString('en-NP', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                        <td>${escapeHtml(service.service_provider)}</td>
                        <td>
                            <button class="btn-link-edit" onclick="editService(${service.id})" style="margin-left: 5px;">✏️Edit</button>
                            <button class="btn-link-delete" onclick="deleteService(${service.id})">🗑️Delete</button>
                        </td>
                    </tr>
                `).join('');
            }

            // Show table
            document.getElementById('services-table-container').style.display = 'block';
        }

        function showError(message) {
            document.getElementById('loading-indicator').style.display = 'none';
            document.getElementById('services-table-container').style.display = 'none';
            document.getElementById('error-message').style.display = 'block';
            document.getElementById('error-message').querySelector('p').textContent = message;
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
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
