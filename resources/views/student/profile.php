<script>
// Simple notification function
function showNotification(message, options = {}) {
  const type = options.type || 'info';
  let bgColor = '#0d6efd';
  if (type === 'success') bgColor = '#198754';
  if (type === 'danger') bgColor = '#dc3545';
  if (type === 'warning') bgColor = '#ffc107';
  const notif = document.createElement('div');
  notif.textContent = message;
  notif.style.position = 'fixed';
  notif.style.top = '20px';
  notif.style.right = '20px';
  notif.style.zIndex = '9999';
  notif.style.background = bgColor;
  notif.style.color = '#fff';
  notif.style.padding = '12px 24px';
  notif.style.borderRadius = '6px';
  notif.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
  document.body.appendChild(notif);
  setTimeout(() => notif.remove(), 3000);
}
</script>
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
    <div class="surface p-4">
      <div class="text-center">
        <div class="position-relative d-inline-block mb-3">
          <?php if ($student_data['profile_picture']): ?>
            <img src="<?= \Helpers\Url::basePath() . $student_data['profile_picture'] ?>" alt="Profile Picture" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
          <?php else: ?>
            <div class="bg-primary bg-opacity-10 rounded-circle p-4" style="width: 120px; height: 120px;">
              <svg class="icon text-primary" width="48" height="48" fill="currentColor">
                <use href="#icon-user"></use>
              </svg>
            </div>
          <?php endif; ?>
          <button class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle" style="width: 32px; height: 32px;" onclick="changeProfilePicture()">
            <svg class="icon" width="16" height="16" fill="currentColor">
              <use href="#icon-camera"></use>
            </svg>
          </button>
        </div>
        <h5 class="mb-1"><?= htmlspecialchars($student_data['full_name'] ?? $student_data['name'] ?? 'Student Name') ?></h5>
        <p class="text-muted mb-2">
          <?php
            $grade = $student_data['grade_level'] ?? '';
            $section = $student_data['section_name'] ?? '';
            if ($grade && $section) {
              if (stripos($section, 'Grade ' . $grade) === false) {
                echo 'Grade ' . htmlspecialchars($grade) . ' - ' . htmlspecialchars($section);
              } else {
                echo htmlspecialchars($section);
              }
            } elseif ($grade) {
              echo 'Grade ' . htmlspecialchars($grade);
            } elseif ($section) {
              echo htmlspecialchars($section);
            }
          ?>
        </p>
        <?php if ($student_data['lrn']): ?>
          <p class="text-muted small mb-2">
            <strong>LRN:</strong> <?= htmlspecialchars($student_data['lrn']) ?>
          </p>
        <?php endif; ?>
        <div class="d-flex justify-content-center gap-2 mb-3">
          <span class="badge bg-primary">Student</span>
          <?php if ($student_data['enrollment_status']): ?>
            <span class="badge bg-<?= $student_data['enrollment_status'] === 'enrolled' ? 'success' : ($student_data['enrollment_status'] === 'graduated' ? 'info' : 'warning') ?>">
              <?= ucfirst($student_data['enrollment_status']) ?>
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
    <div class="surface p-4">
      <h5 class="mb-4">Personal Information</h5>
      <form id="profileForm">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['first_name'] ?? '') ?>" readonly>
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['middle_name'] ?? '') ?>" readonly>
          </div>
          <div class="col-md-4">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['last_name'] ?? '') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Birth Date</label>
            <input type="text" class="form-control" value="<?= $student_data['birth_date'] ? date('F j, Y', strtotime($student_data['birth_date'])) : 'Not provided' ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Gender</label>
            <input type="text" class="form-control" value="<?= $student_data['gender'] ? ucfirst($student_data['gender']) : 'Not provided' ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($student_data['email'] ?? '') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['contact_number'] ?? 'Not provided') ?>" readonly>
          </div>
          <div class="col-12">
            <label class="form-label">Address</label>
            <textarea class="form-control" rows="2" readonly><?= htmlspecialchars($student_data['address'] ?? 'Not provided') ?></textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Account Status</label>
            <input type="text" class="form-control" value="<?= ucfirst($student_data['user_status'] ?? 'Unknown') ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Member Since</label>
            <input type="text" class="form-control" value="<?= date('F j, Y', strtotime($student_data['created_at'] ?? '')) ?>" readonly>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Academic Information -->
<div class="row g-4 mb-4">
  <div class="col-lg-6">
    <div class="surface p-4">
      <h5 class="mb-4">Academic Information</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">LRN (Learner Reference Number)</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['lrn'] ?? 'Not assigned') ?>" readonly>
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
          <input type="text" class="form-control" value="<?= $student_data['section_name'] ? htmlspecialchars($student_data['section_name']) : 'Not assigned' ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Enrollment Status</label>
          <input type="text" class="form-control" value="<?= ucfirst($student_data['enrollment_status'] ?? 'Unknown') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Previous School</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['previous_school'] ?? 'Not provided') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Student Record Created</label>
          <input type="text" class="form-control" value="<?= $student_data['created_at'] ? date('F j, Y g:i A', strtotime($student_data['created_at'])) : 'Not created' ?>" readonly>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="surface p-4">
      <h5 class="mb-4">
        <svg width="20" height="20" fill="currentColor" class="me-2">
          <use href="#icon-book"></use>
        </svg>
        Section Information
      </h5>
      <?php if ($student_data['section_name']): ?>
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Section Name</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['section_name']) ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">Grade Level</label>
            <input type="text" class="form-control" value="Grade <?= htmlspecialchars($student_data['grade_level']) ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">School Year</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['school_year']) ?>" readonly>
          </div>
          <div class="col-md-6">
            <label class="form-label">LRN (Learner Reference Number)</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['lrn']) ?>" readonly>
          </div>
          <div class="col-12">
            <div class="alert alert-info">
              <small>
                <strong>Enrollment Status:</strong> <?= ucfirst($student_data['enrollment_status']) ?><br>
                <strong>Profile Created:</strong> <?= date('F j, Y', strtotime($student_data['created_at'])) ?><br>
                <strong>Last Updated:</strong> <?= date('F j, Y g:i A', strtotime($student_data['updated_at'])) ?>
              </small>
            </div>
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

<!-- Guardian & Emergency Information -->
<div class="row g-4 mb-4">
  <div class="col-lg-6">
    <div class="surface p-4">
      <h5 class="mb-4">
        <svg width="20" height="20" fill="currentColor" class="me-2">
          <use href="#icon-users"></use>
        </svg>
        Guardian Information
      </h5>
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Guardian Name</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['guardian_name'] ?? 'Not provided') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Guardian Contact</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['guardian_contact'] ?? 'Not provided') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Relationship</label>
          <input type="text" class="form-control" value="<?= $student_data['guardian_relationship'] ? ucfirst($student_data['guardian_relationship']) : 'Not provided' ?>" readonly>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="surface p-4">
      <h5 class="mb-4">
        <svg width="20" height="20" fill="currentColor" class="me-2">
          <use href="#icon-alert-triangle"></use>
        </svg>
        Emergency Contact
      </h5>
      <div class="row g-3">
        <div class="col-12">
          <label class="form-label">Emergency Contact Name</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['emergency_contact_name'] ?? 'Not provided') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Emergency Contact Number</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($student_data['emergency_contact_number'] ?? 'Not provided') ?>" readonly>
        </div>
        <div class="col-md-6">
          <label class="form-label">Relationship</label>
          <input type="text" class="form-control" value="<?= $student_data['emergency_contact_relationship'] ? ucfirst($student_data['emergency_contact_relationship']) : 'Not provided' ?>" readonly>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Health Information -->
<div class="row g-4 mb-4">
  <div class="col-lg-12">
    <div class="surface p-4">
      <h5 class="mb-4">
        <svg width="20" height="20" fill="currentColor" class="me-2">
          <use href="#icon-heart"></use>
        </svg>
        Health Information
      </h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Medical Conditions</label>
          <textarea class="form-control" rows="3" readonly><?= htmlspecialchars($student_data['medical_conditions'] ?? 'No medical conditions reported') ?></textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label">Allergies</label>
          <textarea class="form-control" rows="3" readonly><?= htmlspecialchars($student_data['allergies'] ?? 'No known allergies') ?></textarea>
        </div>
        <?php if ($student_data['notes']): ?>
          <div class="col-12">
            <label class="form-label">Additional Notes</label>
            <textarea class="form-control" rows="2" readonly><?= htmlspecialchars($student_data['notes']) ?></textarea>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<!-- Academic Performance Summary -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface p-4">
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
            <div id="imagePreview" class="bg-primary bg-opacity-10 rounded-circle p-4 d-inline-block" style="width: 120px; height: 120px;">
              <svg class="icon text-primary" width="48" height="48" fill="currentColor">
                <use href="#icon-user"></use>
              </svg>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Upload New Picture</label>
            <input type="file" id="profilePictureInput" class="form-control" accept="image/*" required>
            <div class="form-text">
              <strong>Supported formats:</strong> JPG, PNG, GIF, WebP<br>
              <strong>Maximum size:</strong> 2MB<br>
              <strong>Recommended:</strong> Square image (1:1 ratio) for best results
            </div>
          </div>
          <div id="fileInfo" class="alert alert-info d-none">
            <small id="fileDetails"></small>
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
  const form = document.getElementById('changeProfilePictureForm');
  const fileInput = form.querySelector('input[type="file"]');
  const file = fileInput.files[0];
  
  if (!file) {
    showNotification('Please select an image to upload.', { type: 'warning' });
    return;
  }
  
  // Validate file size (2MB limit)
  const maxSize = 2 * 1024 * 1024; // 2MB
  if (file.size > maxSize) {
    showNotification('File size must be less than 2MB.', { type: 'warning' });
    return;
  }
  
  // Validate file type
  const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
  if (!allowedTypes.includes(file.type)) {
    showNotification('Please select a valid image file (JPG, PNG, GIF, or WebP).', { type: 'warning' });
    return;
  }
  
  // Show loading state
  const submitBtn = document.querySelector('button[onclick="updateProfilePicture()"]');
  const originalText = submitBtn.innerHTML;
  submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';
  submitBtn.disabled = true;
  
  const formData = new FormData();
  formData.append('profile_picture', file);
  
  // Add CSRF token if available
  const csrfToken = document.querySelector('meta[name="csrf-token"]');
  if (csrfToken) {
    formData.append('csrf_token', csrfToken.getAttribute('content'));
  }
  
  fetch('<?= \Helpers\Url::to('/api/student/upload_profile_picture.php') ?>', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      if (data.success && data.image_url) {
        // Update profile picture in the UI
        const profileImg = document.querySelector('img[alt="Profile Picture"]');
        if (profileImg) {
          profileImg.src = '<?= \Helpers\Url::basePath() ?>' + data.image_url + '?t=' + Date.now(); // Add timestamp to prevent caching
        }
        
        showNotification(data.message || 'Profile picture updated successfully!', { type: 'success' });
        
        // Close modal and reset form
        const modal = bootstrap.Modal.getInstance(document.getElementById('changeProfilePictureModal'));
        modal.hide();
        form.reset();
      } else {
        showNotification(data.message || 'Failed to update profile picture.', { type: 'danger' });
      }
    })
    .catch(error => {
      console.error('Upload error:', error);
      showNotification('Error uploading profile picture. Please try again.', { type: 'danger' });
    })
    .finally(() => {
      // Restore button state
      submitBtn.innerHTML = originalText;
      submitBtn.disabled = false;
    });
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
  
  // Add file preview functionality
  const fileInput = document.getElementById('profilePictureInput');
  const imagePreview = document.getElementById('imagePreview');
  const fileInfo = document.getElementById('fileInfo');
  const fileDetails = document.getElementById('fileDetails');
  
  if (fileInput && imagePreview) {
    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      
      if (file) {
        // Show file information
        const fileSizeKB = Math.round(file.size / 1024);
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        const sizeText = fileSizeKB < 1024 ? `${fileSizeKB} KB` : `${fileSizeMB} MB`;
        
        fileDetails.innerHTML = `
          <strong>Selected file:</strong> ${file.name}<br>
          <strong>Size:</strong> ${sizeText}<br>
          <strong>Type:</strong> ${file.type}
        `;
        fileInfo.classList.remove('d-none');
        
        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
          imagePreview.innerHTML = `
            <img src="${e.target.result}" alt="Preview" 
                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
          `;
        };
        reader.readAsDataURL(file);
      } else {
        // Reset preview
        imagePreview.innerHTML = `
          <svg class="icon text-primary" width="48" height="48" fill="currentColor">
            <use href="#icon-user"></use>
          </svg>
        `;
        fileInfo.classList.add('d-none');
      }
    });
  }
});
</script>

<style>
/* Student Profile Specific Styles */
.surface {
  transition: all 0.3s ease;
  background: var(--bs-body-bg);
  border: 1px solid var(--bs-border-color);
  border-radius: 0.75rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.surface:hover {
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  transform: translateY(-2px);
}

.form-control:read-only {
  background-color: var(--bs-gray-50);
  border-color: var(--bs-gray-200);
  color: var(--bs-gray-700);
}

.form-control:read-only:focus {
  background-color: var(--bs-gray-50);
  border-color: var(--bs-gray-300);
  box-shadow: none;
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
  font-weight: 500;
}

/* Profile picture styling */
.profile-picture {
  border: 3px solid var(--bs-primary);
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Section headers with icons */
.section-header {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid var(--bs-primary);
}

.section-header svg {
  margin-right: 0.5rem;
  color: var(--bs-primary);
}

/* Enhanced form styling */
.form-label {
  font-weight: 600;
  color: var(--bs-gray-700);
  margin-bottom: 0.5rem;
}

/* Alert styling */
.alert {
  border: none;
  border-radius: 0.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .surface {
    padding: 1rem !important;
  }
  
  .dashboard-header h1 {
    font-size: 1.5rem;
  }
  
  .profile-picture {
    width: 80px !important;
    height: 80px !important;
  }
}
</style>
