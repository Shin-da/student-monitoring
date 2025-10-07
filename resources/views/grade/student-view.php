<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">My Grades</h1>
      <p class="text-muted mb-0">View your academic performance and progress</p>
    </div>
    <div class="d-flex gap-2">
      <select class="form-select form-select-sm" style="width: auto;" id="quarterFilter">
        <option value="">All Quarters</option>
        <option value="1">1st Quarter</option>
        <option value="2">2nd Quarter</option>
        <option value="3">3rd Quarter</option>
        <option value="4">4th Quarter</option>
      </select>
      <button class="btn btn-outline-primary btn-sm" onclick="printGrades()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-report"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Print</span>
      </button>
    </div>
  </div>
</div>

<!-- Grade Summary Cards -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-primary-subtle text-primary">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
        </div>
        <span class="badge bg-primary-subtle text-primary">Current</span>
      </div>
      <h3 class="h4 fw-bold mb-1">85.2</h3>
      <p class="text-muted small mb-0">Overall Average</p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-success-subtle text-success">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-star"></use>
          </svg>
        </div>
        <span class="badge bg-success-subtle text-success">8/10</span>
      </div>
      <h3 class="h4 fw-bold mb-1">8</h3>
      <p class="text-muted small mb-0">Passing Subjects</p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-warning-subtle text-warning">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <span class="badge bg-warning-subtle text-warning">2</span>
      </div>
      <h3 class="h4 fw-bold mb-1">2</h3>
      <p class="text-muted small mb-0">Needs Improvement</p>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="stat-icon bg-info-subtle text-info">
          <svg width="24" height="24" fill="currentColor">
            <use href="#icon-performance"></use>
          </svg>
        </div>
        <span class="badge bg-info-subtle text-info">+3.2%</span>
      </div>
      <h3 class="h4 fw-bold mb-1">+3.2%</h3>
      <p class="text-muted small mb-0">Improvement</p>
    </div>
  </div>
</div>

<!-- Grade Cards by Subject -->
<div class="row g-4 mb-5">
  <!-- Mathematics -->
  <div class="col-md-6 col-lg-4">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Mathematics</h5>
        <span class="badge bg-primary-subtle text-primary">Grade 10</span>
      </div>
      
      <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small text-muted">Overall Grade</span>
          <span class="fw-bold text-success">87.5</span>
        </div>
        <div class="progress" style="height: 6px;">
          <div class="progress-bar bg-success" style="width: 87.5%"></div>
        </div>
      </div>
      
      <div class="grade-breakdown">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small">Written Work (30%)</span>
          <span class="small fw-semibold">85.0</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small">Performance Task (50%)</span>
          <span class="small fw-semibold">88.0</span>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <span class="small">Quarterly Exam (20%)</span>
          <span class="small fw-semibold">90.0</span>
        </div>
      </div>
      
      <div class="mt-3 pt-3 border-top">
        <div class="d-flex justify-content-between align-items-center">
          <span class="small text-muted">Quarter 1</span>
          <span class="badge bg-success-subtle text-success">Passed</span>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Science -->
  <div class="col-md-6 col-lg-4">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Science</h5>
        <span class="badge bg-primary-subtle text-primary">Grade 10</span>
      </div>
      
      <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small text-muted">Overall Grade</span>
          <span class="fw-bold text-success">92.3</span>
        </div>
        <div class="progress" style="height: 6px;">
          <div class="progress-bar bg-success" style="width: 92.3%"></div>
        </div>
      </div>
      
      <div class="grade-breakdown">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small">Written Work (30%)</span>
          <span class="small fw-semibold">90.0</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small">Performance Task (50%)</span>
          <span class="small fw-semibold">95.0</span>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <span class="small">Quarterly Exam (20%)</span>
          <span class="small fw-semibold">88.0</span>
        </div>
      </div>
      
      <div class="mt-3 pt-3 border-top">
        <div class="d-flex justify-content-between align-items-center">
          <span class="small text-muted">Quarter 1</span>
          <span class="badge bg-success-subtle text-success">Passed</span>
        </div>
      </div>
    </div>
  </div>
  
  <!-- English -->
  <div class="col-md-6 col-lg-4">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">English</h5>
        <span class="badge bg-primary-subtle text-primary">Grade 10</span>
      </div>
      
      <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small text-muted">Overall Grade</span>
          <span class="fw-bold text-warning">75.8</span>
        </div>
        <div class="progress" style="height: 6px;">
          <div class="progress-bar bg-warning" style="width: 75.8%"></div>
        </div>
      </div>
      
      <div class="grade-breakdown">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small">Written Work (30%)</span>
          <span class="small fw-semibold">78.0</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="small">Performance Task (50%)</span>
          <span class="small fw-semibold">72.0</span>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <span class="small">Quarterly Exam (20%)</span>
          <span class="small fw-semibold">80.0</span>
        </div>
      </div>
      
      <div class="mt-3 pt-3 border-top">
        <div class="d-flex justify-content-between align-items-center">
          <span class="small text-muted">Quarter 1</span>
          <span class="badge bg-warning-subtle text-warning">Needs Improvement</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Detailed Grade Table -->
<div class="surface p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Detailed Grade Breakdown</h5>
    <div class="d-flex gap-2">
      <select class="form-select form-select-sm" style="width: auto;" id="subjectFilter">
        <option value="">All Subjects</option>
        <option value="math">Mathematics</option>
        <option value="science">Science</option>
        <option value="english">English</option>
        <option value="filipino">Filipino</option>
        <option value="history">History</option>
      </select>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Subject</th>
          <th>Grade Type</th>
          <th>Description</th>
          <th>Score</th>
          <th>Max Points</th>
          <th>Percentage</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><span class="fw-semibold">Mathematics</span></td>
          <td><span class="badge bg-primary-subtle text-primary">WW</span></td>
          <td>Algebra Quiz #1</td>
          <td><span class="fw-bold text-success">85</span></td>
          <td>100</td>
          <td><span class="fw-semibold">85.0%</span></td>
          <td>2024-01-15</td>
        </tr>
        <tr>
          <td><span class="fw-semibold">Mathematics</span></td>
          <td><span class="badge bg-warning-subtle text-warning">PT</span></td>
          <td>Problem Solving Project</td>
          <td><span class="fw-bold text-success">88</span></td>
          <td>100</td>
          <td><span class="fw-semibold">88.0%</span></td>
          <td>2024-01-20</td>
        </tr>
        <tr>
          <td><span class="fw-semibold">Mathematics</span></td>
          <td><span class="badge bg-info-subtle text-info">QE</span></td>
          <td>1st Quarter Exam</td>
          <td><span class="fw-bold text-success">90</span></td>
          <td>100</td>
          <td><span class="fw-semibold">90.0%</span></td>
          <td>2024-01-25</td>
        </tr>
        <tr>
          <td><span class="fw-semibold">Science</span></td>
          <td><span class="badge bg-primary-subtle text-primary">WW</span></td>
          <td>Chemistry Quiz #1</td>
          <td><span class="fw-bold text-success">90</span></td>
          <td>100</td>
          <td><span class="fw-semibold">90.0%</span></td>
          <td>2024-01-16</td>
        </tr>
        <tr>
          <td><span class="fw-semibold">Science</span></td>
          <td><span class="badge bg-warning-subtle text-warning">PT</span></td>
          <td>Lab Experiment Report</td>
          <td><span class="fw-bold text-success">95</span></td>
          <td>100</td>
          <td><span class="fw-semibold">95.0%</span></td>
          <td>2024-01-22</td>
        </tr>
        <tr>
          <td><span class="fw-semibold">English</span></td>
          <td><span class="badge bg-primary-subtle text-primary">WW</span></td>
          <td>Grammar Exercise</td>
          <td><span class="fw-bold text-warning">78</span></td>
          <td>100</td>
          <td><span class="fw-semibold">78.0%</span></td>
          <td>2024-01-17</td>
        </tr>
        <tr>
          <td><span class="fw-semibold">English</span></td>
          <td><span class="badge bg-warning-subtle text-warning">PT</span></td>
          <td>Essay Writing</td>
          <td><span class="fw-bold text-warning">72</span></td>
          <td>100</td>
          <td><span class="fw-semibold">72.0%</span></td>
          <td>2024-01-23</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Grade Trend Chart (Placeholder) -->
<div class="surface p-4 mt-4">
  <h5 class="fw-bold mb-4">Grade Trend</h5>
  <div class="text-center py-5">
    <svg width="64" height="64" fill="currentColor" class="text-muted mb-3">
      <use href="#icon-chart"></use>
    </svg>
    <p class="text-muted">Grade trend chart will be displayed here</p>
    <small class="text-muted">This will show your performance over time across all subjects</small>
  </div>
</div>

<script>
// Filter functionality
document.getElementById('quarterFilter').addEventListener('change', function() {
  const selectedQuarter = this.value;
  console.log('Filtering by quarter:', selectedQuarter);
  // Here you would filter the grade data
});

document.getElementById('subjectFilter').addEventListener('change', function() {
  const selectedSubject = this.value;
  console.log('Filtering by subject:', selectedSubject);
  // Here you would filter the grade data
});

function printGrades() {
  // Print functionality
  window.print();
}

// Add print styles
const printStyles = `
  @media print {
    .btn, .form-select, .dashboard-header .d-flex:last-child {
      display: none !important;
    }
    .surface {
      border: 1px solid #ddd !important;
      box-shadow: none !important;
    }
  }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = printStyles;
document.head.appendChild(styleSheet);
</script>
