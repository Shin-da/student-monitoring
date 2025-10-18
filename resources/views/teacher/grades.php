<?php /** @var array $user */ ?>
<?php /** @var array $stats */ ?>
<?php /** @var array $sections */ ?>
<?php /** @var array $subjects */ ?>
<?php /** @var array $grades */ ?>
<?php /** @var array $assignments */ ?>
<?php /** @var array $filters */ ?>

<!-- Static Data Indicator -->
<?= $staticDataIndicator ?? '' ?>

<!-- Teacher Grade Management Header -->
<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Grade Management</h1>
      <p class="text-muted mb-0">Manage grades, assignments, and student performance</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bulkGradeModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Bulk Grade Entry
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAssignmentModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Create Assignment
      </button>
    </div>
  </div>
</div>

<!-- Grade Management Summary Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="<?= $stats['total_students'] ?>">0</div>
          <div class="text-muted small">Total Students <?= \Helpers\StaticData::getStaticDataBadge() ?></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-success" width="24" height="24" fill="currentColor">
            <use href="#icon-check"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-success mb-0" data-count-to="<?= $stats['grades_entered'] ?>">0</div>
          <div class="text-muted small">Grades Entered <?= \Helpers\StaticData::getStaticDataBadge() ?></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-warning" width="24" height="24" fill="currentColor">
            <use href="#icon-clock"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-warning mb-0" data-count-to="<?= $stats['pending_grades'] ?>">0</div>
          <div class="text-muted small">Pending Grades <?= \Helpers\StaticData::getStaticDataBadge() ?></div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-performance"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0" data-count-to="<?= $stats['avg_grade'] ?>" data-count-decimals="1">0</div>
          <div class="text-muted small">Average Grade <?= \Helpers\StaticData::getStaticDataBadge() ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Grade Management Filters -->
<div class="surface mb-4">
  <form method="GET" action="/teacher/grades" class="row g-3 align-items-center">
    <div class="col-md-3">
      <label class="form-label">Section</label>
      <select class="form-select" name="section" id="sectionFilter">
        <option value="">All Sections</option>
        <?php foreach ($sections as $section): ?>
          <option value="<?= $section['section_id'] ?>" <?= $filters['section_id'] == $section['section_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($section['class_name']) ?> - <?= htmlspecialchars($section['subject_name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Subject</label>
      <select class="form-select" name="subject" id="subjectFilter">
        <option value="">All Subjects</option>
        <?php foreach ($subjects as $subject): ?>
          <option value="<?= $subject['id'] ?>" <?= $filters['subject_id'] == $subject['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($subject['name']) ?> (Grade <?= $subject['grade_level'] ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Grade Type</label>
      <select class="form-select" name="grade_type" id="gradeTypeFilter">
        <option value="">All Types</option>
        <option value="ww" <?= $filters['grade_type'] == 'ww' ? 'selected' : '' ?>>Written Work</option>
        <option value="pt" <?= $filters['grade_type'] == 'pt' ? 'selected' : '' ?>>Performance Task</option>
        <option value="qe" <?= $filters['grade_type'] == 'qe' ? 'selected' : '' ?>>Quarterly Exam</option>
      </select>
    </div>
    <div class="col-md-3">
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="/teacher/grades" class="btn btn-outline-secondary btn-sm">Clear</a>
      </div>
    </div>
  </form>
</div>

<!-- Grade Management Charts -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Grade Distribution</h5>
        <div class="btn-group btn-group-sm" role="group">
          <input type="radio" class="btn-check" name="chartView" id="distribution" checked>
          <label class="btn btn-outline-primary" for="distribution">Distribution</label>
          <input type="radio" class="btn-check" name="chartView" id="trend">
          <label class="btn btn-outline-primary" for="trend">Trend</label>
        </div>
      </div>
      <div class="chart-container" style="height: 300px;">
        <canvas id="gradeDistributionChart"></canvas>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface">
      <h5 class="mb-4">Performance Summary</h5>
      <div class="d-flex flex-column gap-3">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
              <svg class="icon text-success" width="16" height="16" fill="currentColor">
                <use href="#icon-check"></use>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Passing Rate</div>
              <div class="text-muted small">Students with 75+</div>
            </div>
          </div>
          <div class="badge bg-success">89%</div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
              <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                <use href="#icon-alerts"></use>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Needs Improvement</div>
              <div class="text-muted small">Below 75</div>
            </div>
          </div>
          <div class="badge bg-warning">11%</div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
              <svg class="icon text-info" width="16" height="16" fill="currentColor">
                <use href="#icon-star"></use>
              </svg>
            </div>
            <div>
              <div class="fw-semibold">Excellence</div>
              <div class="text-muted small">90+ grades</div>
            </div>
          </div>
          <div class="badge bg-info">23%</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Grade Management Table -->
<div class="surface">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Student Grades (<?= count($grades) ?> entries)</h5>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-secondary btn-sm" onclick="exportGrades()">
        <svg class="icon me-1" width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        Export
      </button>
      <button class="btn btn-outline-primary btn-sm" onclick="refreshGrades()">
        <svg class="icon me-1" width="16" height="16" fill="currentColor">
          <use href="#icon-refresh"></use>
        </svg>
        Refresh
      </button>
    </div>
  </div>
  
  <?php if (empty($grades)): ?>
    <!-- Empty state -->
    <div class="text-center py-5">
      <svg class="icon text-muted mb-3" width="64" height="64" fill="currentColor">
        <use href="#icon-chart"></use>
      </svg>
      <h4 class="text-muted mb-3">No Grades Found</h4>
      <p class="text-muted mb-4">
        <?php if (!empty($filters['section_id']) || !empty($filters['subject_id']) || !empty($filters['grade_type'])): ?>
          No grades match your current filters. Try adjusting your search criteria.
        <?php else: ?>
          You haven't entered any grades yet. Create an assignment and start grading!
        <?php endif; ?>
      </p>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAssignmentModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Create Assignment
      </button>
    </div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover" id="gradesTable">
        <thead class="table-light">
          <tr>
            <th>Student</th>
            <th>Section</th>
            <th>Subject</th>
            <th>Assignment</th>
            <th>Type</th>
            <th>Grade</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($grades as $grade): ?>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                    <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                      <use href="#icon-user"></use>
                    </svg>
                  </div>
                  <div>
                    <div class="fw-semibold"><?= htmlspecialchars($grade['student_name']) ?></div>
                    <div class="text-muted small">LRN: <?= htmlspecialchars($grade['lrn']) ?></div>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge bg-primary"><?= htmlspecialchars($grade['class_name']) ?></span>
              </td>
              <td><?= htmlspecialchars($grade['subject_name']) ?></td>
              <td><?= htmlspecialchars($grade['description'] ?: 'Manual Entry') ?></td>
              <td>
                <span class="badge bg-info">
                  <?php
                  switch($grade['grade_type']) {
                    case 'ww': echo 'WW'; break;
                    case 'pt': echo 'PT'; break;
                    case 'qe': echo 'QE'; break;
                    default: echo strtoupper($grade['grade_type']);
                  }
                  ?>
                </span>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="fw-semibold <?= $grade['grade_value'] >= 75 ? 'text-success' : 'text-danger' ?> me-2">
                    <?= round($grade['grade_value'], 1) ?>
                  </span>
                  <div class="progress" style="width: 60px; height: 6px;">
                    <div class="progress-bar <?= $grade['grade_value'] >= 75 ? 'bg-success' : 'bg-danger' ?>" 
                         style="width: <?= min(100, ($grade['grade_value'] / $grade['max_score']) * 100) ?>%"></div>
                  </div>
                </div>
                <div class="text-muted small">/ <?= $grade['max_score'] ?></div>
              </td>
              <td>
                <span class="badge <?= $grade['status'] == 'passing' ? 'bg-success' : 'bg-danger' ?>">
                  <?= ucfirst($grade['status']) ?>
                </span>
              </td>
              <td>
                <div class="text-muted small">
                  <?= date('M j, Y', strtotime($grade['graded_at'])) ?>
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="editGrade(<?= $grade['id'] ?>)">Edit Grade</a></li>
                    <li><a class="dropdown-item" href="#" onclick="viewGradeDetails(<?= $grade['id'] ?>)">View Details</a></li>
                    <li><a class="dropdown-item" href="#" onclick="deleteGrade(<?= $grade['id'] ?>)">Delete Grade</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<!-- Assignments Section -->
<?php if (!empty($assignments)): ?>
<div class="surface mb-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Recent Assignments (<?= count($assignments) ?>)</h5>
    <button class="btn btn-outline-primary btn-sm" onclick="location.href='/teacher/assignments'">
      <svg class="icon me-1" width="16" height="16" fill="currentColor">
        <use href="#icon-plus"></use>
      </svg>
      View All
    </button>
  </div>
  
  <div class="row g-3">
    <?php foreach (array_slice($assignments, 0, 3) as $assignment): ?>
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h6 class="card-title mb-0"><?= htmlspecialchars($assignment['title']) ?></h6>
              <span class="badge bg-info">
                <?php
                switch($assignment['assignment_type']) {
                  case 'ww': echo 'WW'; break;
                  case 'pt': echo 'PT'; break;
                  case 'qe': echo 'QE'; break;
                  default: echo strtoupper($assignment['assignment_type']);
                }
                ?>
              </span>
            </div>
            <p class="card-text small text-muted mb-2">
              <?= htmlspecialchars($assignment['subject_name']) ?> - <?= htmlspecialchars($assignment['class_name']) ?>
            </p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="small text-muted">
                Due: <?= $assignment['due_date'] ? date('M j', strtotime($assignment['due_date'])) : 'No due date' ?>
              </div>
              <div class="small text-muted">
                <?= $assignment['grades_count'] ?>/<?= $assignment['total_students'] ?> graded
              </div>
            </div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-primary" style="width: <?= $assignment['total_students'] > 0 ? ($assignment['grades_count'] / $assignment['total_students']) * 100 : 0 ?>%"></div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<!-- Bulk Grade Entry Modal -->
<div class="modal fade" id="bulkGradeModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bulk Grade Entry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="bulkGradeForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Section</label>
              <select class="form-select" name="section_id" required>
                <option value="">Select Section</option>
                <?php foreach ($sections as $section): ?>
                  <option value="<?= $section['section_id'] ?>">
                    <?= htmlspecialchars($section['class_name']) ?> - <?= htmlspecialchars($section['subject_name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select class="form-select" name="subject_id" required>
                <option value="">Select Subject</option>
                <?php foreach ($subjects as $subject): ?>
                  <option value="<?= $subject['id'] ?>">
                    <?= htmlspecialchars($subject['name']) ?> (Grade <?= $subject['grade_level'] ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Grade Type</label>
              <select class="form-select" name="grade_type" required>
                <option value="">Select Type</option>
                <option value="ww">Written Work</option>
                <option value="pt">Performance Task</option>
                <option value="qe">Quarterly Exam</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Assignment</label>
              <input type="text" class="form-control" name="description" placeholder="e.g., Quiz #1" required>
            </div>
            <div class="col-12">
              <label class="form-label">Max Points</label>
              <input type="number" class="form-control" name="max_score" placeholder="100" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="proceedToBulkEntry()">Proceed to Grade Entry</button>
      </div>
    </div>
  </div>
</div>

<!-- Create Assignment Modal -->
<div class="modal fade" id="createAssignmentModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Assignment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="createAssignmentForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Assignment Title</label>
              <input type="text" class="form-control" name="title" placeholder="e.g., Algebra Quiz #3" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select class="form-select" name="subject_id" required>
                <option value="">Select Subject</option>
                <?php foreach ($subjects as $subject): ?>
                  <option value="<?= $subject['id'] ?>">
                    <?= htmlspecialchars($subject['name']) ?> (Grade <?= $subject['grade_level'] ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Grade Type</label>
              <select class="form-select" name="assignment_type" required>
                <option value="">Select Type</option>
                <option value="ww">Written Work</option>
                <option value="pt">Performance Task</option>
                <option value="qe">Quarterly Exam</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Max Points</label>
              <input type="number" class="form-control" name="max_score" placeholder="100" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Due Date</label>
              <input type="date" class="form-control" name="due_date" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Section</label>
              <select class="form-select" name="section_id" required>
                <option value="">Select Section</option>
                <?php foreach ($sections as $section): ?>
                  <option value="<?= $section['section_id'] ?>">
                    <?= htmlspecialchars($section['class_name']) ?> - <?= htmlspecialchars($section['subject_name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" name="description" rows="3" placeholder="Assignment description and instructions..."></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="createAssignment()">Create Assignment</button>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js and Teacher Grade Management Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Teacher Grade Management
class TeacherGradeManagement {
  constructor() {
    this.charts = {};
    this.selectedGrades = [];
    this.init();
  }

  init() {
    this.initializeCharts();
    this.bindEvents();
    this.loadGradeData();
  }

  initializeCharts() {
    // Grade Distribution Chart
    const distributionCtx = document.getElementById('gradeDistributionChart');
    if (distributionCtx) {
      this.charts.gradeDistribution = new Chart(distributionCtx, {
        type: 'bar',
        data: {
          labels: ['A (90-100)', 'B (80-89)', 'C (70-79)', 'D (60-69)', 'F (Below 60)'],
          datasets: [{
            label: 'Number of Students',
            data: [15, 25, 18, 8, 3],
            backgroundColor: [
              'rgba(25, 135, 84, 0.8)',
              'rgba(13, 110, 253, 0.8)',
              'rgba(255, 193, 7, 0.8)',
              'rgba(255, 152, 0, 0.8)',
              'rgba(220, 53, 69, 0.8)'
            ],
            borderColor: [
              'rgba(25, 135, 84, 1)',
              'rgba(13, 110, 253, 1)',
              'rgba(255, 193, 7, 1)',
              'rgba(255, 152, 0, 1)',
              'rgba(220, 53, 69, 1)'
            ],
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            }
          }
        }
      });
    }
  }

  bindEvents() {
    // Filter changes
    document.getElementById('sectionFilter').addEventListener('change', () => this.filterGrades());
    document.getElementById('subjectFilter').addEventListener('change', () => this.filterGrades());
    document.getElementById('gradeTypeFilter').addEventListener('change', () => this.filterGrades());

    // Quarter change
    document.querySelectorAll('input[name="quarter"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.loadGradeData(e.target.value);
      });
    });

    // Chart view change
    document.querySelectorAll('input[name="chartView"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.updateChartView(e.target.value);
      });
    });

    // Select all checkbox
    document.getElementById('selectAll').addEventListener('change', (e) => {
      this.toggleSelectAll(e.target.checked);
    });

    // Individual checkboxes
    document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
      checkbox.addEventListener('change', () => this.updateSelectedGrades());
    });
  }

  loadGradeData(quarter = 1) {
    // Simulate loading grade data based on quarter
    console.log(`Loading grade data for quarter ${quarter}`);
    this.updateCharts();
  }

  filterGrades() {
    const section = document.getElementById('sectionFilter').value;
    const subject = document.getElementById('subjectFilter').value;
    const gradeType = document.getElementById('gradeTypeFilter').value;

    const rows = document.querySelectorAll('#gradesTable tbody tr');
    rows.forEach(row => {
      let show = true;

      if (section && !row.querySelector('td:nth-child(3)').textContent.includes(section)) {
        show = false;
      }
      if (subject && !row.querySelector('td:nth-child(4)').textContent.includes(subject)) {
        show = false;
      }
      if (gradeType && !row.querySelector('td:nth-child(6)').textContent.includes(gradeType.toUpperCase())) {
        show = false;
      }

      row.style.display = show ? '' : 'none';
    });
  }

  updateChartView(view) {
    if (view === 'trend') {
      // Update chart to show trend over time
      if (this.charts.gradeDistribution) {
        this.charts.gradeDistribution.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'];
        this.charts.gradeDistribution.data.datasets[0].data = [82, 85, 87, 84, 86];
        this.charts.gradeDistribution.update();
      }
    } else {
      // Update chart to show distribution
      if (this.charts.gradeDistribution) {
        this.charts.gradeDistribution.data.labels = ['A (90-100)', 'B (80-89)', 'C (70-79)', 'D (60-69)', 'F (Below 60)'];
        this.charts.gradeDistribution.data.datasets[0].data = [15, 25, 18, 8, 3];
        this.charts.gradeDistribution.update();
      }
    }
  }

  updateCharts() {
    // Update charts with new data
    if (this.charts.gradeDistribution) {
      this.charts.gradeDistribution.update();
    }
  }

  toggleSelectAll(checked) {
    document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
      checkbox.checked = checked;
    });
    this.updateSelectedGrades();
  }

  updateSelectedGrades() {
    this.selectedGrades = Array.from(document.querySelectorAll('input[type="checkbox"][value]:checked'))
      .map(checkbox => checkbox.value);
    console.log('Selected grades:', this.selectedGrades);
  }
}

// Global functions
function editGrade(gradeId) {
  showNotification(`Editing grade ${gradeId}...`, { type: 'info' });
  // Open edit grade modal or redirect to edit page
}

function viewGradeDetails(gradeId) {
  showNotification(`Viewing grade details ${gradeId}...`, { type: 'info' });
  // Open grade details modal
}

function deleteGrade(gradeId) {
  if (confirm('Are you sure you want to delete this grade?')) {
    showNotification(`Grade ${gradeId} deleted successfully!`, { type: 'success' });
  }
}

function enterGrade(gradeId) {
  showNotification(`Opening grade entry for ${gradeId}...`, { type: 'info' });
  // Open grade entry modal
}

function sendReminder(gradeId) {
  showNotification(`Reminder sent for grade ${gradeId}!`, { type: 'success' });
}

function proceedToBulkEntry() {
  showNotification('Redirecting to bulk grade entry...', { type: 'info' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('bulkGradeModal'));
  modal.hide();
  // Redirect to bulk grade entry page
}

function createAssignment() {
  showNotification('Assignment created successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('createAssignmentModal'));
  modal.hide();
}

function exportGrades() {
  showNotification('Exporting grades...', { type: 'info' });
  setTimeout(() => {
    showNotification('Grades exported successfully!', { type: 'success' });
  }, 2000);
}

function refreshGrades() {
  if (window.teacherGradeManagementInstance) {
    window.teacherGradeManagementInstance.loadGradeData();
    showNotification('Grades refreshed successfully!', { type: 'success' });
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.teacherGradeManagementInstance = new TeacherGradeManagement();
});
</script>

<style>
/* Teacher Grade Management Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.chart-container {
  position: relative;
  max-height: 300px;
  overflow: hidden;
}

.table-hover tbody tr:hover {
  background-color: var(--bs-table-hover-bg);
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
