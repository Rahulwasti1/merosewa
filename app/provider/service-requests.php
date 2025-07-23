<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests - MeroSewa</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="css/service-requests.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <div class="service-requests-container">
                <div class="requests-list">
                    <div class="page-header">
                        <h1>Service Requests</h1>
                        <div class="search-container">
                            <input type="text" placeholder="Search requests..." class="search-input">
                        </div>
                    </div>

                    <!-- Request Items -->
                    <div class="request-item active">
                        <div class="request-profile">
                            <img src="/webb/public/assets/profile.jpg" alt="Rajesh Sharma" class="profile-pic">
                            <div class="request-info">
                                <h3>Rajesh Sharma</h3>
                                <p class="service-type">Electrical Repair</p>
                                <span class="time">10:30 AM</span>
                            </div>
                            <div class="message-preview">
                                <p>Okay, I will accept it!</p>
                            </div>
                        </div>
                    </div>

                    <div class="request-item">
                        <div class="request-profile">
                            <img src="/webb/public/assets/profile.jpg" alt="Priya Gurung" class="profile-pic">
                            <div class="request-info">
                                <h3>Priya Gurung</h3>
                                <p class="service-type">Plumbing Installation</p>
                                <span class="time">Yesterday</span>
                            </div>
                            <div class="message-preview">
                                <p>Can you do it tomorrow?</p>
                            </div>
                        </div>
                    </div>

                    <div class="request-item">
                        <div class="request-profile">
                            <img src="/webb/public/assets/profile.jpg" alt="Sita Devi" class="profile-pic">
                            <div class="request-info">
                                <h3>Sita Devi</h3>
                                <p class="service-type">Deep Cleaning Service</p>
                                <span class="time">Mar 15</span>
                            </div>
                            <div class="message-preview">
                                <p>I need it done by evening</p>
                            </div>
                        </div>
                    </div>

                    <div class="request-item">
                        <div class="request-profile">
                            <img src="/webb/public/assets/profile.jpg" alt="Bimal Thapa" class="profile-pic">
                            <div class="request-info">
                                <h3>Bimal Thapa</h3>
                                <p class="service-type">Carpentry Work</p>
                                <span class="time">Mar 12</span>
                            </div>
                            <div class="message-preview">
                                <p>Can you propose a new time?</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Section -->
                <div class="chat-section">
                    <div class="chat-header">
                        <div class="chat-user-info">
                            <img src="/webb/public/assets/profile.jpg" alt="Rajesh Sharma" class="profile-pic">
                            <div>
                                <h3>Rajesh Sharma</h3>
                                <p>Electrical Repair</p>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <button class="btn-icon" title="Video Call"><i class="fas fa-video"></i></button>
                            <button class="btn-icon" title="More Options"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>

                    <div class="chat-messages">
                        <div class="message sent">
                            <p>Hello Rajesh! I received your request for electrical repair. I can visit today between 2-4 PM for Rs. 3,500. Does that work for you?</p>
                            <span class="time">10:00 AM</span>
                        </div>

                        <div class="message received">
                            <p>Hi there! 2-4 PM sounds good, but would it be possible to do it for Rs. 3,000?</p>
                            <span class="time">10:15 AM</span>
                        </div>

                        <div class="offer-proposal">
                            <div class="offer-header">
                                <i class="fas fa-tag"></i>
                                <h4>Offer Proposal</h4>
                            </div>
                            <p>Customer proposed: Rs. 3,000 for service at today 2-4 PM</p>
                            <div class="offer-actions">
                                <button class="btn-outline">View Details</button>
                                <button class="btn-primary">Counter Offer</button>
                            </div>
                        </div>

                        <div class="message sent">
                            <p>Okay, I will accept this offer. Please confirm the booking.</p>
                            <span class="time">10:30 AM</span>
                        </div>

                        <div class="offer-accepted">
                            <i class="fas fa-check-circle"></i>
                            <span>Offer Accepted</span>
                        </div>
                    </div>

                    <div class="chat-input">
                        <input type="text" placeholder="Write a message..." class="message-input">
                        <div class="input-actions">
                            <button class="btn-icon"><i class="fas fa-paperclip"></i></button>
                            <button class="btn-icon"><i class="far fa-smile"></i></button>
                            <button class="btn-icon send"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Request Details Sidebar -->
                <div class="request-details">
                    <div class="details-header">
                        <h2>Request Details</h2>
                        <button class="close-btn"><i class="fas fa-times"></i></button>
                    </div>

                    <div class="details-content">
                        <div class="details-section">
                            <h3>Service Information</h3>
                            <div class="info-item">
                                <label>Service Type:</label>
                                <span>Electrical Repair</span>
                            </div>
                            <div class="info-item">
                                <label>Initial Offer:</label>
                                <span>Rs. 3,500</span>
                            </div>
                            <div class="info-item">
                                <label>Proposed Time:</label>
                                <span>Today, 2:00 PM - 4:00 PM</span>
                            </div>
                            <div class="info-item">
                                <label>Status:</label>
                                <span class="status accepted">Accepted</span>
                            </div>
                            <div class="info-item">
                                <label>Description:</label>
                                <p>Repair of faulty wiring in kitchen, checking circuit breaker and light fixtures. Urgent request.</p>
                            </div>
                        </div>

                        <div class="details-section">
                            <h3>Customer Information</h3>
                            <div class="customer-info">
                                <img src="/webb/public/assets/profile.jpg" alt="Rajesh Sharma" class="profile-pic">
                                <div>
                                    <h4>Rajesh Sharma</h4>
                                    <p>Member since March 2024</p>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <span>4.8 (15 reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="details-section">
                            <h3>Negotiation History</h3>
                            <div class="negotiation-timeline">
                                <div class="timeline-item">
                                    <span class="time">10:00 AM</span>
                                    <p>Initial offer: Rs. 3,500</p>
                                </div>
                                <div class="timeline-item">
                                    <span class="time">10:15 AM</span>
                                    <p>Counter offer: Rs. 3,000</p>
                                </div>
                                <div class="timeline-item">
                                    <span class="time">10:30 AM</span>
                                    <p>Offer accepted</p>
                                </div>
                            </div>
                        </div>

                        <div class="details-section">
                            <h3>Additional Notes</h3>
                            <p>Customer prefers communication via chat. Previous service history shows good payment record.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/service-requests.js"></script>
</body>
</html> 