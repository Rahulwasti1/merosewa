<?php
require_once '../helpers/redirect-to-login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - All Users</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/merosewa/public/assets/logo.png">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/merosewa/public/css/base.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <?php include 'includes/header.php'; ?>

            <div class="user-management-content">
                <h1>Users</h1>
                <!-- User List -->
                <div class="section">
                    <div class="section-header">
                        <div>
                            <h2>User List</h2>
                            <p>A comprehensive list of all users and their details.</p>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id="users-table">
                                <tr>
                                    <td colspan="4">
                                        <div class="booking-cards" id="booking-cards-container">
                                            <!-- Loading Indicator -->
                                            <div id="loading-indicator" class="loading-container" style="text-align: center; padding: 20px;">
                                                <div class="spinner" style="border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 40px; height: 40px; animation: spin 2s linear infinite; margin: 0 auto;"></div>
                                                <p style="margin-top: 10px; color: #666;">Loading services...</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            vertical-align: top;
            text-align: left;
            padding: 16px;
            border-bottom: 1px solid #ddd;
        }

        .role-badge {
            display: inline-block;
            width: 200px;
            padding: 2px;
            border-radius: 7px;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            text-transform: capitalize;
            text-align: center;
            min-width: 80px;
        }

        .admin {
            background: #959;
            color: #fff;
        }

        .consumer {
            background: #676;
            color: #fff;
        }

        .service_provider {
            background: #278;
            color: #fff;
        }
    </style>
    <script src=" https://code.jquery.com/jquery-3.6.0.min.js">
    </script>
    <script>
        $(document).ready(function() {
            loadUsers();
        });

        function loadUsers() {
            $.ajax({
                url: 'http://localhost/merosewa/api/getAllUsers.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.users.length > 0) {
                        console.log(response.users);
                        populateUsersTable(response.users);
                    } else {
                        $('#users-table').html('<tr><td colspan="7">No Upcoming users in db.</td></tr>');
                    }
                },
                error: function() {
                    $('#users-table').html('<tr><td colspan="7">Error loading data.</td></tr>');
                }
            });
        }

        populateUsersTable = (users) => {
            const tbody = $('#users-table');
            tbody.empty();

            users.forEach(user => {
                const row =
                    ` <tr>
                        <td>${user.id}</td>
                        <td>
                            <div class="user-info">
                                <img src="/merosewa/${user.profile_picture}" alt="${user.full_name}" class="user-avatar">
                                <span>${user.full_name}</span>
                            </div>
                        </td>
                        <td>${user.email}</td>
                        <td>
                            <span class="role-badge ${user.role.toLowerCase()}">${user.role}</span>
                        </td>
                        </tr>`;
                tbody.append(row);
            });
        }
    </script>
</body>

</html>
