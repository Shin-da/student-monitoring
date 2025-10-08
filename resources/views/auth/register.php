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
      <form method="post" action="<?= \Helpers\Url::to('/register') ?>" class="auth-form">
        <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
        <input type="hidden" name="role" value="student">
        
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
          <label for="name">Full Name</label>
        </div>
        
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
          <label for="email">Email address</label>
        </div>
        
        <div class="form-floating mb-4">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
          <div class="form-text">Must be at least 8 characters long</div>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
          <span>Create account</span>
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


