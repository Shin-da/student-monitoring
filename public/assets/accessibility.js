// Accessibility and UX improvements JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Enhanced keyboard navigation
    setupKeyboardNavigation();
    
    // ARIA live regions for dynamic content
    setupLiveRegions();
    
    // Form validation improvements
    setupFormValidation();
    
    // Loading states for async actions
    setupLoadingStates();
    
    // Focus management for modals
    setupModalFocus();
    
    // Tooltips initialization
    setupTooltips();
    
    // Skip link functionality
    setupSkipLinks();
});

function setupKeyboardNavigation() {
    // Escape key to close modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                const modal = bootstrap.Modal.getInstance(openModal);
                if (modal) modal.hide();
            }
        }
    });
    
    // Tab trap in modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                trapFocus(e, openModal);
            }
        }
    });
}

function trapFocus(e, container) {
    const focusableElements = container.querySelectorAll(
        'button:not([disabled]), [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
    );
    
    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];
    
    if (e.shiftKey && document.activeElement === firstElement) {
        e.preventDefault();
        lastElement.focus();
    } else if (!e.shiftKey && document.activeElement === lastElement) {
        e.preventDefault();
        firstElement.focus();
    }
}

function setupLiveRegions() {
    // Create ARIA live regions for announcements
    if (!document.getElementById('aria-live-polite')) {
        const liveRegion = document.createElement('div');
        liveRegion.id = 'aria-live-polite';
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'visually-hidden';
        document.body.appendChild(liveRegion);
    }
    
    if (!document.getElementById('aria-live-assertive')) {
        const liveRegion = document.createElement('div');
        liveRegion.id = 'aria-live-assertive';
        liveRegion.setAttribute('aria-live', 'assertive');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'visually-hidden';
        document.body.appendChild(liveRegion);
    }
}

function announceToScreenReader(message, priority = 'polite') {
    const liveRegion = document.getElementById(`aria-live-${priority}`);
    if (liveRegion) {
        liveRegion.textContent = '';
        setTimeout(() => {
            liveRegion.textContent = message;
        }, 100);
    }
}

function setupFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearFieldError(this);
            });
        });
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                announceToScreenReader('Please correct the errors in the form', 'assertive');
                
                // Focus first invalid field
                const firstError = form.querySelector('.has-error input, .has-error select, .has-error textarea');
                if (firstError) {
                    firstError.focus();
                }
            }
        });
    });
}

function validateField(field) {
    const fieldGroup = field.closest('.mb-3, .form-group, .col');
    if (!fieldGroup) return true;
    
    clearFieldError(field);
    
    // Required field validation
    if (field.hasAttribute('required') && !field.value.trim()) {
        showFieldError(field, 'This field is required');
        return false;
    }
    
    // Email validation
    if (field.type === 'email' && field.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value)) {
            showFieldError(field, 'Please enter a valid email address');
            return false;
        }
    }
    
    // Password validation
    if (field.type === 'password' && field.value) {
        if (field.value.length < 8) {
            showFieldError(field, 'Password must be at least 8 characters long');
            return false;
        }
    }
    
    return true;
}

function showFieldError(field, message) {
    const fieldGroup = field.closest('.mb-3, .form-group, .col');
    fieldGroup.classList.add('has-error');
    field.setAttribute('aria-invalid', 'true');
    
    // Remove existing error message
    const existingError = fieldGroup.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Add new error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    errorDiv.id = `${field.id || field.name}-error`;
    field.setAttribute('aria-describedby', errorDiv.id);
    
    field.parentNode.insertBefore(errorDiv, field.nextSibling);
}

function clearFieldError(field) {
    if (!field) return;
    const fieldGroup = field.closest && field.closest('.mb-3, .form-group, .col');
    if (fieldGroup && fieldGroup.classList) {
        fieldGroup.classList.remove('has-error');
    }
    if (field && field.removeAttribute) {
        field.removeAttribute('aria-invalid');
        field.removeAttribute('aria-describedby');
    }
    if (fieldGroup) {
        const errorMessage = fieldGroup.querySelector('.error-message');
        if (errorMessage && errorMessage.remove) {
            errorMessage.remove();
        }
    }
}

function setupLoadingStates() {
    // Add loading state to buttons on form submit
    document.addEventListener('submit', function(e) {
        const form = e.target;
        const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
        
        if (submitButton && !form.querySelector('.has-error')) {
            showLoading(submitButton);
        }
    });
    
    // Add loading state to AJAX buttons
    document.addEventListener('click', function(e) {
        if (e.target.matches('[data-loading-text]')) {
            showLoading(e.target);
        }
    });
}

function showLoading(element) {
    element.disabled = true;
    element.classList.add('loading');
    
    const originalText = element.textContent || element.value;
    const loadingText = element.dataset.loadingText || 'Loading...';
    
    element.dataset.originalText = originalText;
    if (element.tagName === 'INPUT') {
        element.value = loadingText;
    } else {
        element.textContent = loadingText;
    }
    
    element.setAttribute('aria-busy', 'true');
}

function hideLoading(element) {
    element.disabled = false;
    element.classList.remove('loading');
    
    const originalText = element.dataset.originalText;
    if (originalText) {
        if (element.tagName === 'INPUT') {
            element.value = originalText;
        } else {
            element.textContent = originalText;
        }
        delete element.dataset.originalText;
    }
    
    element.removeAttribute('aria-busy');
}

function setupModalFocus() {
    // Focus management for Bootstrap modals
    document.addEventListener('shown.bs.modal', function(e) {
        const modal = e.target;
        const firstFocusable = modal.querySelector('button:not([disabled]), [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])');
        
        if (firstFocusable) {
            firstFocusable.focus();
        }
    });
    
    // Return focus when modal closes
    let lastFocusedElement = null;
    
    document.addEventListener('show.bs.modal', function(e) {
        lastFocusedElement = document.activeElement;
    });
    
    document.addEventListener('hidden.bs.modal', function(e) {
        if (lastFocusedElement) {
            lastFocusedElement.focus();
        }
    });
}

function setupTooltips() {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

function setupSkipLinks() {
    // Enhanced skip link functionality
    const skipLinks = document.querySelectorAll('.skip-link');
    
    skipLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const target = document.getElementById(targetId);
            
            if (target) {
                target.focus();
                target.scrollIntoView({ behavior: 'smooth' });
                announceToScreenReader(`Skipped to ${target.textContent || targetId}`);
            }
        });
    });
}

// Utility functions for other scripts to use
window.accessibility = {
    announce: announceToScreenReader,
    showLoading: showLoading,
    hideLoading: hideLoading,
    validateField: validateField,
    trapFocus: trapFocus
};