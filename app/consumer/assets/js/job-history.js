document.addEventListener('DOMContentLoaded', function() {
    // Initialize Filters
    initializeFilters();

    // Initialize Job Actions
    initializeJobActions();

    // Initialize Pagination
    initializePagination();
});

function initializeFilters() {
    const filters = {
        date: document.getElementById('date'),
        service: document.getElementById('service'),
        rating: document.getElementById('rating')
    };

    // Add change event listeners to all filters
    Object.values(filters).forEach(filter => {
        filter.addEventListener('change', function() {
            applyFilters();
        });
    });
}

function applyFilters() {
    const date = document.getElementById('date').value;
    const service = document.getElementById('service').value;
    const rating = document.getElementById('rating').value;

    // Here you would typically make an API call with the filter values
    // For demonstration, we'll just log the filter values
    console.log('Applying filters:', { date, service, rating });

    // Show loading state
    showLoading();

    // Simulate API call
    setTimeout(() => {
        // Update job list
        // For demonstration, we'll just hide/show some cards
        const jobCards = document.querySelectorAll('.job-card');
        jobCards.forEach(card => {
            // Apply some random filtering logic
            const shouldShow = Math.random() > 0.5;
            card.style.display = shouldShow ? 'block' : 'none';
        });

        // Hide loading state
        hideLoading();
    }, 500);
}

function initializeJobActions() {
    // Edit Review
    document.querySelectorAll('.btn-edit-review').forEach(btn => {
        btn.addEventListener('click', function() {
            const jobCard = this.closest('.job-card');
            const jobId = jobCard.dataset.jobId;
            window.location.href = `/webb/user/review.php?job=${jobId}&edit=true`;
        });
    });

    // Write Review
    document.querySelectorAll('.btn-write-review').forEach(btn => {
        btn.addEventListener('click', function() {
            const jobCard = this.closest('.job-card');
            const jobId = jobCard.dataset.jobId;
            window.location.href = `/webb/user/review.php?job=${jobId}`;
        });
    });

    // Book Again
    document.querySelectorAll('.btn-rebook').forEach(btn => {
        btn.addEventListener('click', function() {
            const jobCard = this.closest('.job-card');
            const serviceId = jobCard.dataset.serviceId;
            window.location.href = `/webb/user/booking.php?service=${serviceId}`;
        });
    });

    // Download Receipt
    document.querySelectorAll('.btn-receipt').forEach(btn => {
        btn.addEventListener('click', function() {
            const jobCard = this.closest('.job-card');
            const jobId = jobCard.dataset.jobId;
            downloadReceipt(jobId);
        });
    });

    // Review Photos
    document.querySelectorAll('.review-photos img').forEach(img => {
        img.addEventListener('click', function() {
            showPhotoModal(this.src);
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

function downloadReceipt(jobId) {
    // Here you would typically make an API call to get the receipt
    // For demonstration, we'll just show a message
    showMessage('Downloading receipt...');
}

function showPhotoModal(src) {
    // Create modal if it doesn't exist
    let modal = document.querySelector('.photo-modal');
    if (!modal) {
        modal = document.createElement('div');
        modal.className = 'photo-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <button class="close-modal">&times;</button>
                <img src="${src}" alt="Review Photo">
            </div>
        `;
        document.body.appendChild(modal);

        // Close button event
        modal.querySelector('.close-modal').addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Click outside to close
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    } else {
        modal.querySelector('img').src = src;
    }

    modal.style.display = 'flex';
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

    .photo-modal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
    }

    .modal-content img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
    }

    .close-modal {
        position: absolute;
        top: -40px;
        right: 0;
        background: none;
        border: none;
        color: white;
        font-size: 2rem;
        cursor: pointer;
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = styles;
document.head.appendChild(styleSheet); 