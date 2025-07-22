document.addEventListener('DOMContentLoaded', function() {
    // Initialize Calendar
    initializeCalendar();

    // Initialize Price Range Slider
    initializePriceRange();

    // Initialize Filter Actions
    initializeFilterActions();
});

function initializeCalendar() {
    const calendarDates = document.querySelector('.calendar-dates');
    const monthDisplay = document.querySelector('.calendar-header span');
    const prevMonthBtn = document.querySelector('.prev-month');
    const nextMonthBtn = document.querySelector('.next-month');

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    function renderCalendar() {
        const firstDay = new Date(currentYear, currentMonth, 1);
        const lastDay = new Date(currentYear, currentMonth + 1, 0);
        const startingDay = firstDay.getDay();
        const monthLength = lastDay.getDate();

        // Update month display
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        monthDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;

        // Clear previous dates
        calendarDates.innerHTML = '';

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < startingDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('calendar-date', 'empty');
            calendarDates.appendChild(emptyCell);
        }

        // Add dates
        for (let i = 1; i <= monthLength; i++) {
            const dateCell = document.createElement('div');
            dateCell.classList.add('calendar-date');
            dateCell.textContent = i;
            
            // Add click event
            dateCell.addEventListener('click', function() {
                document.querySelectorAll('.calendar-date').forEach(cell => {
                    cell.classList.remove('selected');
                });
                this.classList.add('selected');
            });

            calendarDates.appendChild(dateCell);
        }
    }

    // Event listeners for month navigation
    prevMonthBtn.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar();
    });

    // Initial render
    renderCalendar();
}

function initializePriceRange() {
    const slider = document.querySelector('.slider');
    const rangeLabels = document.querySelector('.range-labels');

    slider.addEventListener('input', function() {
        const value = this.value;
        const leftLabel = rangeLabels.firstElementChild;
        const rightLabel = rangeLabels.lastElementChild;

        leftLabel.textContent = `NPR ${value}`;
        rightLabel.textContent = 'NPR 5000';
    });
}

function initializeFilterActions() {
    const applyBtn = document.querySelector('.btn-apply');
    const clearBtn = document.querySelector('.btn-clear');

    applyBtn.addEventListener('click', function() {
        // Get all filter values
        const selectedCategory = document.querySelector('input[name="category"]:checked').value;
        const priceRange = document.querySelector('.slider').value;
        const selectedRatings = Array.from(document.querySelectorAll('.rating-item input:checked'))
            .map(input => input.value);
        const selectedLocation = document.querySelector('.location-select').value;
        const selectedDate = document.querySelector('.calendar-date.selected')?.textContent;

        // Create filter object
        const filters = {
            category: selectedCategory,
            priceRange: priceRange,
            ratings: selectedRatings,
            location: selectedLocation,
            date: selectedDate
        };

        // Apply filters (you would typically make an API call here)
        applyFilters(filters);
    });

    clearBtn.addEventListener('click', function() {
        // Reset all form elements
        document.querySelector('input[name="category"][value="plumbing"]').checked = true;
        document.querySelector('.slider').value = 2500;
        document.querySelectorAll('.rating-item input').forEach(input => input.checked = false);
        document.querySelector('.location-select').value = '';
        document.querySelectorAll('.calendar-date').forEach(date => date.classList.remove('selected'));

        // Reset the display
        document.querySelector('.range-labels').firstElementChild.textContent = 'NPR 0';
        document.querySelector('.range-labels').lastElementChild.textContent = 'NPR 5000';

        // Clear filters
        applyFilters({});
    });
}

function applyFilters(filters) {
    // This function would typically make an API call to get filtered results
    console.log('Applying filters:', filters);
    
    // For demonstration, we'll just log the filters
    // In a real application, you would:
    // 1. Make an API call with the filters
    // 2. Receive filtered service data
    // 3. Update the services-grid with new data
    // 4. Show loading state while waiting for response
    // 5. Handle any errors that occur
} 