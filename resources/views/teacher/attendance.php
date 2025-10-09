<?php
$title = 'Attendance Management';
?>

<!-- Teacher Attendance Management Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Attendance Management</h1>
      <p class="text-muted mb-0">Track and manage student attendance</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bulkAttendanceModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Bulk Mark
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#markAttendanceModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Mark Attendance
      </button>
    </div>
  </div>
</div>

<!-- Attendance Statistics Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-success" width="24" height="24" fill="currentColor">
            <use href="#icon-check"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-success mb-0" data-count-to="95">0</div>
          <div class="text-muted small">Present Today</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-danger bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-danger" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-danger mb-0" data-count-to="5">0</div>
          <div class="text-muted small">Absent Today</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-calendar"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0" data-count-to="88.5" data-count-decimals="1">0</div>
          <div class="text-muted small">Average Attendance</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-warning" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-warning mb-0" data-count-to="12">0</div>
          <div class="text-muted small">At Risk</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Attendance Filters -->
<div class="surface mb-4">
  <div class="row g-3 align-items-center">
    <div class="col-md-3">
      <label class="form-label">Class</label>
      <select class="form-select" id="classFilter">
        <option value="">All Classes</option>
        <option value="grade-10-a">Grade 10-A</option>
        <option value="grade-10-b">Grade 10-B</option>
        <option value="grade-9-a">Grade 9-A</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Date Range</label>
      <select class="form-select" id="dateRangeFilter">
        <option value="today">Today</option>
        <option value="week">This Week</option>
        <option value="month">This Month</option>
        <option value="quarter">This Quarter</option>
        <option value="custom">Custom Range</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Status</label>
      <select class="form-select" id="statusFilter">
        <option value="">All Status</option>
        <option value="present">Present</option>
        <option value="absent">Absent</option>
        <option value="late">Late</option>
        <option value="excused">Excused</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Search</label>
      <div class="input-group">
        <span class="input-group-text">
          <svg class="icon" width="16" height="16" fill="currentColor">
            <use href="#icon-search"></use>
          </svg>
        </span>
        <input type="text" class="form-control" placeholder="Search students..." id="studentSearch">
      </div>
    </div>
  </div>
</div>

<!-- Attendance Management Tabs -->
<div class="surface mb-4">
  <ul class="nav nav-tabs" id="attendanceTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="today-tab" data-bs-toggle="tab" data-bs-target="#today" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-calendar"></use>
        </svg>
        Today's Attendance
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-chart"></use>
        </svg>
        Attendance History
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-report"></use>
        </svg>
        Reports
      </button>
    </li>
  </ul>
  
  <div class="tab-content" id="attendanceTabsContent">
    <!-- Today's Attendance Tab -->
    <div class="tab-pane fade show active" id="today" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Today's Attendance - December 20, 2024</h5>
          <div class="d-flex gap-2">
            <button class="btn btn-outline-primary btn-sm" onclick="markAllPresent()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-check"></use>
              </svg>
              Mark All Present
            </button>
            <button class="btn btn-outline-secondary btn-sm" onclick="exportTodayAttendance()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-download"></use>
              </svg>
              Export
            </button>
          </div>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-8">
            <div class="table-responsive">
              <table class="table table-hover" id="todayAttendanceTable">
                <thead class="table-light">
                  <tr>
                    <th>
                      <input type="checkbox" class="form-check-input" id="selectAllToday">
                    </th>
                    <th>Student</th>
                    <th>Class</th>
                    <th>Time In</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <input type="checkbox" class="form-check-input" value="1">
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                          <svg class="icon text-success" width="16" height="16" fill="currentColor">
                            <use href="#icon-user"></use>
                          </svg>
                        </div>
                        <div>
                          <div class="fw-semibold">John Doe</div>
                          <div class="text-muted small">LRN: 123456789012</div>
                        </div>
                      </div>
                    </td>
                    <td><span class="badge bg-primary">Grade 10-A</span></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <svg class="icon text-success me-1" width="14" height="14" fill="currentColor">
                          <use href="#icon-clock"></use>
                        </svg>
                        <span>8:15 AM</span>
                      </div>
                    </td>
                    <td><span class="badge bg-success">Present</span></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                          <svg class="icon" width="16" height="16" fill="currentColor">
                            <use href="#icon-more"></use>
                          </svg>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#" onclick="markAbsent(1)">Mark Absent</a></li>
                          <li><a class="dropdown-item" href="#" onclick="markLate(1)">Mark Late</a></li>
                          <li><a class="dropdown-item" href="#" onclick="markExcused(1)">Mark Excused</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#" onclick="viewStudentAttendance(1)">View History</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>
                      <input type="checkbox" class="form-check-input" value="2">
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                          <svg class="icon text-danger" width="16" height="16" fill="currentColor">
                            <use href="#icon-user"></use>
                          </svg>
                        </div>
                        <div>
                          <div class="fw-semibold">Jane Smith</div>
                          <div class="text-muted small">LRN: 123456789013</div>
                        </div>
                      </div>
                    </td>
                    <td><span class="badge bg-primary">Grade 10-A</span></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                          <use href="#icon-clock"></use>
                        </svg>
                        <span>-</span>
                      </div>
                    </td>
                    <td><span class="badge bg-danger">Absent</span></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                          <svg class="icon" width="16" height="16" fill="currentColor">
                            <use href="#icon-more"></use>
                          </svg>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#" onclick="markPresent(2)">Mark Present</a></li>
                          <li><a class="dropdown-item" href="#" onclick="markLate(2)">Mark Late</a></li>
                          <li><a class="dropdown-item" href="#" onclick="markExcused(2)">Mark Excused</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#" onclick="viewStudentAttendance(2)">View History</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>
                      <input type="checkbox" class="form-check-input" value="3">
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                          <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                            <use href="#icon-user"></use>
                          </svg>
                        </div>
                        <div>
                          <div class="fw-semibold">Mike Johnson</div>
                          <div class="text-muted small">LRN: 123456789014</div>
                        </div>
                      </div>
                    </td>
                    <td><span class="badge bg-primary">Grade 10-A</span></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <svg class="icon text-warning me-1" width="14" height="14" fill="currentColor">
                          <use href="#icon-clock"></use>
                        </svg>
                        <span>8:45 AM</span>
                      </div>
                    </td>
                    <td><span class="badge bg-warning">Late</span></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                          <svg class="icon" width="16" height="16" fill="currentColor">
                            <use href="#icon-more"></use>
                          </svg>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#" onclick="markPresent(3)">Mark Present</a></li>
                          <li><a class="dropdown-item" href="#" onclick="markAbsent(3)">Mark Absent</a></li>
                          <li><a class="dropdown-item" href="#" onclick="markExcused(3)">Mark Excused</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#" onclick="viewStudentAttendance(3)">View History</a></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Quick Actions</h6>
              <div class="d-grid gap-2">
                <button class="btn btn-success" onclick="markAllPresent()">
                  <svg class="icon me-2" width="16" height="16" fill="currentColor">
                    <use href="#icon-check"></use>
                  </svg>
                  Mark All Present
                </button>
                <button class="btn btn-warning" onclick="markAllLate()">
                  <svg class="icon me-2" width="16" height="16" fill="currentColor">
                    <use href="#icon-clock"></use>
                  </svg>
                  Mark All Late
                </button>
                <button class="btn btn-danger" onclick="markAllAbsent()">
                  <svg class="icon me-2" width="16" height="16" fill="currentColor">
                    <use href="#icon-alerts"></use>
                  </svg>
                  Mark All Absent
                </button>
                <button class="btn btn-outline-primary" onclick="sendAbsenceNotification()">
                  <svg class="icon me-2" width="16" height="16" fill="currentColor">
                    <use href="#icon-message"></use>
                  </svg>
                  Notify Parents
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Attendance History Tab -->
    <div class="tab-pane fade" id="history" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Attendance History</h5>
          <div class="d-flex gap-2">
            <button class="btn btn-outline-primary btn-sm" onclick="exportAttendanceHistory()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-download"></use>
              </svg>
              Export
            </button>
            <button class="btn btn-outline-secondary btn-sm" onclick="refreshHistory()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-refresh"></use>
              </svg>
              Refresh
            </button>
          </div>
        </div>
        
        <div class="row g-4 mb-4">
          <div class="col-lg-8">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Attendance Calendar</h6>
              <div id="attendanceCalendar" style="height: 300px;">
                <!-- Calendar will be rendered here -->
                <div class="text-center text-muted py-5">
                  <svg class="icon mb-3" width="48" height="48" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <p>Attendance calendar will be displayed here</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Attendance Summary</h6>
              <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-success" width="16" height="16" fill="currentColor">
                        <use href="#icon-check"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Present</div>
                      <div class="text-muted small">This month</div>
                    </div>
                  </div>
                  <div class="badge bg-success">85%</div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-danger" width="16" height="16" fill="currentColor">
                        <use href="#icon-alerts"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Absent</div>
                      <div class="text-muted small">This month</div>
                    </div>
                  </div>
                  <div class="badge bg-danger">10%</div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                        <use href="#icon-clock"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Late</div>
                      <div class="text-muted small">This month</div>
                    </div>
                  </div>
                  <div class="badge bg-warning">5%</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Date</th>
                <th>Class</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Late</th>
                <th>Excused</th>
                <th>Attendance Rate</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Dec 20, 2024</td>
                <td><span class="badge bg-primary">Grade 10-A</span></td>
                <td><span class="badge bg-success">42</span></td>
                <td><span class="badge bg-danger">3</span></td>
                <td><span class="badge bg-warning">2</span></td>
                <td><span class="badge bg-info">1</span></td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="fw-semibold text-success me-2">89%</span>
                    <div class="progress" style="width: 60px; height: 6px;">
                      <div class="progress-bar bg-success" style="width: 89%"></div>
                    </div>
                  </div>
                </td>
                <td>
                  <button class="btn btn-sm btn-outline-primary" onclick="viewDayDetails('2024-12-20')">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-eye"></use>
                    </svg>
                  </button>
                </td>
              </tr>
              
              <tr>
                <td>Dec 19, 2024</td>
                <td><span class="badge bg-primary">Grade 10-A</span></td>
                <td><span class="badge bg-success">40</span></td>
                <td><span class="badge bg-danger">5</span></td>
                <td><span class="badge bg-warning">1</span></td>
                <td><span class="badge bg-info">2</span></td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="fw-semibold text-warning me-2">83%</span>
                    <div class="progress" style="width: 60px; height: 6px;">
                      <div class="progress-bar bg-warning" style="width: 83%"></div>
                    </div>
                  </div>
                </td>
                <td>
                  <button class="btn btn-sm btn-outline-primary" onclick="viewDayDetails('2024-12-19')">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-eye"></use>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Reports Tab -->
    <div class="tab-pane fade" id="reports" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Attendance Reports</h5>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generateReportModal">
            <svg class="icon me-1" width="16" height="16" fill="currentColor">
              <use href="#icon-plus"></use>
            </svg>
            Generate Report
          </button>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Monthly Attendance Trends</h6>
              <div class="chart-container" style="height: 250px;">
                <canvas id="monthlyTrendChart"></canvas>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Class Comparison</h6>
              <div class="chart-container" style="height: 250px;">
                <canvas id="classComparisonChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Mark Attendance Modal -->
<div class="modal fade" id="markAttendanceModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mark Attendance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="markAttendanceForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Class</label>
              <select class="form-select" required>
                <option value="">Select Class</option>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date</label>
              <input type="date" class="form-control" required>
            </div>
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
              <label class="form-label">Period</label>
              <select class="form-select" required>
                <option value="">Select Period</option>
                <option value="1">1st Period</option>
                <option value="2">2nd Period</option>
                <option value="3">3rd Period</option>
                <option value="4">4th Period</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="proceedToMarkAttendance()">Proceed to Mark</button>
      </div>
    </div>
  </div>
</div>

<!-- Bulk Attendance Modal -->
<div class="modal fade" id="bulkAttendanceModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bulk Mark Attendance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="bulkAttendanceForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Class</label>
              <select class="form-select" required>
                <option value="">Select Class</option>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Default Status</label>
              <select class="form-select" required>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
                <option value="late">Late</option>
                <option value="excused">Excused</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select class="form-select" required>
                <option value="">Select Subject</option>
                <option value="mathematics">Mathematics</option>
                <option value="science">Science</option>
                <option value="english">English</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="proceedToBulkMark()">Proceed to Bulk Mark</button>
      </div>
    </div>
  </div>
</div>

<!-- Generate Report Modal -->
<div class="modal fade" id="generateReportModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Generate Attendance Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="generateReportForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Report Type</label>
              <select class="form-select" required>
                <option value="">Select Report Type</option>
                <option value="daily">Daily Report</option>
                <option value="weekly">Weekly Report</option>
                <option value="monthly">Monthly Report</option>
                <option value="quarterly">Quarterly Report</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Class</label>
              <select class="form-select" required>
                <option value="">Select Class</option>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date Range</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">End Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Format</label>
              <select class="form-select" required>
                <option value="pdf">PDF</option>
                <option value="excel">Excel</option>
                <option value="csv">CSV</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Include Charts</label>
              <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="includeCharts" checked>
                <label class="form-check-label" for="includeCharts">
                  Include charts and graphs
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="generateAttendanceReport()">Generate Report</button>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js and Teacher Attendance Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Teacher Attendance Management
class TeacherAttendanceManagement {
  constructor() {
    this.charts = {};
    this.selectedStudents = [];
    this.init();
  }

  init() {
    this.initializeCharts();
    this.bindEvents();
    this.loadAttendanceData();
  }

  initializeCharts() {
    // Monthly Trend Chart
    const monthlyCtx = document.getElementById('monthlyTrendChart');
    if (monthlyCtx) {
      this.charts.monthlyTrend = new Chart(monthlyCtx, {
        type: 'line',
        data: {
          labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
          datasets: [{
            label: 'Attendance Rate',
            data: [88, 92, 85, 90],
            borderColor: 'rgba(13, 110, 253, 1)',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            tension: 0.4,
            fill: true
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
              beginAtZero: false,
              min: 80,
              max: 100
            }
          }
        }
      });
    }

    // Class Comparison Chart
    const comparisonCtx = document.getElementById('classComparisonChart');
    if (comparisonCtx) {
      this.charts.classComparison = new Chart(comparisonCtx, {
        type: 'bar',
        data: {
          labels: ['Grade 10-A', 'Grade 10-B', 'Grade 9-A'],
          datasets: [{
            label: 'Attendance Rate',
            data: [88, 92, 85],
            backgroundColor: [
              'rgba(13, 110, 253, 0.8)',
              'rgba(25, 135, 84, 0.8)',
              'rgba(255, 193, 7, 0.8)'
            ],
            borderColor: [
              'rgba(13, 110, 253, 1)',
              'rgba(25, 135, 84, 1)',
              'rgba(255, 193, 7, 1)'
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
              beginAtZero: false,
              min: 80,
              max: 100
            }
          }
        }
      });
    }
  }

  bindEvents() {
    // Filter changes
    document.getElementById('classFilter').addEventListener('change', () => this.filterAttendance());
    document.getElementById('dateRangeFilter').addEventListener('change', () => this.filterAttendance());
    document.getElementById('statusFilter').addEventListener('change', () => this.filterAttendance());

    // Search
    document.getElementById('studentSearch').addEventListener('input', (e) => {
      this.searchStudents(e.target.value);
    });

    // Select all today
    document.getElementById('selectAllToday').addEventListener('change', (e) => {
      this.toggleSelectAllToday(e.target.checked);
    });

    // Individual checkboxes
    document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
      checkbox.addEventListener('change', () => this.updateSelectedStudents());
    });
  }

  loadAttendanceData() {
    console.log('Loading attendance data...');
    // Load attendance data from API
  }

  filterAttendance() {
    const className = document.getElementById('classFilter').value;
    const dateRange = document.getElementById('dateRangeFilter').value;
    const status = document.getElementById('statusFilter').value;

    console.log(`Filtering by: Class=${className}, DateRange=${dateRange}, Status=${status}`);
    // Implement filtering logic
  }

  searchStudents(searchTerm) {
    const rows = document.querySelectorAll('#todayAttendanceTable tbody tr');
    rows.forEach(row => {
      const studentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
      
      if (studentName.includes(searchTerm.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  toggleSelectAllToday(checked) {
    document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
      checkbox.checked = checked;
    });
    this.updateSelectedStudents();
  }

  updateSelectedStudents() {
    this.selectedStudents = Array.from(document.querySelectorAll('input[type="checkbox"][value]:checked'))
      .map(checkbox => checkbox.value);
    console.log('Selected students:', this.selectedStudents);
  }
}

// Global functions
function markPresent(studentId) {
  showNotification(`Marking student ${studentId} as present...`, { type: 'info' });
}

function markAbsent(studentId) {
  showNotification(`Marking student ${studentId} as absent...`, { type: 'info' });
}

function markLate(studentId) {
  showNotification(`Marking student ${studentId} as late...`, { type: 'info' });
}

function markExcused(studentId) {
  showNotification(`Marking student ${studentId} as excused...`, { type: 'info' });
}

function viewStudentAttendance(studentId) {
  showNotification(`Viewing attendance history for student ${studentId}...`, { type: 'info' });
}

function markAllPresent() {
  showNotification('Marking all students as present...', { type: 'info' });
}

function markAllLate() {
  showNotification('Marking all students as late...', { type: 'info' });
}

function markAllAbsent() {
  showNotification('Marking all students as absent...', { type: 'info' });
}

function sendAbsenceNotification() {
  showNotification('Sending absence notifications to parents...', { type: 'info' });
}

function viewDayDetails(date) {
  showNotification(`Viewing attendance details for ${date}...`, { type: 'info' });
}

function proceedToMarkAttendance() {
  showNotification('Redirecting to attendance marking...', { type: 'info' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('markAttendanceModal'));
  modal.hide();
}

function proceedToBulkMark() {
  showNotification('Redirecting to bulk attendance marking...', { type: 'info' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('bulkAttendanceModal'));
  modal.hide();
}

function generateAttendanceReport() {
  showNotification('Generating attendance report...', { type: 'info' });
  setTimeout(() => {
    showNotification('Report generated successfully!', { type: 'success' });
  }, 3000);
  const modal = bootstrap.Modal.getInstance(document.getElementById('generateReportModal'));
  modal.hide();
}

function exportTodayAttendance() {
  showNotification('Exporting today\'s attendance...', { type: 'info' });
  setTimeout(() => {
    showNotification('Attendance exported successfully!', { type: 'success' });
  }, 2000);
}

function exportAttendanceHistory() {
  showNotification('Exporting attendance history...', { type: 'info' });
  setTimeout(() => {
    showNotification('History exported successfully!', { type: 'success' });
  }, 2000);
}

function refreshHistory() {
  if (window.teacherAttendanceManagementInstance) {
    window.teacherAttendanceManagementInstance.loadAttendanceData();
    showNotification('Attendance history refreshed successfully!', { type: 'success' });
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.teacherAttendanceManagementInstance = new TeacherAttendanceManagement();
});
</script>

<style>
/* Teacher Attendance Management Specific Styles */
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

.progress {
  transition: width 0.6s ease;
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
</style>
