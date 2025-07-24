<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints - MeroSewa</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="css/complaints.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <!-- Complaints Content -->
            <div class="complaints-container">
                <!-- New Complaint Form -->
                <div class="complaint-form-section">
                    <h2>Submit New Complaint</h2>
                    <p>Please provide details about your issue.</p>

                    <form class="complaint-form">
                        <div class="form-group">
                            <label>Complaint Type</label>
                            <select required>
                                <option value="">Select a complaint type</option>
                                <option>Service Quality</option>
                                <option>Provider Behavior</option>
                                <option>Technical Issue</option>
                                <option>Booking Discrepancy</option>
                                <option>Payment Issue</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Booking ID (Optional)</label>
                            <input type="text" placeholder="e.g., MS-BOOK-20240715-001">
                        </div>

                        <div class="form-group">
                            <label>Issue Description</label>
                            <textarea rows="4" placeholder="Describe your issue in detail. Please include relevant dates, times, and names." required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Upload Supporting Documents (Optional)</label>
                            <div class="file-upload">
                                <input type="file" id="complaint-docs" hidden multiple>
                                <label for="complaint-docs" class="upload-area">
                                    <span>📄</span>
                                    <p>Drag and drop files here or click to browse</p>
                                    <small>Max file size: 5MB</small>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary">Submit Complaint</button>
                    </form>
                </div>

                <!-- Complaint History -->
                <div class="complaint-history-section">
                    <div class="section-header">
                        <h2>Complaint History</h2>
                        <div class="filters">
                            <input type="text" placeholder="Search by ID, type, or keyword...">
                            <select>
                                <option>All</option>
                                <option>Pending</option>
                                <option>Resolved</option>
                            </select>
                        </div>
                    </div>

                    <div class="complaints-list">
                        <div class="complaint-card">
                            <div class="complaint-header">
                                <div class="complaint-info">
                                    <h3>Complaint #MEROSEW-C-001</h3>
                                    <span class="badge resolved">Resolved</span>
                                </div>
                                <span class="complaint-date">Submitted on 2024-01-15</span>
                            </div>
                            <div class="complaint-type">Service Quality</div>
                            <p class="complaint-text">The cleaning service was not up to the expected standard. The service provider missed several areas and the floor was still dirty.</p>
                            <div class="complaint-footer">
                                <span class="booking-id">Booking ID: MEROSEW-20240115-001</span>
                                <button class="btn-link">View Details</button>
                            </div>
                        </div>

                        <div class="complaint-card">
                            <div class="complaint-header">
                                <div class="complaint-info">
                                    <h3>Complaint #MEROSEW-C-002</h3>
                                    <span class="badge pending">Pending</span>
                                </div>
                                <span class="complaint-date">Submitted on 2024-01-14</span>
                            </div>
                            <div class="complaint-type">Provider Behavior</div>
                            <p class="complaint-text">The provider arrived late without prior notification and was rude during the service.</p>
                            <div class="complaint-footer">
                                <span class="booking-id">Booking ID: MEROSEW-20240114-003</span>
                                <button class="btn-link">View Details</button>
                            </div>
                        </div>

                        <div class="complaint-card">
                            <div class="complaint-header">
                                <div class="complaint-info">
                                    <h3>Complaint #MEROSEW-C-003</h3>
                                    <span class="badge resolved">Resolved</span>
                                </div>
                                <span class="complaint-date">Submitted on 2024-01-13</span>
                            </div>
                            <div class="complaint-type">Payment Issue</div>
                            <p class="complaint-text">Overcharged for the service provided. The final bill was higher than the quoted price.</p>
                            <div class="complaint-footer">
                                <span class="booking-id">Booking ID: MEROSEW-20240113-002</span>
                                <button class="btn-link">View Details</button>
                            </div>
                        </div>

                        <div class="complaint-card">
                            <div class="complaint-header">
                                <div class="complaint-info">
                                    <h3>Complaint #MEROSEW-C-004</h3>
                                    <span class="badge escalated">Escalated</span>
                                </div>
                                <span class="complaint-date">Submitted on 2024-01-12</span>
                            </div>
                            <div class="complaint-type">Booking Discrepancy</div>
                            <p class="complaint-text">My booking for a pest control service was scheduled for the wrong time slot.</p>
                            <div class="complaint-footer">
                                <span class="booking-id">Booking ID: MEROSEW-20240112-005</span>
                                <button class="btn-link">View Details</button>
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
                        <span class="pagination-info">Showing 1 to 4 of 8 complaints</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/complaints.js"></script>
</body>
</html> 