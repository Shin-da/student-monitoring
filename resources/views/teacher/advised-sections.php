<?php
$title = $title ?? 'My Advised Sections';
$user = $user ?? null;
$activeNav = $activeNav ?? 'sections';
$sections = $sections ?? [];
$statistics = $statistics ?? [];
$error = $error ?? null;
?>

<div class="container-fluid">
  <!-- Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h3 mb-1">My Advised Sections</h1>
          <p class="text-muted mb-0">Sections and subjects you handle based on your assignments</p>
        </div>
        <div class="d-flex gap-2">
          <a href="<?= \Helpers\Url::to('/teacher/add-students') ?>" class="btn btn-primary">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-user-plus"></use>
            </svg>
            Add Students
          </a>
          <a href="<?= \Helpers\Url::to('/teacher/students') ?>" class="btn btn-outline-secondary">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-users"></use>
            </svg>
            My Students
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Error Message -->
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
              <use href="#icon-book"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= $statistics['total_classes'] ?? 0 ?></h4>
          <p class="text-muted mb-0">Total Classes</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-success bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-success mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-users"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= $statistics['total_students'] ?? 0 ?></h4>
          <p class="text-muted mb-0">Total Students</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-info bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-info mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-graduation-cap"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= $statistics['grade_levels'] ?? 0 ?></h4>
          <p class="text-muted mb-0">Grade Levels</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 bg-warning bg-opacity-10">
        <div class="card-body text-center">
          <div class="text-warning mb-2">
            <svg width="32" height="32" fill="currentColor">
              <use href="#icon-sections"></use>
            </svg>
          </div>
          <h4 class="mb-1"><?= count(array_unique(array_column($sections, 'section_name'))) ?></h4>
          <p class="text-muted mb-0">Unique Sections</p>
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
                <use href="#icon-sections"></use>
              </svg>
              Section Assignments
            </h5>
            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-primary" onclick="refreshSections()">
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
                <use href="#icon-sections"></use>
              </svg>
              <h5 class="text-muted">No Section Assignments</h5>
              <p class="text-muted">You don't have any section assignments yet. Contact the administrator to assign you to sections.</p>
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th class="border-0">Section</th>
                    <th class="border-0">Subject</th>
                    <th class="border-0">Schedule</th>
                    <th class="border-0">Room</th>
                    <th class="border-0">Students</th>
                    <th class="border-0">Capacity</th>
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
                              <use href="#icon-sections"></use>
                            </svg>
                          </div>
                          <div>
                            <h6 class="mb-0"><?= htmlspecialchars($section['section_name']) ?></h6>
                            <small class="text-muted">Grade <?= $section['grade_level'] ?> • <?= htmlspecialchars($section['section_room']) ?></small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-info"><?= htmlspecialchars($section['subject_name']) ?></span>
                      </td>
                      <td>
                        <span class="text-muted"><?= htmlspecialchars($section['schedule']) ?></span>
                      </td>
                      <td>
                        <span class="text-muted"><?= htmlspecialchars($section['class_room']) ?></span>
                      </td>
                      <td>
                        <span class="badge bg-success"><?= $section['enrolled_students'] ?></span>
                      </td>
                      <td>
                        <span class="text-muted"><?= $section['max_students'] ?></span>
                      </td>
                      <td>
                        <?php 
                        $capacityPercent = $section['max_students'] > 0 ? ($section['enrolled_students'] / $section['max_students']) * 100 : 0;
                        if ($capacityPercent >= 100): ?>
                          <span class="badge bg-danger">Full</span>
                        <?php elseif ($capacityPercent >= 80): ?>
                          <span class="badge bg-warning">Near Full</span>
                        <?php else: ?>
                          <span class="badge bg-success">Available</span>
                        <?php endif; ?>
                      </td>
                      <td class="text-end">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewSectionStudents(<?= $section['section_id'] ?>, '<?= htmlspecialchars($section['section_name']) ?>')">
                            <svg width="16" height="16" fill="currentColor">
                              <use href="#icon-users"></use>
                            </svg>
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-info" onclick="viewSectionDetails(<?= $section['class_id'] ?>)">
                            <svg width="16" height="16" fill="currentColor">
                              <use href="#icon-eye"></use>
                            </svg>
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-success" onclick="manageAttendance(<?= $section['class_id'] ?>)">
                            <svg width="16" height="16" fill="currentColor">
                              <use href="#icon-calendar"></use>
                            </svg>
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

  <!-- Section Summary -->
  <?php if (!empty($sections)): ?>
    <div class="row mt-4">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">
              <svg width="20" height="20" fill="currentColor" class="me-2">
                <use href="#icon-chart"></use>
              </svg>
              Section Summary
            </h5>
          </div>
          <div class="card-body">
            <div class="row g-4">
              <?php 
              $sectionGroups = [];
              foreach ($sections as $section) {
                $sectionGroups[$section['section_name']][] = $section;
              }
              ?>
              <?php foreach ($sectionGroups as $sectionName => $classes): ?>
                <div class="col-md-6 col-lg-4">
                  <div class="card border-0 bg-light">
                    <div class="card-body">
                      <h6 class="card-title"><?= htmlspecialchars($sectionName) ?></h6>
                      <div class="mb-2">
                        <small class="text-muted">Grade <?= $classes[0]['grade_level'] ?></small>
                      </div>
                      <div class="mb-2">
                        <strong><?= count($classes) ?></strong> subjects
                      </div>
                      <div class="mb-2">
                        <strong><?= $classes[0]['enrolled_students'] ?></strong> students enrolled
                      </div>
                      <div class="progress mb-2" style="height: 6px;">
                        <?php 
                        $capacityPercent = $classes[0]['max_students'] > 0 ? ($classes[0]['enrolled_students'] / $classes[0]['max_students']) * 100 : 0;
                        ?>
                        <div class="progress-bar <?= $capacityPercent >= 100 ? 'bg-danger' : ($capacityPercent >= 80 ? 'bg-warning' : 'bg-success') ?>" 
                             style="width: <?= min($capacityPercent, 100) ?>%"></div>
                      </div>
                      <small class="text-muted"><?= $classes[0]['enrolled_students'] ?> / <?= $classes[0]['max_students'] ?> students</small>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<script>
// Action functions
function viewSectionStudents(sectionId, sectionName) {
  // TODO: Implement section students view
  alert('Students in ' + sectionName + ' (ID: ' + sectionId + ')');
}

function viewSectionDetails(classId) {
  // TODO: Implement section details modal
  alert('Section details for class ID: ' + classId);
}

function manageAttendance(classId) {
  // TODO: Implement attendance management
  alert('Manage attendance for class ID: ' + classId);
}

function refreshSections() {
  window.location.reload();
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
  // Add any initialization logic here
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

.table tbody tr:hover {
  background-color: var(--bs-gray-50);
}

.progress {
  background-color: var(--bs-gray-200);
}

.card.bg-light {
  background-color: var(--bs-gray-100) !important;
}
</style>
