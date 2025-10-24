<?php
$title = 'My Assignments';
?>

<!-- Student Assignments Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">My Assignments</h1>
      <p class="text-muted mb-0">Track your assignments, deadlines, and submissions</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#assignmentFiltersModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-filter"></use>
        </svg>
        Filters
      </button>
      <button class="btn btn-primary" onclick="refreshAssignments()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-refresh"></use>
        </svg>
        Refresh
      </button>
    </div>
  </div>
</div>

<!-- Assignment Summary Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface p-3 stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-plus"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="12">0</div>
          <div class="text-muted small">Total Assignments</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface p-3 stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-success" width="24" height="24" fill="currentColor">
            <use href="#icon-check"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-success mb-0" data-count-to="8">0</div>
          <div class="text-muted small">Completed</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface p-3 stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-warning" width="24" height="24" fill="currentColor">
            <use href="#icon-clock"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-warning mb-0" data-count-to="3">0</div>
          <div class="text-muted small">Pending</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface p-3 stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-danger bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-danger" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-danger mb-0" data-count-to="1">0</div>
          <div class="text-muted small">Overdue</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Assignment Filters -->
<div class="surface p-3 mb-4">
  <div class="row g-3 align-items-center">
    <div class="col-md-3">
      <label class="form-label">Subject</label>
      <select class="form-select" id="subjectFilter">
        <option value="">All Subjects</option>
        <option value="mathematics">Mathematics</option>
        <option value="science">Science</option>
        <option value="english">English</option>
        <option value="filipino">Filipino</option>
        <option value="history">History</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Status</label>
      <select class="form-select" id="statusFilter">
        <option value="">All Status</option>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
        <option value="overdue">Overdue</option>
        <option value="graded">Graded</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Due Date</label>
      <select class="form-select" id="dueDateFilter">
        <option value="">All Dates</option>
        <option value="today">Today</option>
        <option value="week">This Week</option>
        <option value="month">This Month</option>
        <option value="overdue">Overdue</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Type</label>
      <select class="form-select" id="typeFilter">
        <option value="">All Types</option>
        <option value="quiz">Quiz</option>
        <option value="assignment">Assignment</option>
        <option value="project">Project</option>
        <option value="exam">Exam</option>
      </select>
    </div>
  </div>
</div>

<!-- Assignment Timeline -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="surface p-4 ">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Assignment Timeline</h5>
        <div class="btn-group btn-group-sm" role="group">
          <input type="radio" class="btn-check" name="timelineView" id="listView" checked>
          <label class="btn btn-outline-primary" for="listView">List</label>
          <input type="radio" class="btn-check" name="timelineView" id="calendarView">
          <label class="btn btn-outline-primary" for="calendarView">Calendar</label>
        </div>
      </div>
      
      <div id="assignmentsList">
        <!-- Upcoming Assignments -->
        <div class="mb-4">
          <h6 class="text-primary mb-3">
            <svg class="icon me-2" width="16" height="16" fill="currentColor">
              <use href="#icon-clock"></use>
            </svg>
            Upcoming Assignments
          </h6>
          
          <div class="assignment-item border rounded-3 p-3 mb-3">
            <div class="d-flex justify-content-between align-items-start">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                    <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                      <use href="#icon-chart"></use>
                    </svg>
                  </div>
                  <div>
                    <h6 class="mb-1">Mathematics Quiz #4</h6>
                    <div class="text-muted small">Algebra and Geometry</div>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-4">
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-calendar"></use>
                    </svg>
                    <span class="text-muted small">Due: Jan 30, 2024</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-clock"></use>
                    </svg>
                    <span class="text-muted small">2 days left</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-user"></use>
                    </svg>
                    <span class="text-muted small">Ms. Johnson</span>
                  </div>
                </div>
              </div>
              <div class="d-flex gap-2">
                <span class="badge bg-warning">Pending</span>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewAssignmentDetails('math-quiz-4')">View Details</a></li>
                    <li><a class="dropdown-item" href="#" onclick="submitAssignment('math-quiz-4')">Submit Assignment</a></li>
                    <li><a class="dropdown-item" href="#" onclick="contactTeacher('mathematics')">Contact Teacher</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          <div class="assignment-item border rounded-3 p-3 mb-3">
            <div class="d-flex justify-content-between align-items-start">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                    <svg class="icon text-success" width="16" height="16" fill="currentColor">
                      <use href="#icon-star"></use>
                    </svg>
                  </div>
                  <div>
                    <h6 class="mb-1">Science Project</h6>
                    <div class="text-muted small">Environmental Impact Study</div>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-4">
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-calendar"></use>
                    </svg>
                    <span class="text-muted small">Due: Feb 5, 2024</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-clock"></use>
                    </svg>
                    <span class="text-muted small">1 week left</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-user"></use>
                    </svg>
                    <span class="text-muted small">Mr. Smith</span>
                  </div>
                </div>
              </div>
              <div class="d-flex gap-2">
                <span class="badge bg-info">In Progress</span>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewAssignmentDetails('science-project')">View Details</a></li>
                    <li><a class="dropdown-item" href="#" onclick="submitAssignment('science-project')">Submit Assignment</a></li>
                    <li><a class="dropdown-item" href="#" onclick="contactTeacher('science')">Contact Teacher</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Recent Assignments -->
        <div class="mb-4">
          <h6 class="text-success mb-3">
            <svg class="icon me-2" width="16" height="16" fill="currentColor">
              <use href="#icon-check"></use>
            </svg>
            Recent Assignments
          </h6>
          
          <div class="assignment-item border rounded-3 p-3 mb-3">
            <div class="d-flex justify-content-between align-items-start">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                    <svg class="icon text-success" width="16" height="16" fill="currentColor">
                      <use href="#icon-check"></use>
                    </svg>
                  </div>
                  <div>
                    <h6 class="mb-1">English Essay</h6>
                    <div class="text-muted small">Argumentative Essay</div>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-4">
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-calendar"></use>
                    </svg>
                    <span class="text-muted small">Submitted: Jan 25, 2024</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-star"></use>
                    </svg>
                    <span class="text-muted small">Score: 85/100</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-user"></use>
                    </svg>
                    <span class="text-muted small">Ms. Davis</span>
                  </div>
                </div>
              </div>
              <div class="d-flex gap-2">
                <span class="badge bg-success">Graded</span>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewAssignmentDetails('english-essay')">View Details</a></li>
                    <li><a class="dropdown-item" href="#" onclick="viewFeedback('english-essay')">View Feedback</a></li>
                    <li><a class="dropdown-item" href="#" onclick="downloadSubmission('english-essay')">Download Submission</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Overdue Assignments -->
        <div class="mb-4">
          <h6 class="text-danger mb-3">
            <svg class="icon me-2" width="16" height="16" fill="currentColor">
              <use href="#icon-alerts"></use>
            </svg>
            Overdue Assignments
          </h6>
          
          <div class="assignment-item border border-danger rounded-3 p-3 mb-3">
            <div class="d-flex justify-content-between align-items-start">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                    <svg class="icon text-danger" width="16" height="16" fill="currentColor">
                      <use href="#icon-alerts"></use>
                    </svg>
                  </div>
                  <div>
                    <h6 class="mb-1">History Research Paper</h6>
                    <div class="text-muted small">World War II Analysis</div>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-4">
                  <div class="d-flex align-items-center">
                    <svg class="icon text-danger me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-calendar"></use>
                    </svg>
                    <span class="text-danger small">Due: Jan 20, 2024</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <svg class="icon text-danger me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-clock"></use>
                    </svg>
                    <span class="text-danger small">8 days overdue</span>
                  </div>
                  <div class="d-flex align-items-center">
                    <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                      <use href="#icon-user"></use>
                    </svg>
                    <span class="text-muted small">Mr. Wilson</span>
                  </div>
                </div>
              </div>
              <div class="d-flex gap-2">
                <span class="badge bg-danger">Overdue</span>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewAssignmentDetails('history-paper')">View Details</a></li>
                    <li><a class="dropdown-item" href="#" onclick="submitAssignment('history-paper')">Submit Assignment</a></li>
                    <li><a class="dropdown-item" href="#" onclick="contactTeacher('history')">Contact Teacher</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <!-- Assignment Calendar -->
    <div class="surface p-3 mb-4">
      <h5 class="mb-4">Assignment Calendar</h5>
      <div id="assignmentCalendar">
        <!-- Calendar will be rendered here -->
        <div class="text-center text-muted py-4">
          <svg class="icon mb-2" width="48" height="48" fill="currentColor">
            <use href="#icon-calendar"></use>
          </svg>
          <div>Calendar view coming soon</div>
        </div>
      </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="surface p-3">
      <h5 class="mb-4">Quick Actions</h5>
      <div class="d-grid gap-2">
        <button class="btn btn-outline-primary" onclick="viewAllAssignments()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-plus"></use>
          </svg>
          View All Assignments
        </button>
        <button class="btn btn-outline-success" onclick="viewCompletedAssignments()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-check"></use>
          </svg>
          Completed Assignments
        </button>
        <button class="btn btn-outline-warning" onclick="viewPendingAssignments()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-clock"></use>
          </svg>
          Pending Assignments
        </button>
        <button class="btn btn-outline-danger" onclick="viewOverdueAssignments()">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
          Overdue Assignments
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Assignment Details Modal -->
<div class="modal fade" id="assignmentDetailsModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignmentDetailsTitle">Assignment Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="assignmentDetailsContent">
          <!-- Content will be loaded dynamically -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitAssignment()">Submit Assignment</button>
      </div>
    </div>
  </div>
</div>

<!-- Assignment Filters Modal -->
<div class="modal fade" id="assignmentFiltersModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assignment Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="assignmentFiltersForm">
          <div class="mb-3">
            <label class="form-label">Subject</label>
            <select class="form-select" multiple>
              <option value="mathematics">Mathematics</option>
              <option value="science">Science</option>
              <option value="english">English</option>
              <option value="filipino">Filipino</option>
              <option value="history">History</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="pending" id="filterPending">
              <label class="form-check-label" for="filterPending">Pending</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="completed" id="filterCompleted">
              <label class="form-check-label" for="filterCompleted">Completed</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="overdue" id="filterOverdue">
              <label class="form-check-label" for="filterOverdue">Overdue</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="graded" id="filterGraded">
              <label class="form-check-label" for="filterGraded">Graded</label>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Due Date Range</label>
            <div class="row g-2">
              <div class="col-6">
                <input type="date" class="form-control" placeholder="From">
              </div>
              <div class="col-6">
                <input type="date" class="form-control" placeholder="To">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="applyFilters()">Apply Filters</button>
      </div>
    </div>
  </div>
</div>

<!-- Assignment Submission Modal -->
<div class="modal fade" id="assignmentSubmissionModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submit Assignment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="assignmentSubmissionForm">
          <div class="mb-3">
            <label class="form-label">Assignment</label>
            <input type="text" class="form-control" id="submissionAssignment" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Upload File</label>
            <input type="file" class="form-control" accept=".pdf,.doc,.docx,.txt" required>
            <div class="form-text">Supported formats: PDF, DOC, DOCX, TXT</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Comments (Optional)</label>
            <textarea class="form-control" rows="3" placeholder="Add any comments about your submission..."></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="submitAssignmentFile()">Submit Assignment</button>
      </div>
    </div>
  </div>
</div>

<script>
// Student Assignments Management
class StudentAssignments {
  constructor() {
    this.assignments = [];
    this.filters = {
      subject: '',
      status: '',
      dueDate: '',
      type: ''
    };
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadAssignments();
  }

  bindEvents() {
    // Filter changes
    document.getElementById('subjectFilter').addEventListener('change', (e) => {
      this.filters.subject = e.target.value;
      this.filterAssignments();
    });

    document.getElementById('statusFilter').addEventListener('change', (e) => {
      this.filters.status = e.target.value;
      this.filterAssignments();
    });

    document.getElementById('dueDateFilter').addEventListener('change', (e) => {
      this.filters.dueDate = e.target.value;
      this.filterAssignments();
    });

    document.getElementById('typeFilter').addEventListener('change', (e) => {
      this.filters.type = e.target.value;
      this.filterAssignments();
    });

    // Timeline view change
    document.querySelectorAll('input[name="timelineView"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.toggleViewType(e.target.value);
      });
    });
  }

  loadAssignments() {
    // Simulate loading assignments data
    this.assignments = [
      {
        id: 'math-quiz-4',
        title: 'Mathematics Quiz #4',
        subject: 'mathematics',
        type: 'quiz',
        status: 'pending',
        dueDate: '2024-01-30',
        teacher: 'Ms. Johnson',
        description: 'Algebra and Geometry'
      },
      {
        id: 'science-project',
        title: 'Science Project',
        subject: 'science',
        type: 'project',
        status: 'in-progress',
        dueDate: '2024-02-05',
        teacher: 'Mr. Smith',
        description: 'Environmental Impact Study'
      },
      {
        id: 'english-essay',
        title: 'English Essay',
        subject: 'english',
        type: 'assignment',
        status: 'graded',
        dueDate: '2024-01-25',
        teacher: 'Ms. Davis',
        description: 'Argumentative Essay',
        score: 85,
        maxScore: 100
      },
      {
        id: 'history-paper',
        title: 'History Research Paper',
        subject: 'history',
        type: 'assignment',
        status: 'overdue',
        dueDate: '2024-01-20',
        teacher: 'Mr. Wilson',
        description: 'World War II Analysis'
      }
    ];
  }

  filterAssignments() {
    const assignmentItems = document.querySelectorAll('.assignment-item');
    
    assignmentItems.forEach(item => {
      let show = true;
      
      // Apply filters
      if (this.filters.subject) {
        const subjectElement = item.querySelector('.bg-opacity-10');
        if (subjectElement && !subjectElement.classList.contains(`bg-${this.getSubjectColor(this.filters.subject)}-opacity-10`)) {
          show = false;
        }
      }
      
      if (this.filters.status) {
        const statusBadge = item.querySelector('.badge');
        if (statusBadge && !statusBadge.textContent.toLowerCase().includes(this.filters.status)) {
          show = false;
        }
      }
      
      item.style.display = show ? '' : 'none';
    });
  }

  getSubjectColor(subject) {
    const colors = {
      mathematics: 'primary',
      science: 'success',
      english: 'warning',
      filipino: 'info',
      history: 'secondary'
    };
    return colors[subject] || 'primary';
  }

  toggleViewType(type) {
    const assignmentsList = document.getElementById('assignmentsList');
    
    if (type === 'calendar') {
      assignmentsList.innerHTML = `
        <div class="text-center text-muted py-4">
          <svg class="icon mb-2" width="48" height="48" fill="currentColor">
            <use href="#icon-calendar"></use>
          </svg>
          <div>Calendar view coming soon</div>
        </div>
      `;
    } else {
      // Reload list view
      this.loadAssignments();
    }
  }
}

// Global functions
function viewAssignmentDetails(assignmentId) {
  const modal = new bootstrap.Modal(document.getElementById('assignmentDetailsModal'));
  document.getElementById('assignmentDetailsTitle').textContent = 'Assignment Details';
  
  // Load assignment details content
  document.getElementById('assignmentDetailsContent').innerHTML = `
    <div class="row g-4">
      <div class="col-md-8">
        <h6>Assignment Information</h6>
        <div class="mb-3">
          <strong>Title:</strong> Mathematics Quiz #4
        </div>
        <div class="mb-3">
          <strong>Description:</strong> Algebra and Geometry concepts covering chapters 5-8
        </div>
        <div class="mb-3">
          <strong>Instructions:</strong>
          <ul class="mt-2">
            <li>Complete all 25 multiple choice questions</li>
            <li>Show your work for problem-solving questions</li>
            <li>Time limit: 45 minutes</li>
            <li>Submit before the deadline</li>
          </ul>
        </div>
        <div class="mb-3">
          <strong>Materials Needed:</strong> Calculator, pencil, eraser
        </div>
      </div>
      <div class="col-md-4">
        <h6>Assignment Details</h6>
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <span>Due Date:</span>
              <strong>Jan 30, 2024</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Points:</span>
              <strong>100</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Type:</span>
              <strong>Quiz</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Teacher:</span>
              <strong>Ms. Johnson</strong>
            </div>
            <div class="d-flex justify-content-between">
              <span>Status:</span>
              <span class="badge bg-warning">Pending</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  `;
  
  modal.show();
}

function submitAssignment(assignmentId) {
  const modal = new bootstrap.Modal(document.getElementById('assignmentSubmissionModal'));
  document.getElementById('submissionAssignment').value = 'Mathematics Quiz #4';
  modal.show();
}

function submitAssignmentFile() {
  showNotification('Assignment submitted successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('assignmentSubmissionModal'));
  modal.hide();
}

function viewFeedback(assignmentId) {
  showNotification('Loading feedback...', { type: 'info' });
  // Redirect to feedback page
  setTimeout(() => {
    window.location.href = `/student/assignments/${assignmentId}/feedback`;
  }, 1000);
}

function downloadSubmission(assignmentId) {
  showNotification('Downloading submission...', { type: 'info' });
  // Simulate download
  setTimeout(() => {
    showNotification('Download completed!', { type: 'success' });
  }, 2000);
}

function contactTeacher(subject) {
  showNotification(`Opening contact form for ${subject} teacher...`, { type: 'info' });
  // Open contact teacher modal
  setTimeout(() => {
    window.location.href = `/student/contact-teacher/${subject}`;
  }, 1000);
}

function viewAllAssignments() {
  // Reset all filters
  document.getElementById('subjectFilter').value = '';
  document.getElementById('statusFilter').value = '';
  document.getElementById('dueDateFilter').value = '';
  document.getElementById('typeFilter').value = '';
  
  if (window.studentAssignmentsInstance) {
    window.studentAssignmentsInstance.filters = {
      subject: '',
      status: '',
      dueDate: '',
      type: ''
    };
    window.studentAssignmentsInstance.filterAssignments();
  }
}

function viewCompletedAssignments() {
  document.getElementById('statusFilter').value = 'completed';
  if (window.studentAssignmentsInstance) {
    window.studentAssignmentsInstance.filters.status = 'completed';
    window.studentAssignmentsInstance.filterAssignments();
  }
}

function viewPendingAssignments() {
  document.getElementById('statusFilter').value = 'pending';
  if (window.studentAssignmentsInstance) {
    window.studentAssignmentsInstance.filters.status = 'pending';
    window.studentAssignmentsInstance.filterAssignments();
  }
}

function viewOverdueAssignments() {
  document.getElementById('statusFilter').value = 'overdue';
  if (window.studentAssignmentsInstance) {
    window.studentAssignmentsInstance.filters.status = 'overdue';
    window.studentAssignmentsInstance.filterAssignments();
  }
}

function applyFilters() {
  showNotification('Filters applied successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('assignmentFiltersModal'));
  modal.hide();
}

function refreshAssignments() {
  if (window.studentAssignmentsInstance) {
    window.studentAssignmentsInstance.loadAssignments();
    showNotification('Assignments refreshed successfully!', { type: 'success' });
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.studentAssignmentsInstance = new StudentAssignments();
});
</script>

<style>
/* Student Assignments Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.assignment-item {
  transition: all 0.3s ease;
}

.assignment-item:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.assignment-item.border-danger {
  background-color: rgba(220, 53, 69, 0.05);
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}
</style>
