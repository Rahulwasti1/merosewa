// Handle service filtering
document.addEventListener('DOMContentLoaded', function() {
    // Category filtering
    const categoryItems = document.querySelectorAll('.category-list li');
    categoryItems.forEach(item => {
        item.addEventListener('click', function() {
            categoryItems.forEach(cat => cat.classList.remove('active'));
            this.classList.add('active');
            // Add filter logic here
        });
    });

    // Price range filtering
    const minPrice = document.querySelector('input[placeholder="Min Price"]');
    const maxPrice = document.querySelector('input[placeholder="Max Price"]');
    
    [minPrice, maxPrice].forEach(input => {
        input.addEventListener('change', function() {
            // Add price filter logic here
        });
    });

    // Rating filtering
    const ratingCheckboxes = document.querySelectorAll('.rating-options input');
    ratingCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Add rating filter logic here
        });
    });

    // Apply filters button
    const applyFiltersBtn = document.querySelector('.filter-button');
    applyFiltersBtn.addEventListener('click', function() {
        // Collect all filter values and apply them
        const filters = {
            category: document.querySelector('.category-list li.active')?.textContent,
            minPrice: minPrice.value,
            maxPrice: maxPrice.value,
            ratings: Array.from(ratingCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.parentElement.textContent.trim())
        };
        
        // Apply filters logic here
    });

    // Clear filters
    const clearFiltersBtn = document.querySelector('.clear-filters');
    clearFiltersBtn.addEventListener('click', function() {
        // Reset all filters
        categoryItems.forEach(cat => cat.classList.remove('active'));
        minPrice.value = '';
        maxPrice.value = '';
        ratingCheckboxes.forEach(cb => cb.checked = false);
        // Reset the service display
    });

    // Time slot selection
    const timeSlots = document.querySelectorAll('.time-slot');
    timeSlots.forEach(slot => {
        slot.addEventListener('click', function() {
            timeSlots.forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // File upload handling
    const dropZone = document.getElementById('dropZone');
    const attachmentList = document.getElementById('attachmentList');

    if (dropZone && attachmentList) {
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = 'var(--primary-color)';
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.style.borderColor = 'var(--border-color)';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = 'var(--border-color)';
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        dropZone.addEventListener('click', () => {
            const input = document.createElement('input');
            input.type = 'file';
            input.multiple = true;
            input.accept = 'image/*,.pdf,.doc,.docx';
            input.onchange = (e) => handleFiles(e.target.files);
            input.click();
        });

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                if (file.size > 5 * 1024 * 1024) { // 5MB limit
                    alert('File size exceeds 5MB limit: ' + file.name);
                    return;
                }
                
                const item = document.createElement('div');
                item.className = 'attachment-item';
                item.innerHTML = `
                    <i class="fas fa-file"></i>
                    <span>${file.name}</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove()" style="margin-left: auto; cursor: pointer;"></i>
                `;
                attachmentList.appendChild(item);
            });
        }
    }

    // Form submission
    const form = document.getElementById('serviceRequestForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const selectedTimeSlot = document.querySelector('.time-slot.selected');
            if (!selectedTimeSlot) {
                alert('Please select a time slot');
                return;
            }

            // Basic form validation
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = 'var(--primary-color)';
                } else {
                    field.style.borderColor = 'var(--border-color)';
                }
            });

            if (!isValid) {
                alert('Please fill in all required fields');
                return;
            }

            // Add your form submission logic here
            alert('Service request submitted successfully!');
            window.location.href = 'services.php';
        });
    }

    // Filter functionality
    const filterButton = document.querySelector('.filter-button');
    const clearFiltersButton = document.querySelector('.clear-filters');

    if (filterButton && clearFiltersButton) {
        filterButton.addEventListener('click', function() {
            // Get filter values
            const filterCategories = document.querySelectorAll('.category-list li');
            const selectedCategories = Array.from(filterCategories)
                .filter(item => item.classList.contains('selected'))
                .map(item => item.textContent);

            const minPrice = document.querySelector('input[placeholder="Min Price"]').value;
            const maxPrice = document.querySelector('input[placeholder="Max Price"]').value;
            const ratings = Array.from(document.querySelectorAll('.rating-options input:checked'))
                .map(input => input.parentElement.textContent.trim());
            const location = document.querySelector('input[placeholder="Enter location"]').value;
            const city = document.querySelector('select').value;

            // Add your filter logic here
            console.log('Applying filters:', {
                categories: selectedCategories,
                priceRange: { min: minPrice, max: maxPrice },
                ratings,
                location,
                city
            });
        });

        clearFiltersButton.addEventListener('click', function() {
            // Reset all filters
            document.querySelectorAll('.category-list li').forEach(item => {
                item.classList.remove('selected');
            });
            document.querySelectorAll('input[type="number"]').forEach(input => {
                input.value = '';
            });
            document.querySelectorAll('.rating-options input').forEach(input => {
                input.checked = false;
            });
            document.querySelector('input[placeholder="Enter location"]').value = '';
            document.querySelector('select').selectedIndex = 0;
        });
    }

    // Category selection
    const categoryElements = document.querySelectorAll('.category-list li');
    categoryElements.forEach(item => {
        item.addEventListener('click', function() {
            this.classList.toggle('selected');
        });
    });
});

// Service Details Page
if (document.querySelector('.service-details-container')) {
    // Thumbnail image handling
    const mainImage = document.querySelector('.main-image');
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            mainImage.src = this.src;
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Calendar handling
    const calendarDays = document.querySelectorAll('.calendar-day');
    calendarDays.forEach(day => {
        day.addEventListener('click', function() {
            if (this.classList.contains('available')) {
                calendarDays.forEach(d => d.classList.remove('selected'));
                this.classList.add('selected');
            }
        });
    });

    // Book Now button
    const bookNowBtn = document.querySelector('.book-now');
    bookNowBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const selectedDay = document.querySelector('.calendar-day.selected');
        if (!selectedDay) {
            alert('Please select a date first');
            return;
        }
        // Add booking logic here
    });

    // Contact Provider button
    const contactProviderBtn = document.querySelector('.contact-provider');
    contactProviderBtn.addEventListener('click', function(e) {
        e.preventDefault();
        // Add contact logic here
    });

    // Calendar navigation
    const prevMonthBtn = document.querySelector('.calendar-header button:first-child');
    const nextMonthBtn = document.querySelector('.calendar-header button:last-child');
    const monthDisplay = document.querySelector('.calendar-header h4');

    let currentDate = new Date();

    function updateCalendar() {
        // Add calendar update logic here
        monthDisplay.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
    }

    prevMonthBtn.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendar();
    });

    nextMonthBtn.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendar();
    });
} 