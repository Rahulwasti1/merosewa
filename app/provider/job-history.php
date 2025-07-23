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
                <h1>Job History</h1>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📊</div>
                        <div class="stat-info">
                            <h3>Total Jobs Completed</h3>
                            <div class="stat-value">9</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">💰</div>
                        <div class="stat-info">
                            <h3>Total Earnings</h3>
                            <div class="stat-value">Rs. 33,300</div>
                            <div class="stat-subtitle">From completed jobs</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⭐</div>
                        <div class="stat-info">
                            <h3>Average Customer Rating</h3>
                            <div class="stat-value">4.4</div>
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

                <!-- Job History Table -->
                <div class="job-history-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Service Type</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Earnings (NPR)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="customer-info">
                                        <img src="../assets/profile.jpg" alt="Aisha Sharma">
                                        <span>Aisha Sharma</span>
                                    </div>
                                </td>
                                <td>Plumbing Repair</td>
                                <td>2023-10-26 at 14:00 PM</td>
                                <td><span class="status completed">Completed</span></td>
                                <td>Rs. 2,500</td>
                                <td><button class="btn-link">View Details</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer-info">
                                        <img src="../assets/profile.jpg" alt="Bikram Gurung">
                                        <span>Bikram Gurung</span>
                                    </div>
                                </td>
                                <td>Electrical Wiring</td>
                                <td>2023-10-25 at 10:30 AM</td>
                                <td><span class="status completed">Completed</span></td>
                                <td>Rs. 4,500</td>
                                <td><button class="btn-link">View Details</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer-info">
                                        <img src="../assets/profile.jpg" alt="Deepa Rai">
                                        <span>Deepa Rai</span>
                                    </div>
                                </td>
                                <td>House Cleaning</td>
                                <td>2023-10-24 at 09:00 AM</td>
                                <td><span class="status completed">Completed</span></td>
                                <td>Rs. 1,800</td>
                                <td><button class="btn-link">View Details</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer-info">
                                        <img src="../assets/profile.jpg" alt="Kishore Thapa">
                                        <span>Kishore Thapa</span>
                                    </div>
                                </td>
                                <td>AC Maintenance</td>
                                <td>2023-10-23 at 16:00 PM</td>
                                <td><span class="status pending">Pending Review</span></td>
                                <td>Rs. 3,000</td>
                                <td><button class="btn-link">View Details</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="customer-info">
                                        <img src="../assets/profile.jpg" alt="Priya Dahal">
                                        <span>Priya Dahal</span>
                                    </div>
                                </td>
                                <td>Gardening Services</td>
                                <td>2023-10-22 at 11:00 AM</td>
                                <td><span class="status completed">Completed</span></td>
                                <td>Rs. 2,000</td>
                                <td><button class="btn-link">View Details</button></td>
                            </tr>
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
