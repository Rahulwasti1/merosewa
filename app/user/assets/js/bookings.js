document.addEventListener('DOMContentLoaded', function() {
    // Initialize Filters
    initializeFilters();

    // Initialize Booking Actions
    initializeBookingActions();

    // Initialize Pagination
    initializePagination();
});

function initializeFilters() {
    const filters = {
        status: document.getElementById('status'),
        date: document.getElementById('date'),
        service: document.getElementById('service')
    };

    // Add change event listeners to all filters
    Object.values(filters).forEach(filter => {
        filter.addEventListener('change', function() {
            applyFilters();
        });
    });
}

function applyFilters() {
    const status = document.getElementById('status').value;
    const date = document.getElementById('date').value;
    const service = document.getElementById('service').value;

    // Here you would typically make an API call with the filter values
    // For demonstration, we'll just log the filter values
    console.log('Applying filters:', { status, date, service });

    // Show loading state
    showLoading();

    // Simulate API call
    setTimeout(() => {
        // Update booking list
        // For demonstration, we'll just hide/show some cards
        const bookingCards = document.querySelectorAll('.booking-card');
        bookingCards.forEach(card => {
            if (status === 'all' || card.classList.contains(status)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        // Hide loading state
        hideLoading();
    }, 500);
}

function initializeBookingActions() {
    // Reschedule Booking
    document.querySelectorAll('.btn-reschedule').forEach(btn => {
        btn.addEventListener('click', function() {
            const bookingId = this.closest('.booking-card').querySelector('.booking-id').textContent;
            showRescheduleModal(bookingId);
        });
    });

    // Cancel Booking
    document.querySelectorAll('.btn-cancel').forEach(btn => {
        btn.addEventListener('click', function() {
            const bookingId = this.closest('.booking-card').querySelector('.booking-id').textContent;
            showCancelConfirmation(bookingId);
        });
    });

    // Contact Provider
    document.querySelectorAll('.btn-contact').forEach(btn => {
        btn.addEventListener('click', function() {
            const bookingId = this.closest('.booking-card').querySelector('.booking-id').textContent;
            window.location.href = `/webb/user/chat.php?booking=${bookingId}`;
        });
    });

    // Write Review
    document.querySelectorAll('.btn-review').forEach(btn => {
        btn.addEventListener('click', function() {
            const bookingId = this.closest('.booking-card').querySelector('.booking-id').textContent;
            window.location.href = `/webb/user/review.php?booking=${bookingId}`;
        });
    });

    // Book Again
    document.querySelectorAll('.btn-rebook').forEach(btn => {
        btn.addEventListener('click', function() {
            const serviceId = this.closest('.booking-card').dataset.serviceId;
            window.location.href = `/webb/user/booking.php?service=${serviceId}`;
        });
    });

    // Download Receipt
    document.querySelectorAll('.btn-receipt').forEach(btn => {
        btn.addEventListener('click', function() {
            const bookingId = this.closest('.booking-card').querySelector('.booking-id').textContent;
            downloadReceipt(bookingId);
        });
    });

    // Contact Support
    document.querySelectorAll('.btn-support').forEach(btn => {
        btn.addEventListener('click', function() {
            window.location.href = '/webb/user/support.php';
        });
    });
}

function initializePagination() {
    const prevBtn = document.querySelector('.btn-prev');
    const nextBtn = document.querySelector('.btn-next');
    const pageButtons = document.querySelectorAll('.page-numbers button');

    // Page number buttons
    pageButtons.forEach(button => {
        button.addEventListener('click', function() {
            const page = this.textContent;
            changePage(page);
        });
    });

    // Previous page
    prevBtn.addEventListener('click', function() {
        if (!this.disabled) {
            const currentPage = document.querySelector('.page-numbers button.active');
            const prevPage = currentPage.previousElementSibling;
            if (prevPage && prevPage.tagName === 'BUTTON') {
                changePage(prevPage.textContent);
            }
        }
    });

    // Next page
    nextBtn.addEventListener('click', function() {
        if (!this.disabled) {
            const currentPage = document.querySelector('.page-numbers button.active');
            const nextPage = currentPage.nextElementSibling;
            if (nextPage && nextPage.tagName === 'BUTTON') {
                changePage(nextPage.textContent);
            }
        }
    });
}

function changePage(page) {
    // Show loading state
    showLoading();

    // Update active page button
    document.querySelectorAll('.page-numbers button').forEach(button => {
        button.classList.remove('active');
        if (button.textContent === page) {
            button.classList.add('active');
        }
    });

    // Update prev/next button states
    const prevBtn = document.querySelector('.btn-prev');
    const nextBtn = document.querySelector('.btn-next');
    prevBtn.disabled = page === '1';
    nextBtn.disabled = page === '10';

    // Here you would typically make an API call to get the page data
    // For demonstration, we'll just simulate a delay
    setTimeout(() => {
        // Hide loading state
        hideLoading();
    }, 500);
}

function showRescheduleModal(bookingId) {
    // Here you would typically show a modal with a calendar
    // For demonstration, we'll just show an alert
    alert(`Reschedule booking ${bookingId}`);
}

function showCancelConfirmation(bookingId) {
    if (confirm('Are you sure you want to cancel this booking?')) {
        // Show loading state
        showLoading();

        // Here you would typically make an API call to cancel the booking
        // For demonstration, we'll just simulate a delay
        setTimeout(() => {
            // Update UI to show cancelled state
            const bookingCard = document.querySelector(`.booking-card:has(.booking-id:contains("${bookingId}"))`);
            if (bookingCard) {
                bookingCard.classList.remove('upcoming');
                bookingCard.classList.add('cancelled');
                bookingCard.querySelector('.status-badge').textContent = 'Cancelled';
                bookingCard.querySelector('.status-badge').className = 'status-badge cancelled';
                
                // Update actions
                const actions = bookingCard.querySelector('.booking-actions');
                actions.innerHTML = `
                    <button class="btn-rebook">Book Again</button>
                    <button class="btn-support">Contact Support</button>
                `;
                
                // Reinitialize actions
                initializeBookingActions();
            }

            // Hide loading state
            hideLoading();

            // Show success message
            showMessage('Booking cancelled successfully');
        }, 500);
    }
}

function downloadReceipt(bookingId) {
    // Here you would typically make an API call to get the receipt
    // For demonstration, we'll just show a message
    showMessage('Downloading receipt...');
}

function showLoading() {
    // Create loading overlay if it doesn't exist
    let loadingOverlay = document.querySelector('.loading-overlay');
    if (!loadingOverlay) {
        loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'loading-overlay';
        loadingOverlay.innerHTML = `
            <div class="loading-spinner"></div>
        `;
        document.body.appendChild(loadingOverlay);
    }
    loadingOverlay.style.display = 'flex';
}

function hideLoading() {
    const loadingOverlay = document.querySelector('.loading-overlay');
    if (loadingOverlay) {
        loadingOverlay.style.display = 'none';
    }
}

function showMessage(message) {
    // Create message element
    const messageElement = document.createElement('div');
    messageElement.className = 'message';
    messageElement.textContent = message;

    // Add to document
    document.body.appendChild(messageElement);

    // Remove after 3 seconds
    setTimeout(() => {
        messageElement.remove();
    }, 3000);
}

// Add these styles dynamically
const styles = `
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #e53e3e;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .message {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 1rem 2rem;
        background: #333;
        color: white;
        border-radius: 4px;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from { transform: translateX(100%); }
        to { transform: translateX(0); }
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = styles;
document.head.appendChild(styleSheet); 