document.addEventListener('DOMContentLoaded', function() {
    // Form Submission
    const complaintForm = document.querySelector('.complaint-form');
    const complaintType = complaintForm.querySelector('select');
    const issueDescription = complaintForm.querySelector('textarea');
    const fileUpload = document.getElementById('complaint-docs');
    const uploadArea = document.querySelector('.upload-area');

    // File Upload Handling
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--primary)';
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--border-color)';
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = 'var(--border-color)';
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    fileUpload.addEventListener('change', function(e) {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const validFiles = Array.from(files).filter(file => {
            if (file.size > maxSize) {
                alert(`File ${file.name} is too large. Maximum size is 5MB.`);
                return false;
            }
            return true;
        });

        if (validFiles.length > 0) {
            uploadArea.querySelector('p').textContent = `Selected ${validFiles.length} file(s)`;
            // Here you would typically prepare the files for upload
        }
    }

    // Form Validation and Submission
    complaintForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!complaintType.value) {
            alert('Please select a complaint type');
            complaintType.focus();
            return;
        }

        if (!issueDescription.value.trim()) {
            alert('Please provide a description of your issue');
            issueDescription.focus();
            return;
        }

        // Here you would typically send the form data to your server
        const formData = new FormData(this);
        console.log('Submitting complaint:', Object.fromEntries(formData));
        alert('Complaint submitted successfully!');
        this.reset();
        uploadArea.querySelector('p').textContent = 'Drag and drop files here or click to browse';
    });

    // Search and Filter Functionality
    const searchInput = document.querySelector('.filters input');
    const statusFilter = document.querySelector('.filters select');
    const complaintCards = document.querySelectorAll('.complaint-card');

    function filterComplaints() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedStatus = statusFilter.value.toLowerCase();

        complaintCards.forEach(card => {
            const complaintId = card.querySelector('h3').textContent.toLowerCase();
            const complaintType = card.querySelector('.complaint-type').textContent.toLowerCase();
            const complaintText = card.querySelector('.complaint-text').textContent.toLowerCase();
            const bookingId = card.querySelector('.booking-id').textContent.toLowerCase();
            const status = card.querySelector('.badge').textContent.toLowerCase();

            const matchesSearch = complaintId.includes(searchTerm) ||
                                complaintType.includes(searchTerm) ||
                                complaintText.includes(searchTerm) ||
                                bookingId.includes(searchTerm);

            const matchesStatus = selectedStatus === 'all' || status === selectedStatus;

            card.style.display = matchesSearch && matchesStatus ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterComplaints);
    statusFilter.addEventListener('change', filterComplaints);

    // View Details Functionality
    const viewDetailsButtons = document.querySelectorAll('.btn-link');
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.complaint-card');
            const complaintId = card.querySelector('h3').textContent;
            const complaintType = card.querySelector('.complaint-type').textContent;
            const complaintText = card.querySelector('.complaint-text').textContent;
            const bookingId = card.querySelector('.booking-id').textContent;
            const status = card.querySelector('.badge').textContent;
            const date = card.querySelector('.complaint-date').textContent;

            // Here you would typically open a modal or navigate to a details page
            alert(`
                ${complaintId}
                Type: ${complaintType}
                Status: ${status}
                ${date}
                
                Description:
                ${complaintText}
                
                ${bookingId}
            `);
        });
    });

    // Pagination Functionality
    const paginationButtons = document.querySelectorAll('.btn-page');
    const prevButton = document.querySelector('.btn-icon:first-child');
    const nextButton = document.querySelector('.btn-icon:last-child');

    paginationButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (!this.classList.contains('active')) {
                document.querySelector('.btn-page.active').classList.remove('active');
                this.classList.add('active');
                const page = this.textContent;
                // Here you would typically fetch the next page of complaints
                console.log(`Fetching page ${page}`);
            }
        });
    });

    prevButton.addEventListener('click', function() {
        if (!this.disabled) {
            const activePage = document.querySelector('.btn-page.active');
            const prevPage = activePage.previousElementSibling;
            if (prevPage && prevPage.classList.contains('btn-page')) {
                activePage.classList.remove('active');
                prevPage.classList.add('active');
                // Here you would typically fetch the previous page
                console.log(`Fetching page ${prevPage.textContent}`);
            }
        }
    });

    nextButton.addEventListener('click', function() {
        if (!this.disabled) {
            const activePage = document.querySelector('.btn-page.active');
            const nextPage = activePage.nextElementSibling;
            if (nextPage && nextPage.classList.contains('btn-page')) {
                activePage.classList.remove('active');
                nextPage.classList.add('active');
                // Here you would typically fetch the next page
                console.log(`Fetching page ${nextPage.textContent}`);
            }
        }
    });
}); 