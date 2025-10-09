<?php
$title = 'My Profile';
?>

<!-- Student Profile Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">My Profile</h1>
      <p class="text-muted mb-0">Manage your personal information and account settings</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" onclick="editProfile()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-edit"></use>
        </svg>
        Edit Profile
      </button>
      <button class="btn btn-primary" onclick="saveProfile()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-check"></use>
        </svg>
        Save Changes
      </button>
    </div>
  </div>
</div>

<!-- Profile Overview -->
<div class="row g-4 mb-4">
  <div class="col-lg-4">
    <div class="surface">
      <div class="text-center">
        <div class="position-relative d-inline-block mb-3">
          <div class="bg-primary bg-opacity-10 rounded-circle p-4" style="width: 120px; height: 120px;">
            <svg class="icon text-primary" width="48" height="48" fill="currentColor">
              <use href="#icon-user"></use>
            </svg>
          </div>
          <button class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle" style="width: 32px; height: 32px;" onclick="changeProfilePicture()">
            <svg class="icon" width="16" height="16" fill="currentColor">
              <use href="#icon-camera"></use>
            </svg>
          </button>
        </div>
        <h5 class="mb-1"><?= htmlspecialchars($user['name'] ?? 'Student Name') ?></h5>
        <p class="text-muted mb-2">Grade 10 - Section A</p>
        <div class="d-flex justify-content-center gap-2 mb-3">
          <span class="badge bg-primary">Student</span>
          <span class="badge bg-success">Active</span>
        </div>
        <div class="d-grid gap-2">
          <button class="btn btn-outline-primary btn-sm" onclick="viewAcademicRecord()">
            <svg class="icon me-1" width="14" height="14" fill="currentColor">
              <use href="#icon-chart"></use>
            </svg>
            Academic Record
          </button>
          <button class="btn btn-outline-secondary btn-sm" onclick="viewAttendance()">
            <svg class="icon me-1" width="14" height="14" fill="currentColor">
              <use href="#icon-calendar"></use>
            </svg>
            Attendance
          </button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-8">
    <div class="surface">
      <h5 class="mb-4">Personal Information</h5>
      <form id="profileForm">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user['name'] ?? '') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" value="Doe" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($user['email'] ?? '') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Phone Number</label>
            <input type="tel" class="form-control" value="+1 (555) 123-4567" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Date of Birth</label>
            <input type="date" class="form-control" value="2008-05-15" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select class="form-select" readonly>
              <option value="male" selected>Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label">Address</label>
            <textarea class="form-control" rows="2" readonly>123 Main Street, City, State 12345</textarea>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Academic Information -->
<div class="row g-4 mb-4">
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Academic Information</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Student ID (LRN)</label>
          <input type="text" class="form-control" value="123456789012" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Grade Level</label>
          <input type="text" class="form-control" value="Grade 10" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Section</label>
          <input type="text" class="form-control" value="Section A" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">School Year</label>
          <input type="text" class="form-control" value="2024-2025" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Adviser</label>
          <input type="text" class="form-control" value="Ms. Johnson" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Enrollment Date</label>
          <input type="date" class="form-control" value="2024-06-15" readonly>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Emergency Contact</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Contact Name</label>
          <input type="text" class="form-control" value="John Doe" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Relationship</label>
          <input type="text" class="form-control" value="Father" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone Number</label>
          <input type="tel" class="form-control" value="+1 (555) 987-6543" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" value="john.doe@email.com" readonly>
        </div>
        <div class="col-12">
          <label class="form-label">Address</label>
          <textarea class="form-control" rows="2" readonly>123 Main Street, City, State 12345</textarea>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Academic Performance Summary -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface">
      <h5 class="mb-4">Academic Performance</h5>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-primary mb-1" data-count-to="87.5" data-count-decimals="1">0</div>
            <div class="text-muted small">Overall Average</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-primary" data-progress-to="87.5" style="width: 0%"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-success mb-1" data-count-to="8">0</div>
            <div class="text-muted small">Passing Subjects</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-success" data-progress-to="80" style="width: 0%"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-info mb-1">+<span data-count-to="3.2" data-count-decimals="1">0</span>%</div>
            <div class="text-muted small">Improvement</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-info" data-progress-to="60" style="width: 0%"></div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="mt-4">
        <h6>Subject Performance</h6>
        <div class="row g-2">
          <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center p-2 border rounded">
              <span>Mathematics</span>
              <div class="d-flex align-items-center">
                <span class="fw-semibold text-success me-2">87.5</span>
                <div class="progress" style="width: 60px; height: 6px;">
                  <div class="progress-bar bg-success" style="width: 87.5%"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center p-2 border rounded">
              <span>Science</span>
              <div class="d-flex align-items-center">
                <span class="fw-semibold text-success me-2">92.3</span>
                <div class="progress" style="width: 60px; height: 6px;">
                  <div class="progress-bar bg-success" style="width: 92.3%"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center p-2 border rounded">
              <span>English</span>
              <div class="d-flex align-items-center">
                <span class="fw-semibold text-warning me-2">75.8</span>
                <div class="progress" style="width: 60px; height: 6px;">
                  <div class="progress-bar bg-warning" style="width: 75.8%"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center p-2 border rounded">
              <span>Filipino</span>
              <div class="d-flex align-items-center">
                <span class="fw-semibold text-success me-2">88.2</span>
                <div class="progress" style="width: 60px; height: 6px;">
                  <div class="progress-bar bg-success" style="width: 88.2%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface">
      <h5 class="mb-4">Quick Actions</h5>
      <div class="d-grid gap-2">
        <button class="btn btn-outline-primary" onclick="viewGrades()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          View Grades
        </button>
        <button class="btn btn-outline-success" onclick="viewAssignments()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-plus"></use>
          </svg>
          View Assignments
        </button>
        <button class="btn btn-outline-info" onclick="viewAttendance()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-calendar"></use>
          </svg>
          View Attendance
        </button>
        <button class="btn btn-outline-warning" onclick="viewAlerts()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
          View Alerts
        </button>
        <button class="btn btn-outline-secondary" onclick="changePassword()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-settings"></use>
          </svg>
          Change Password
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Account Settings -->
<div class="surface">
  <h5 class="mb-4">Account Settings</h5>
  <div class="row g-4">
    <div class="col-md-6">
      <h6>Security Settings</h6>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <div class="fw-semibold">Two-Factor Authentication</div>
          <div class="text-muted small">Add an extra layer of security</div>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="twoFactorAuth">
          <label class="form-check-label" for="twoFactorAuth"></label>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <div class="fw-semibold">Email Notifications</div>
          <div class="text-muted small">Receive notifications via email</div>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
          <label class="form-check-label" for="emailNotifications"></label>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="fw-semibold">SMS Notifications</div>
          <div class="text-muted small">Receive notifications via SMS</div>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="smsNotifications">
          <label class="form-check-label" for="smsNotifications"></label>
        </div>
      </div>
    </div>
    
    <div class="col-md-6">
      <h6>Privacy Settings</h6>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <div class="fw-semibold">Profile Visibility</div>
          <div class="text-muted small">Make profile visible to teachers</div>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="profileVisibility" checked>
          <label class="form-check-label" for="profileVisibility"></label>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <div class="fw-semibold">Grade Sharing</div>
          <div class="text-muted small">Allow parents to view grades</div>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="gradeSharing" checked>
          <label class="form-check-label" for="gradeSharing"></label>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="fw-semibold">Activity Tracking</div>
          <div class="text-muted small">Track login and activity</div>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="activityTracking" checked>
          <label class="form-check-label" for="activityTracking"></label>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="changePasswordForm">
          <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" minlength="8" required>
            <div class="form-text">Password must be at least 8 characters long</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" minlength="8" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="updatePassword()">Update Password</button>
      </div>
    </div>
  </div>
</div>

<!-- Change Profile Picture Modal -->
<div class="modal fade" id="changeProfilePictureModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="changeProfilePictureForm">
          <div class="text-center mb-3">
            <div class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block">
              <svg class="icon text-primary" width="48" height="48" fill="currentColor">
                <use href="#icon-user"></use>
              </svg>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Upload New Picture</label>
            <input type="file" class="form-control" accept="image/*" required>
            <div class="form-text">Supported formats: JPG, PNG, GIF (Max 2MB)</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="updateProfilePicture()">Update Picture</button>
      </div>
    </div>
  </div>
</div>

<script>
// Student Profile Management
class StudentProfile {
  constructor() {
    this.isEditing = false;
    this.init();
  }

  init() {
    this.bindEvents();
  }

  bindEvents() {
    // Form switches
    document.querySelectorAll('.form-check-input').forEach(switchEl => {
      switchEl.addEventListener('change', (e) => {
        this.updateSetting(e.target.id, e.target.checked);
      });
    });
  }

  updateSetting(settingId, value) {
    // Simulate saving setting
    showNotification(`${settingId} updated successfully!`, { type: 'success' });
  }

  toggleEditMode() {
    this.isEditing = !this.isEditing;
    const formInputs = document.querySelectorAll('#profileForm input, #profileForm select, #profileForm textarea');
    
    formInputs.forEach(input => {
      input.readOnly = !this.isEditing;
      if (this.isEditing) {
        input.classList.remove('form-control-plaintext');
        input.classList.add('form-control');
      } else {
        input.classList.remove('form-control');
        input.classList.add('form-control-plaintext');
      }
    });

    const editBtn = document.querySelector('button[onclick="editProfile()"]');
    const saveBtn = document.querySelector('button[onclick="saveProfile()"]');
    
    if (this.isEditing) {
      editBtn.style.display = 'none';
      saveBtn.style.display = 'inline-block';
    } else {
      editBtn.style.display = 'inline-block';
      saveBtn.style.display = 'none';
    }
  }
}

// Global functions
function editProfile() {
  if (window.studentProfileInstance) {
    window.studentProfileInstance.toggleEditMode();
  }
}

function saveProfile() {
  showNotification('Profile updated successfully!', { type: 'success' });
  if (window.studentProfileInstance) {
    window.studentProfileInstance.toggleEditMode();
  }
}

function changeProfilePicture() {
  const modal = new bootstrap.Modal(document.getElementById('changeProfilePictureModal'));
  modal.show();
}

function updateProfilePicture() {
  showNotification('Profile picture updated successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('changeProfilePictureModal'));
  modal.hide();
}

function changePassword() {
  const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
  modal.show();
}

function updatePassword() {
  showNotification('Password updated successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('changePasswordModal'));
  modal.hide();
}

function viewGrades() {
  window.location.href = "<?= \Helpers\Url::to('/student/grades') ?>";
}

function viewAssignments() {
  window.location.href = "<?= \Helpers\Url::to('/student/assignments') ?>";
}

function viewAttendance() {
  window.location.href = "<?= \Helpers\Url::to('/student/attendance') ?>";
}

function viewAlerts() {
  window.location.href = "<?= \Helpers\Url::to('/student/alerts') ?>";
}

function viewAcademicRecord() {
  showNotification('Opening academic record...', { type: 'info' });
  // Redirect to academic record page
  setTimeout(() => {
  window.location.href = "<?= \Helpers\Url::to('/student/academic-record') ?>";
  }, 1000);
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.studentProfileInstance = new StudentProfile();
});
</script>

<style>
/* Student Profile Specific Styles */
.surface {
  transition: all 0.3s ease;
}

.surface:hover {
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.form-control:read-only {
  background-color: var(--bs-gray-100);
  border-color: var(--bs-gray-300);
}

.form-check-input:checked {
  background-color: var(--bs-primary);
  border-color: var(--bs-primary);
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}

.progress {
  transition: width 0.6s ease;
}

.badge {
  font-size: 0.75em;
}
</style>
