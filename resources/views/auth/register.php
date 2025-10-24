<div class="auth-card">
  <div class="text-center mb-4">
    <div class="auth-icon">
      <svg width="40" height="40" fill="currentColor">
        <use href="#icon-star"></use>
      </svg>
    </div>
    <h2 class="h3 fw-bold mb-2 text-dark">Create your account</h2>
    <p class="text-muted">Join our student monitoring platform</p>
  </div>
  
  <?php if (isset($error)): ?>
    <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
      <svg width="20" height="20" fill="currentColor">
        <use href="#icon-alert"></use>
      </svg>
      <span><?= htmlspecialchars($error) ?></span>
    </div>
  <?php endif; ?>
  
  <?php if (isset($success)): ?>
    <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
      <svg width="20" height="20" fill="currentColor">
        <use href="#icon-check"></use>
      </svg>
      <span><?= htmlspecialchars($success) ?></span>
    </div>
  <?php endif; ?>
  
  <?php if (!isset($success)): ?>
  <form method="post" action="<?= \Helpers\Url::to('/register') ?>" class="auth-form" id="registerForm" novalidate>
    <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::generateToken() ?>">
    <input type="hidden" name="role" value="student">
    
    <div class="form-group">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required minlength="2" maxlength="100">
      <div class="form-help">Enter your complete name as it appears on official documents</div>
    </div>
    
    <div class="form-group">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
      <div class="form-help">We'll use this to send you important updates</div>
    </div>
    
    <div class="form-group">
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Create a strong password" required minlength="8">
        <button type="button" class="btn btn-outline-secondary password-toggle" tabindex="-1" aria-label="Toggle password visibility">
          <svg class="icon" width="16" height="16" fill="currentColor">
            <use href="#icon-eye"></use>
          </svg>
        </button>
      </div>
      <div class="password-strength">
        <div class="password-strength-bar">
          <div class="password-strength-fill"></div>
        </div>
        <div class="password-strength-text"></div>
      </div>
      <div class="form-help">Password must be at least 8 characters with uppercase, lowercase, number, and special character</div>
    </div>
    
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="agreeTerms" required>
      <label class="form-check-label" for="agreeTerms">
        I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
      </label>
    </div>
    
    <button type="submit" class="btn btn-primary w-100" id="registerBtn">
      <span class="btn-text">Create Account</span>
      <span class="btn-loading d-none">
        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
        Creating account...
      </span>
    </button>
  </form>
  <?php endif; ?>
  
  <div class="auth-links">
    <p class="text-muted mb-0">Already have an account? 
      <a href="<?= \Helpers\Url::to('/login') ?>">Sign in</a>
    </p>
  </div>
</div>

<script>
// Enhanced Register Form with Modern UX
document.addEventListener('DOMContentLoaded', function() {
  const registerForm = document.getElementById('registerForm');
  const registerBtn = document.getElementById('registerBtn');
  const passwordToggle = document.querySelector('.password-toggle');
  const passwordInput = document.getElementById('password');
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const agreeTermsCheckbox = document.getElementById('agreeTerms');

  // Password visibility toggle with smooth animation
  if (passwordToggle && passwordInput) {
    passwordToggle.addEventListener('click', function(e) {
      e.preventDefault();
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      
      const icon = passwordToggle.querySelector('svg use');
      icon.setAttribute('href', isPassword ? '#icon-eye-off' : '#icon-eye');
      
      // Add visual feedback
      passwordToggle.style.transform = 'scale(0.95)';
      setTimeout(() => {
        passwordToggle.style.transform = 'scale(1)';
      }, 150);
    });
  }

  // Enhanced password strength indicator
  if (passwordInput) {
    passwordInput.addEventListener('input', function() {
      updatePasswordStrength(this.value);
      clearFieldError(this);
      if (this.value && this.value.length < 8) {
        showFieldError(this, 'Password must be at least 8 characters long');
      } else if (this.value && this.value.length >= 8) {
        showFieldSuccess(this, 'Password looks good!');
      }
    });
  }

  // Enhanced form submission with better UX
  if (registerForm) {
    registerForm.addEventListener('submit', function(e) {
      if (!validateForm()) {
        e.preventDefault();
        return;
      }
      
      // Show loading state with animation
      registerBtn.disabled = true;
      registerBtn.querySelector('.btn-text').classList.add('d-none');
      registerBtn.querySelector('.btn-loading').classList.remove('d-none');
      registerBtn.classList.add('loading');
      
      // Add success animation after a delay (simulate processing)
      setTimeout(() => {
        if (registerBtn.classList.contains('loading')) {
          registerBtn.style.background = 'linear-gradient(135deg, #2ecc71, #27ae60)';
          registerBtn.querySelector('.btn-loading').innerHTML = 
            '<svg class="icon me-2" width="16" height="16" fill="currentColor"><use href="#icon-check"></use></svg>Account created!';
        }
      }, 1500);
    });
  }

  // Real-time validation with better feedback
  if (nameInput) {
    nameInput.addEventListener('input', function() {
      clearFieldError(this);
      if (this.value && this.value.length < 2) {
        showFieldError(this, 'Name must be at least 2 characters long');
      }
    });
    
    nameInput.addEventListener('blur', function() {
      if (this.value && this.value.length < 2) {
        showFieldError(this, 'Name must be at least 2 characters long');
      } else if (this.value && this.value.length >= 2) {
        showFieldSuccess(this, 'Name looks good!');
      }
    });
  }

  if (emailInput) {
    emailInput.addEventListener('input', function() {
      clearFieldError(this);
      if (this.value && !isValidEmail(this.value)) {
        showFieldError(this, 'Please enter a valid email address');
      }
    });
    
    emailInput.addEventListener('blur', function() {
      if (this.value && !isValidEmail(this.value)) {
        showFieldError(this, 'Please enter a valid email address');
      } else if (this.value && isValidEmail(this.value)) {
        showFieldSuccess(this, 'Email looks good!');
      }
    });
  }

  if (agreeTermsCheckbox) {
    agreeTermsCheckbox.addEventListener('change', function() {
      clearFieldError(this);
      if (!this.checked) {
        showFieldError(this, 'You must agree to the terms and conditions');
      } else {
        showFieldSuccess(this, 'Terms accepted!');
      }
    });
  }

  // Add focus animations
  const inputs = document.querySelectorAll('.form-control');
  inputs.forEach(input => {
    input.addEventListener('focus', function() {
      this.parentNode.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
      this.parentNode.classList.remove('focused');
    });
  });
});

// Enhanced password strength calculation
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
    textElement.className = `password-strength-text text-${color}`;
  }
}

// Enhanced form validation
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
  
  // Add shake animation
  field.style.animation = 'shake 0.5s ease-in-out';
  setTimeout(() => {
    field.style.animation = '';
  }, 500);
}

function showFieldSuccess(field, message) {
  clearFieldError(field);
  field.classList.add('is-valid');
  
  // Check if success message already exists
  const existingSuccess = field.parentNode.querySelector('.valid-feedback');
  if (existingSuccess) {
    existingSuccess.textContent = message;
    return;
  }
  
  const successDiv = document.createElement('div');
  successDiv.className = 'valid-feedback';
  successDiv.textContent = message;
  
  field.parentNode.appendChild(successDiv);
  
  // Remove success message after 3 seconds
  setTimeout(() => {
    if (successDiv.parentNode) {
      successDiv.remove();
    }
  }, 3000);
}

function clearFieldError(field) {
  field.classList.remove('is-invalid', 'is-valid');
  
  // Remove all feedback messages
  const errorDiv = field.parentNode.querySelector('.invalid-feedback');
  const successDiv = field.parentNode.querySelector('.valid-feedback');
  
  if (errorDiv) errorDiv.remove();
  if (successDiv) successDiv.remove();
  
  // Also check for any existing feedback in the form group
  const formGroup = field.closest('.form-group');
  if (formGroup) {
    const existingError = formGroup.querySelector('.invalid-feedback');
    const existingSuccess = formGroup.querySelector('.valid-feedback');
    if (existingError) existingError.remove();
    if (existingSuccess) existingSuccess.remove();
  }
}
</script>

