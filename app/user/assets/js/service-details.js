document.addEventListener('DOMContentLoaded', function() {
    // Initialize Tabs
    initializeTabs();

    // Initialize Image Gallery
    initializeImageGallery();

    // Initialize FAQ
    initializeFAQ();

    // Initialize Booking Actions
    initializeBookingActions();
});

function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked button and corresponding content
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
}

function initializeImageGallery() {
    const mainImage = document.querySelector('.main-image img');
    const thumbnails = document.querySelectorAll('.thumbnail-images img');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            // Swap main image source with thumbnail source
            const tempSrc = mainImage.src;
            mainImage.src = thumbnail.src;
            thumbnail.src = tempSrc;

            // Swap alt text as well
            const tempAlt = mainImage.alt;
            mainImage.alt = thumbnail.alt;
            thumbnail.alt = tempAlt;

            // Add animation effect
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.style.opacity = '1';
            }, 50);
        });
    });

    // Add zoom effect on main image hover
    mainImage.addEventListener('mousemove', function(e) {
        const bounds = this.getBoundingClientRect();
        const x = e.clientX - bounds.left;
        const y = e.clientY - bounds.top;
        
        const xPercent = Math.round(100 / bounds.width * x);
        const yPercent = Math.round(100 / bounds.height * y);
        
        this.style.transformOrigin = `${xPercent}% ${yPercent}%`;
    });

    mainImage.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.5)';
    });

    mainImage.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
}

function initializeFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const toggleIcon = item.querySelector('.toggle-icon');

        question.addEventListener('click', () => {
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-answer').style.maxHeight = '0px';
                    otherItem.querySelector('.toggle-icon').style.transform = 'rotate(0deg)';
                }
            });

            // Toggle current FAQ item
            item.classList.toggle('active');
            
            if (item.classList.contains('active')) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                toggleIcon.style.transform = 'rotate(45deg)';
            } else {
                answer.style.maxHeight = '0px';
                toggleIcon.style.transform = 'rotate(0deg)';
            }
        });
    });
}

function initializeBookingActions() {
    const bookBtn = document.querySelector('.btn-book');
    const contactBtn = document.querySelector('.btn-contact');

    bookBtn.addEventListener('click', () => {
        // Here you would typically:
        // 1. Show a booking modal or redirect to booking page
        // 2. Initialize a booking flow
        // 3. Handle the booking process
        console.log('Booking flow initiated');
        window.location.href = '/webb/user/booking.php?service_id=1'; // Replace with actual service ID
    });

    contactBtn.addEventListener('click', () => {
        // Here you would typically:
        // 1. Show a contact modal
        // 2. Initialize a chat interface
        // 3. Handle the messaging process
        console.log('Contact provider initiated');
        window.location.href = '/webb/user/chat.php?provider_id=1'; // Replace with actual provider ID
    });
}

// Helper function to format currency
function formatCurrency(amount) {
    return `NPR ${amount.toLocaleString()}`;
}

// Helper function to format date
function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('en-US', options);
}

// Helper function to calculate rating percentage
function calculateRatingPercentage(rating, totalRatings) {
    return (rating / totalRatings * 100).toFixed(1) + '%';
} 