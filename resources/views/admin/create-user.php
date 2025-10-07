<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">Create New User</h1>
      <p class="text-muted mb-0">Add a new user account to the system</p>
    </div>
    <div>
      <a href="/admin/users" class="btn btn-outline-secondary btn-sm">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-arrow-left"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Back to Users</span>
      </a>
    </div>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <div class="surface p-4">
      <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="post" action="/admin/create-user">
        <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
        
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
              <label for="name">Full Name</label>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating">
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
              <label for="email">Email Address</label>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              <label for="password">Password</label>
              <div class="form-text">Must be at least 8 characters long</div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating">
              <select class="form-select" id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="teacher">Teacher</option>
                <option value="adviser">Adviser</option>
                <option value="student">Student</option>
                <option value="parent">Parent</option>
              </select>
              <label for="role">User Role</label>
            </div>
          </div>
          
          <div class="col-12">
            <div class="form-floating">
              <select class="form-select" id="status" name="status">
                <option value="active">Active</option>
                <option value="pending">Pending</option>
                <option value="suspended">Suspended</option>
              </select>
              <label for="status">Account Status</label>
              <div class="form-text">Active users can log in immediately. Pending users need approval.</div>
            </div>
          </div>
        </div>
        
        <div class="d-flex gap-2 mt-4">
          <button type="submit" class="btn btn-primary">
            <svg width="16" height="16" fill="currentColor">
              <use href="#icon-plus"></use>
            </svg>
            <span class="ms-1">Create User</span>
          </button>
          <a href="/admin/users" class="btn btn-outline-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row mt-5">
  <div class="col-12">
    <div class="surface p-4">
      <h6 class="fw-bold mb-3">Role Descriptions</h6>
      <div class="row g-3">
        <div class="col-md-6 col-lg-4">
          <div class="border rounded-3 p-3">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-danger-subtle text-danger">Admin</span>
            </div>
            <p class="small text-muted mb-0">Full system access, user management, and administrative controls.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="border rounded-3 p-3">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-success-subtle text-success">Teacher</span>
            </div>
            <p class="small text-muted mb-0">Can manage grades, attendance, and student records for assigned classes.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="border rounded-3 p-3">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-info-subtle text-info">Adviser</span>
            </div>
            <p class="small text-muted mb-0">Class adviser with additional responsibilities for student guidance.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="border rounded-3 p-3">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-primary-subtle text-primary">Student</span>
            </div>
            <p class="small text-muted mb-0">Can view their own grades, attendance, and academic progress.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="border rounded-3 p-3">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-warning-subtle text-warning">Parent</span>
            </div>
            <p class="small text-muted mb-0">Can view their child's academic progress and school activities.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
