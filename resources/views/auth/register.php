<div class="row justify-content-center">
  <div class="col-md-5 col-lg-4">
    <div class="auth-card surface p-4 p-md-5">
      <div class="text-center mb-4">
        <div class="auth-icon mb-3">
          <svg width="48" height="48" fill="currentColor">
            <use href="#icon-star"></use>
          </svg>
        </div>
        <h2 class="h4 fw-bold mb-2">Create your account</h2>
        <p class="text-muted small">Join our student monitoring platform</p>
      </div>
      
      <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>
      
      <?php if (isset($success)): ?>
        <div class="alert alert-success" role="alert">
          <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>
      
      <?php if (!isset($success)): ?>
      <form method="post" action="<?= \Helpers\Url::to('/register') ?>" class="auth-form" id="registerForm" novalidate>
        <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
        <input type="hidden" name="role" value="student">
        
        <div class="form-group mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required minlength="2" maxlength="100">
          <div class="form-help">Enter your complete name as it appears on official documents</div>
        </div>
        
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
          <div class="form-help">We'll use this to send you important updates</div>
        </div>
        
        <div class="form-group mb-4">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Create a strong password" required minlength="8">
            <button type="button" class="btn btn-outline-secondary password-toggle" tabindex="-1">
              <svg class="icon" width="16" height="16" fill="currentColor">
                <use href="#icon-eye"></use>
              </svg>
            </button>
          </div>
          <div class="password-strength mt-2">
            <div class="password-strength-bar">
              <div class="password-strength-fill"></div>
            </div>
            <div class="password-strength-text small text-muted"></div>
          </div>
          <div class="form-help">Password must be at least 8 characters with uppercase, lowercase, number, and special character</div>
        </div>
        
        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" id="agreeTerms" required>
          <label class="form-check-label" for="agreeTerms">
            I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
          </label>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 btn-lg mb-3" id="registerBtn">
          <span class="btn-text">Create account</span>
          <span class="btn-loading d-none">
            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
            Creating account...
          </span>
        </button>
      </form>
      <?php endif; ?>
      
      <div class="text-center">
        <p class="text-muted small mb-0">Already have an account? 
          <a href="<?= \Helpers\Url::to('/login') ?>" class="text-decoration-none fw-semibold">Sign in</a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
// Enhanced Register Form
document.addEventListener('DOMContentLoaded', function() {
  const registerForm = document.getElementById('registerForm');
  const registerBtn = document.getElementById('registerBtn');
  const passwordToggle = document.querySelector('.password-toggle');
  const passwordInput = document.getElementById('password');
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const agreeTermsCheckbox = document.getElementById('agreeTerms');

  // Password visibility toggle
  if (passwordToggle && passwordInput) {
    passwordToggle.addEventListener('click', function() {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      
      const icon = passwordToggle.querySelector('svg use');
      icon.setAttribute('href', isPassword ? '#icon-eye-off' : '#icon-eye');
    });
  }

  // Password strength indicator
  if (passwordInput) {
    passwordInput.addEventListener('input', function() {
      updatePasswordStrength(this.value);
    });
  }

  // Form submission with loading state
  if (registerForm) {
    registerForm.addEventListener('submit', function(e) {
      if (!validateForm()) {
        e.preventDefault();
        return;
      }
      
      // Show loading state
      registerBtn.disabled = true;
      registerBtn.querySelector('.btn-text').classList.add('d-none');
      registerBtn.querySelector('.btn-loading').classList.remove('d-none');
      registerBtn.classList.add('loading');
    });
  }

  // Real-time validation
  if (nameInput) {
    nameInput.addEventListener('blur', function() {
      if (this.value && this.value.length < 2) {
        showFieldError(this, 'Name must be at least 2 characters long');
      } else {
        clearFieldError(this);
      }
    });
  }

  if (emailInput) {
    emailInput.addEventListener('blur', function() {
      if (this.value && !isValidEmail(this.value)) {
        showFieldError(this, 'Please enter a valid email address');
      } else {
        clearFieldError(this);
      }
    });
  }

  if (passwordInput) {
    passwordInput.addEventListener('blur', function() {
      if (this.value && this.value.length < 8) {
        showFieldError(this, 'Password must be at least 8 characters long');
      } else {
        clearFieldError(this);
      }
    });
  }

  if (agreeTermsCheckbox) {
    agreeTermsCheckbox.addEventListener('change', function() {
      if (!this.checked) {
        showFieldError(this, 'You must agree to the terms and conditions');
      } else {
        clearFieldError(this);
      }
    });
  }
});

// Password strength calculation
function updatePasswordStrength(password) {
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

  const fill = document.querySelector('.password-strength-fill');
  const textElement = document.querySelector('.password-strength-text');
  
  if (fill && textElement) {
    fill.style.width = score + '%';
    fill.className = `password-strength-fill bg-${color}`;
    textElement.textContent = text;
  }
}

// Form validation
function validateForm() {
  let isValid = true;
  
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const agreeTermsCheckbox = document.getElementById('agreeTerms');

  // Validate name
  if (!nameInput.value || nameInput.value.length < 2) {
    showFieldError(nameInput, 'Name must be at least 2 characters long');
    isValid = false;
  }

  // Validate email
  if (!emailInput.value || !isValidEmail(emailInput.value)) {
    showFieldError(emailInput, 'Please enter a valid email address');
    isValid = false;
  }

  // Validate password
  if (!passwordInput.value || passwordInput.value.length < 8) {
    showFieldError(passwordInput, 'Password must be at least 8 characters long');
    isValid = false;
  }

  // Validate terms agreement
  if (!agreeTermsCheckbox.checked) {
    showFieldError(agreeTermsCheckbox, 'You must agree to the terms and conditions');
    isValid = false;
  }

  return isValid;
}

// Helper functions
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function showFieldError(field, message) {
  clearFieldError(field);
  field.classList.add('is-invalid');
  
  const errorDiv = document.createElement('div');
  errorDiv.className = 'invalid-feedback';
  errorDiv.textContent = message;
  
  field.parentNode.appendChild(errorDiv);
}

function clearFieldError(field) {
  field.classList.remove('is-invalid');
  const errorDiv = field.parentNode.querySelector('.invalid-feedback');
  if (errorDiv) {
    errorDiv.remove();
  }
}
</script>

<style>
/* Enhanced Register Form Styles */
.auth-form .form-group {
  margin-bottom: 1.5rem;
}

.auth-form .form-label {
  font-weight: 500;
  margin-bottom: 0.5rem;
  color: var(--bs-body-color);
}

.auth-form .form-control {
  border-radius: 0.5rem;
  border: 1px solid var(--bs-border-color);
  padding: 0.75rem 1rem;
  transition: all 0.2s ease;
}

.auth-form .form-control:focus {
  border-color: var(--bs-primary);
  box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
  transform: translateY(-1px);
}

.auth-form .input-group .form-control {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.auth-form .input-group .btn {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  border-left: 0;
}

.auth-form .form-check {
  margin-bottom: 1.5rem;
}

.auth-form .form-check-input:checked {
  background-color: var(--bs-primary);
  border-color: var(--bs-primary);
}

.auth-form .btn {
  border-radius: 0.5rem;
  padding: 0.75rem 1.5rem;
  font-weight: 500;
  transition: all 0.2s ease;
}

.auth-form .btn:hover:not(:disabled) {
  transform: translateY(-1px);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.auth-form .btn.loading {
  pointer-events: none;
}

.form-help {
  font-size: 0.875rem;
  color: var(--bs-gray-600);
  margin-top: 0.25rem;
}

.password-strength {
  margin-top: 0.5rem;
}

.password-strength-bar {
  height: 4px;
  background-color: var(--bs-gray-200);
  border-radius: 2px;
  overflow: hidden;
  margin-bottom: 0.25rem;
}

.password-strength-fill {
  height: 100%;
  transition: width 0.3s ease, background-color 0.3s ease;
  border-radius: 2px;
}

.password-strength-fill.bg-danger {
  background-color: var(--bs-danger) !important;
}

.password-strength-fill.bg-warning {
  background-color: var(--bs-warning) !important;
}

.password-strength-fill.bg-success {
  background-color: var(--bs-success) !important;
}

.password-strength-text {
  font-size: 0.75rem;
  line-height: 1.2;
}

.invalid-feedback {
  display: block;
  width: 100%;
  margin-top: 0.25rem;
  font-size: 0.875rem;
  color: var(--bs-danger);
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}
</style>
