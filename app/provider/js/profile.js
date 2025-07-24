document.addEventListener('DOMContentLoaded', function() {
    // Profile Picture Upload
    const profilePicture = document.querySelector('.picture-container img');
    const editProfileBtn = document.querySelector('.btn-outline');

    editProfileBtn.addEventListener('click', function() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePicture.src = e.target.result;
                    // Here you would typically upload the file to your server
                };
                reader.readAsDataURL(file);
            }
        };
        input.click();
    });

    // Document Upload
    const documentUpload = document.getElementById('document-upload');
    const uploadArea = document.querySelector('.upload-area');

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
        if (files.length > 0) {
            documentUpload.files = files;
            handleDocumentUpload(files[0]);
        }
    });

    documentUpload.addEventListener('change', function(e) {
        if (this.files.length > 0) {
            handleDocumentUpload(this.files[0]);
        }
    });

    function handleDocumentUpload(file) {
        if (file.size > 5 * 1024 * 1024) { // 5MB limit
            alert('File size exceeds 5MB limit');
            return;
        }
        // Here you would typically upload the file to your server
        const fileName = file.name;
        uploadArea.querySelector('p').textContent = `Selected file: ${fileName}`;
    }

    // Form Validation and Submission
    const forms = document.querySelectorAll('.profile-section');
    forms.forEach(form => {
        const saveBtn = form.querySelector('.btn-primary');
        if (saveBtn) {
            saveBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const inputs = form.querySelectorAll('input, select, textarea');
                let isValid = true;

                inputs.forEach(input => {
                    if (input.hasAttribute('required') && !input.value) {
                        isValid = false;
                        input.style.borderColor = '#EF4444';
                    } else {
                        input.style.borderColor = 'var(--border-color)';
                    }
                });

                if (isValid) {
                    // Here you would typically submit the form data to your server
                    alert('Changes saved successfully!');
                }
            });
        }
    });

    // Password Change Validation
    const passwordForm = document.querySelector('.profile-section:nth-child(4)');
    const passwordInputs = passwordForm.querySelectorAll('input[type="password"]');
    const changePasswordBtn = passwordForm.querySelector('.btn-primary');

    changePasswordBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const currentPassword = passwordInputs[0].value;
        const newPassword = passwordInputs[1].value;
        const confirmPassword = passwordInputs[2].value;

        if (!currentPassword || !newPassword || !confirmPassword) {
            alert('Please fill in all password fields');
            return;
        }

        if (newPassword !== confirmPassword) {
            alert('New passwords do not match');
            return;
        }

        if (newPassword.length < 8) {
            alert('New password must be at least 8 characters long');
            return;
        }

        // Here you would typically send the password change request to your server
        alert('Password changed successfully!');
        passwordInputs.forEach(input => input.value = '');
    });

    // Toggle Switches
    const toggleSwitches = document.querySelectorAll('.switch input');
    toggleSwitches.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const status = this.checked ? 'enabled' : 'disabled';
            const settingName = this.closest('.preference-item').querySelector('h3').textContent;
            // Here you would typically update the setting on your server
            console.log(`${settingName} ${status}`);
        });
    });

    // Logout Button
    const logoutBtn = document.querySelector('.btn-danger');
    logoutBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to log out?')) {
            // Here you would typically handle the logout process
            window.location.href = 'logout.php';
        }
    });
}); 