<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">Create New User</h1>
      <p class="text-muted mb-0">Add a new user account to the system</p>
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

  <form method="post" action="<?= \Helpers\Url::to('/admin/create-user') ?>" id="createUserForm" novalidate>
        <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::token() ?>">
        
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" 
                     pattern="^[a-zA-Z\s]{2,50}$" minlength="2" maxlength="50" required>
              <label for="name">Full Name</label>
              <div class="invalid-feedback">Please enter a valid name (2-50 characters, letters only).</div>
              <div class="valid-feedback">Looks good!</div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating">
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
              <label for="email">Email Address</label>
              <div class="invalid-feedback">Please enter a valid email address.</div>
              <div class="valid-feedback">Email looks good!</div>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-floating position-relative">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" 
                     pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" 
                     minlength="8" required>
              <label for="password">Password</label>
              <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-3" 
                      id="togglePassword" style="z-index: 10; border: none; background: none;">
                <svg width="16" height="16" fill="currentColor" id="passwordIcon">
                  <use href="#icon-eye"></use>
                </svg>
              </button>
              <div class="form-text">
                <div class="password-requirements">
                  <div class="requirement" data-requirement="length">
                    <svg width="12" height="12" fill="currentColor" class="me-1">
                      <use href="#icon-check"></use>
                    </svg>
                    At least 8 characters
                  </div>
                  <div class="requirement" data-requirement="lowercase">
                    <svg width="12" height="12" fill="currentColor" class="me-1">
                      <use href="#icon-check"></use>
                    </svg>
                    One lowercase letter
                  </div>
                  <div class="requirement" data-requirement="uppercase">
                    <svg width="12" height="12" fill="currentColor" class="me-1">
                      <use href="#icon-check"></use>
                    </svg>
                    One uppercase letter
                  </div>
                  <div class="requirement" data-requirement="number">
                    <svg width="12" height="12" fill="currentColor" class="me-1">
                      <use href="#icon-check"></use>
                    </svg>
                    One number
                  </div>
                  <div class="requirement" data-requirement="special">
                    <svg width="12" height="12" fill="currentColor" class="me-1">
                      <use href="#icon-check"></use>
                    </svg>
                    One special character
                  </div>
                </div>
              </div>
              <div class="invalid-feedback">Password must meet all requirements above.</div>
              <div class="valid-feedback">Strong password!</div>
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
              <div class="invalid-feedback">Please select a user role.</div>
              <div class="valid-feedback">Role selected!</div>
            </div>
          </div>

          <!-- Role-specific fields -->
          <div class="col-12" id="roleSpecificFields" style="display: none;">
            <div class="border rounded-3 p-3 bg-light">
              <h6 class="fw-semibold mb-3">Role-Specific Information</h6>
              <div id="roleFieldsContent">
                <!-- Dynamic content based on role selection -->
              </div>
            </div>
          </div>
          
          <div class="col-md-6">
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

          <div class="col-md-6">
            <div class="form-floating">
              <input type="date" class="form-control" id="expiryDate" name="expiry_date">
              <label for="expiryDate">Account Expiry (Optional)</label>
              <div class="form-text">Leave empty for no expiry date.</div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-floating">
              <textarea class="form-control" id="notes" name="notes" placeholder="Additional notes..." 
                        style="height: 100px" maxlength="500"></textarea>
              <label for="notes">Notes (Optional)</label>
              <div class="form-text">
                <span id="notesCount">0</span>/500 characters
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex gap-2 mt-4">
          <button type="submit" class="btn btn-primary" id="submitBtn">
            <span class="btn-text">
              <svg width="16" height="16" fill="currentColor">
                <use href="#icon-plus"></use>
              </svg>
              <span class="ms-1">Create User</span>
            </span>
            <span class="btn-loading" style="display: none;">
              <span class="spinner-border spinner-border-sm me-2" role="status"></span>
              Creating User...
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

<script>
// Enhanced Create User Form JavaScript
class CreateUserForm {
  constructor() {
    this.form = document.getElementById('createUserForm');
    this.passwordField = document.getElementById('password');
    this.roleField = document.getElementById('role');
    this.roleSpecificFields = document.getElementById('roleSpecificFields');
    this.roleFieldsContent = document.getElementById('roleFieldsContent');
    this.notesField = document.getElementById('notes');
    this.notesCount = document.getElementById('notesCount');
    this.submitBtn = document.getElementById('submitBtn');
    this.togglePasswordBtn = document.getElementById('togglePassword');
    this.passwordIcon = document.getElementById('passwordIcon');
    
    this.init();
  }

  init() {
    this.bindEvents();
    this.setupPasswordValidation();
    this.setupRoleSpecificFields();
    this.setupNotesCounter();
  }

  bindEvents() {
    // Form submission
    this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    
    // Real-time validation
    this.form.addEventListener('input', (e) => this.validateField(e.target));
    
    // Password toggle
    this.togglePasswordBtn.addEventListener('click', () => this.togglePassword());
    
    // Role change
    this.roleField.addEventListener('change', () => this.handleRoleChange());
    
    // Notes counter
    this.notesField.addEventListener('input', () => this.updateNotesCount());
  }

  setupPasswordValidation() {
    this.passwordField.addEventListener('input', () => {
      this.validatePassword();
    });
  }

  validatePassword() {
    const password = this.passwordField.value;
    const requirements = {
      length: password.length >= 8,
      lowercase: /[a-z]/.test(password),
      uppercase: /[A-Z]/.test(password),
      number: /\d/.test(password),
      special: /[@$!%*?&]/.test(password)
    };

    // Update requirement indicators
    Object.keys(requirements).forEach(requirement => {
      const element = document.querySelector(`[data-requirement="${requirement}"]`);
      const icon = element.querySelector('svg use');
      
      if (requirements[requirement]) {
        element.classList.add('text-success');
        element.classList.remove('text-muted');
        icon.setAttribute('href', '#icon-check');
      } else {
        element.classList.add('text-muted');
        element.classList.remove('text-success');
        icon.setAttribute('href', '#icon-x');
      }
    });

    // Validate field
    this.validateField(this.passwordField);
  }

  setupRoleSpecificFields() {
    this.roleSpecificFields.style.display = 'none';
  }

  handleRoleChange() {
    const role = this.roleField.value;
    
    if (role) {
      this.roleSpecificFields.style.display = 'block';
      this.roleFieldsContent.innerHTML = this.getRoleSpecificFields(role);
    } else {
      this.roleSpecificFields.style.display = 'none';
    }
  }

  getRoleSpecificFields(role) {
    const fields = {
      'student': `
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="student_id" name="student_id" placeholder="2024-001">
              <label for="student_id">Student ID</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <select class="form-select" id="grade_level" name="grade_level">
                <option value="">Select Grade Level</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
                <option value="11">Grade 11</option>
                <option value="12">Grade 12</option>
              </select>
              <label for="grade_level">Grade Level</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="section" name="section" placeholder="Section A">
              <label for="section">Section</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="date" class="form-control" id="birth_date" name="birth_date">
              <label for="birth_date">Birth Date</label>
            </div>
          </div>
        </div>
      `,
      'teacher': `
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="EMP-001">
              <label for="employee_id">Employee ID</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <select class="form-select" id="department" name="department">
                <option value="">Select Department</option>
                <option value="math">Mathematics</option>
                <option value="science">Science</option>
                <option value="english">English</option>
                <option value="filipino">Filipino</option>
                <option value="history">History</option>
                <option value="pe">Physical Education</option>
                <option value="arts">Arts</option>
              </select>
              <label for="department">Department</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="subject_specialization" name="subject_specialization" placeholder="Algebra, Geometry">
              <label for="subject_specialization">Subject Specialization</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="date" class="form-control" id="hire_date" name="hire_date">
              <label for="hire_date">Hire Date</label>
            </div>
          </div>
        </div>
      `,
      'parent': `
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="phone" name="phone" placeholder="+63 912 345 6789">
              <label for="phone">Phone Number</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Engineer">
              <label for="occupation">Occupation</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="workplace" name="workplace" placeholder="ABC Company">
              <label for="workplace">Workplace</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="relationship" name="relationship" placeholder="Father">
              <label for="relationship">Relationship to Student</label>
            </div>
          </div>
        </div>
      `,
      'admin': `
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="admin_level" name="admin_level" placeholder="Super Admin">
              <label for="admin_level">Admin Level</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <select class="form-select" id="permissions" name="permissions">
                <option value="full">Full Access</option>
                <option value="limited">Limited Access</option>
                <option value="readonly">Read Only</option>
              </select>
              <label for="permissions">Permissions</label>
            </div>
          </div>
        </div>
      `,
      'adviser': `
        <div class="row g-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="EMP-001">
              <label for="employee_id">Employee ID</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="advisory_class" name="advisory_class" placeholder="Grade 10-A">
              <label for="advisory_class">Advisory Class</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <select class="form-select" id="department" name="department">
                <option value="">Select Department</option>
                <option value="math">Mathematics</option>
                <option value="science">Science</option>
                <option value="english">English</option>
                <option value="filipino">Filipino</option>
                <option value="history">History</option>
              </select>
              <label for="department">Department</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="date" class="form-control" id="hire_date" name="hire_date">
              <label for="hire_date">Hire Date</label>
            </div>
          </div>
        </div>
      `
    };

    return fields[role] || '';
  }

  setupNotesCounter() {
    this.updateNotesCount();
  }

  updateNotesCount() {
    const count = this.notesField.value.length;
    this.notesCount.textContent = count;
    
    if (count > 450) {
      this.notesCount.classList.add('text-warning');
    } else if (count > 480) {
      this.notesCount.classList.add('text-danger');
    } else {
      this.notesCount.classList.remove('text-warning', 'text-danger');
    }
  }

  togglePassword() {
    const type = this.passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    this.passwordField.setAttribute('type', type);
    
    const icon = this.passwordIcon.querySelector('use');
    icon.setAttribute('href', type === 'password' ? '#icon-eye' : '#icon-eye-off');
  }

  validateField(field) {
    const isValid = field.checkValidity();
    
    if (field.value.trim() !== '') {
      field.classList.remove('is-invalid');
      if (isValid) {
        field.classList.add('is-valid');
      } else {
        field.classList.add('is-invalid');
      }
    } else {
      field.classList.remove('is-valid', 'is-invalid');
    }
  }

  handleSubmit(e) {
    e.preventDefault();
    
    // Validate all fields
    const inputs = this.form.querySelectorAll('input[required], select[required]');
    let isValid = true;
    
    inputs.forEach(input => {
      this.validateField(input);
      if (!input.checkValidity()) {
        isValid = false;
      }
    });

    // Special password validation
    this.validatePassword();
    const passwordValid = this.passwordField.checkValidity();
    if (!passwordValid) {
      isValid = false;
    }

    if (isValid) {
      this.submitForm();
    } else {
      this.showNotification('Please fix the errors before submitting.', 'error');
    }
  }

  submitForm() {
    // Show loading state
    this.submitBtn.disabled = true;
    this.submitBtn.querySelector('.btn-text').style.display = 'none';
    this.submitBtn.querySelector('.btn-loading').style.display = 'inline-flex';

    // Simulate form submission (replace with actual API call)
    setTimeout(() => {
      this.showNotification('User created successfully!', 'success');
      
      // Reset form
      this.form.reset();
      this.roleSpecificFields.style.display = 'none';
      this.updateNotesCount();
      
      // Reset button state
      this.submitBtn.disabled = false;
      this.submitBtn.querySelector('.btn-text').style.display = 'inline-flex';
      this.submitBtn.querySelector('.btn-loading').style.display = 'none';
      
      // Clear validation states
      this.form.querySelectorAll('.is-valid, .is-invalid').forEach(field => {
        field.classList.remove('is-valid', 'is-invalid');
      });
      
    }, 2000);
  }

  showNotification(message, type) {
    // Use the notification system we created earlier
    if (typeof Notification !== 'undefined') {
      new Notification(message, { type });
    } else {
      alert(message);
    }
  }
}

// Initialize the form when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new CreateUserForm();
});
</script>

<style>
.password-requirements {
  font-size: 0.875rem;
}

.password-requirements .requirement {
  display: flex;
  align-items: center;
  margin-bottom: 0.25rem;
  transition: color 0.2s ease;
}

.password-requirements .requirement.text-success {
  color: var(--bs-success) !important;
}

.password-requirements .requirement.text-muted {
  color: var(--bs-secondary) !important;
}

.password-requirements .requirement svg {
  transition: fill 0.2s ease;
}

#notesCount {
  font-weight: 500;
}

#notesCount.text-warning {
  color: var(--bs-warning) !important;
}

#notesCount.text-danger {
  color: var(--bs-danger) !important;
}

.role-specific-fields {
  animation: slideDown 0.3s ease;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
