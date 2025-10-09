<div class="row justify-content-center">
  <div class="col-md-5 col-lg-4">
    <div class="auth-card surface p-4 p-md-5">
      <div class="text-center mb-4">
        <div class="auth-icon mb-3">
          <svg width="48" height="48" fill="currentColor">
            <use href="#icon-lock"></use>
          </svg>
        </div>
        <h2 class="h4 fw-bold mb-2">Welcome back</h2>
        <p class="text-muted small">Sign in to your account to continue</p>
      </div>
      
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
          <span>⚠️</span>
          <span><?= htmlspecialchars($error) ?></span>
        </div>
      <?php endif; ?>
      
      <form method="post" action="<?= \Helpers\Url::to('/login') ?>" class="auth-form" id="loginForm" novalidate>
        <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
        
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
          <div class="form-help">We'll never share your email with anyone else.</div>
        </div>
        
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            <button type="button" class="btn btn-outline-secondary password-toggle" tabindex="-1">
              <svg class="icon" width="16" height="16" fill="currentColor">
                <use href="#icon-eye"></use>
              </svg>
            </button>
          </div>
        </div>
        
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
          <label class="form-check-label" for="rememberMe">
            Remember me for 30 days
          </label>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 btn-lg mb-3" id="loginBtn">
          <span class="btn-text">Sign in</span>
          <span class="btn-loading d-none">
            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
            Signing in...
          </span>
        </button>
      </form>
      
      <div class="text-center">
        <p class="text-muted small mb-0">Don't have an account? 
          <a href="<?= \Helpers\Url::to('/register') ?>" class="text-decoration-none fw-semibold">Create one</a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
// Enhanced Login Form
document.addEventListener('DOMContentLoaded', function() {
  const loginForm = document.getElementById('loginForm');
  const loginBtn = document.getElementById('loginBtn');
  const passwordToggle = document.querySelector('.password-toggle');
  const passwordInput = document.getElementById('password');

  // Password visibility toggle
  if (passwordToggle && passwordInput) {
    passwordToggle.addEventListener('click', function() {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      
      const icon = passwordToggle.querySelector('svg use');
      icon.setAttribute('href', isPassword ? '#icon-eye-off' : '#icon-eye');
    });
  }

  // Form submission with loading state
  if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
      // Show loading state
      loginBtn.disabled = true;
      loginBtn.querySelector('.btn-text').classList.add('d-none');
      loginBtn.querySelector('.btn-loading').classList.remove('d-none');
      
      // Add loading class to button
      loginBtn.classList.add('loading');
    });
  }

  // Real-time validation
  const emailInput = document.getElementById('email');
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
      if (this.value && this.value.length < 6) {
        showFieldError(this, 'Password must be at least 6 characters long');
      } else {
        clearFieldError(this);
      }
    });
  }
});

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
/* Enhanced Login Form Styles */
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
