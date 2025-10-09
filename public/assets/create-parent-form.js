// Enhanced Create Parent Form with Advanced UX
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createParentForm');
    const passwordInput = document.getElementById('password');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const studentSelect = document.getElementById('student_id');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    // Password visibility toggle
    if (togglePasswordBtn && passwordInput) {
        togglePasswordBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('svg use');
            icon.setAttribute('href', type === 'password' ? '#icon-eye' : '#icon-eye-off');
        });
    }

    // Real-time password validation
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            validatePassword(this.value);
        });
    }

    // Student selection with info display
    if (studentSelect) {
        studentSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const studentInfo = document.getElementById('selectedStudentInfo');
            
            if (this.value && selectedOption.dataset.lrn) {
                document.getElementById('selectedStudentName').textContent = selectedOption.textContent.split(' (')[0];
                document.getElementById('selectedStudentLRN').textContent = selectedOption.dataset.lrn;
                document.getElementById('selectedStudentGrade').textContent = selectedOption.dataset.grade;
                document.getElementById('selectedStudentSection').textContent = selectedOption.dataset.section;
                studentInfo.classList.remove('d-none');
            } else {
                studentInfo.classList.add('d-none');
            }
        });
    }

    // Enhanced form validation
    if (form) {
        // Real-time validation on input
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
            });
        });

        // Form submission with loading state
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate all fields
            let isValid = true;
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });

            if (isValid) {
                showLoadingState();
                // Simulate form submission (replace with actual submission)
                setTimeout(() => {
                    hideLoadingState();
                    showSuccessMessage();
                }, 2000);
            } else {
                showErrorMessage('Please fix the errors above before submitting.');
            }
        });
    }

    // Password validation function
    function validatePassword(password) {
        const requirements = {
            length: password.length >= 8,
            lowercase: /[a-z]/.test(password),
            uppercase: /[A-Z]/.test(password),
            number: /\d/.test(password)
        };

        // Update requirement indicators
        Object.keys(requirements).forEach(requirement => {
            const element = document.querySelector(`[data-requirement="${requirement}"]`);
            if (element) {
                const icon = element.querySelector('svg use');
                if (requirements[requirement]) {
                    element.classList.add('text-success');
                    element.classList.remove('text-muted');
                    icon.setAttribute('href', '#icon-check');
                } else {
                    element.classList.add('text-muted');
                    element.classList.remove('text-success');
                    icon.setAttribute('href', '#icon-check');
                }
            }
        });

        return Object.values(requirements).every(req => req);
    }

    // Field validation function
    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        // Remove existing validation classes
        field.classList.remove('is-valid', 'is-invalid');

        // Required field validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'This field is required.';
        }

        // Pattern validation
        if (isValid && value && field.hasAttribute('pattern')) {
            const pattern = new RegExp(field.getAttribute('pattern'));
            if (!pattern.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid value.';
            }
        }

        // Email validation
        if (isValid && field.type === 'email' && value) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address.';
            }
        }

        // Password validation
        if (isValid && field.type === 'password' && value) {
            if (!validatePassword(value)) {
                isValid = false;
                errorMessage = 'Password must meet all requirements.';
            }
        }

        // Name validation
        if (isValid && field.id === 'name' && value) {
            if (value.length < 2 || value.length > 50) {
                isValid = false;
                errorMessage = 'Name must be between 2 and 50 characters.';
            }
        }

        // Apply validation classes
        if (value) { // Only show validation if field has content
            field.classList.add(isValid ? 'is-valid' : 'is-invalid');
        }

        return isValid;
    }

    // Loading state management
    function showLoadingState() {
        submitBtn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');
    }

    function hideLoadingState() {
        submitBtn.disabled = false;
        btnText.classList.remove('d-none');
        btnLoading.classList.add('d-none');
    }

    // Success message
    function showSuccessMessage() {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
        alertDiv.innerHTML = `
            <svg width="20" height="20" fill="currentColor" class="me-2">
                <use href="#icon-check"></use>
            </svg>
            <strong>Success!</strong> Parent account has been created successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        form.parentNode.insertBefore(alertDiv, form.nextSibling);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Error message
    function showErrorMessage(message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger alert-dismissible fade show mt-3';
        alertDiv.innerHTML = `
            <svg width="20" height="20" fill="currentColor" class="me-2">
                <use href="#icon-alerts"></use>
            </svg>
            <strong>Error!</strong> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        form.parentNode.insertBefore(alertDiv, form.nextSibling);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Add smooth animations to form elements
    const formElements = form.querySelectorAll('.form-floating');
    formElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        
        setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Add focus effects
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});

// Add CSS for enhanced form styling
if (!document.querySelector('#create-parent-form-styles')) {
    const style = document.createElement('style');
    style.id = 'create-parent-form-styles';
    style.textContent = `
        .form-floating.focused {
            transform: translateY(-2px);
            transition: transform 0.2s ease;
        }
        
        .password-requirements .requirement {
            transition: color 0.3s ease;
        }
        
        .password-requirements .requirement.text-success {
            color: #198754 !important;
        }
        
        .student-info {
            background: rgba(13, 110, 253, 0.05);
            border: 1px solid rgba(13, 110, 253, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem;
            margin-top: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            border-color: #0d6efd;
        }
        
        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
        
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
        
        .alert {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.1), rgba(25, 135, 84, 0.05));
            border-left: 4px solid #198754;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05));
            border-left: 4px solid #dc3545;
        }
    `;
    document.head.appendChild(style);
}
