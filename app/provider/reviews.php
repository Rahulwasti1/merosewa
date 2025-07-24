<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews - MeroSewa</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="css/reviews.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <!-- Reviews Content -->
            <div class="reviews-container">
                <div class="reviews-header">
                    <h1>Customer Reviews</h1>
                    <div class="reviews-actions">
                        <input type="text" placeholder="Search reviews by customer name or keyword...">
                        <select>
                            <option>All Reviews</option>
                            <option>Recent First</option>
                            <option>Highest Rated</option>
                            <option>Lowest Rated</option>
                        </select>
                    </div>
                </div>

                <div class="reviews-content">
                    <div class="reviews-summary">
                        <div class="overall-rating">
                            <h2>Overall Rating</h2>
                            <div class="rating-value">
                                <span class="star">⭐</span>
                                4.2
                            </div>
                            <p>Based on 10 Reviews</p>
                        </div>

                        <div class="rating-distribution">
                            <h2>Rating Distribution</h2>
                            <div class="rating-bars">
                                <div class="rating-bar">
                                    <span class="stars">5 ⭐</span>
                                    <div class="bar-container">
                                        <div class="bar" style="width: 50%"></div>
                                    </div>
                                    <span class="count">5</span>
                                </div>
                                <div class="rating-bar">
                                    <span class="stars">4 ⭐</span>
                                    <div class="bar-container">
                                        <div class="bar" style="width: 30%"></div>
                                    </div>
                                    <span class="count">3</span>
                                </div>
                                <div class="rating-bar">
                                    <span class="stars">3 ⭐</span>
                                    <div class="bar-container">
                                        <div class="bar" style="width: 10%"></div>
                                    </div>
                                    <span class="count">1</span>
                                </div>
                                <div class="rating-bar">
                                    <span class="stars">2 ⭐</span>
                                    <div class="bar-container">
                                        <div class="bar" style="width: 10%"></div>
                                    </div>
                                    <span class="count">1</span>
                                </div>
                                <div class="rating-bar">
                                    <span class="stars">1 ⭐</span>
                                    <div class="bar-container">
                                        <div class="bar" style="width: 0%"></div>
                                    </div>
                                    <span class="count">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews-list">
                        <!-- Review Item -->
                        <div class="review-item">
                            <div class="review-header">
                                <h3>Aisha Sharma</h3>
                                <span class="review-date">October 26, 2023</span>
                            </div>
                            <div class="review-rating">
                                ⭐⭐⭐⭐⭐
                                <span class="rating-value">5.0/5.0</span>
                            </div>
                            <p class="review-text">The electrician was prompt, professional, and fixed the issue quickly. Highly recommend MeroSewa!</p>
                            <button class="btn-reply">Reply</button>
                        </div>

                        <!-- More Review Items -->
                        <div class="review-item">
                            <div class="review-header">
                                <h3>Bikram Gurung</h3>
                                <span class="review-date">October 25, 2023</span>
                            </div>
                            <div class="review-rating">
                                ⭐⭐⭐⭐
                                <span class="rating-value">4.0/5.0</span>
                            </div>
                            <p class="review-text">Good plumbing service, but arrived a bit late. The work quality was excellent though.</p>
                            <button class="btn-reply">Reply</button>
                        </div>

                        <div class="review-item">
                            <div class="review-header">
                                <h3>Priya Dahal</h3>
                                <span class="review-date">October 24, 2023</span>
                            </div>
                            <div class="review-rating">
                                ⭐⭐⭐⭐⭐
                                <span class="rating-value">5.0/5.0</span>
                            </div>
                            <p class="review-text">Fantastic cleaning service! My house feels spotless. The team was very polite and thorough.</p>
                            <button class="btn-reply">Reply</button>
                        </div>

                        <div class="review-item">
                            <div class="review-header">
                                <h3>Rabin Thapa</h3>
                                <span class="review-date">October 23, 2023</span>
                            </div>
                            <div class="review-rating">
                                ⭐⭐⭐
                                <span class="rating-value">3.0/5.0</span>
                            </div>
                            <p class="review-text">The AC repair was okay, but the communication could have been better. Took longer than expected.</p>
                            <button class="btn-reply">Reply</button>
                        </div>

                        <div class="review-item">
                            <div class="review-header">
                                <h3>Samira Devi</h3>
                                <span class="review-date">October 22, 2023</span>
                            </div>
                            <div class="review-rating">
                                ⭐⭐⭐⭐⭐
                                <span class="rating-value">5.0/5.0</span>
                            </div>
                            <p class="review-text">Exceptional carpentry work. The custom shelf looks amazing and was built with great attention to detail.</p>
                            <button class="btn-reply">Reply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/reviews.js"></script>
</body>
</html> 