<!-- Enhanced Dashboard Header with Gradient Background -->
<div class="dashboard-header mb-4 position-relative overflow-hidden">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); opacity: 0.1;"></div>
  <div class="position-relative">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h1 class="h3 fw-bold mb-1 text-primary">Student Dashboard</h1>
        <p class="text-muted mb-0">Welcome back, <span class="fw-semibold text-dark"><?= htmlspecialchars($user['name'] ?? 'Student') ?></span>! Here's your academic overview.</p>
        <div class="d-flex align-items-center gap-3 mt-2">
          <span class="badge bg-primary-subtle text-primary">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-user"></use>
            </svg>
            Grade 10-A
          </span>
          <span class="badge bg-success-subtle text-success">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-star"></use>
            </svg>
            LRN: 123456789012
          </span>
        </div>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm" onclick="location.href='/grade/student-view'">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">View Grades</span>
        </button>
        <button class="btn btn-primary btn-sm">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-report"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">Print Report</span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Student Statistics Cards with Animations -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4 h-100 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
      <div class="position-absolute top-0 end-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.05) 100%);"></div>
      <div class="position-relative">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="stat-icon bg-primary-subtle text-primary" style="transition: all 0.3s ease;">
            <svg width="24" height="24" fill="currentColor">
              <use href="#icon-chart"></use>
            </svg>
          </div>
          <span class="badge bg-primary-subtle text-primary">Current</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-primary" data-count-to="85.2" data-count-decimals="1">0.0</h3>
        <p class="text-muted small mb-0">Overall Average</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-primary" style="width: 85.2%" data-progress-to="85.2"></div>
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
              <use href="#icon-star"></use>
            </svg>
          </div>
          <span class="badge bg-success-subtle text-success">8/10</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-success" data-count-to="8">0</h3>
        <p class="text-muted small mb-0">Passing Subjects</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-success" style="width: 80%" data-progress-to="80"></div>
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
              <use href="#icon-alerts"></use>
            </svg>
          </div>
          <span class="badge bg-warning-subtle text-warning">2</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-warning" data-count-to="2">0</h3>
        <p class="text-muted small mb-0">Needs Improvement</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-warning" style="width: 20%" data-progress-to="20"></div>
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
              <use href="#icon-performance"></use>
            </svg>
          </div>
          <span class="badge bg-info-subtle text-info">+3.2%</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-info">+<span data-count-to="3.2" data-count-decimals="1">0.0</span>%</h3>
        <p class="text-muted small mb-0">Improvement</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-info" style="width: 60%" data-progress-to="60"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Performance Chart Section -->
<div class="row g-4 mb-4">
  <div class="col-12">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Academic Performance Trend</h5>
        <div class="d-flex gap-2">
          <select class="form-select form-select-sm" style="width: auto;">
            <option value="quarterly">Quarterly</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
          </select>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-8">
          <canvas id="performanceChart" height="100"></canvas>
        </div>
        <div class="col-md-4">
          <div class="text-center">
            <div class="display-6 fw-bold text-primary mb-1">85.2</div>
            <div class="text-muted small mb-3">Current Average</div>
            <div class="d-flex justify-content-center gap-3">
              <div class="text-center">
                <div class="h5 fw-bold text-success mb-0">+3.2%</div>
                <div class="text-muted small">vs Last Quarter</div>
              </div>
              <div class="text-center">
                <div class="h5 fw-bold text-info mb-0">8/10</div>
                <div class="text-muted small">Passing Subjects</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <!-- Current Grades Overview -->
  <div class="col-lg-8">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Current Grades (1st Quarter)</h5>
        <div class="d-flex align-items-center gap-3">
          <span class="text-muted small">Grade 10-A</span>
          <div class="btn-group btn-group-sm" role="group">
            <input type="radio" class="btn-check" name="quarter" id="q1" checked>
            <label class="btn btn-outline-primary" for="q1">Q1</label>
            <input type="radio" class="btn-check" name="quarter" id="q2">
            <label class="btn btn-outline-primary" for="q2">Q2</label>
            <input type="radio" class="btn-check" name="quarter" id="q3">
            <label class="btn btn-outline-primary" for="q3">Q3</label>
            <input type="radio" class="btn-check" name="quarter" id="q4">
            <label class="btn btn-outline-primary" for="q4">Q4</label>
          </div>
        </div>
      </div>
      
      <div class="row g-3">
        <!-- Mathematics -->
        <div class="col-md-6">
          <div class="action-card d-block p-3 border rounded-3 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary-subtle text-primary" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                </div>
                <div class="flex-grow-1">
                  <div class="fw-semibold">Mathematics</div>
                  <div class="text-muted small">Overall: <span class="fw-bold text-success">87.5</span></div>
                  <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-success" style="width: 87.5%" data-progress-to="87.5"></div>
                  </div>
                  <div class="d-flex justify-content-between mt-1">
                    <small class="text-muted">WW: 85 | PT: 88 | QE: 90</small>
                  </div>
                </div>
                <div class="text-end">
                  <span class="badge bg-success-subtle text-success">Passed</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Science -->
        <div class="col-md-6">
          <div class="action-card d-block p-3 border rounded-3 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(25, 135, 84, 0.05) 0%, rgba(25, 135, 84, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-success-subtle text-success" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-star"></use>
                  </svg>
                </div>
                <div class="flex-grow-1">
                  <div class="fw-semibold">Science</div>
                  <div class="text-muted small">Overall: <span class="fw-bold text-success">92.3</span></div>
                  <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-success" style="width: 92.3%" data-progress-to="92.3"></div>
                  </div>
                  <div class="d-flex justify-content-between mt-1">
                    <small class="text-muted">WW: 90 | PT: 94 | QE: 93</small>
                  </div>
                </div>
                <div class="text-end">
                  <span class="badge bg-success-subtle text-success">Passed</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- English -->
        <div class="col-md-6">
          <div class="action-card d-block p-3 border rounded-3 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.05) 0%, rgba(255, 193, 7, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning-subtle text-warning" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-alerts"></use>
                  </svg>
                </div>
                <div class="flex-grow-1">
                  <div class="fw-semibold">English</div>
                  <div class="text-muted small">Overall: <span class="fw-bold text-warning">75.8</span></div>
                  <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-warning" style="width: 75.8%" data-progress-to="75.8"></div>
                  </div>
                  <div class="d-flex justify-content-between mt-1">
                    <small class="text-muted">WW: 72 | PT: 78 | QE: 77</small>
                  </div>
                </div>
                <div class="text-end">
                  <span class="badge bg-warning-subtle text-warning">Needs Improvement</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Filipino -->
        <div class="col-md-6">
          <div class="action-card d-block p-3 border rounded-3 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 202, 240, 0.05) 0%, rgba(13, 202, 240, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-info-subtle text-info" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-performance"></use>
                  </svg>
                </div>
                <div class="flex-grow-1">
                  <div class="fw-semibold">Filipino</div>
                  <div class="text-muted small">Overall: <span class="fw-bold text-success">88.2</span></div>
                  <div class="progress mt-1" style="height: 4px;">
                    <div class="progress-bar bg-success" style="width: 88.2%" data-progress-to="88.2"></div>
                  </div>
                  <div class="d-flex justify-content-between mt-1">
                    <small class="text-muted">WW: 86 | PT: 89 | QE: 90</small>
                  </div>
                </div>
                <div class="text-end">
                  <span class="badge bg-success-subtle text-success">Passed</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="mt-4 pt-3 border-top">
        <div class="d-flex justify-content-between align-items-center">
          <span class="text-muted small">View detailed grades and breakdown</span>
          <button class="btn btn-outline-primary btn-sm" onclick="location.href='/grade/student-view'">
            View All Grades
            <svg width="16" height="16" fill="currentColor" class="ms-1">
              <use href="#icon-chart"></use>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Recent Activity & Quick Actions -->
  <div class="col-lg-4">
    <div class="surface p-4 mb-4">
      <h5 class="fw-bold mb-4">Recent Activity</h5>
      <div class="activity-list">
        <div class="activity-item d-flex gap-3 mb-3">
          <svg class="activity-icon" width="20" height="20" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">New grade posted</div>
            <div class="text-muted small">Math Quiz #3: 85/100</div>
            <div class="text-muted small">2 hours ago</div>
          </div>
        </div>
        <div class="activity-item d-flex gap-3 mb-3">
          <svg class="activity-icon" width="20" height="20" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">Alert received</div>
            <div class="text-muted small">English grade needs improvement</div>
            <div class="text-muted small">1 day ago</div>
          </div>
        </div>
        <div class="activity-item d-flex gap-3">
          <svg class="activity-icon" width="20" height="20" fill="currentColor">
            <use href="#icon-star"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">Achievement unlocked</div>
            <div class="text-muted small">Science Excellence Award</div>
            <div class="text-muted small">3 days ago</div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Quick Actions</h5>
      <div class="d-grid gap-2">
        <button class="btn btn-outline-primary" onclick="location.href='/grade/student-view'">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-chart"></use>
          </svg>
          View My Grades
        </button>
        <button class="btn btn-outline-secondary">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-report"></use>
          </svg>
          Print Report Card
        </button>
        <button class="btn btn-outline-info">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-alerts"></use>
          </svg>
          View Alerts
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Upcoming Assignments -->
<div class="surface p-4 mt-4">
  <h5 class="fw-bold mb-4">Upcoming Assignments & Exams</h5>
  <div class="row g-3">
    <div class="col-md-6 col-lg-4">
      <div class="border rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <h6 class="fw-semibold mb-0">Math Quiz #4</h6>
          <span class="badge bg-primary-subtle text-primary">Mathematics</span>
        </div>
        <p class="text-muted small mb-2">Algebra and Geometry</p>
        <div class="d-flex justify-content-between align-items-center">
          <span class="text-muted small">Due: Jan 30, 2024</span>
          <span class="badge bg-warning-subtle text-warning">2 days left</span>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="border rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <h6 class="fw-semibold mb-0">Science Project</h6>
          <span class="badge bg-success-subtle text-success">Science</span>
        </div>
        <p class="text-muted small mb-2">Environmental Impact Study</p>
        <div class="d-flex justify-content-between align-items-center">
          <span class="text-muted small">Due: Feb 5, 2024</span>
          <span class="badge bg-info-subtle text-info">1 week left</span>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="border rounded-3 p-3">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <h6 class="fw-semibold mb-0">English Essay</h6>
          <span class="badge bg-warning-subtle text-warning">English</span>
        </div>
        <p class="text-muted small mb-2">Argumentative Essay</p>
        <div class="d-flex justify-content-between align-items-center">
          <span class="text-muted small">Due: Feb 8, 2024</span>
          <span class="badge bg-info-subtle text-info">1 week left</span>
        </div>
      </div>
    </div>
  </div>
</div>



 
 < ! - -   C h a r t . j s   a n d   D a s h b o a r d   S c r i p t s   - - > 
 
 < s c r i p t   s r c = " h t t p s : / / c d n . j s d e l i v r . n e t / n p m / c h a r t . j s " > < / s c r i p t > 
 
 < s c r i p t   s r c = " / a s s e t s / s t u d e n t - d a s h b o a r d . j s " > < / s c r i p t > 
 
 