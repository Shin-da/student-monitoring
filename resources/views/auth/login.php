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
      
      <form method="post" action="/login" class="auth-form">
        <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
          <label for="email">Email address</label>
        </div>
        
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
          <span>Sign in</span>
        </button>
      </form>
      
      <div class="text-center">
        <p class="text-muted small mb-0">Don't have an account? 
          <a href="/register" class="text-decoration-none fw-semibold">Create one</a>
        </p>
      </div>
    </div>
  </div>
</div>


