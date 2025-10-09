<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">Reports & Analytics</h1>
      <p class="text-muted mb-0">Comprehensive insights and data analysis for your school</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" onclick="exportAllReports()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Export All</span>
      </button>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#generateReportModal">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Generate Report</span>
      </button>
    </div>
  </div>
</div>

<!-- Quick Stats Overview -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="stat-card surface p-4 text-center">
      <div class="stat-icon bg-primary-subtle text-primary mx-auto mb-3">
        <svg width="32" height="32" fill="currentColor">
          <use href="#icon-user"></use>
        </svg>
      </div>
      <h3 class="h4 fw-bold text-primary mb-1" data-count-to="315">0</h3>
      <p class="text-muted mb-0">Total Users</p>
      <div class="progress mt-2" style="height: 4px;">
        <div class="progress-bar bg-primary" style="width: 85%" data-progress-to="85"></div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stat-card surface p-4 text-center">
      <div class="stat-icon bg-success-subtle text-success mx-auto mb-3">
        <svg width="32" height="32" fill="currentColor">
          <use href="#icon-chart"></use>
        </svg>
      </div>
      <h3 class="h4 fw-bold text-success mb-1" data-count-to="92.5" data-count-decimals="1">0.0</h3>
      <p class="text-muted mb-0">Avg Performance</p>
      <div class="progress mt-2" style="height: 4px;">
        <div class="progress-bar bg-success" style="width: 92.5%" data-progress-to="92.5"></div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stat-card surface p-4 text-center">
      <div class="stat-icon bg-warning-subtle text-warning mx-auto mb-3">
        <svg width="32" height="32" fill="currentColor">
          <use href="#icon-alerts"></use>
        </svg>
      </div>
      <h3 class="h4 fw-bold text-warning mb-1" data-count-to="23">0</h3>
      <p class="text-muted mb-0">Active Alerts</p>
      <div class="progress mt-2" style="height: 4px;">
        <div class="progress-bar bg-warning" style="width: 60%" data-progress-to="60"></div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stat-card surface p-4 text-center">
      <div class="stat-icon bg-info-subtle text-info mx-auto mb-3">
        <svg width="32" height="32" fill="currentColor">
          <use href="#icon-calendar"></use>
        </svg>
      </div>
      <h3 class="h4 fw-bold text-info mb-1" data-count-to="156">0</h3>
      <p class="text-muted mb-0">Days Active</p>
      <div class="progress mt-2" style="height: 4px;">
        <div class="progress-bar bg-info" style="width: 75%" data-progress-to="75"></div>
      </div>
    </div>
  </div>
</div>

<!-- Report Categories -->
<div class="row g-4 mb-4">
  <div class="col-md-4">
    <div class="surface p-4">
      <div class="d-flex align-items-center mb-3">
        <div class="stat-icon bg-primary-subtle text-primary me-3">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-user"></use>
          </svg>
        </div>
        <h5 class="fw-bold mb-0">User Analytics</h5>
      </div>
      <p class="text-muted small mb-3">Comprehensive user statistics and behavior analysis</p>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm" onclick="generateUserReport()">Generate</button>
        <button class="btn btn-outline-secondary btn-sm" onclick="viewUserAnalytics()">View Details</button>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="surface p-4">
      <div class="d-flex align-items-center mb-3">
        <div class="stat-icon bg-success-subtle text-success me-3">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-performance"></use>
          </svg>
        </div>
        <h5 class="fw-bold mb-0">Academic Performance</h5>
      </div>
      <p class="text-muted small mb-3">Student grades, attendance, and academic trends</p>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm" onclick="generateAcademicReport()">Generate</button>
        <button class="btn btn-outline-secondary btn-sm" onclick="viewAcademicAnalytics()">View Details</button>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="surface p-4">
      <div class="d-flex align-items-center mb-3">
        <div class="stat-icon bg-warning-subtle text-warning me-3">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
        </div>
        <h5 class="fw-bold mb-0">System Analytics</h5>
      </div>
      <p class="text-muted small mb-3">System usage, performance metrics, and health status</p>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm" onclick="generateSystemReport()">Generate</button>
        <button class="btn btn-outline-secondary btn-sm" onclick="viewSystemAnalytics()">View Details</button>
      </div>
    </div>
  </div>
</div>

<!-- Advanced Analytics Dashboard -->
<div class="row g-4 mb-4">
  <div class="col-md-8">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">User Growth Trends</h5>
        <div class="d-flex gap-2">
          <select class="form-select form-select-sm" id="trendTimeframe" style="width: auto;">
            <option value="7d">Last 7 Days</option>
            <option value="30d" selected>Last 30 Days</option>
            <option value="90d">Last 90 Days</option>
            <option value="1y">Last Year</option>
          </select>
          <button class="btn btn-outline-primary btn-sm" onclick="exportTrendData()">
            <svg width="14" height="14" fill="currentColor">
              <use href="#icon-download"></use>
            </svg>
          </button>
        </div>
      </div>
      <canvas id="userGrowthChart" height="100"></canvas>
    </div>
  </div>
  <div class="col-md-4">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">User Distribution</h5>
      <canvas id="userDistributionChart" height="200"></canvas>
    </div>
  </div>
</div>

<!-- Performance Analytics -->
<div class="row g-4 mb-4">
  <div class="col-md-6">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Grade Distribution</h5>
        <div class="dropdown">
          <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
            All Subjects
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="filterBySubject('all')">All Subjects</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterBySubject('math')">Mathematics</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterBySubject('science')">Science</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterBySubject('english')">English</a></li>
          </ul>
        </div>
      </div>
      <canvas id="gradeDistributionChart" height="150"></canvas>
    </div>
  </div>
  <div class="col-md-6">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Attendance Trends</h5>
        <div class="dropdown">
          <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
            All Grades
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="filterByGrade('all')">All Grades</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterByGrade('7')">Grade 7</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterByGrade('8')">Grade 8</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterByGrade('9')">Grade 9</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterByGrade('10')">Grade 10</a></li>
          </ul>
        </div>
      </div>
      <canvas id="attendanceChart" height="150"></canvas>
    </div>
  </div>
</div>

<!-- Recent Reports Table -->
<div class="surface p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Recent Reports</h5>
    <button class="btn btn-outline-primary btn-sm" onclick="viewAllReports()">
      <svg width="16" height="16" fill="currentColor">
        <use href="#icon-eye"></use>
      </svg>
      <span class="d-none d-md-inline ms-1">View All</span>
    </button>
  </div>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Report Name</th>
          <th>Type</th>
          <th>Generated By</th>
          <th>Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="reportsTableBody">
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <svg width="20" height="20" fill="currentColor" class="text-primary me-2">
                <use href="#icon-user"></use>
              </svg>
              <div>
                <div class="fw-semibold">Monthly User Report</div>
                <div class="text-muted small">October 2024</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-primary-subtle text-primary">User Analytics</span></td>
          <td>Administrator</td>
          <td>Oct 7, 2024</td>
          <td><span class="badge bg-success-subtle text-success">Completed</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="downloadReport(1)">
                  <svg width="14" height="14" fill="currentColor" class="me-2">
                    <use href="#icon-download"></use>
                  </svg>
                  Download
                </a></li>
                <li><a class="dropdown-item" href="#" onclick="viewReport(1)">
                  <svg width="14" height="14" fill="currentColor" class="me-2">
                    <use href="#icon-eye"></use>
                  </svg>
                  View
                </a></li>
                <li><a class="dropdown-item" href="#" onclick="shareReport(1)">
                  <svg width="14" height="14" fill="currentColor" class="me-2">
                    <use href="#icon-share"></use>
                  </svg>
                  Share
                </a></li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <svg width="20" height="20" fill="currentColor" class="text-success me-2">
                <use href="#icon-performance"></use>
              </svg>
              <div>
                <div class="fw-semibold">Academic Performance Report</div>
                <div class="text-muted small">Q3 2024</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-success-subtle text-success">Academic</span></td>
          <td>Administrator</td>
          <td>Oct 5, 2024</td>
          <td><span class="badge bg-success-subtle text-success">Completed</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="downloadReport(2)">
                  <svg width="14" height="14" fill="currentColor" class="me-2">
                    <use href="#icon-download"></use>
                  </svg>
                  Download
                </a></li>
                <li><a class="dropdown-item" href="#" onclick="viewReport(2)">
                  <svg width="14" height="14" fill="currentColor" class="me-2">
                    <use href="#icon-eye"></use>
                  </svg>
                  View
                </a></li>
                <li><a class="dropdown-item" href="#" onclick="shareReport(2)">
                  <svg width="14" height="14" fill="currentColor" class="me-2">
                    <use href="#icon-share"></use>
                  </svg>
                  Share
                </a></li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="d-flex align-items-center">
              <svg width="20" height="20" fill="currentColor" class="text-warning me-2">
                <use href="#icon-chart"></use>
              </svg>
              <div>
                <div class="fw-semibold">System Health Report</div>
                <div class="text-muted small">Weekly</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-warning-subtle text-warning">System</span></td>
          <td>System</td>
          <td>Oct 3, 2024</td>
          <td><span class="badge bg-warning-subtle text-warning">Processing</span></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <svg width="14" height="14" fill="currentColor">
                  <use href="#icon-more"></use>
                </svg>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="viewReport(3)">
                  <svg width="14" height="14" fill="currentColor" class="me-2">
                    <use href="#icon-eye"></use>
                  </svg>
                  View Progress
                </a></li>
                <li><a class="dropdown-item" href="#" onclick="cancelReport(3)">
                  <svg width="14" height="14" fill="currentColor" class="me-2">
                    <use href="#icon-x"></use>
                  </svg>
                  Cancel
                </a></li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Generate Report Modal -->
<div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="generateReportModalLabel">Generate New Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="reportGenerationForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="reportType" class="form-label">Report Type</label>
              <select class="form-select" id="reportType" required>
                <option value="">Select Report Type</option>
                <option value="user_analytics">User Analytics</option>
                <option value="academic_performance">Academic Performance</option>
                <option value="attendance">Attendance Report</option>
                <option value="system_health">System Health</option>
                <option value="financial">Financial Report</option>
                <option value="custom">Custom Report</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="reportFormat" class="form-label">Output Format</label>
              <select class="form-select" id="reportFormat" required>
                <option value="pdf">PDF</option>
                <option value="excel">Excel</option>
                <option value="csv">CSV</option>
                <option value="json">JSON</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="dateFrom" class="form-label">Date From</label>
              <input type="date" class="form-control" id="dateFrom" required>
            </div>
            <div class="col-md-6">
              <label for="dateTo" class="form-label">Date To</label>
              <input type="date" class="form-control" id="dateTo" required>
            </div>
            <div class="col-12">
              <label for="reportFilters" class="form-label">Additional Filters</label>
              <textarea class="form-control" id="reportFilters" rows="3" placeholder="Specify any additional filters or parameters..."></textarea>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="scheduleReport">
                <label class="form-check-label" for="scheduleReport">
                  Schedule this report for regular generation
                </label>
              </div>
            </div>
            <div class="col-12" id="scheduleOptions" style="display: none;">
              <div class="row g-3">
                <div class="col-md-6">
                  <label for="scheduleFrequency" class="form-label">Frequency</label>
                  <select class="form-select" id="scheduleFrequency">
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="quarterly">Quarterly</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="scheduleTime" class="form-label">Time</label>
                  <input type="time" class="form-control" id="scheduleTime" value="09:00">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="generateReport()">
          <span class="btn-text">Generate Report</span>
          <span class="btn-loading" style="display: none;">
            <span class="spinner-border spinner-border-sm me-2"></span>Generating...
          </span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Include Chart.js and Reports JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= \Helpers\Url::asset('admin-reports.js') ?>"></script>
