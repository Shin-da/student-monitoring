<?php /** @var array $user */ ?>
<?php /** @var array $sections */ ?>

<!-- Static Data Indicator -->
<?= $staticDataIndicator ?? '' ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h1 class="h4 fw-bold mb-1">My Sections</h1>
    <p class="text-muted mb-0">Manage your assigned sections and students</p>
  </div>
  <div class="d-flex gap-2">
    <button class="btn btn-outline-primary btn-sm" onclick="location.href='/teacher/grades'">
      <svg width="16" height="16" fill="currentColor"><use href="#icon-chart"></use></svg>
      <span class="d-none d-md-inline ms-1">Manage Grades</span>
    </button>
    <button class="btn btn-outline-secondary btn-sm" onclick="location.href='/teacher/attendance'">
      <svg width="16" height="16" fill="currentColor"><use href="#icon-user"></use></svg>
      <span class="d-none d-md-inline ms-1">Attendance</span>
    </button>
  </div>
</div>

<?php if (empty($sections)): ?>
  <!-- Empty state -->
  <div class="surface p-5 text-center">
    <svg class="icon text-muted mb-3" width="64" height="64" fill="currentColor">
      <use href="#icon-sections"></use>
    </svg>
    <h4 class="text-muted mb-3">No Sections Assigned</h4>
    <p class="text-muted mb-4">You haven't been assigned to any sections yet. Contact your administrator to get assigned to sections.</p>
    <button class="btn btn-primary" onclick="location.href='/teacher/dashboard'">
      <svg width="16" height="16" fill="currentColor" class="me-2">
        <use href="#icon-arrow-left"></use>
      </svg>
      Back to Dashboard
    </button>
  </div>
<?php else: ?>
  <!-- Sections Grid -->
  <div class="row g-4">
    <?php foreach ($sections as $section): ?>
      <div class="col-lg-6">
        <div class="surface p-4 h-100">
          <!-- Section Header -->
          <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
              <h5 class="fw-bold mb-1"><?= htmlspecialchars($section['class_name']) ?></h5>
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-primary-subtle text-primary">
                  Grade <?= htmlspecialchars($section['grade_level']) ?> - <?= htmlspecialchars($section['section']) ?>
                </span>
                <span class="badge bg-info-subtle text-info">
                  <?= htmlspecialchars($section['subject_name']) ?>
                </span>
                <?php if ($section['is_adviser']): ?>
                  <span class="badge bg-success-subtle text-success">Adviser</span>
                <?php endif; ?>
              </div>
              <p class="text-muted small mb-0">
                <svg width="14" height="14" fill="currentColor" class="me-1">
                  <use href="#icon-map-pin"></use>
                </svg>
                Room: <?= htmlspecialchars($section['room']) ?>
              </p>
            </div>
            <div class="text-end">
              <div class="h4 fw-bold text-primary mb-0"><?= $section['student_count'] ?></div>
              <div class="text-muted small">Students</div>
            </div>
          </div>

          <!-- Attendance Rate -->
          <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <span class="small text-muted">Attendance Rate</span>
              <span class="small fw-semibold"><?= round($section['attendance_rate']) ?>%</span>
            </div>
            <div class="progress" style="height: 6px;">
              <div class="progress-bar bg-success" style="width: <?= round($section['attendance_rate']) ?>%"></div>
            </div>
          </div>

          <!-- Students List -->
          <div class="mb-3">
            <h6 class="fw-semibold mb-2">Students (<?= count($section['students']) ?>)</h6>
            <?php if (empty($section['students'])): ?>
              <div class="text-center py-3 text-muted">
                <svg width="24" height="24" fill="currentColor" class="mb-2">
                  <use href="#icon-user"></use>
                </svg>
                <div class="small">No students assigned</div>
              </div>
            <?php else: ?>
              <div class="students-list" style="max-height: 200px; overflow-y: auto;">
                <?php foreach ($section['students'] as $student): ?>
                  <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                      <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center">
                        <svg width="14" height="14" fill="currentColor">
                          <use href="#icon-user"></use>
                        </svg>
                      </div>
                      <div>
                        <div class="fw-semibold small"><?= htmlspecialchars($student['student_name']) ?></div>
                        <div class="text-muted small">LRN: <?= htmlspecialchars($student['lrn']) ?></div>
                      </div>
                    </div>
                    <div class="text-end">
                      <div class="small fw-semibold">
                        <?php if ($student['avg_grade'] > 0): ?>
                          <span class="text-success"><?= round($student['avg_grade'], 1) ?></span>
                        <?php else: ?>
                          <span class="text-muted">No grades</span>
                        <?php endif; ?>
                      </div>
                      <div class="text-muted small">
                        <?php if ($student['total_attendance'] > 0): ?>
                          <?= $student['present_count'] ?>/<?= $student['total_attendance'] ?> present
                        <?php else: ?>
                          No attendance
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <!-- Action Buttons -->
          <div class="d-grid gap-2">
            <div class="row g-2">
              <div class="col-6">
                <button class="btn btn-outline-primary btn-sm w-100" onclick="location.href='/teacher/grades?section=<?= $section['section_id'] ?>&subject=<?= $section['subject_id'] ?>'">
                  <svg width="14" height="14" fill="currentColor" class="me-1">
                    <use href="#icon-chart"></use>
                  </svg>
                  Grades
                </button>
              </div>
              <div class="col-6">
                <button class="btn btn-outline-secondary btn-sm w-100" onclick="location.href='/teacher/attendance?section=<?= $section['section_id'] ?>&subject=<?= $section['subject_id'] ?>'">
                  <svg width="14" height="14" fill="currentColor" class="me-1">
                    <use href="#icon-user"></use>
                  </svg>
                  Attendance
                </button>
              </div>
            </div>
            <button class="btn btn-outline-info btn-sm" onclick="location.href='/teacher/assignments?section=<?= $section['section_id'] ?>&subject=<?= $section['subject_id'] ?>'">
              <svg width="14" height="14" fill="currentColor" class="me-1">
                <use href="#icon-plus"></use>
              </svg>
              Assignments
            </button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Section Statistics -->
  <div class="row g-4 mt-4">
    <div class="col-md-4">
      <div class="surface p-3 text-center">
        <div class="h3 fw-bold text-primary mb-1"><?= count($sections) ?></div>
        <div class="text-muted small">Total Sections</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="surface p-3 text-center">
        <div class="h3 fw-bold text-success mb-1">
          <?= array_sum(array_column($sections, 'student_count')) ?>
        </div>
        <div class="text-muted small">Total Students</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="surface p-3 text-center">
        <div class="h3 fw-bold text-info mb-1">
          <?= round(array_sum(array_column($sections, 'attendance_rate')) / count($sections), 1) ?>%
        </div>
        <div class="text-muted small">Avg Attendance</div>
      </div>
    </div>
  </div>
<?php endif; ?>


