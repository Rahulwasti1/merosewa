<?php
require_once '../helpers/redirect-to-login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MeroSewa - All Jobs</title>
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
    <link rel="stylesheet" href="/merosewa/app/provider/job-history.css">
    <link rel="stylesheet" href="/merosewa/app/consumer/assets/css/style.css">
    <link rel="stylesheet" href="/merosewa/app/consumer/assets/css/sidebar.css">
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

            <div class="job-history-container">
                <h1>Job History</h1>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📊</div>
                        <div class="stat-info">
                            <h3>Total Jobs</h3>
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

                <div class="job-history-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Provider</th>
                                <th>Service Type</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Earnings (NPR)</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody id="job-history-body">
                            <tr>
                                <td colspan="7">
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

        .btn-view-feedback {
            border: 2px solid #959;
            color: #959;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-view-feedback:hover {
            background-color: #616;
            color: white;
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
                url: 'http://localhost/merosewa/api/getAllJobs.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.jobs.length > 0) {
                        console.log(response.jobs);
                        populateJobsTable(response.jobs);
                        populateAnalytics(response.jobs);
                    } else {
                        $('#job-history-table').html('<tr><td colspan="7">No Upcoming jobs in db.</td></tr>');
                        $('#total-jobs').text(0);
                        $('#total-earnings').text("Rs. 0");
                        $('#total-time').text("0 mins");
                    }
                },
                error: function() {
                    $('#job-history-table').html('<tr><td colspan="7">Error loading data.</td></tr>');
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
            $('#total-jobs').text(jobs.length);
            $('#total-earnings').text(`Rs. ${earnings}`);
            $('#total-time').text(`${time} mins`);
        }

        populateJobsTable = (jobs) => {
            const tbody = $('#job-history-body');
            tbody.empty();

            jobs.forEach(job => {
                const feedbackBtn = job.feedback && job.feedback.trim() !== '' ?
                    `<button class="btn-view-feedback" onclick='viewFeedback(${JSON.stringify(job.feedback)})'>View Feedback</button>` :
                    `<span style="color: #999;">No Feedback</span>`;
                const row =
                    `<tr>
                        <td>${job.customer_name}</td>
                        <td>${job.provider_name}</td>
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
