<?php
require_once '../../helpers/redirect-to-login.php';


function cancelBooking() {}
ob_start();
?>

<div class="bookings-dashboard">
    <h1>My Bookings Dashboard</h1>

    <!-- Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Total Bookings</span>
                <span class="stat-value" id="total-bookings-count">0</span>
                <span class="stat-desc">Your cancelled, completed and upcoming bookings.</span>
            </div>
            <i class="fas fa-spinner"></i>
        </div>

        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Upcoming Bookings</span>
                <span class="stat-value" id="upcoming-bookings-count">0</span>
                <span class="stat-desc">Your pending and accepted bookings</span>
            </div>
            <i class="fas fa-calendar"></i>
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

    <!-- Upcoming & Active Bookings -->
    <section class="bookings-section">
        <h2>Upcoming & Active Bookings</h2>
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
        <div class="booking-cards" id="booking-cards-container">
            <!-- Loading Indicator -->
            <div id="loading-indicator" class="loading-container" style="text-align: center; padding: 20px;">
                <div class="spinner" style="border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 40px; height: 40px; animation: spin 2s linear infinite; margin: 0 auto;"></div>
                <p style="margin-top: 10px; color: #666;">Loading services...</p>
            </div>
        </div>

        <!-- Booking Modal -->
        <div id="booking-modal" class="booking-modal" style="display: none;">
            <div class="modal-content">
                <a href="#" class="modal-close" onclick="closeBookingModal()">&times;</a>
                <h3 id="modal-booking-service-name"></h3>
                <div style="margin: 15px 0; text-align: center;">
                    <img id="modal-booking-service-image" src="" alt="" style="max-height: 200px; border-radius: 8px;" />
                </div>
                <p><strong>Provider:</strong> <span id="modal-booking-provider"></span></p>
                <p><strong>Description:</strong></p>
                <p id="modal-booking-description"></p>
                <p><strong>Rate:</strong> NPR <span id="modal-booking-rate"></span> / hour</p>
                <p><strong>Date:</strong> <span id="modal-booking-date"></span></p>
                <p><strong>Status:</strong> <span id="modal-booking-status"></span></p>
                <p><strong>Message:</strong> <span id="modal-booking-message"></span></p>
            </div>
        </div>

</div>

</section>
<section class="bookings-section">
    <h2>Inactive Bookings</h2>

    <div class="bookings-table">
        <table>
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Provider</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="inactive-bookings-body">
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
</section>
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

    /* Modal styles */
    .booking-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 600px;
        position: relative;
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 16px;
        font-size: 24px;
        color: #333;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        loadBookings();
    });

    function loadBookings() {
        $.ajax({
            url: 'http://localhost/merosewa/api/getAllBookingsFromLoggedInUser.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.bookings.length > 0) {
                    populateBookings(response.bookings);

                    // 🔢 Count total and upcoming bookings
                    const total = response.bookings.length;
                    const upcoming = response.bookings.filter(b =>
                        b.status === 'PENDING' || b.status === 'ACCEPTED'
                    ).length;

                    $('#total-bookings-count').text(total);
                    $('#upcoming-bookings-count').text(upcoming);

                    // 🪶 Populate inactive bookings
                    populateInactiveBookings(response.bookings);
                } else {
                    $('#booking-cards-container').html('<p>No active or upcoming bookings.</p>');
                    $('#inactive-bookings-body').html('<tr><td colspan="4">No inactive bookings.</td></tr>');
                    $('#total-bookings-count').text('0');
                    $('#upcoming-bookings-count').text('0');
                }
            },
            error: function() {
                $('#booking-cards-container').html('<p>Error loading bookings.</p>');
                $('#inactive-bookings-body').html('<tr><td colspan="4">Error loading data.</td></tr>');
                $('#total-bookings-count').text('0');
                $('#upcoming-bookings-count').text('0');
            }
        });
    }


    function populateBookings(bookings) {
        const container = $('#booking-cards-container');
        container.empty();

        bookings.forEach(booking => {
            console.log(booking)
            if (booking.status === 'PENDING' || booking.status === 'CONFIRMED') {
                const badgeClass = booking.status === 'PENDING' ? 'upcoming' : 'active';
                const cardHtml = `
                <div class="booking-card">
                    <img class="service-image" src="/merosewa/${booking.service_image}" alt="${booking.service_name}" />
                    <div class="booking-details">
                        <div class="booking-header">
                            <h3>${booking.service_name}</h3>
                            <span class="status-badge ${badgeClass}">${booking.status}</span>
                        </div>
                        <p class="service-provider">Service provided by ${booking.provider_name}</p>
                        <div class="booking-time">
                            <div class="time-item">
                                <i class="far fa-calendar"></i>
                                <span>${booking.booking_date}</span>
                            </div>
                        </div>
                        <div class="booking-actions">
                            <button class="btn-view" onclick='viewBookingDetails(${JSON.stringify(booking)})'>View Details</button>
                            <button data-id="${booking.id}" class="btn-cancel">Cancel</button>
                        </div>
                    </div>
                </div>
            `;
                container.append(cardHtml);
                $('.btn-cancel').off('click').on('click', function() {
                    var bookingId = $(this).data('id');
                    const confirmed = confirm("Are you sure you want to cancel this booking?");
                    if (confirmed) {
                        cancelBooking(bookingId);
                    }
                });
            }
        });
    }



    function cancelBooking(bookingId) {
        window.location.href = `cancel.php?id=${bookingId}`;
    }

    function populateInactiveBookings(bookings) {
        const tbody = $('#inactive-bookings-body');
        tbody.empty();

        const inactive = bookings.filter(b => b.status === 'CANCELLED' || b.status === 'COMPLETED');

        if (inactive.length === 0) {
            tbody.append('<tr><td colspan="4">No inactive bookings found.</td></tr>');
            return;
        }

        inactive.forEach(booking => {
            const statusClass = booking.status.toLowerCase(); // e.g., 'completed' or 'cancelled'
            const row = `
            <tr>
                <td>${booking.service_name}</td>
                <td>${booking.provicer_name}</td>
                <td>${booking.booking_date}</td>
                <td><span class="status ${statusClass}">${booking.status}</span></td>
            </tr>
        `;
            tbody.append(row);
        });
    }

    function viewBookingDetails(booking) {
        $('#modal-booking-service-name').text(booking.service_name);
        $('#modal-booking-service-image').attr('src', '/merosewa/' + booking.service_image).attr('alt', booking.service_name);
        $('#modal-booking-provider').text(booking.provider_name);
        $('#modal-booking-description').text(booking.service_description);
        $('#modal-booking-rate').text(parseFloat(booking.service_hourly_rate).toLocaleString('en-NP', {
            minimumFractionDigits: 2
        }));
        $('#modal-booking-date').text(booking.booking_date);
        $('#modal-booking-status').text(booking.status);
        $('#modal-booking-message').text(booking.message);
        $('#booking-modal').fadeIn();
    }

    function closeBookingModal() {
        $('#booking-modal').fadeOut();
    }
</script>

<?php
$content = ob_get_clean();
$additional_css = ['/merosewa/app/consumer/assets/css/bookings.css'];
$additional_js = ['/merosewa/app/consumer/assets/js/bookings.js'];
require '../layouts/provider.php';
?>
