<?php
require_once '../../helpers/redirect-to-login.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Booking Requests</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/merosewa/public/assets/logo.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/merosewa/public/css/base.css">
    <link rel="stylesheet" href="/merosewa/public/css/layout.css">
    <link rel="stylesheet" href="/merosewa/app/consumer/assets/css/bookings.css">
    <link rel="stylesheet" href="../css/job-history.css">
    <link rel="stylesheet" href="/merosewa/app/consumer/assets/css/style.css">
    <link rel="stylesheet" href="/merosewa/app/consumer/assets/css/sidebar.css">
</head>

<body>
    <div class="dashboard-container">
        <?php include '../includes/sidebar.php'; ?>
        <div class="main-content">
            <?php include '../includes/header.php'; ?>

            <div class="bookings-dashboard">
                <h1>My Bookings Dashboard</h1>

                <!-- Stats Cards -->
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-label">Pending Bookings</span>
                            <span class="stat-value" id="pending-bookings-count">0</span>
                            <span class="stat-desc">Bookings requested by customers but you have yet to accept.</span>
                        </div>
                        <i class="fas fa-spinner"></i>
                    </div>

                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-label">Accepted Bookings</span>
                            <span class="stat-value" id="accepted-bookings-count">0</span>
                            <span class="stat-desc">Bookings you have accepted but yet to complete.</span>
                        </div>
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="stat-label">Total Bookings</span>
                            <span class="stat-value" id="total-bookings-count">0</span>
                            <span class="stat-desc">All the bookings including pending, accepted, completed and cancelled.</span>
                        </div>
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>


                <!-- Search and Filter -->
                <div class="bookings-header">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search bookings...">
                    </div>
                    <div class="filter-dropdown">
                        <button class="btn-filter">
                            Filter by Status
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>

                <section class="bookings-section">
                    <h2>Upcoming Bookings</h2>
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
                    <div class="bookings-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Provider</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="upcoming-bookings-body">
                                <tr>
                                    <td colspan="6">
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
                </section>
                <section class="bookings-section">
                    <h2>Archived Bookings</h2>

                    <div class="bookings-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Provider</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="archived-bookings-body">
                                <tr>
                                    <td colspan="5">
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
                </section>
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

        td {
            padding: 16px;
            text-align: left;
            vertical-align: middle;
        }

        .btn-link-accept,
        .btn-link-complete {
            background: none;
            border: 2px solid #38a169;
            color: #38a169;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-link-cancel {
            background: none;
            border: 2px solid #ed1f11;
            color: #ed1f11;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }


        .btn-link-accept:hover,
        .btn-link-complete:hover {
            background-color: #38a169;
            color: white;
        }

        .btn-link-cancel:hover {
            background-color: #ed1f11;
            color: white;
        }

        .booking-message {
            text-align: left;
            max-width: 250px;
            word-wrap: break-word;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            loadBookings();
        });

        function loadBookings() {
            $.ajax({
                url: 'http://localhost/merosewa/api/getAllBookingsForLoggedInProvider.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.bookings.length > 0) {
                        console.log(response.bookings);
                        populateTotals(response.bookings);
                        populateUpcomingBookings(response.bookings);
                        populateArchivedBookings(response.bookings);
                    } else {
                        $('#upcoming-bookings-body').html('<tr><td colspan="6">No Upcoming bookings in db.</td></tr>');
                        $('#archived-bookings-body').html('<tr><td colspan="5">No Bookings Yet.</td></tr>');
                        $('#total-bookings-count').text(0);
                        $('#accepted-bookings-count').text(0);
                        $('#pending-bookings-count').text(0);
                    }
                },
                error: function() {
                    $('#upcoming-bookings-body').html('<tr><td colspan="6">Error loading data.</td></tr>');
                    $('#archived-bookings-body').html('<tr><td colspan="5">Error loading data.</td></tr>');
                    $('#total-bookings-count').text(0);
                    $('#accepted-bookings-count').text(0);
                    $('#pending-bookings-count').text(0);
                }
            });
        }
        populateTotals = (bookings) => {
            const total = bookings.length;
            const accepted = bookings.filter(b => b.status === "ACCEPTED").length;
            const pending = bookings.filter(b => b.status === "PENDING").length;

            $('#total-bookings-count').text(total);
            $('#accepted-bookings-count').text(accepted);
            $('#pending-bookings-count').text(pending);
        }

        populateUpcomingBookings = (bookings) => {
            const tbody = $('#upcoming-bookings-body');
            tbody.empty();

            const pending = bookings.filter(b => b.status === 'PENDING' || b.status === 'ACCEPTED');

            if (pending.length === 0) {
                tbody.append('<tr><td colspan="6">No upcoming bookings found.</td></tr>');
                return;
            }

            pending.forEach(booking => {
                let statusClass;
                if (booking.status === 'PENDING') {
                    statusClass = 'upcoming';
                } else if (booking.status === 'ACCEPTED') {
                    statusClass = 'completed';
                }
                const actionButtons = booking.status === 'PENDING' ?
                    `<button class="btn-link-accept" data-id="${booking.id}">Accept</button>
                    <button class="btn-link-cancel" data-id="${booking.id}">Cancel</button>` :
                    `<button class="btn-link-complete" data-id="${booking.id}">Complete Job</button>`;
                const row =
                    `<tr>
                        <td><div>${booking.service_name}</div></td>
                        <td><div>${booking.consumer_name}</div></td>
                        <td>
                            <div class="booking-message">${booking.message}</div>
                        </td>
                        <td>${booking.booking_date}</td>
                        <td>
                            <span class="status-badge ${statusClass}">${booking.status}</span>
                        </td>
                        <td>
                            ${actionButtons}
                        </td>
                    </tr>`;
                tbody.append(row);
                $('.btn-link-complete').off('click').on('click', function() {
                    var bookingId = $(this).data('id');
                    window.location.href = `/merosewa/app/provider/jobs/create.php?id=${bookingId}`;
                });
                $('.btn-link-accept').off('click').on('click', function() {
                    var bookingId = $(this).data('id');
                    window.location.href = `accept.php?id=${bookingId}`;
                });
                $('.btn-link-cancel').off('click').on('click', function() {
                    var bookingId = $(this).data('id');
                    const confirmed = confirm("Are you sure you want to cancel this booking?");
                    if (confirmed) {
                        window.location.href = `cancel.php?id=${bookingId}`;
                    }
                });
            });
        }

        populateArchivedBookings = (bookings) => {
            const tbody = $('#archived-bookings-body');
            tbody.empty();

            const accepted = bookings.filter(b => b.status !== 'PENDING' && b.status !== 'ACCEPTED');

            if (accepted.length === 0) {
                tbody.append('<tr><td colspan="5">No bookings found.</td></tr>');
                return;
            }

            accepted.forEach(booking => {
                const statusClass = booking.status.toLowerCase();
                const row = `
            <tr>
                <td>${booking.service_name}</td>
                <td>${booking.consumer_name}</td>
                <td>
                    <div class="booking-message">${booking.message}</div>
                </td>
                <td>${booking.booking_date}</td>
                <td>
                    <span class="status-badge ${statusClass}">${booking.status}</span>
                </td>
            </tr>
        `;
                tbody.append(row);
            });
        }

        cancelBooking = (bookingId) => {
            window.location.href = `cancel.php?id=${bookingId}`;
        }
    </script>
</body>

</html>
