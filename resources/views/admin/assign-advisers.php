<?php
$title = $title ?? 'Assign Advisers to Sections';
$user = $user ?? null;
$activeNav = $activeNav ?? 'sections';
$sections = $sections ?? [];
$advisers = $advisers ?? [];
$teachers = $teachers ?? [];
$error = $error ?? null;
?>

<div class="container-fluid">
  <!-- Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h3 mb-1">Assign Advisers to Sections</h1>
          <p class="text-muted mb-0">Manage section advisers and ensure each section has exactly one adviser</p>
        </div>
        <div class="d-flex gap-2">
          <a href="<?= \Helpers\Url::to('/admin/users') ?>" class="btn btn-outline-secondary">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-arrow-left"></use>
            </svg>
            Back to Users
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Success/Error Messages -->
  <?php if (isset($_GET['success'])): ?>
    <?php if ($_GET['success'] === 'adviser_assigned'): ?>
      <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-center">
          <svg width="20" height="20" fill="currentColor" class="me-3">
            <use href="#icon-check-circle"></use>
          </svg>
          <div>
            <strong>Success!</strong> Adviser <strong><?= htmlspecialchars($_GET['adviser'] ?? '') ?></strong> has been assigned to section <strong><?= htmlspecialchars($_GET['section'] ?? '') ?></strong>.
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php elseif ($_GET['success'] === 'adviser_removed'): ?>
      <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <div class="d-flex align-items-center">
          <svg width="20" height="20" fill="currentColor" class="me-3">
            <use href="#icon-info"></use>
          </svg>
          <div>
            <strong>Adviser Removed!</strong> Adviser <strong><?= htmlspecialchars($_GET['adviser'] ?? '') ?></strong> has been removed from section <strong><?= htmlspecialchars($_GET['section'] ?? '') ?></strong>.
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      <div class="d-flex align-items-center">
        <svg width="20" height="20" fill="currentColor" class="me-3">
          <use href="#icon-alert-circle"></use>
        </svg>
        <div>
          <strong>Error!</strong> 
          <?php
          $errorMsg = $_GET['error'];
          switch ($errorMsg) {
            case 'csrf_invalid':
              echo 'Invalid security token. Please try again.';
              break;
            case 'missing_data':
              echo 'Missing required data. Please select both section and adviser.';
              break;
            case 'missing_section':
              echo 'Section not specified.';
              break;
            default:
              echo htmlspecialchars($errorMsg);
          }
          ?>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      <div class="d-flex align-items-center">
        <svg width="20" height="20" fill="currentColor" class="me-3">
          <use href="#icon-alert-circle"></use>
        </svg>
        <div>
          <strong>Error!</strong> <?= htmlspecialchars($error) ?>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Statistics Cards -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card border-0 bg-primary bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-primary mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-users"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= count($sections) ?></h4>
          <p class="text-muted mb-0">Total Sections</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-success bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-success mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-check-circle"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= count(array_filter($sections, fn($s) => $s['adviser_id'])) ?></h4>
          <p class="text-muted mb-0">Assigned Sections</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-warning bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-warning mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-alert-triangle"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= count(array_filter($sections, fn($s) => !$s['adviser_id'])) ?></h4>
          <p class="text-muted mb-0">Unassigned Sections</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-info bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-info mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-user-check"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= count($advisers) + count($teachers) ?></h4>
          <p class="text-muted mb-0">Available Advisers</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Sections List -->
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
              <svg width="20" height="20" fill="currentColor" class="me-2">
                <use href="#icon-users"></use>
              </svg>
              Section Adviser Assignments
            </h5>
            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-primary" onclick="refreshAssignments()">
                <svg width="16" height="16" fill="currentColor" class="me-1">
                  <use href="#icon-refresh-cw"></use>
                </svg>
                Refresh
              </button>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <?php if (empty($sections)): ?>
            <div class="text-center py-5">
              <svg width="64" height="64" fill="currentColor" class="text-muted mb-3">
                <use href="#icon-users"></use>
              </svg>
              <h5 class="text-muted">No Sections Found</h5>
              <p class="text-muted">There are no active sections to assign advisers to.</p>
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th class="border-0">Section</th>
                    <th class="border-0">Grade Level</th>
                    <th class="border-0">Room</th>
                    <th class="border-0">Current Adviser</th>
                    <th class="border-0">Status</th>
                    <th class="border-0 text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sections as $section): ?>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <svg width="16" height="16" fill="currentColor" class="text-primary">
                              <use href="#icon-users"></use>
                            </svg>
                          </div>
                          <div>
                            <h6 class="mb-0"><?= htmlspecialchars($section['name']) ?></h6>
                            <small class="text-muted">ID: <?= $section['id'] ?></small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-secondary">Grade <?= $section['grade_level'] ?></span>
                      </td>
                      <td>
                        <span class="text-muted"><?= htmlspecialchars($section['room'] ?? 'N/A') ?></span>
                      </td>
                      <td>
                        <?php if ($section['adviser_id']): ?>
                          <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-1 me-2">
                              <svg width="12" height="12" fill="currentColor" class="text-success">
                                <use href="#icon-user-check"></use>
                              </svg>
                            </div>
                            <div>
                              <div class="fw-medium"><?= htmlspecialchars($section['adviser_name']) ?></div>
                              <small class="text-muted"><?= htmlspecialchars($section['adviser_email']) ?></small>
                            </div>
                          </div>
                        <?php else: ?>
                          <span class="text-muted">No adviser assigned</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if ($section['adviser_id']): ?>
                          <span class="badge bg-success">Assigned</span>
                        <?php else: ?>
                          <span class="badge bg-warning">Unassigned</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-end">
                        <div class="btn-group" role="group">
                          <?php if ($section['adviser_id']): ?>
                            <!-- Remove Adviser -->
                            <form method="POST" action="<?= \Helpers\Url::to('/admin/remove-adviser') ?>" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this adviser from the section?')">
                              <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::generateToken() ?>">
                              <input type="hidden" name="section_id" value="<?= $section['id'] ?>">
                              <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove Adviser">
                                <svg width="16" height="16" fill="currentColor">
                                  <use href="#icon-user-minus"></use>
                                </svg>
                              </button>
                            </form>
                          <?php endif; ?>
                          
                          <!-- Assign/Change Adviser -->
                          <button type="button" class="btn btn-sm btn-primary" onclick="openAssignModal(<?= $section['id'] ?>, '<?= htmlspecialchars($section['name']) ?>', <?= $section['adviser_id'] ?>)">
                            <svg width="16" height="16" fill="currentColor">
                              <use href="#icon-user-plus"></use>
                            </svg>
                            <?= $section['adviser_id'] ? 'Change' : 'Assign' ?>
                          </button>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Assignment Modal -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignModalLabel">Assign Adviser to Section</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="<?= \Helpers\Url::to('/admin/assign-adviser') ?>" id="assignForm">
        <div class="modal-body">
          <input type="hidden" name="csrf_token" value="<?= \Helpers\Csrf::generateToken() ?>">
          <input type="hidden" name="section_id" id="modalSectionId">
          
          <div class="mb-4">
            <h6 class="text-muted mb-2">Section Information</h6>
            <div class="bg-light rounded p-3">
              <div class="row">
                <div class="col-md-6">
                  <strong>Section:</strong> <span id="modalSectionName"></span>
                </div>
                <div class="col-md-6">
                  <strong>Current Adviser:</strong> <span id="modalCurrentAdviser">None</span>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="adviserSelect" class="form-label">
              <svg width="16" height="16" fill="currentColor" class="me-1">
                <use href="#icon-user-check"></use>
              </svg>
              Select Adviser <span class="text-danger">*</span>
            </label>
            <select class="form-select" id="adviserSelect" name="adviser_id" required>
              <option value="">Choose an adviser...</option>
              
              <!-- Available Advisers -->
              <?php if (!empty($advisers)): ?>
                <optgroup label="Current Advisers">
                  <?php foreach ($advisers as $adviser): ?>
                    <option value="<?= $adviser['id'] ?>" data-email="<?= htmlspecialchars($adviser['email']) ?>">
                      <?= htmlspecialchars($adviser['name']) ?> (<?= htmlspecialchars($adviser['email']) ?>)
                    </option>
                  <?php endforeach; ?>
                </optgroup>
              <?php endif; ?>

              <!-- Teachers who can become advisers -->
              <?php if (!empty($teachers)): ?>
                <optgroup label="Teachers (will be promoted to adviser)">
                  <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= $teacher['id'] ?>" data-email="<?= htmlspecialchars($teacher['email']) ?>">
                      <?= htmlspecialchars($teacher['name']) ?> (<?= htmlspecialchars($teacher['email']) ?>)
                    </option>
                  <?php endforeach; ?>
                </optgroup>
              <?php endif; ?>
            </select>
            <div class="form-text">
              <svg width="14" height="14" fill="currentColor" class="me-1">
                <use href="#icon-info"></use>
              </svg>
              Teachers will be automatically promoted to adviser role when assigned to a section.
            </div>
          </div>

          <div class="alert alert-info">
            <div class="d-flex align-items-start">
              <svg width="20" height="20" fill="currentColor" class="me-3 mt-1">
                <use href="#icon-info"></use>
              </svg>
              <div>
                <h6 class="alert-heading mb-2">Important Notes:</h6>
                <ul class="mb-0 small">
                  <li>Each adviser can only be assigned to <strong>one section</strong></li>
                  <li>If a teacher is selected, they will be promoted to adviser role</li>
                  <li>Current adviser will be removed from this section</li>
                  <li>All changes are logged for audit purposes</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <svg width="16" height="16" fill="currentColor" class="me-1">
              <use href="#icon-user-plus"></use>
            </svg>
            Assign Adviser
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Assignment modal functionality
function openAssignModal(sectionId, sectionName, currentAdviserId) {
  document.getElementById('modalSectionId').value = sectionId;
  document.getElementById('modalSectionName').textContent = sectionName;
  
  // Reset form
  document.getElementById('adviserSelect').value = '';
  
  // Show current adviser info
  const currentAdviserSpan = document.getElementById('modalCurrentAdviser');
  if (currentAdviserId) {
    // Find current adviser name from the table row
    const row = document.querySelector(`tr:has(input[value="${sectionId}"])`);
    if (row) {
      const adviserCell = row.querySelector('td:nth-child(4)');
      if (adviserCell) {
        const adviserName = adviserCell.querySelector('.fw-medium');
        if (adviserName) {
          currentAdviserSpan.textContent = adviserName.textContent;
        }
      }
    }
  } else {
    currentAdviserSpan.textContent = 'None';
  }
  
  // Show modal
  const modal = new bootstrap.Modal(document.getElementById('assignModal'));
  modal.show();
}

// Refresh assignments
function refreshAssignments() {
  window.location.reload();
}

// Form validation
document.getElementById('assignForm').addEventListener('submit', function(e) {
  const adviserSelect = document.getElementById('adviserSelect');
  if (!adviserSelect.value) {
    e.preventDefault();
    adviserSelect.classList.add('is-invalid');
    adviserSelect.focus();
    return false;
  }
  adviserSelect.classList.remove('is-invalid');
});

// Clear validation on change
document.getElementById('adviserSelect').addEventListener('change', function() {
  this.classList.remove('is-invalid');
});
</script>

<style>
.table th {
  font-weight: 600;
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.btn-group .btn {
  border-radius: 0.375rem;
}

.btn-group .btn:not(:last-child) {
  margin-right: 0.25rem;
}

.card {
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.badge {
  font-size: 0.75rem;
  font-weight: 500;
}

.alert {
  border: none;
  border-radius: 0.75rem;
}

.modal-content {
  border: none;
  border-radius: 1rem;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

.modal-header {
  border-bottom: 1px solid var(--bs-border-color-translucent);
  border-radius: 1rem 1rem 0 0;
}

.modal-footer {
  border-top: 1px solid var(--bs-border-color-translucent);
  border-radius: 0 0 1rem 1rem;
}
</style>
