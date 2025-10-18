/**
 * Enhanced Forms System
 * Comprehensive form validation, UX improvements, and consistency
 */

class EnhancedFormsSystem {
  constructor() {
    this.init();
  }

  init() {
    this.initializeFormValidation();
    this.initializeFormUX();
    this.initializeFormConsistency();
  }

  initializeFormValidation() {
    // Real-time validation for all forms except auth forms
    document.querySelectorAll('form').forEach(form => {
      const isAuthForm = form.id === 'loginForm' || form.id === 'registerForm';
      if (!isAuthForm) {
        this.enhanceFormValidation(form);
      }
    });

    // Password strength validation (excludes auth forms)
    document.querySelectorAll('input[type="password"]').forEach(input => {
      this.enhancePasswordField(input);
    });

    // Email validation (excludes auth forms)
    document.querySelectorAll('input[type="email"]').forEach(input => {
      const parentForm = input.closest('form');
      const isAuthForm = parentForm && (parentForm.id === 'loginForm' || parentForm.id === 'registerForm');
      if (!isAuthForm) {
        this.enhanceEmailField(input);
      }
    });

    // Phone number validation
    document.querySelectorAll('input[type="tel"]').forEach(input => {
      this.enhancePhoneField(input);
    });
  }

  initializeFormUX() {
    // Loading states for submit buttons (excludes auth forms)
    document.querySelectorAll('form').forEach(form => {
      const isAuthForm = form.id === 'loginForm' || form.id === 'registerForm';
      if (!isAuthForm) {
        this.addLoadingStates(form);
      }
    });

    // Auto-save for long forms
    document.querySelectorAll('form[data-auto-save]').forEach(form => {
      this.addAutoSave(form);
    });

    // Character counters for text areas
    document.querySelectorAll('textarea[maxlength]').forEach(textarea => {
      this.addCharacterCounter(textarea);
    });

    // File upload enhancements
    document.querySelectorAll('input[type="file"]').forEach(input => {
      this.enhanceFileUpload(input);
    });
  }

  initializeFormConsistency() {
    // Consistent styling
    this.applyConsistentStyling();
    
    // Focus management
    this.enhanceFocusManagement();
    
    // Keyboard navigation
    this.enhanceKeyboardNavigation();
  }

  enhanceFormValidation(form) {
    const inputs = form.querySelectorAll('input, select, textarea');
    
    inputs.forEach(input => {
      // Real-time validation
      input.addEventListener('blur', () => {
        this.validateField(input);
      });

      input.addEventListener('input', () => {
        this.clearFieldError(input);
      });
    });

    // Form submission validation
    form.addEventListener('submit', (e) => {
      if (!this.validateForm(form)) {
        e.preventDefault();
        this.showFormErrors(form);
      }
    });
  }

  enhancePasswordField(input) {
    const container = input.closest('.form-group, .mb-3');
    if (!container) return;

    // Detect auth forms and skip enhancement (they handle their own password toggles)
    const parentForm = input.closest('form');
    const isAuthForm = parentForm && (parentForm.id === 'loginForm' || parentForm.id === 'registerForm');
    
    if (isAuthForm) {
      // Skip enhancement for auth forms - they have their own password toggle implementation
      return;
    }

    // Create password strength indicator for non-auth forms
    const strengthIndicator = document.createElement('div');
    strengthIndicator.className = 'password-strength mt-2';
    strengthIndicator.innerHTML = `
      <div class="password-strength-bar">
        <div class="password-strength-fill"></div>
      </div>
      <div class="password-strength-text small text-muted"></div>
    `;
    container.appendChild(strengthIndicator);

    // Password visibility toggle
    const toggleButton = document.createElement('button');
    toggleButton.type = 'button';
    toggleButton.className = 'btn btn-outline-secondary btn-sm password-toggle';
    toggleButton.innerHTML = '<svg class="icon" width="16" height="16" fill="currentColor"><use href="#icon-eye"></use></svg>';
    
    const inputGroup = document.createElement('div');
    inputGroup.className = 'input-group';
    input.parentNode.insertBefore(inputGroup, input);
    inputGroup.appendChild(input);
    inputGroup.appendChild(toggleButton);

    // Password strength calculation
    input.addEventListener('input', () => {
      this.updatePasswordStrength(input, strengthIndicator);
    });

    // Toggle password visibility
    toggleButton.addEventListener('click', () => {
      this.togglePasswordVisibility(input, toggleButton);
    });
  }

  enhanceEmailField(input) {
    input.addEventListener('blur', () => {
      if (input.value && !this.isValidEmail(input.value)) {
        this.showFieldError(input, 'Please enter a valid email address');
      }
    });
  }

  enhancePhoneField(input) {
    input.addEventListener('input', () => {
      // Format phone number as user types
      let value = input.value.replace(/\D/g, '');
      if (value.length >= 10) {
        value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
      }
      input.value = value;
    });
  }

  addLoadingStates(form) {
    const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
    if (!submitButton) return;

    form.addEventListener('submit', () => {
      this.setButtonLoading(submitButton, true);
    });
  }

  addAutoSave(form) {
    const autoSaveInterval = form.dataset.autoSave || 30000; // 30 seconds default
    let autoSaveTimer;

    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
      input.addEventListener('input', () => {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
          this.autoSaveForm(form);
        }, autoSaveInterval);
      });
    });
  }

  addCharacterCounter(textarea) {
    const maxLength = parseInt(textarea.getAttribute('maxlength'));
    if (!maxLength) return;

    const container = textarea.closest('.form-group, .mb-3');
    if (!container) return;

    const counter = document.createElement('div');
    counter.className = 'character-counter small text-muted text-end';
    counter.innerHTML = `<span class="current">0</span> / <span class="max">${maxLength}</span>`;
    container.appendChild(counter);

    textarea.addEventListener('input', () => {
      const current = textarea.value.length;
      const currentSpan = counter.querySelector('.current');
      currentSpan.textContent = current;
      
      if (current > maxLength * 0.9) {
        counter.classList.add('text-warning');
      } else {
        counter.classList.remove('text-warning');
      }
    });
  }

  enhanceFileUpload(input) {
    const container = input.closest('.form-group, .mb-3');
    if (!container) return;

    // Create file preview area
    const preview = document.createElement('div');
    preview.className = 'file-preview mt-2';
    container.appendChild(preview);

    input.addEventListener('change', () => {
      this.updateFilePreview(input, preview);
    });
  }

  validateField(field) {
    const value = field.value.trim();
    const type = field.type;
    const required = field.hasAttribute('required');
    const minLength = field.getAttribute('minlength');
    const maxLength = field.getAttribute('maxlength');
    const pattern = field.getAttribute('pattern');

    // Required field validation
    if (required && !value) {
      this.showFieldError(field, 'This field is required');
      return false;
    }

    // Email validation
    if (type === 'email' && value && !this.isValidEmail(value)) {
      this.showFieldError(field, 'Please enter a valid email address');
      return false;
    }

    // Length validation
    if (minLength && value.length < parseInt(minLength)) {
      this.showFieldError(field, `Minimum length is ${minLength} characters`);
      return false;
    }

    if (maxLength && value.length > parseInt(maxLength)) {
      this.showFieldError(field, `Maximum length is ${maxLength} characters`);
      return false;
    }

    // Pattern validation
    if (pattern && value && !new RegExp(pattern).test(value)) {
      this.showFieldError(field, 'Please enter a valid format');
      return false;
    }

    this.clearFieldError(field);
    return true;
  }

  validateForm(form) {
    const fields = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;

    fields.forEach(field => {
      if (!this.validateField(field)) {
        isValid = false;
      }
    });

    return isValid;
  }

  showFieldError(field, message) {
    this.clearFieldError(field);
    
    field.classList.add('is-invalid');
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
  }

  clearFieldError(field) {
    field.classList.remove('is-invalid');
    const errorDiv = field.parentNode.querySelector('.invalid-feedback');
    if (errorDiv) {
      errorDiv.remove();
    }
  }

  showFormErrors(form) {
    const firstInvalidField = form.querySelector('.is-invalid');
    if (firstInvalidField) {
      firstInvalidField.focus();
      firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  }

  updatePasswordStrength(input, indicator) {
    const password = input.value;
    const strength = this.calculatePasswordStrength(password);
    
    const fill = indicator.querySelector('.password-strength-fill');
    const text = indicator.querySelector('.password-strength-text');
    
    fill.style.width = strength.score + '%';
    fill.className = `password-strength-fill bg-${strength.color}`;
    text.textContent = strength.text;
  }

  calculatePasswordStrength(password) {
    let score = 0;
    let feedback = [];

    if (password.length >= 8) score += 20;
    else feedback.push('at least 8 characters');

    if (/[a-z]/.test(password)) score += 20;
    else feedback.push('lowercase letter');

    if (/[A-Z]/.test(password)) score += 20;
    else feedback.push('uppercase letter');

    if (/[0-9]/.test(password)) score += 20;
    else feedback.push('number');

    if (/[^A-Za-z0-9]/.test(password)) score += 20;
    else feedback.push('special character');

    let color, text;
    if (score < 40) {
      color = 'danger';
      text = 'Weak';
    } else if (score < 80) {
      color = 'warning';
      text = 'Medium';
    } else {
      color = 'success';
      text = 'Strong';
    }

    if (feedback.length > 0) {
      text += ` - Need: ${feedback.join(', ')}`;
    }

    return { score, color, text };
  }

  togglePasswordVisibility(input, button) {
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    
    const icon = button.querySelector('svg use');
    icon.setAttribute('href', isPassword ? '#icon-eye-off' : '#icon-eye');
  }

  isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  setButtonLoading(button, loading) {
    if (loading) {
      button.disabled = true;
      button.dataset.originalText = button.textContent;
      button.innerHTML = `
        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
        Processing...
      `;
    } else {
      button.disabled = false;
      button.textContent = button.dataset.originalText || 'Submit';
    }
  }

  autoSaveForm(form) {
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    
    // Save to localStorage
    const formId = form.id || 'auto-save-form';
    localStorage.setItem(`auto-save-${formId}`, JSON.stringify(data));
    
    // Show auto-save indicator
    this.showAutoSaveIndicator();
  }

  showAutoSaveIndicator() {
    // Create or update auto-save indicator
    let indicator = document.querySelector('.auto-save-indicator');
    if (!indicator) {
      indicator = document.createElement('div');
      indicator.className = 'auto-save-indicator position-fixed top-0 end-0 m-3';
      document.body.appendChild(indicator);
    }

    indicator.innerHTML = `
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-check"></use>
        </svg>
        Form auto-saved
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    `;

    // Auto-hide after 3 seconds
    setTimeout(() => {
      if (indicator) {
        indicator.remove();
      }
    }, 3000);
  }

  updateFilePreview(input, preview) {
    preview.innerHTML = '';
    
    if (input.files.length === 0) return;

    Array.from(input.files).forEach((file, index) => {
      const fileItem = document.createElement('div');
      fileItem.className = 'file-item d-flex align-items-center p-2 border rounded mb-2';
      
      const fileIcon = this.getFileIcon(file.type);
      const fileSize = this.formatFileSize(file.size);
      
      fileItem.innerHTML = `
        <div class="me-3">
          <svg class="icon text-muted" width="24" height="24" fill="currentColor">
            <use href="#${fileIcon}"></use>
          </svg>
        </div>
        <div class="flex-grow-1">
          <div class="fw-semibold">${file.name}</div>
          <div class="text-muted small">${fileSize}</div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.file-item').remove()">
          <svg class="icon" width="14" height="14" fill="currentColor">
            <use href="#icon-close"></use>
          </svg>
        </button>
      `;
      
      preview.appendChild(fileItem);
    });
  }

  getFileIcon(mimeType) {
    if (mimeType.startsWith('image/')) return 'icon-image';
    if (mimeType.includes('pdf')) return 'icon-document';
    if (mimeType.includes('word')) return 'icon-document';
    if (mimeType.includes('excel')) return 'icon-document';
    return 'icon-download';
  }

  formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  }

  applyConsistentStyling() {
    // Add consistent classes to form elements
    document.querySelectorAll('input, select, textarea').forEach(element => {
      if (!element.classList.contains('form-control') && !element.classList.contains('form-select')) {
        if (element.tagName === 'SELECT') {
          element.classList.add('form-select');
        } else {
          element.classList.add('form-control');
        }
      }
    });
  }

  enhanceFocusManagement() {
    // Focus first invalid field on form submission
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', (e) => {
        const firstInvalid = form.querySelector('.is-invalid');
        if (firstInvalid) {
          e.preventDefault();
          firstInvalid.focus();
          firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      });
    });
  }

  enhanceKeyboardNavigation() {
    // Tab navigation enhancement
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Tab') {
        // Add focus indicators
        document.querySelectorAll(':focus').forEach(element => {
          element.classList.add('keyboard-focus');
        });
      }
    });

    // Remove focus indicators on mouse interaction
    document.addEventListener('mousedown', () => {
      document.querySelectorAll('.keyboard-focus').forEach(element => {
        element.classList.remove('keyboard-focus');
      });
    });
  }
}

// Initialize enhanced forms system
document.addEventListener('DOMContentLoaded', () => {
  new EnhancedFormsSystem();
});

// Export for global access
window.EnhancedFormsSystem = EnhancedFormsSystem;
