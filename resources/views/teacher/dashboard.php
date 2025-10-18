<!-- Static Data Indicator -->
<?= $staticDataIndicator ?? '' ?>

<!-- Enhanced Teacher Dashboard Header -->
<div class="dashboard-header mb-4 position-relative overflow-hidden">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); opacity: 0.1;"></div>
  <div class="position-relative">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h1 class="h3 fw-bold mb-1 text-primary">Teacher Dashboard</h1>
        <p class="text-muted mb-0">Welcome back, <span class="fw-semibold text-dark"><?= htmlspecialchars($user['name'] ?? 'Teacher') ?></span>! Here's your teaching overview.</p>
        <div class="d-flex align-items-center gap-3 mt-2">
          <span class="badge bg-primary-subtle text-primary">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-sections"></use>
            </svg>
            <?= $stats['subjects_count'] ?> Subject<?= $stats['subjects_count'] != 1 ? 's' : '' ?> Taught
          </span>
          <span class="badge bg-success-subtle text-success">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-star"></use>
            </svg>
            <?= $stats['sections_count'] ?> Section<?= $stats['sections_count'] != 1 ? 's' : '' ?> Assigned
          </span>
        </div>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm" onclick="location.href='/teacher/grades'">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">Manage Grades</span>
        </button>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#quickGradeModal">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-plus"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">Quick Grade</span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Teacher Statistics Cards with Real Data -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4 h-100 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
      <div class="position-absolute top-0 end-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.05) 100%);"></div>
      <div class="position-relative">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="stat-icon bg-primary-subtle text-primary" style="transition: all 0.3s ease;">
            <svg width="24" height="24" fill="currentColor">
              <use href="#icon-sections"></use>
            </svg>
          </div>
          <span class="badge bg-primary-subtle text-primary"><?= $stats['sections_count'] ?></span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-primary" data-count-to="<?= $stats['sections_count'] ?>">0</h3>
        <p class="text-muted small mb-0">Assigned Sections <?= \Helpers\StaticData::getStaticDataBadge() ?></p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-primary" style="width: <?= min(100, ($stats['sections_count'] / 5) * 100) ?>%" data-progress-to="<?= min(100, ($stats['sections_count'] / 5) * 100) ?>"></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4 h-100 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
      <div class="position-absolute top-0 end-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.05) 100%);"></div>
      <div class="position-relative">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="stat-icon bg-success-subtle text-success" style="transition: all 0.3s ease;">
            <svg width="24" height="24" fill="currentColor">
              <use href="#icon-students"></use>
            </svg>
          </div>
          <span class="badge bg-success-subtle text-success"><?= $stats['students_count'] ?></span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-success" data-count-to="<?= $stats['students_count'] ?>">0</h3>
        <p class="text-muted small mb-0">Total Students <?= \Helpers\StaticData::getStaticDataBadge() ?></p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-success" style="width: <?= min(100, ($stats['students_count'] / 50) * 100) ?>%" data-progress-to="<?= min(100, ($stats['students_count'] / 50) * 100) ?>"></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4 h-100 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
      <div class="position-absolute top-0 end-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.05) 100%);"></div>
      <div class="position-relative">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="stat-icon bg-warning-subtle text-warning" style="transition: all 0.3s ease;">
            <svg width="24" height="24" fill="currentColor">
              <use href="#icon-subjects"></use>
            </svg>
          </div>
          <span class="badge bg-warning-subtle text-warning"><?= $stats['subjects_count'] ?></span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-warning" data-count-to="<?= $stats['subjects_count'] ?>">0</h3>
        <p class="text-muted small mb-0">Subjects Taught <?= \Helpers\StaticData::getStaticDataBadge() ?></p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-warning" style="width: <?= min(100, ($stats['subjects_count'] / 3) * 100) ?>%" data-progress-to="<?= min(100, ($stats['subjects_count'] / 3) * 100) ?>"></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4 h-100 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
      <div class="position-absolute top-0 end-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 202, 240, 0.1) 0%, rgba(13, 202, 240, 0.05) 100%);"></div>
      <div class="position-relative">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="stat-icon bg-info-subtle text-info" style="transition: all 0.3s ease;">
            <svg width="24" height="24" fill="currentColor">
              <use href="#icon-alerts"></use>
            </svg>
          </div>
          <span class="badge bg-info-subtle text-info"><?= $stats['alerts_count'] ?></span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-info" data-count-to="<?= $stats['alerts_count'] ?>">0</h3>
        <p class="text-muted small mb-0">Pending Alerts</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-info" style="width: <?= min(100, ($stats['alerts_count'] / 10) * 100) ?>%" data-progress-to="<?= min(100, ($stats['alerts_count'] / 10) * 100) ?>"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <!-- My Sections -->
  <div class="col-lg-8">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">My Sections</h5>
        <span class="text-muted small">Manage your assigned classes</span>
      </div>
      
      <?php if (empty($sections)): ?>
        <!-- Empty state -->
        <div class="text-center py-5">
          <svg class="icon text-muted mb-3" width="48" height="48" fill="currentColor">
            <use href="#icon-sections"></use>
          </svg>
          <h5 class="text-muted">No sections assigned</h5>
          <p class="text-muted">Contact your administrator to get assigned to sections.</p>
        </div>
      <?php else: ?>
        <!-- Real sections data -->
        <div class="row g-3">
          <?php foreach ($sections as $section): ?>
            <div class="col-md-6">
              <div class="action-card d-block p-3 border rounded-3 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.02) 100%);"></div>
                <div class="position-relative">
                  <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary-subtle text-primary" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                      <svg width="20" height="20" fill="currentColor">
                        <use href="#icon-sections"></use>
                      </svg>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold"><?= htmlspecialchars($section['class_name']) ?></div>
                      <div class="text-muted small"><?= htmlspecialchars($section['subject_name']) ?> • <?= $section['student_count'] ?> students</div>
                      <div class="text-muted small">Room: <?= htmlspecialchars($section['room']) ?></div>
                      <?php if ($section['is_adviser']): ?>
                        <span class="badge bg-success-subtle text-success small">Adviser</span>
                      <?php endif; ?>
                      <div class="progress mt-2" style="height: 3px;">
                        <div class="progress-bar bg-primary" style="width: <?= round($section['attendance_rate']) ?>%" data-progress-to="<?= round($section['attendance_rate']) ?>"></div>
                      </div>
                    </div>
                    <div class="d-flex flex-column gap-1">
                      <button class="btn btn-sm btn-outline-primary" onclick="location.href='/teacher/sections'">View</button>
                      <button class="btn btn-sm btn-outline-secondary" onclick="location.href='/teacher/grades'">Grades</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  
  <!-- Recent Activity & Quick Actions -->
  <div class="col-lg-4">
    <div class="surface p-4 mb-4">
      <h5 class="fw-bold mb-4">Recent Activity</h5>
      <div class="activity-list">
        <?php if (empty($activities)): ?>
          <div class="text-center py-3">
            <p class="text-muted small">No recent activity</p>
          </div>
        <?php else: ?>
          <?php foreach ($activities as $activity): ?>
            <div class="activity-item d-flex gap-3 mb-3">
              <svg class="activity-icon" width="20" height="20" fill="currentColor">
                <?php if ($activity['activity_type'] === 'grade_entered'): ?>
                  <use href="#icon-chart"></use>
                <?php elseif ($activity['activity_type'] === 'assignment_created'): ?>
                  <use href="#icon-plus"></use>
                <?php elseif ($activity['activity_type'] === 'attendance_recorded'): ?>
                  <use href="#icon-user"></use>
                <?php else: ?>
                  <use href="#icon-alerts"></use>
                <?php endif; ?>
              </svg>
              <div class="flex-grow-1">
                <div class="small fw-semibold"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $activity['activity_type']))) ?></div>
                <div class="text-muted small"><?= htmlspecialchars($activity['description']) ?></div>
                <div class="text-muted small"><?= date('M j, Y g:i A', strtotime($activity['created_at'])) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Quick Actions</h5>
      <div class="d-grid gap-2">
        <button class="btn btn-outline-primary" onclick="location.href='/grade'">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-chart"></use>
          </svg>
          Manage Grades
        </button>
        <button class="btn btn-outline-secondary" onclick="location.href='/teacher/alerts'">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-alerts"></use>
          </svg>
          View Alerts
        </button>
        <button class="btn btn-outline-info">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-report"></use>
          </svg>
          Generate Report
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Quick Grade Modal -->
<div class="modal fade" id="quickGradeModal" tabindex="-1" aria-labelledby="quickGradeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quickGradeModalLabel">Quick Grade Entry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="quickGradeForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-12">
              <label for="quickSection" class="form-label">Section <span class="text-danger">*</span></label>
              <select class="form-select" id="quickSection" name="section_id" required>
                <option value="">Select Section</option>
                <option value="1">Grade 10-A</option>
                <option value="2">Grade 10-B</option>
                <option value="3">Grade 9-A</option>
              </select>
            </div>
            <div class="col-12">
              <label for="quickSubject" class="form-label">Subject <span class="text-danger">*</span></label>
              <select class="form-select" id="quickSubject" name="subject_id" required>
                <option value="">Select Subject</option>
                <option value="1">Mathematics</option>
                <option value="2">Science</option>
              </select>
            </div>
            <div class="col-12">
              <label for="quickType" class="form-label">Grade Type <span class="text-danger">*</span></label>
              <select class="form-select" id="quickType" name="grade_type" required>
                <option value="">Select Type</option>
                <option value="ww">Written Work</option>
                <option value="pt">Performance Task</option>
                <option value="qe">Quarterly Exam</option>
              </select>
            </div>
            <div class="col-12">
              <label for="quickDescription" class="form-label">Description</label>
              <input type="text" class="form-control" id="quickDescription" name="description" placeholder="e.g., Quiz #1, Assignment #2">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Continue to Grade Entry</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Quick grade form submission
document.getElementById('quickGradeForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const sectionId = document.getElementById('quickSection').value;
  const subjectId = document.getElementById('quickSubject').value;
  const gradeType = document.getElementById('quickType').value;
  const description = document.getElementById('quickDescription').value;
  
  if (sectionId && subjectId && gradeType) {
    // Close modal and redirect to grade entry with parameters
    const modal = bootstrap.Modal.getInstance(document.getElementById('quickGradeModal'));
    modal.hide();
    
    // Redirect to grade entry page with pre-filled data
    const params = new URLSearchParams({
      section_id: sectionId,
      subject_id: subjectId,
      grade_type: gradeType,
      description: description
    });
    
    window.location.href = `/grade?${params.toString()}`;
  }
});
</script>



 
<!-- Teacher Dashboard Scripts -->
<script>
// Initialize counter animations
document.addEventListener('DOMContentLoaded', function() {
  // Animate counters
  const counters = document.querySelectorAll('[data-count-to]');
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-count-to'));
    const duration = 2000; // 2 seconds
    const increment = target / (duration / 16); // 60fps
    let current = 0;
    
    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      counter.textContent = Math.floor(current);
    }, 16);
  });
  
  // Animate progress bars
  const progressBars = document.querySelectorAll('[data-progress-to]');
  progressBars.forEach(bar => {
    const target = parseInt(bar.getAttribute('data-progress-to'));
    const duration = 1500; // 1.5 seconds
    const increment = target / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      bar.style.width = Math.floor(current) + '%';
    }, 16);
  });
});
</script>
 
 