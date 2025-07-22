// Modal Functions
function openComplaintModal() {
    document.getElementById('complaintModal').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeComplaintModal() {
    document.getElementById('complaintModal').style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
    resetForm();
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('complaintModal');
    if (event.target === modal) {
        closeComplaintModal();
    }
}

// Form Functions
function resetForm() {
    document.getElementById('complaintForm').reset();
    document.getElementById('fileList').innerHTML = '';
}

// File Upload Handling
const fileInput = document.getElementById('attachFiles');
const fileList = document.getElementById('fileList');
const maxFiles = 3;
const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

fileInput.addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
    const files = Array.from(event.target.files);
    
    // Clear existing files if new selection
    fileList.innerHTML = '';
    
    // Validate number of files
    if (files.length > maxFiles) {
        alert(`Please select a maximum of ${maxFiles} files.`);
        fileInput.value = '';
        return;
    }

    files.forEach(file => {
        // Validate file size
        if (file.size > maxFileSize) {
            alert(`${file.name} is too large. Maximum file size is 5MB.`);
            return;
        }

        // Validate file type
        if (!allowedTypes.includes(file.type)) {
            alert(`${file.name} is not a supported file type. Please use JPG, PNG, or PDF.`);
            return;
        }

        // Create file item
        const fileItem = document.createElement('div');
        fileItem.className = 'file-item';
        
        const fileName = document.createElement('div');
        fileName.className = 'file-item-name';
        
        // Add appropriate icon based on file type
        const fileIcon = document.createElement('span');
        fileIcon.textContent = file.type.includes('image') ? '🖼️' : '📄';
        
        fileName.appendChild(fileIcon);
        fileName.appendChild(document.createTextNode(file.name));
        
        const removeButton = document.createElement('span');
        removeButton.className = 'file-item-remove';
        removeButton.textContent = '✕';
        removeButton.onclick = () => {
            fileItem.remove();
            // Reset file input if all files are removed
            if (fileList.children.length === 0) {
                fileInput.value = '';
            }
        };

        fileItem.appendChild(fileName);
        fileItem.appendChild(removeButton);
        fileList.appendChild(fileItem);
    });
}

// Form Submission
document.getElementById('complaintForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('category', document.getElementById('complaintCategory').value);
    formData.append('description', document.getElementById('complaintDescription').value);
    
    // Add files
    const fileInput = document.getElementById('attachFiles');
    Array.from(fileInput.files).forEach(file => {
        formData.append('files[]', file);
    });

    // Here you would typically send the formData to your server
    // For now, we'll just simulate a submission
    submitComplaint(formData);
});

function submitComplaint(formData) {
    // Show loading state
    const submitButton = document.querySelector('.form-actions .btn-primary');
    const originalText = submitButton.textContent;
    submitButton.textContent = 'Submitting...';
    submitButton.disabled = true;

    // Simulate API call
    setTimeout(() => {
        // Reset form and close modal
        submitButton.textContent = originalText;
        submitButton.disabled = false;
        closeComplaintModal();

        // Show success message
        alert('Your complaint has been submitted successfully. We will review it and get back to you within 3-5 business days.');

        // Optionally refresh the complaints list
        // location.reload();
    }, 1500);
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('newComplaintModal');
    const newComplaintBtn = document.querySelector('.btn-new-complaint');
    const closeModalBtn = document.querySelector('.close-modal');
    const complaintForm = document.getElementById('complaintForm');
    const filterBtns = document.querySelectorAll('.filter-btn');

    // Open modal
    newComplaintBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    // Close modal
    closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Handle form submission
    complaintForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Add form submission logic here when backend is ready
        alert('Complaint submission functionality will be added when backend is ready.');
        modal.style.display = 'none';
        complaintForm.reset();
    });

    // Handle filter buttons
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            // Add filter logic here when backend is ready
        });
    });
}); 