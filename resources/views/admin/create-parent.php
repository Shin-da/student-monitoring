<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">Create Parent Account</h1>
      <p class="text-muted mb-0">Create a parent account linked to a specific student</p>
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

      <form method="post" action="/admin/create-parent">
        <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
        
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
              <label for="name">Parent Full Name</label>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating">
              <input type="email" class="form-control" id="email" name="email" placeholder="parent@example.com" required>
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
              <select class="form-select" id="relationship" name="relationship" required>
                <option value="guardian">Guardian</option>
                <option value="father">Father</option>
                <option value="mother">Mother</option>
              </select>
              <label for="relationship">Relationship to Student</label>
            </div>
          </div>
          
          <div class="col-12">
            <div class="form-floating">
              <select class="form-select" id="student_id" name="student_id" required>
                <option value="">Select Student</option>
                <?php foreach ($students as $student): ?>
                  <option value="<?= $student['id'] ?>">
                    <?= htmlspecialchars($student['name']) ?> 
                    (LRN: <?= htmlspecialchars($student['lrn']) ?>, Grade <?= $student['grade_level'] ?>)
                  </option>
                <?php endforeach; ?>
              </select>
              <label for="student_id">Link to Student</label>
              <div class="form-text">Select the student this parent account will be linked to</div>
            </div>
          </div>
        </div>
        
        <div class="d-flex gap-2 mt-4">
          <button type="submit" class="btn btn-primary">
            <svg width="16" height="16" fill="currentColor">
              <use href="#icon-plus"></use>
            </svg>
            <span class="ms-1">Create Parent Account</span>
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
      <h6 class="fw-bold mb-3">Parent Account Information</h6>
      <div class="row g-3">
        <div class="col-md-6">
          <div class="border rounded-3 p-3">
            <h6 class="fw-semibold mb-2">Access Rights</h6>
            <ul class="small text-muted mb-0">
              <li>View their child's grades and academic progress</li>
              <li>Monitor attendance records</li>
              <li>Receive notifications about their child</li>
              <li>View school announcements and events</li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="border rounded-3 p-3">
            <h6 class="fw-semibold mb-2">Security Features</h6>
            <ul class="small text-muted mb-0">
              <li>Account created and managed by administrators</li>
              <li>Linked to specific student records only</li>
              <li>Cannot access other students' information</li>
              <li>Secure login with email and password</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
