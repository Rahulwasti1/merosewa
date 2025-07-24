document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const searchInput = document.querySelector('.reviews-actions input');
    const sortSelect = document.querySelector('.reviews-actions select');
    const reviewItems = document.querySelectorAll('.review-item');
    const replyButtons = document.querySelectorAll('.btn-reply');

    // Search functionality
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        reviewItems.forEach(item => {
            const name = item.querySelector('h3').textContent.toLowerCase();
            const text = item.querySelector('.review-text').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || text.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Sort functionality
    sortSelect.addEventListener('change', function(e) {
        const sortBy = e.target.value;
        const reviewsArray = Array.from(reviewItems);
        const reviewsList = document.querySelector('.reviews-list');

        reviewsArray.sort((a, b) => {
            if (sortBy === 'Recent First') {
                const dateA = new Date(a.querySelector('.review-date').textContent);
                const dateB = new Date(b.querySelector('.review-date').textContent);
                return dateB - dateA;
            } else if (sortBy === 'Highest Rated') {
                const ratingA = parseFloat(a.querySelector('.rating-value').textContent);
                const ratingB = parseFloat(b.querySelector('.rating-value').textContent);
                return ratingB - ratingA;
            } else if (sortBy === 'Lowest Rated') {
                const ratingA = parseFloat(a.querySelector('.rating-value').textContent);
                const ratingB = parseFloat(b.querySelector('.rating-value').textContent);
                return ratingA - ratingB;
            }
            return 0;
        });

        reviewsList.innerHTML = '';
        reviewsArray.forEach(item => reviewsList.appendChild(item));
    });

    // Reply functionality
    replyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const reviewItem = this.closest('.review-item');
            const customerName = reviewItem.querySelector('h3').textContent;
            
            // Check if reply form already exists
            if (!reviewItem.querySelector('.reply-form')) {
                const replyForm = document.createElement('div');
                replyForm.className = 'reply-form';
                replyForm.innerHTML = `
                    <textarea placeholder="Write your reply to ${customerName}..." rows="3" style="width: 100%; margin: 1rem 0; padding: 0.5rem; border: 1px solid var(--border-color); border-radius: var(--radius-sm);"></textarea>
                    <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                        <button class="btn-outline cancel-reply">Cancel</button>
                        <button class="btn-primary send-reply">Send Reply</button>
                    </div>
                `;
                
                // Insert form after the reply button
                button.parentNode.insertBefore(replyForm, button.nextSibling);
                button.style.display = 'none';

                // Handle cancel reply
                replyForm.querySelector('.cancel-reply').addEventListener('click', function() {
                    replyForm.remove();
                    button.style.display = '';
                });

                // Handle send reply
                replyForm.querySelector('.send-reply').addEventListener('click', function() {
                    const replyText = replyForm.querySelector('textarea').value.trim();
                    if (replyText) {
                        // Here you would typically make an API call to save the reply
                        alert('Reply sent successfully!');
                        replyForm.remove();
                        button.style.display = '';
                    }
                });
            }
        });
    });
}); 