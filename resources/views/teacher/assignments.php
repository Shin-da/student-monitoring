<?php /** @var array $user */ ?>
<?php /** @var array $stats */ ?>
<?php /** @var array $sections */ ?>
<?php /** @var array $subjects */ ?>
<?php /** @var array $assignments */ ?>
<?php /** @var array $filters */ ?>

<!-- Static Data Indicator -->
<?= $staticDataIndicator ?? '' ?>

<!-- Teacher Assignment Management Header -->
<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Assignment Management</h1>
      <p class="text-muted mb-0">Create, manage, and track student assignments</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bulkAssignmentModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Bulk Create
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

<!-- Assignment Statistics Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-plus"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="<?= $stats['total_assignments'] ?>">0</div>
          <div class="text-muted small">Total Assignments</div>
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
          <div class="h4 fw-bold text-success mb-0" data-count-to="<?= $stats['completed_assignments'] ?>">0</div>
          <div class="text-muted small">Completed</div>
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
          <div class="h4 fw-bold text-warning mb-0" data-count-to="<?= $stats['active_assignments'] ?>">0</div>
          <div class="text-muted small">Active</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0" data-count-to="<?= $stats['overdue_assignments'] ?>">0</div>
          <div class="text-muted small">Overdue</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Assignment Filters and Search -->
<div class="surface mb-4">
  <form method="GET" action="/teacher/assignments" class="row g-3 align-items-center">
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
      <label class="form-label">Class</label>
      <select class="form-select" name="section" id="classFilter">
        <option value="">All Classes</option>
        <?php foreach ($sections as $section): ?>
          <option value="<?= $section['section_id'] ?>" <?= $filters['section_id'] == $section['section_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($section['class_name']) ?> - <?= htmlspecialchars($section['subject_name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Status</label>
      <select class="form-select" name="status" id="statusFilter">
        <option value="">All Status</option>
        <option value="active" <?= $filters['status'] == 'active' ? 'selected' : '' ?>>Active</option>
        <option value="completed" <?= $filters['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
        <option value="overdue" <?= $filters['status'] == 'overdue' ? 'selected' : '' ?>>Overdue</option>
      </select>
    </div>
    <div class="col-md-3">
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        <a href="/teacher/assignments" class="btn btn-outline-secondary btn-sm">Clear</a>
      </div>
    </div>
  </form>
</div>

<!-- Assignment Management Tabs -->
<div class="surface mb-4">
  <ul class="nav nav-tabs" id="assignmentTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="all-assignments-tab" data-bs-toggle="tab" data-bs-target="#all-assignments" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-list"></use>
        </svg>
        All Assignments
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="active-assignments-tab" data-bs-toggle="tab" data-bs-target="#active-assignments" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-clock"></use>
        </svg>
        Active
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="completed-assignments-tab" data-bs-toggle="tab" data-bs-target="#completed-assignments" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-check"></use>
        </svg>
        Completed
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="overdue-assignments-tab" data-bs-toggle="tab" data-bs-target="#overdue-assignments" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-alerts"></use>
        </svg>
        Overdue
      </button>
    </li>
  </ul>
  
  <div class="tab-content" id="assignmentTabsContent">
    <!-- All Assignments Tab -->
    <div class="tab-pane fade show active" id="all-assignments" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">All Assignments</h5>
          <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm" onclick="exportAssignments()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-download"></use>
              </svg>
              Export
            </button>
            <button class="btn btn-outline-primary btn-sm" onclick="refreshAssignments()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-refresh"></use>
              </svg>
              Refresh
            </button>
          </div>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover" id="assignmentsTable">
            <thead class="table-light">
              <tr>
                <th>Assignment</th>
                <th>Subject</th>
                <th>Class</th>
                <th>Due Date</th>
                <th>Progress</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($assignments)): ?>
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <svg class="icon text-muted mb-3" width="64" height="64" fill="currentColor">
                      <use href="#icon-plus"></use>
                    </svg>
                    <h4 class="text-muted mb-3">No Assignments Found</h4>
                    <p class="text-muted mb-4">
                      <?php if (!empty($filters['section_id']) || !empty($filters['subject_id']) || !empty($filters['status'])): ?>
                        No assignments match your current filters. Try adjusting your search criteria.
                      <?php else: ?>
                        You haven't created any assignments yet. Create your first assignment to get started!
                      <?php endif; ?>
                    </p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAssignmentModal">
                      <svg class="icon me-2" width="16" height="16" fill="currentColor">
                        <use href="#icon-plus"></use>
                      </svg>
                      Create Assignment
                    </button>
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($assignments as $assignment): ?>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                          <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                            <use href="#icon-plus"></use>
                          </svg>
                        </div>
                        <div>
                          <div class="fw-semibold"><?= htmlspecialchars($assignment['title']) ?></div>
                          <div class="text-muted small"><?= htmlspecialchars($assignment['subject_name']) ?> • <?= $assignment['max_score'] ?> points</div>
                        </div>
                      </div>
                    </td>
                    <td><span class="badge bg-primary"><?= htmlspecialchars($assignment['subject_name']) ?></span></td>
                    <td><span class="badge bg-info"><?= htmlspecialchars($assignment['class_name']) ?></span></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                          <use href="#icon-calendar"></use>
                        </svg>
                        <span><?= $assignment['due_date'] ? date('M j, Y', strtotime($assignment['due_date'])) : 'No due date' ?></span>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="progress me-2" style="width: 60px; height: 6px;">
                          <div class="progress-bar <?= $assignment['completion_percentage'] >= 80 ? 'bg-success' : ($assignment['completion_percentage'] >= 50 ? 'bg-warning' : 'bg-danger') ?>" 
                               style="width: <?= $assignment['completion_percentage'] ?>%"></div>
                        </div>
                        <span class="small"><?= $assignment['graded_students'] ?>/<?= $assignment['total_students'] ?></span>
                      </div>
                    </td>
                    <td>
                      <span class="badge <?= $assignment['status'] == 'active' ? 'bg-success' : ($assignment['status'] == 'overdue' ? 'bg-danger' : 'bg-warning') ?>">
                        <?= ucfirst($assignment['status']) ?>
                      </span>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                          <svg class="icon" width="16" height="16" fill="currentColor">
                            <use href="#icon-more"></use>
                          </svg>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#" onclick="viewAssignment(<?= $assignment['id'] ?>)">View Details</a></li>
                          <li><a class="dropdown-item" href="#" onclick="editAssignment(<?= $assignment['id'] ?>)">Edit Assignment</a></li>
                          <li><a class="dropdown-item" href="#" onclick="gradeAssignment(<?= $assignment['id'] ?>)">Grade Students</a></li>
                          <li><a class="dropdown-item" href="#" onclick="duplicateAssignment(<?= $assignment['id'] ?>)">Duplicate</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item text-danger" href="#" onclick="deleteAssignment(<?= $assignment['id'] ?>)">Delete</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Active Assignments Tab -->
    <div class="tab-pane fade" id="active-assignments" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Active Assignments</h5>
          <span class="badge bg-primary">4 assignments</span>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h6 class="fw-bold text-primary mb-1">Algebra Quiz #3</h6>
                  <p class="text-muted small mb-0">Mathematics • Grade 10-A</p>
                </div>
                <span class="badge bg-primary">Active</span>
              </div>
              
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Due Date</span>
                  <span class="small text-muted">Dec 20, 2024</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Progress</span>
                  <span class="small text-muted">42/50 students</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-success" style="width: 84%"></div>
                </div>
              </div>
              
              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-sm" onclick="gradeAssignment(1)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  Grade Students
                </button>
                <button class="btn btn-outline-secondary btn-sm" onclick="viewAssignment(1)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-eye"></use>
                  </svg>
                  View Details
                </button>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6">
            <div class="surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h6 class="fw-bold text-warning mb-1">English Essay</h6>
                  <p class="text-muted small mb-0">English • Grade 10-B</p>
                </div>
                <span class="badge bg-warning">Active</span>
              </div>
              
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Due Date</span>
                  <span class="small text-muted">Dec 18, 2024</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Progress</span>
                  <span class="small text-muted">23/38 students</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-warning" style="width: 60%"></div>
                </div>
              </div>
              
              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-sm" onclick="gradeAssignment(3)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  Grade Students
                </button>
                <button class="btn btn-outline-secondary btn-sm" onclick="viewAssignment(3)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-eye"></use>
                  </svg>
                  View Details
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Completed Assignments Tab -->
    <div class="tab-pane fade" id="completed-assignments" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Completed Assignments</h5>
          <span class="badge bg-success">18 assignments</span>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Assignment</th>
                <th>Subject</th>
                <th>Class</th>
                <th>Completed Date</th>
                <th>Average Grade</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-success" width="16" height="16" fill="currentColor">
                        <use href="#icon-check"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Science Lab Report</div>
                      <div class="text-muted small">100 points</div>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-success">Science</span></td>
                <td><span class="badge bg-info">Grade 9-A</span></td>
                <td>Dec 15, 2024</td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="fw-semibold text-success me-2">87.5</span>
                    <div class="progress" style="width: 60px; height: 6px;">
                      <div class="progress-bar bg-success" style="width: 87.5%"></div>
                    </div>
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
                      <li><a class="dropdown-item" href="#" onclick="viewAssignment(2)">View Details</a></li>
                      <li><a class="dropdown-item" href="#" onclick="viewGrades(2)">View Grades</a></li>
                      <li><a class="dropdown-item" href="#" onclick="duplicateAssignment(2)">Duplicate</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Overdue Assignments Tab -->
    <div class="tab-pane fade" id="overdue-assignments" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Overdue Assignments</h5>
          <span class="badge bg-danger">2 assignments</span>
        </div>
        
        <div class="alert alert-warning" role="alert">
          <div class="d-flex align-items-center">
            <svg class="icon me-2" width="20" height="20" fill="currentColor">
              <use href="#icon-alerts"></use>
            </svg>
            <div>
              <strong>Attention:</strong> You have 2 assignments that are overdue. Please review and take appropriate action.
            </div>
          </div>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="surface p-4 border-danger">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h6 class="fw-bold text-danger mb-1">Math Problem Set #5</h6>
                  <p class="text-muted small mb-0">Mathematics • Grade 10-A</p>
                </div>
                <span class="badge bg-danger">Overdue</span>
              </div>
              
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Due Date</span>
                  <span class="small text-danger">Dec 10, 2024</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Progress</span>
                  <span class="small text-muted">35/50 students</span>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-danger" style="width: 70%"></div>
                </div>
              </div>
              
              <div class="d-grid gap-2">
                <button class="btn btn-danger btn-sm" onclick="handleOverdue(1)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-alerts"></use>
                  </svg>
                  Handle Overdue
                </button>
                <button class="btn btn-outline-secondary btn-sm" onclick="viewAssignment(1)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-eye"></use>
                  </svg>
                  View Details
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Create Assignment Modal -->
<div class="modal fade" id="createAssignmentModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create New Assignment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="createAssignmentForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Assignment Title</label>
              <input type="text" class="form-control" placeholder="e.g., Algebra Quiz #3" required>
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
              <label class="form-label">Assignment Type</label>
              <select class="form-select" name="assignment_type" required>
                <option value="">Select Type</option>
                <option value="ww">Written Work</option>
                <option value="pt">Performance Task</option>
                <option value="qe">Quarterly Exam</option>
                <option value="quiz">Quiz</option>
                <option value="project">Project</option>
                <option value="lab">Lab Activity</option>
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
            <div class="col-12">
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
              <label class="form-label">Instructions</label>
              <textarea class="form-control" rows="4" placeholder="Assignment instructions and requirements..."></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Attachments</label>
              <input type="file" class="form-control" multiple accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.png">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-primary" onclick="saveAsDraft()">Save as Draft</button>
        <button type="button" class="btn btn-primary" onclick="createAssignment()">Create Assignment</button>
      </div>
    </div>
  </div>
</div>

<!-- Bulk Assignment Modal -->
<div class="modal fade" id="bulkAssignmentModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bulk Create Assignments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="bulkAssignmentForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select class="form-select" required>
                <option value="">Select Subject</option>
                <option value="mathematics">Mathematics</option>
                <option value="science">Science</option>
                <option value="english">English</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Assignment Type</label>
              <select class="form-select" required>
                <option value="">Select Type</option>
                <option value="quiz">Quiz</option>
                <option value="assignment">Assignment</option>
                <option value="project">Project</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Upload CSV File</label>
              <input type="file" class="form-control" accept=".csv" required>
              <div class="form-text">Upload a CSV file with assignment details. <a href="#" onclick="downloadTemplate()">Download template</a></div>
            </div>
            <div class="col-12">
              <label class="form-label">Classes</label>
              <select class="form-select" multiple required>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="processBulkAssignments()">Process Assignments</button>
      </div>
    </div>
  </div>
</div>

<script>
// Teacher Assignment Management
class TeacherAssignmentManagement {
  constructor() {
    this.selectedAssignments = [];
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadAssignmentData();
  }

  bindEvents() {
    // Filter changes
    document.getElementById('subjectFilter').addEventListener('change', () => this.filterAssignments());
    document.getElementById('classFilter').addEventListener('change', () => this.filterAssignments());
    document.getElementById('statusFilter').addEventListener('change', () => this.filterAssignments());

    // Search
    document.getElementById('assignmentSearch').addEventListener('input', (e) => {
      this.searchAssignments(e.target.value);
    });

    // Select all assignments
    document.getElementById('selectAllAssignments').addEventListener('change', (e) => {
      this.toggleSelectAllAssignments(e.target.checked);
    });

    // Individual assignment checkboxes
    document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
      checkbox.addEventListener('change', () => this.updateSelectedAssignments());
    });
  }

  loadAssignmentData() {
    console.log('Loading assignment data...');
    // Load assignment data from API
  }

  filterAssignments() {
    const subject = document.getElementById('subjectFilter').value;
    const className = document.getElementById('classFilter').value;
    const status = document.getElementById('statusFilter').value;

    const rows = document.querySelectorAll('#assignmentsTable tbody tr');
    rows.forEach(row => {
      let show = true;

      if (subject && !row.querySelector('td:nth-child(3)').textContent.toLowerCase().includes(subject.toLowerCase())) {
        show = false;
      }
      if (className && !row.querySelector('td:nth-child(4)').textContent.toLowerCase().includes(className.toLowerCase())) {
        show = false;
      }
      if (status && !row.querySelector('td:nth-child(7)').textContent.toLowerCase().includes(status.toLowerCase())) {
        show = false;
      }

      row.style.display = show ? '' : 'none';
    });
  }

  searchAssignments(searchTerm) {
    const rows = document.querySelectorAll('#assignmentsTable tbody tr');
    rows.forEach(row => {
      const assignmentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
      
      if (assignmentName.includes(searchTerm.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  toggleSelectAllAssignments(checked) {
    document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
      checkbox.checked = checked;
    });
    this.updateSelectedAssignments();
  }

  updateSelectedAssignments() {
    this.selectedAssignments = Array.from(document.querySelectorAll('input[type="checkbox"][value]:checked'))
      .map(checkbox => checkbox.value);
    console.log('Selected assignments:', this.selectedAssignments);
  }
}

// Global functions
function viewAssignment(assignmentId) {
  showNotification(`Viewing assignment ${assignmentId}...`, { type: 'info' });
}

function editAssignment(assignmentId) {
  showNotification(`Editing assignment ${assignmentId}...`, { type: 'info' });
}

function gradeAssignment(assignmentId) {
  showNotification(`Opening grade entry for assignment ${assignmentId}...`, { type: 'info' });
}

function duplicateAssignment(assignmentId) {
  showNotification(`Duplicating assignment ${assignmentId}...`, { type: 'info' });
}

function deleteAssignment(assignmentId) {
  if (confirm('Are you sure you want to delete this assignment?')) {
    showNotification(`Assignment ${assignmentId} deleted successfully!`, { type: 'success' });
  }
}

function viewGrades(assignmentId) {
  showNotification(`Viewing grades for assignment ${assignmentId}...`, { type: 'info' });
}

function handleOverdue(assignmentId) {
  showNotification(`Handling overdue assignment ${assignmentId}...`, { type: 'info' });
}

function createAssignment() {
  showNotification('Assignment created successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('createAssignmentModal'));
  modal.hide();
}

function saveAsDraft() {
  showNotification('Assignment saved as draft!', { type: 'info' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('createAssignmentModal'));
  modal.hide();
}

function processBulkAssignments() {
  showNotification('Processing bulk assignments...', { type: 'info' });
  setTimeout(() => {
    showNotification('Bulk assignments created successfully!', { type: 'success' });
  }, 2000);
  const modal = bootstrap.Modal.getInstance(document.getElementById('bulkAssignmentModal'));
  modal.hide();
}

function downloadTemplate() {
  showNotification('Downloading CSV template...', { type: 'info' });
}

function exportAssignments() {
  showNotification('Exporting assignments...', { type: 'info' });
  setTimeout(() => {
    showNotification('Assignments exported successfully!', { type: 'success' });
  }, 2000);
}

function refreshAssignments() {
  if (window.teacherAssignmentManagementInstance) {
    window.teacherAssignmentManagementInstance.loadAssignmentData();
    showNotification('Assignments refreshed successfully!', { type: 'success' });
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.teacherAssignmentManagementInstance = new TeacherAssignmentManagement();
});
</script>

<style>
/* Teacher Assignment Management Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}

.table-hover tbody tr:hover {
  background-color: var(--bs-table-hover-bg);
}

.badge {
  font-size: 0.75em;
}

.nav-tabs .nav-link {
  border: none;
  border-bottom: 2px solid transparent;
}

.nav-tabs .nav-link.active {
  border-bottom-color: var(--bs-primary);
  background-color: transparent;
}

.nav-tabs .nav-link:hover {
  border-bottom-color: var(--bs-primary);
  background-color: transparent;
}

.progress {
  transition: width 0.6s ease;
}

.border-danger {
  border-left: 4px solid var(--bs-danger) !important;
}
</style>
