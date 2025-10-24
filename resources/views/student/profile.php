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
        <h5 class="mb-1"><?= htmlspecialchars($student_data['name'] ?? 'Student Name') ?></h5>
        <p class="text-muted mb-2">
          <?php if ($student_data['grade_level']): ?>
            Grade <?= htmlspecialchars($student_data['grade_level']) ?>
          <?php endif; ?>
          <?php if ($section_info): ?>
            - <?= htmlspecialchars($section_info['name'] ?? 'Section') ?>
          <?php endif; ?>
        </p>
        <div class="d-flex justify-content-center gap-2 mb-3">
          <span class="badge bg-primary">Student</span>
          <span class="badge bg-<?= $student_data['status'] === 'active' ? 'success' : ($student_data['status'] === 'pending' ? 'warning' : 'danger') ?>">
            <?= ucfirst($student_data['status'] ?? 'Unknown') ?>
          </span>
          <?php if (isset($enrollment_info['status'])): ?>
            <span class="badge bg-<?= $enrollment_info['status'] === 'enrolled' ? 'success' : ($enrollment_info['status'] === 'graduated' ? 'info' : 'warning') ?>">
              <?= ucfirst($enrollment_info['status']) ?>
            </span>
          <?php endif; ?>
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
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['name'] ?? '') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($student_data['email'] ?? '') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Account Status</label>
            <input type="text" class="form-control" value="<?= ucfirst($student_data['status'] ?? 'Unknown') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Member Since</label>
            <input type="text" class="form-control" value="<?= date('F j, Y', strtotime($student_data['created_at'] ?? '')) ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Last Updated</label>
            <input type="text" class="form-control" value="<?= date('F j, Y g:i A', strtotime($student_data['updated_at'] ?? '')) ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Approved By</label>
            <input type="text" class="form-control" value="<?= $student_data['approved_at'] ? 'Admin' : 'Pending' ?>" readonly>
          </div>
          <div class="col-12">
            <label class="form-label">Account Information</label>
            <div class="alert alert-info">
              <small>
                <strong>Role:</strong> <?= ucfirst($student_data['role'] ?? 'Student') ?><br>
                <strong>Requested Role:</strong> <?= $student_data['requested_role'] ? ucfirst($student_data['requested_role']) : 'N/A' ?><br>
                <strong>Approved Date:</strong> <?= $student_data['approved_at'] ? date('F j, Y g:i A', strtotime($student_data['approved_at'])) : 'Not approved yet' ?>
              </small>
            </div>
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
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['lrn'] ?? 'Not assigned') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Student Number</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['student_number'] ?? 'Not assigned') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Grade Level</label>
          <input type="text" class="form-control" value="<?= $student_data['grade_level'] ? 'Grade ' . $student_data['grade_level'] : 'Not assigned' ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">School Year</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['school_year'] ?? 'Not assigned') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Section</label>
          <input type="text" class="form-control" value="<?= $section_info ? htmlspecialchars($section_info['name']) : 'Not assigned' ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Room</label>
          <input type="text" class="form-control" value="<?= $section_info ? htmlspecialchars($section_info['room'] ?? 'Not assigned') : 'Not assigned' ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Date Enrolled</label>
          <input type="text" class="form-control" value="<?= $student_data['date_enrolled'] ? date('F j, Y', strtotime($student_data['date_enrolled'])) : 'Not available' ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Enrollment Status</label>
          <input type="text" class="form-control" value="<?= ucfirst($student_data['student_status'] ?? 'Unknown') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Student Record Created</label>
          <input type="text" class="form-control" value="<?= $student_data['student_created_at'] ? date('F j, Y g:i A', strtotime($student_data['student_created_at'])) : 'Not created' ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">User ID</label>
          <input type="text" class="form-control" value="<?= $student_data['id'] ?? 'N/A' ?>" readonly>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Section & Adviser Information</h5>
      <?php if ($section_info): ?>
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Section Name</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($section_info['name']) ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Room</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($section_info['room'] ?? 'Not assigned') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Max Students</label>
            <input type="text" class="form-control" value="<?= $section_info['max_students'] ?? 'Not set' ?>" readonly>
          </div>
          <?php if ($section_info['adviser_name']): ?>
            <div class="col-md-6">
              <label class="form-label">Class Adviser</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($section_info['adviser_name']) ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Adviser Email</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($section_info['adviser_email'] ?? 'Not available') ?>" readonly>
            </div>
          <?php endif; ?>
          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="2" readonly><?= htmlspecialchars($section_info['description'] ?? 'No description available') ?></textarea>
          </div>
        </div>
      <?php else: ?>
        <div class="alert alert-warning">
          <h6 class="alert-heading">No Section Assigned</h6>
          <p class="mb-0">You are not currently assigned to any section. Please contact the administration for assistance.</p>
        </div>
      <?php endif; ?>
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
            <div class="h4 fw-bold text-primary mb-1">
              <?= $academic_stats['overall_average'] > 0 ? number_format($academic_stats['overall_average'], 1) : 'N/A' ?>
            </div>
            <div class="text-muted small">Overall Average</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-primary" style="width: <?= $academic_stats['overall_average'] > 0 ? $academic_stats['overall_average'] : 0 ?>%"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-success mb-1">
              <?= $academic_stats['passing_subjects'] > 0 ? $academic_stats['passing_subjects'] : 'N/A' ?>
            </div>
            <div class="text-muted small">Passing Subjects</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-success" style="width: <?= $academic_stats['total_subjects'] > 0 ? ($academic_stats['passing_subjects'] / $academic_stats['total_subjects'] * 100) : 0 ?>%"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-info mb-1">
              <?= $academic_stats['improvement'] > 0 ? '+' . number_format($academic_stats['improvement'], 1) . '%' : 'N/A' ?>
            </div>
            <div class="text-muted small">Improvement</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-info" style="width: <?= $academic_stats['improvement'] > 0 ? min($academic_stats['improvement'] * 10, 100) : 0 ?>%"></div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="mt-4">
        <h6>Subjects for Grade <?= $student_data['grade_level'] ?? 'N/A' ?></h6>
        <?php if (!empty($subjects)): ?>
          <div class="row g-2">
            <?php foreach ($subjects as $subject): ?>
              <div class="col-md-6">
                <div class="border rounded-3 p-3">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <h6 class="mb-1"><?= htmlspecialchars($subject['name']) ?></h6>
                      <small class="text-muted"><?= htmlspecialchars($subject['code']) ?></small>
                    </div>
                    <span class="badge bg-primary-subtle text-primary"><?= $subject['grade_level'] ?></span>
                  </div>
                  <?php if ($subject['description']): ?>
                    <p class="small text-muted mt-2 mb-0"><?= htmlspecialchars($subject['description']) ?></p>
                  <?php endif; ?>
                  <div class="mt-2">
                    <small class="text-muted">
                      WW: <?= $subject['ww_percent'] ?>% | 
                      PT: <?= $subject['pt_percent'] ?>% | 
                      QE: <?= $subject['qe_percent'] ?>%
                    </small>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="alert alert-info">
            <div class="d-flex align-items-center">
              <svg class="icon me-2" width="20" height="20" fill="currentColor">
                <use href="#icon-info"></use>
              </svg>
              <div>
                <strong>No subjects assigned yet</strong><br>
                <small>Subjects for your grade level will be displayed here once they are configured by the administration.</small>
              </div>
            </div>
          </div>
        <?php endif; ?>
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
