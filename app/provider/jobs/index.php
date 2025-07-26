<?php
require_once '../../helpers/redirect-to-login.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - Job History</title>
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

            <div class="job-history-container">
                <h1>Job History</h1>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📊</div>
                        <div class="stat-info">
                            <h3>Total Jobs Completed</h3>
                            <div class="stat-value" id="total-jobs">0</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">💰</div>
                        <div class="stat-info">
                            <h3>Total Earnings</h3>
                            <div class="stat-value" id="total-earnings">Rs. 0</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⏱️</div>
                        <div class="stat-info">
                            <h3>Total Time</h3>
                            <div class="stat-value" id="total-time">0 mins</div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filters">
                    <div class="search-filter">
                        <input type="text" placeholder="Search by customer name, service, or ID...">
                    </div>
                    <div class="filter-group">
                        <select>
                            <option>All Dates</option>
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 3 Months</option>
                        </select>
                        <select>
                            <option>All Service Types</option>
                            <option>Plumbing</option>
                            <option>Electrical</option>
                            <option>Cleaning</option>
                        </select>
                        <select>
                            <option>All Statuses</option>
                            <option>Completed</option>
                            <option>Pending Review</option>
                        </select>
                        <button class="btn-outline">Clear Filters</button>
                    </div>
                </div>

                <div class="job-history-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Service Type</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Earnings (NPR)</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody id="job-history-body">
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
                    <div id="feedback-modal" class="feedback-modal" style="display: none;">
                        <div class="modal-content">
                            <a href="#" class="modal-close" onclick="closeModal()">&times;</a>
                            <h3>Customer Feedback</h3>
                            <p style="margin-top:12px;" id="modal-feedback-message"></p>
                        </div>
                    </div>
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

        .feedback-modal {
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
                url: 'http://localhost/merosewa/api/getAllJobForLoggedInProvider.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.jobs.length > 0) {
                        console.log(response.jobs);
                        populateJobsTable(response.jobs);
                        populateAnalytics(response.jobs);
                    } else {
                        $('#job-history-table').html('<tr><td colspan="6">No Upcoming jobs in db.</td></tr>');
                        $('#total-jobs').text(0);
                        $('#total-earnings').text("Rs. 0");
                        $('#total-time').text("0 mins");
                    }
                },
                error: function() {
                    $('#job-history-table').html('<tr><td colspan="6">Error loading data.</td></tr>');
                    $('#total-jobs').text(0);
                    $('#total-earnings').text("Rs. 0");
                    $('#total-time').text("0 mins");
                }
            });
        }
        populateAnalytics = (jobs) => {
            const total = jobs.length;
            const earnings = jobs.reduce((sum, job) => sum + job.earnings, 0);
            const time = jobs.reduce((sum, job) => sum + job.duration, 0);
            $('#total-jobs').text(0);
            $('#total-earnings').text(`Rs. ${earnings}`);
            $('#total-time').text(`${time} mins`);
        }

        populateJobsTable = (jobs) => {
            const tbody = $('#job-history-body');
            tbody.empty();

            jobs.forEach(job => {
                const feedbackBtn = job.feedback && job.feedback.trim() !== '' ?
                    `<span style="color: #959;cursor: pointer;" onclick='viewFeedback(${JSON.stringify(job.feedback)})'>View Feedback</span>` :
                    `<span style="color: #999;">No Feedback</span>`;
                const row =
                    `<tr>
                        <td>${job.customer_name}</td>
                        <td>${job.service_name}</td>
                        <td>${job.booking_date} for ${job.duration} mins</td>
                        <td><span class="status completed">${job.status}</span></td>
                        <td>${job.earnings}</td>
                        <td>${feedbackBtn}</td>
                    </tr>`;
                tbody.append(row);
            });
        }

        function viewFeedback(feedback) {
            $('#modal-feedback-message').text(feedback);
            $('#feedback-modal').fadeIn();
        }

        function closeModal() {
            $('#feedback-modal').fadeOut();
        }


        function escapeHtml(text) {
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    </script>


</body>

</html>
