<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">Create Parent Account</h1>
      <p class="text-muted mb-0">Create a parent account linked to a specific student</p>
    </div>
    <div>
  <a href="<?= \Helpers\Url::to('/admin/users') ?>" class="btn btn-outline-secondary btn-sm">
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

  <form method="post" action="<?= \Helpers\Url::to('/admin/create-parent') ?>" id="createParentForm" novalidate>
        <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
        
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required 
                     pattern="[A-Za-z\s]{2,50}" minlength="2" maxlength="50">
              <label for="name">Parent Full Name</label>
              <div class="invalid-feedback">Please enter a valid name (2-50 characters, letters only)</div>
              <div class="valid-feedback">Name looks good!</div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating">
              <input type="email" class="form-control" id="email" name="email" placeholder="parent@example.com" required>
              <label for="email">Email Address</label>
              <div class="invalid-feedback">Please enter a valid email address</div>
              <div class="valid-feedback">Email looks good!</div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating position-relative">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required 
                     minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$">
              <label for="password">Password</label>
              <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-2" 
                      id="togglePassword" style="z-index: 10; border: none; background: none; color: var(--color-muted);">
                <svg width="16" height="16" fill="currentColor">
                  <use href="#icon-eye"></use>
                </svg>
              </button>
              <div class="form-text">
                <div class="password-requirements">
                  <small class="text-muted">Password must contain:</small>
                  <ul class="list-unstyled small mt-1">
                    <li class="requirement" data-requirement="length">
                      <svg width="12" height="12" fill="currentColor" class="me-1">
                        <use href="#icon-check"></use>
                      </svg>
                      At least 8 characters
                    </li>
                    <li class="requirement" data-requirement="lowercase">
                      <svg width="12" height="12" fill="currentColor" class="me-1">
                        <use href="#icon-check"></use>
                      </svg>
                      One lowercase letter
                    </li>
                    <li class="requirement" data-requirement="uppercase">
                      <svg width="12" height="12" fill="currentColor" class="me-1">
                        <use href="#icon-check"></use>
                      </svg>
                      One uppercase letter
                    </li>
                    <li class="requirement" data-requirement="number">
                      <svg width="12" height="12" fill="currentColor" class="me-1">
                        <use href="#icon-check"></use>
                      </svg>
                      One number
                    </li>
                  </ul>
                </div>
              </div>
              <div class="invalid-feedback">Password must meet all requirements above</div>
              <div class="valid-feedback">Password is strong!</div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating">
              <select class="form-select" id="relationship" name="relationship" required>
                <option value="">Choose relationship...</option>
                <option value="father">Father</option>
                <option value="mother">Mother</option>
                <option value="guardian">Guardian</option>
                <option value="grandparent">Grandparent</option>
                <option value="sibling">Sibling</option>
                <option value="other">Other</option>
              </select>
              <label for="relationship">Relationship to Student</label>
              <div class="invalid-feedback">Please select a relationship</div>
              <div class="valid-feedback">Relationship selected!</div>
            </div>
          </div>
          
          <div class="col-12">
            <div class="form-floating">
              <select class="form-select" id="student_id" name="student_id" required>
                <option value="">Search and select a student...</option>
                <?php foreach ($students as $student): ?>
                  <option value="<?= $student['id'] ?>" 
                          data-lrn="<?= htmlspecialchars($student['lrn']) ?>"
                          data-grade="<?= $student['grade_level'] ?>"
                          data-section="<?= htmlspecialchars($student['section'] ?? 'N/A') ?>">
                    <?= htmlspecialchars($student['name']) ?> 
                    (LRN: <?= htmlspecialchars($student['lrn']) ?>, Grade <?= $student['grade_level'] ?><?= isset($student['section']) ? ' - ' . htmlspecialchars($student['section']) : '' ?>)
                  </option>
                <?php endforeach; ?>
              </select>
              <label for="student_id">Link to Student</label>
              <div class="form-text">
                <div class="student-info d-none" id="selectedStudentInfo">
                  <div class="d-flex align-items-center gap-2">
                    <svg width="16" height="16" fill="currentColor">
                      <use href="#icon-user"></use>
                    </svg>
                    <span class="fw-semibold" id="selectedStudentName">-</span>
                  </div>
                  <div class="text-muted small">
                    LRN: <span id="selectedStudentLRN">-</span> | 
                    Grade: <span id="selectedStudentGrade">-</span> | 
                    Section: <span id="selectedStudentSection">-</span>
                  </div>
                </div>
              </div>
              <div class="invalid-feedback">Please select a student</div>
              <div class="valid-feedback">Student selected!</div>
            </div>
          </div>
        </div>
        
        <div class="d-flex gap-2 mt-4">
          <button type="submit" class="btn btn-primary" id="submitBtn">
            <span class="btn-text">
              <svg width="16" height="16" fill="currentColor">
                <use href="#icon-plus"></use>
              </svg>
              <span class="ms-1">Create Parent Account</span>
            </span>
            <span class="btn-loading d-none">
              <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
              Creating Account...
            </span>
          </button>
          <a href="<?= \Helpers\Url::to('/admin/users') ?>" class="btn btn-outline-secondary">Cancel</a>
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

<script src="<?= \Helpers\Url::asset('create-parent-form.js') ?>"></script>
