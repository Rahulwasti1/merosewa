document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const searchInput = document.querySelector('.search-filter input');
    const dateFilter = document.querySelector('select:nth-child(1)');
    const serviceFilter = document.querySelector('select:nth-child(2)');
    const statusFilter = document.querySelector('select:nth-child(3)');
    const clearFiltersBtn = document.querySelector('.btn-outline');
    const tableRows = document.querySelectorAll('tbody tr');
    const viewDetailsButtons = document.querySelectorAll('.btn-link');
    const paginationButtons = document.querySelectorAll('.btn-page');

    // Search functionality
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        
        tableRows.forEach(row => {
            const customerName = row.querySelector('.customer-info span').textContent.toLowerCase();
            const serviceType = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const bookingId = row.dataset.bookingId ? row.dataset.bookingId.toLowerCase() : '';
            
            if (customerName.includes(searchTerm) || serviceType.includes(searchTerm) || bookingId.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Filter functionality
    function applyFilters() {
        const selectedDate = dateFilter.value;
        const selectedService = serviceFilter.value;
        const selectedStatus = statusFilter.value;

        tableRows.forEach(row => {
            const date = row.querySelector('td:nth-child(3)').textContent;
            const service = row.querySelector('td:nth-child(2)').textContent;
            const status = row.querySelector('.status').textContent;

            let showRow = true;

            if (selectedDate !== 'All Dates') {
                const rowDate = new Date(date);
                const today = new Date();
                const daysDiff = Math.floor((today - rowDate) / (1000 * 60 * 60 * 24));

                if (selectedDate === 'Last 7 Days' && daysDiff > 7) showRow = false;
                if (selectedDate === 'Last 30 Days' && daysDiff > 30) showRow = false;
                if (selectedDate === 'Last 3 Months' && daysDiff > 90) showRow = false;
            }

            if (selectedService !== 'All Service Types' && service !== selectedService) showRow = false;
            if (selectedStatus !== 'All Statuses' && !status.includes(selectedStatus)) showRow = false;

            row.style.display = showRow ? '' : 'none';
        });
    }

    // Add event listeners to filters
    dateFilter.addEventListener('change', applyFilters);
    serviceFilter.addEventListener('change', applyFilters);
    statusFilter.addEventListener('change', applyFilters);

    // Clear filters
    clearFiltersBtn.addEventListener('click', function() {
        dateFilter.value = 'All Dates';
        serviceFilter.value = 'All Service Types';
        statusFilter.value = 'All Statuses';
        searchInput.value = '';
        
        tableRows.forEach(row => {
            row.style.display = '';
        });
    });

    // View details functionality
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const customerName = row.querySelector('.customer-info span').textContent;
            const serviceType = row.querySelector('td:nth-child(2)').textContent;
            const dateTime = row.querySelector('td:nth-child(3)').textContent;
            const status = row.querySelector('.status').textContent;
            const earnings = row.querySelector('td:nth-child(5)').textContent;

            // Here you would typically open a modal or navigate to a details page
            alert(`
                Customer: ${customerName}
                Service: ${serviceType}
                Date & Time: ${dateTime}
                Status: ${status}
                Earnings: ${earnings}
            `);
        });
    });

    // Pagination functionality
    paginationButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (!this.classList.contains('active')) {
                document.querySelector('.btn-page.active').classList.remove('active');
                this.classList.add('active');
                // Here you would typically make an API call to fetch the next page of results
            }
        });
    });
}); 