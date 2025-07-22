document.addEventListener('DOMContentLoaded', function() {
    // Get service details from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const serviceId = urlParams.get('serviceId');
    
    // Populate service details
    if (serviceId) {
        // In a real application, you would fetch these details from the server
        // This is just a placeholder example
        document.getElementById('service-name').textContent = urlParams.get('serviceName') || 'Service Name';
        document.getElementById('provider-name').textContent = urlParams.get('providerName') || 'Provider Name';
        document.getElementById('service-date').textContent = urlParams.get('serviceDate') || 'Service Date';
        document.getElementById('service-id').textContent = `Service ID: ${serviceId}`;
    }

    // Handle file upload
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = uploadArea.querySelector('.file-input');
    const previewContainer = document.getElementById('preview-container');
    const maxFiles = 5;
    const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = 'var(--primary)';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = 'var(--border-color)';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = 'var(--border-color)';
        
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        handleFiles(files);
    });

    function handleFiles(files) {
        const currentFiles = previewContainer.children.length;
        const remainingSlots = maxFiles - currentFiles;

        if (remainingSlots <= 0) {
            alert('Maximum number of files reached (5 files)');
            return;
        }

        Array.from(files).slice(0, remainingSlots).forEach(file => {
            if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                alert('Only JPG and PNG files are allowed');
                return;
            }

            if (file.size > maxFileSize) {
                alert('File size must be less than 5MB');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                const preview = document.createElement('div');
                preview.className = 'preview-item';
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button type="button" class="remove-btn">&times;</button>
                `;

                preview.querySelector('.remove-btn').addEventListener('click', () => {
                    preview.remove();
                });

                previewContainer.appendChild(preview);
            };
            reader.readAsDataURL(file);
        });
    }

    // Handle form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Validate required fields
        const rating = form.querySelector('input[name="rating"]:checked');
        const feedback = form.querySelector('textarea[name="feedback"]').value.trim();

        if (!rating) {
            alert('Please select a rating');
            return;
        }

        if (!feedback) {
            alert('Please provide your feedback');
            return;
        }

        // In a real application, you would submit the form data to the server
        // For now, we'll just show a success message
        alert('Thank you for your review!');
        window.location.href = 'job-history.php';
    });
}); 