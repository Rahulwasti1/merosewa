document.addEventListener('DOMContentLoaded', function() {
    // Get all view details buttons
    const viewDetailsButtons = document.querySelectorAll('.btn-icon[title="View Details"]');
    const dialog = document.getElementById('bookingDetailsDialog');
    const closeButton = dialog.querySelector('.close-btn');
    const closeActionButton = dialog.querySelector('.btn-outline');

    // Function to open dialog
    function openDialog() {
        dialog.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Function to close dialog
    function closeDialog() {
        dialog.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Add click event to all view details buttons
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', openDialog);
    });

    // Add click events to close buttons
    closeButton.addEventListener('click', closeDialog);
    closeActionButton.addEventListener('click', closeDialog);

    // Close dialog when clicking outside
    dialog.addEventListener('click', function(e) {
        if (e.target === dialog) {
            closeDialog();
        }
    });

    // Close dialog with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && dialog.classList.contains('active')) {
            closeDialog();
        }
    });

    // Handle mark as completed
    const completeButton = dialog.querySelector('.btn-primary');
    completeButton.addEventListener('click', function() {
        // Here you would typically make an API call to update the status
        alert('Service marked as completed!');
        closeDialog();
    });

    // Handle search functionality
    const searchInput = document.querySelector('.search-container input');
    const requestItems = document.querySelectorAll('.request-item');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        requestItems.forEach(item => {
            const name = item.querySelector('h3').textContent.toLowerCase();
            const service = item.querySelector('.request-info p').textContent.toLowerCase();
            const message = item.querySelector('.request-message p').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || service.includes(searchTerm) || message.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
}); 