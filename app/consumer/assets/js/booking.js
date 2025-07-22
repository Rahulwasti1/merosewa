document.addEventListener('DOMContentLoaded', function() {
    // Initialize Calendar
    initializeCalendar();

    // Initialize Photo Upload
    initializePhotoUpload();

    // Initialize Form Submission
    initializeFormSubmission();

    // Initialize Service Type Change
    initializeServiceTypeChange();

    // Initialize Time Slot Selection
    initializeTimeSlots();
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

            // Disable past dates
            const cellDate = new Date(currentYear, currentMonth, i);
            if (cellDate < new Date().setHours(0, 0, 0, 0)) {
                dateCell.classList.add('disabled');
            } else {
                dateCell.addEventListener('click', function() {
                    if (!this.classList.contains('disabled')) {
                        document.querySelectorAll('.calendar-date').forEach(cell => {
                            cell.classList.remove('selected');
                        });
                        this.classList.add('selected');
                        updateTimeSlots();
                    }
                });
            }

            calendarDates.appendChild(dateCell);
        }
    }

    // Event listeners for month navigation
    prevMonthBtn.addEventListener('click', function() {
        const today = new Date();
        const prevMonth = new Date(currentYear, currentMonth - 1);
        if (prevMonth >= today.setDate(1)) {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        }
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

function initializePhotoUpload() {
    const photoInput = document.getElementById('photos');
    const photoPreview = document.getElementById('photoPreview');
    const uploadPlaceholder = document.querySelector('.upload-placeholder');

    photoInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        
        // Clear previous preview
        photoPreview.innerHTML = '';
        
        files.forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = file.name;
                    
                    const container = document.createElement('div');
                    container.classList.add('preview-item');
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '×';
                    removeBtn.classList.add('remove-photo');
                    removeBtn.onclick = function() {
                        container.remove();
                        updatePhotoInput();
                    };
                    
                    container.appendChild(img);
                    container.appendChild(removeBtn);
                    photoPreview.appendChild(container);
                };
                
                reader.readAsDataURL(file);
            }
        });
        
        // Update placeholder visibility
        uploadPlaceholder.style.display = files.length > 0 ? 'none' : 'block';
    });

    // Handle drag and drop
    const dropZone = document.querySelector('.photo-upload');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dropZone.classList.add('drag-over');
    }

    function unhighlight() {
        dropZone.classList.remove('drag-over');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        photoInput.files = files;
        
        // Trigger change event
        const event = new Event('change');
        photoInput.dispatchEvent(event);
    }
}

function initializeFormSubmission() {
    const form = document.getElementById('bookingForm');
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Validate form
        if (!validateForm()) {
            return;
        }

        // Collect form data
        const formData = new FormData(form);
        
        try {
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Processing...';
            submitBtn.disabled = true;

            // Here you would typically make an API call to submit the booking
            // For demonstration, we'll simulate an API call
            await simulateApiCall(formData);

            // Redirect to confirmation page
            window.location.href = '/webb/user/booking-confirmation.php';
        } catch (error) {
            // Handle error
            showError('An error occurred while processing your booking. Please try again.');
            
            // Reset button
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    });
}

function initializeServiceTypeChange() {
    const serviceType = document.getElementById('serviceType');
    
    serviceType.addEventListener('change', function() {
        updatePricing(this.value);
    });
}

function initializeTimeSlots() {
    const timeSlots = document.querySelectorAll('.time-slot input');
    
    timeSlots.forEach(slot => {
        slot.addEventListener('change', function() {
            updateSummary();
        });
    });
}

// Helper Functions
function validateForm() {
    const requiredFields = document.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value) {
            isValid = false;
            field.classList.add('error');
        } else {
            field.classList.remove('error');
        }
    });

    const selectedDate = document.querySelector('.calendar-date.selected');
    if (!selectedDate) {
        isValid = false;
        showError('Please select a date');
    }

    const selectedTime = document.querySelector('input[name="timeSlot"]:checked');
    if (!selectedTime) {
        isValid = false;
        showError('Please select a time slot');
    }

    return isValid;
}

function updateTimeSlots() {
    const selectedDate = document.querySelector('.calendar-date.selected');
    const timeSlots = document.querySelectorAll('.time-slot input');
    
    if (selectedDate) {
        // Here you would typically make an API call to get available time slots
        // For demonstration, we'll randomly disable some slots
        timeSlots.forEach(slot => {
            slot.disabled = Math.random() > 0.7;
        });
    }
}

function updatePricing(serviceType) {
    // Here you would typically fetch pricing based on service type
    const baseRates = {
        'repair': 1500,
        'installation': 2000,
        'maintenance': 1200,
        'emergency': 2500
    };

    const baseRate = baseRates[serviceType] || 1500;
    const serviceFee = 200;
    const minimumHours = 2;
    const total = (baseRate * minimumHours) + serviceFee;

    // Update summary
    document.querySelector('.summary-item:nth-child(1) span:last-child').textContent = `NPR ${baseRate} / Hr`;
    document.querySelector('.summary-item.total span:last-child').textContent = `NPR ${total}`;
}

function updateSummary() {
    const selectedDate = document.querySelector('.calendar-date.selected');
    const selectedTime = document.querySelector('input[name="timeSlot"]:checked');
    const serviceType = document.getElementById('serviceType').value;

    if (selectedDate && selectedTime && serviceType) {
        updatePricing(serviceType);
    }
}

function showError(message) {
    // Create error element
    const error = document.createElement('div');
    error.classList.add('error-message');
    error.textContent = message;

    // Show error
    document.querySelector('.booking-header').appendChild(error);

    // Remove after 3 seconds
    setTimeout(() => {
        error.remove();
    }, 3000);
}

async function simulateApiCall(formData) {
    // Simulate API delay
    await new Promise(resolve => setTimeout(resolve, 1500));

    // Simulate API response
    const response = {
        success: true,
        booking_id: Math.random().toString(36).substring(7)
    };

    if (!response.success) {
        throw new Error('Booking failed');
    }

    return response;
}

// Add these styles dynamically
const styles = `
    .error {
        border-color: #e53e3e !important;
    }

    .error-message {
        color: #e53e3e;
        margin-top: 0.5rem;
        font-size: 0.9rem;
    }

    .drag-over {
        border-color: #e53e3e;
        background: #fff5f5;
    }

    .preview-item {
        position: relative;
    }

    .remove-photo {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #e53e3e;
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        line-height: 1;
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = styles;
document.head.appendChild(styleSheet); 