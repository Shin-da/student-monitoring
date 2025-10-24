<div class="auth-card">
  <div class="text-center mb-4">
    <div class="auth-icon">
      <svg width="40" height="40" fill="currentColor">
        <use href="#icon-lock"></use>
      </svg>
    </div>
    <h2 class="h3 fw-bold mb-2 text-dark">Welcome back</h2>
    <p class="text-muted">Sign in to your account to continue</p>
  </div>
  
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
      <svg width="20" height="20" fill="currentColor">
        <use href="#icon-alert"></use>
      </svg>
      <span><?= htmlspecialchars($error) ?></span>
    </div>
  <?php endif; ?>
  
  <form method="post" action="<?= \Helpers\Url::to('/login') ?>" class="auth-form" id="loginForm" novalidate>
    <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::generateToken() ?>">
    
    <div class="form-group">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
      <div class="form-help">We'll never share your email with anyone else</div>
    </div>
    
    <div class="form-group">
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        <button type="button" class="btn btn-outline-secondary password-toggle" tabindex="-1" aria-label="Toggle password visibility">
          <svg class="icon" width="16" height="16" fill="currentColor">
            <use href="#icon-eye"></use>
          </svg>
        </button>
      </div>
    </div>
    
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
      <label class="form-check-label" for="rememberMe">
        Remember me for 30 days
      </label>
    </div>
    
    <button type="submit" class="btn btn-primary w-100" id="loginBtn">
      <span class="btn-text">Sign In</span>
      <span class="btn-loading d-none">
        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
        Signing in...
      </span>
    </button>
  </form>
  
  <div class="auth-links">
    <p class="text-muted mb-0">Don't have an account? 
      <a href="<?= \Helpers\Url::to('/register') ?>">Create one</a>
    </p>
  </div>
</div>

<script>
// Enhanced Login Form with Modern UX
document.addEventListener('DOMContentLoaded', function() {
  const loginForm = document.getElementById('loginForm');
  const loginBtn = document.getElementById('loginBtn');
  const passwordToggle = document.querySelector('.password-toggle');
  const passwordInput = document.getElementById('password');
  const emailInput = document.getElementById('email');

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

  // Enhanced form submission with better UX
  if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
      // Validate form before submission
      if (!validateForm()) {
        e.preventDefault();
        return;
      }
      
      // Show loading state with animation
      loginBtn.disabled = true;
      loginBtn.querySelector('.btn-text').classList.add('d-none');
      loginBtn.querySelector('.btn-loading').classList.remove('d-none');
      loginBtn.classList.add('loading');
      
      // Add success animation after a delay (simulate processing)
      setTimeout(() => {
        if (loginBtn.classList.contains('loading')) {
          loginBtn.style.background = 'linear-gradient(135deg, #2ecc71, #27ae60)';
          loginBtn.querySelector('.btn-loading').innerHTML = 
            '<svg class="icon me-2" width="16" height="16" fill="currentColor"><use href="#icon-check"></use></svg>Success!';
        }
      }, 1000);
    });
  }

  // Real-time validation with better feedback
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
      } else if (this.value) {
        showFieldSuccess(this, 'Email looks good!');
      }
    });
  }

  if (passwordInput) {
    passwordInput.addEventListener('input', function() {
      clearFieldError(this);
      if (this.value && this.value.length < 6) {
        showFieldError(this, 'Password must be at least 6 characters long');
      } else if (this.value && this.value.length >= 6) {
        showFieldSuccess(this, 'Password looks good!');
      }
    });
    
    passwordInput.addEventListener('blur', function() {
      if (this.value && this.value.length < 6) {
        showFieldError(this, 'Password must be at least 6 characters long');
      } else if (this.value && this.value.length >= 6) {
        showFieldSuccess(this, 'Password looks good!');
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

// Enhanced validation functions
function validateForm() {
  let isValid = true;
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');

  // Validate email
  if (!emailInput.value || !isValidEmail(emailInput.value)) {
    showFieldError(emailInput, 'Please enter a valid email address');
    isValid = false;
  }

  // Validate password
  if (!passwordInput.value || passwordInput.value.length < 6) {
    showFieldError(passwordInput, 'Password must be at least 6 characters long');
    isValid = false;
  }

  return isValid;
}

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

