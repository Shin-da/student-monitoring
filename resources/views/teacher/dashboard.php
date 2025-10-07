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
            Mathematics & Science Teacher
          </span>
          <span class="badge bg-success-subtle text-success">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-star"></use>
            </svg>
            3 Sections Assigned
          </span>
        </div>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm" onclick="location.href='/grade'">
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

<!-- Enhanced Teacher Statistics Cards with Animations -->
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
          <span class="badge bg-primary-subtle text-primary">3</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-primary" data-count-to="3">0</h3>
        <p class="text-muted small mb-0">Assigned Sections</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-primary" style="width: 75%" data-progress-to="75"></div>
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
          <span class="badge bg-success-subtle text-success">+5%</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-success" data-count-to="127">0</h3>
        <p class="text-muted small mb-0">Total Students</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-success" style="width: 85%" data-progress-to="85"></div>
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
          <span class="badge bg-warning-subtle text-warning">2</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-warning" data-count-to="2">0</h3>
        <p class="text-muted small mb-0">Subjects Taught</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-warning" style="width: 60%" data-progress-to="60"></div>
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
          <span class="badge bg-info-subtle text-info">5</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-info" data-count-to="5">0</h3>
        <p class="text-muted small mb-0">Pending Alerts</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-info" style="width: 25%" data-progress-to="25"></div>
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
      <div class="row g-3">
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
                  <div class="fw-semibold">Grade 10-A</div>
                  <div class="text-muted small">Mathematics • 42 students</div>
                  <div class="text-muted small">Schedule: Mon, Wed, Fri 8:00-9:00 AM</div>
                  <div class="progress mt-2" style="height: 3px;">
                    <div class="progress-bar bg-primary" style="width: 85%" data-progress-to="85"></div>
                  </div>
                </div>
                <div class="d-flex flex-column gap-1">
                  <button class="btn btn-sm btn-outline-primary">View</button>
                  <button class="btn btn-sm btn-outline-secondary">Grades</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="action-card d-block p-3 border rounded-3 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(25, 135, 84, 0.05) 0%, rgba(25, 135, 84, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-success-subtle text-success" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-sections"></use>
                  </svg>
                </div>
                <div class="flex-grow-1">
                  <div class="fw-semibold">Grade 10-B</div>
                  <div class="text-muted small">Mathematics • 38 students</div>
                  <div class="text-muted small">Schedule: Tue, Thu 9:00-10:00 AM</div>
                  <div class="progress mt-2" style="height: 3px;">
                    <div class="progress-bar bg-success" style="width: 78%" data-progress-to="78"></div>
                  </div>
                </div>
                <div class="d-flex flex-column gap-1">
                  <button class="btn btn-sm btn-outline-primary">View</button>
                  <button class="btn btn-sm btn-outline-secondary">Grades</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="action-card d-block p-3 border rounded-3 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.05) 0%, rgba(255, 193, 7, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning-subtle text-warning" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-sections"></use>
                  </svg>
                </div>
                <div class="flex-grow-1">
                  <div class="fw-semibold">Grade 9-A</div>
                  <div class="text-muted small">Science • 45 students</div>
                  <div class="text-muted small">Schedule: Mon, Wed 10:00-11:00 AM</div>
                  <div class="progress mt-2" style="height: 3px;">
                    <div class="progress-bar bg-warning" style="width: 92%" data-progress-to="92"></div>
                  </div>
                </div>
                <div class="d-flex flex-column gap-1">
                  <button class="btn btn-sm btn-outline-primary">View</button>
                  <button class="btn btn-sm btn-outline-secondary">Grades</button>
                </div>
              </div>
            </div>
          </div>
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
            <div class="small fw-semibold">Grade entered</div>
            <div class="text-muted small">Math Quiz #3 for Grade 10-A</div>
            <div class="text-muted small">2 hours ago</div>
          </div>
        </div>
        <div class="activity-item d-flex gap-3 mb-3">
          <svg class="activity-icon" width="20" height="20" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">Alert created</div>
            <div class="text-muted small">Low performance in Grade 9-A Science</div>
            <div class="text-muted small">4 hours ago</div>
          </div>
        </div>
        <div class="activity-item d-flex gap-3">
          <svg class="activity-icon" width="20" height="20" fill="currentColor">
            <use href="#icon-user"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">Student consultation</div>
            <div class="text-muted small">Meeting with John Doe about grades</div>
            <div class="text-muted small">6 hours ago</div>
          </div>
        </div>
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
 < ! - -   T e a c h e r   D a s h b o a r d   S c r i p t s   - - >  
 < s c r i p t   s r c = " / a s s e t s / s t u d e n t - d a s h b o a r d . j s " > < / s c r i p t >  
 