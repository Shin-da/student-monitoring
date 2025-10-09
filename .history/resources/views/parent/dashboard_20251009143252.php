<!-- Enhanced Parent Dashboard Header -->
<div class="dashboard-header mb-4 position-relative overflow-hidden">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); opacity: 0.1;"></div>
  <div class="position-relative">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h1 class="h3 fw-bold mb-1 text-primary">Parent Dashboard</h1>
        <p class="text-muted mb-0">Welcome back, <span class="fw-semibold text-dark"><?= htmlspecialchars($user['name'] ?? 'Parent') ?></span>! Monitor your child's academic progress.</p>
        <div class="d-flex align-items-center gap-3 mt-2">
          <span class="badge bg-primary-subtle text-primary">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-parent"></use>
            </svg>
            Parent Account
          </span>
          <span class="badge bg-success-subtle text-success">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-user"></use>
            </svg>
            Linked to 1 Student
          </span>
        </div>
      </div>
      <div class="d-flex gap-2">
  <button class="btn btn-outline-primary btn-sm" onclick="location.href='<?= \Helpers\Url::to('/grade/student-view') ?>'">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">View Grades</span>
        </button>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#contactTeacherModal">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-user"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">Contact Teacher</span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Child Selection -->
<div class="row g-4 mb-4">
  <div class="col-12">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Select Child</h5>
        <span class="text-muted small">Choose which child's information to view</span>
      </div>
      <div class="row g-3">
        <div class="col-md-6">
          <div class="child-card border rounded-3 p-3 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary-subtle text-primary" style="width: 50px; height: 50px; transition: all 0.3s ease;">
                  <svg width="24" height="24" fill="currentColor">
                    <use href="#icon-student"></use>
                  </svg>
                </div>
                <div class="flex-grow-1">
                  <div class="fw-semibold h6 mb-1">John Michael Doe</div>
                  <div class="text-muted small">Grade 10-A • LRN: 123456789012</div>
                  <div class="text-muted small">Section: Einstein • Age: 15</div>
                  <div class="d-flex align-items-center gap-2 mt-2">
                    <span class="badge bg-success-subtle text-success">Active</span>
                    <span class="badge bg-primary-subtle text-primary">Overall: 85.2</span>
                  </div>
                </div>
                <div class="text-end">
                  <button class="btn btn-primary btn-sm" onclick="selectChild('john')">
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
</div>

<!-- Enhanced Parent Statistics Cards -->
<div class="row g-4 mb-5" id="childStats" style="display: none;">
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
        <p class="text-muted small mb-0">Active Alerts</p>
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
          <span class="badge bg-info-subtle text-info">95%</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-info" data-count-to="95">0</h3>
        <p class="text-muted small mb-0">Attendance Rate</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-info" style="width: 95%" data-progress-to="95"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Child's Academic Overview -->
<div class="row g-4" id="childOverview" style="display: none;">
  <!-- Current Grades -->
  <div class="col-lg-8">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Current Grades (1st Quarter)</h5>
        <div class="d-flex align-items-center gap-3">
          <span class="text-muted small">John Michael Doe - Grade 10-A</span>
          <div class="btn-group btn-group-sm" role="group">
            <input type="radio" class="btn-check" name="quarter" id="pq1" checked>
            <label class="btn btn-outline-primary" for="pq1">Q1</label>
            <input type="radio" class="btn-check" name="quarter" id="pq2">
            <label class="btn btn-outline-primary" for="pq2">Q2</label>
            <input type="radio" class="btn-check" name="quarter" id="pq3">
            <label class="btn btn-outline-primary" for="pq3">Q3</label>
            <input type="radio" class="btn-check" name="quarter" id="pq4">
            <label class="btn btn-outline-primary" for="pq4">Q4</label>
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
          <button class="btn btn-outline-primary btn-sm" onclick="location.href='<?= \Helpers\Url::to('/grade/student-view') ?>'">
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
  <button class="btn btn-outline-primary" onclick="location.href='<?= \Helpers\Url::to('/grade/student-view') ?>'">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-chart"></use>
          </svg>
          View Child's Grades
        </button>
        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#contactTeacherModal">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-user"></use>
          </svg>
          Contact Teacher
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

<!-- Contact Teacher Modal -->
<div class="modal fade" id="contactTeacherModal" tabindex="-1" aria-labelledby="contactTeacherModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactTeacherModalLabel">Contact Teacher</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="contactTeacherForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-12">
              <label for="teacherSelect" class="form-label">Select Teacher <span class="text-danger">*</span></label>
              <select class="form-select" id="teacherSelect" name="teacher_id" required>
                <option value="">Choose a teacher...</option>
                <option value="1">Ms. Sarah Johnson - Mathematics</option>
                <option value="2">Mr. Michael Chen - Science</option>
                <option value="3">Ms. Emily Rodriguez - English</option>
                <option value="4">Mr. David Kim - Filipino</option>
              </select>
            </div>
            <div class="col-12">
              <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="subject" name="subject" placeholder="e.g., Concern about Math grades" required>
            </div>
            <div class="col-12">
              <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
              <textarea class="form-control" id="message" name="message" rows="4" placeholder="Please describe your concern or question..." required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Child selection functionality
function selectChild(childId) {
  // Show child statistics and overview
  document.getElementById('childStats').style.display = 'block';
  document.getElementById('childOverview').style.display = 'block';
  
  // Scroll to stats section
  document.getElementById('childStats').scrollIntoView({ behavior: 'smooth' });
  
  // Animate counters
  setTimeout(() => {
    const counters = document.querySelectorAll('[data-count-to]');
    counters.forEach(counter => {
      const target = parseFloat(counter.getAttribute('data-count-to'));
      const decimals = counter.getAttribute('data-count-decimals') || 0;
      const duration = 2000;
      const start = performance.now();
      
      function updateCounter(currentTime) {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        const current = progress * target;
        
        if (decimals > 0) {
          counter.textContent = current.toFixed(decimals);
        } else {
          counter.textContent = Math.floor(current);
        }
        
        if (progress < 1) {
          requestAnimationFrame(updateCounter);
        }
      }
      
      requestAnimationFrame(updateCounter);
    });
    
    // Animate progress bars
    const progressBars = document.querySelectorAll('[data-progress-to]');
    progressBars.forEach(bar => {
      const target = parseFloat(bar.getAttribute('data-progress-to'));
      const duration = 1500;
      const start = performance.now();
      
      function updateProgress(currentTime) {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        const current = progress * target;
        
        bar.style.width = current + '%';
        
        if (progress < 1) {
          requestAnimationFrame(updateProgress);
        }
      }
      
      requestAnimationFrame(updateProgress);
    });
  }, 300);
}

// Contact teacher form submission
document.getElementById('contactTeacherForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const teacherId = document.getElementById('teacherSelect').value;
  const subject = document.getElementById('subject').value;
  const message = document.getElementById('message').value;
  
  if (teacherId && subject && message) {
    // Close modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('contactTeacherModal'));
    modal.hide();
    
    // Show success message
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
    alertDiv.innerHTML = `
      <svg width="20" height="20" fill="currentColor" class="me-2">
        <use href="#icon-check"></use>
      </svg>
      <strong>Message sent!</strong> Your message has been sent to the teacher.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.querySelector('.dashboard-header').parentNode.insertBefore(alertDiv, document.querySelector('.dashboard-header').nextSibling);
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
      if (alertDiv.parentNode) {
        alertDiv.remove();
      }
    }, 5000);
    
    // Reset form
    this.reset();
  }
});
</script>

