<!-- Epic Admin Dashboard Header -->
<div class="dashboard-header mb-4 position-relative overflow-hidden">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); opacity: 0.1;"></div>
  <div class="position-relative">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h1 class="h3 fw-bold mb-1 text-primary">Admin Dashboard</h1>
        <p class="text-muted mb-0">Welcome back, <span class="fw-semibold text-dark"><?= htmlspecialchars($user['name'] ?? 'Admin') ?></span>! Here's your comprehensive school overview.</p>
        <div class="d-flex align-items-center gap-3 mt-2">
          <span class="badge bg-primary-subtle text-primary">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-user"></use>
            </svg>
            System Administrator
          </span>
          <span class="badge bg-success-subtle text-success">
            <svg width="14" height="14" fill="currentColor" class="me-1">
              <use href="#icon-star"></use>
            </svg>
            Full Access
          </span>
        </div>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-report"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">Reports</span>
        </button>
        <button class="btn btn-primary btn-sm">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-plus"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">Add New</span>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Statistics Cards with Animations -->
<div class="row g-4 mb-5">
  <div class="col-md-6 col-lg-3">
    <div class="stat-card surface p-4 h-100 position-relative overflow-hidden" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
      <div class="position-absolute top-0 end-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.05) 100%);"></div>
      <div class="position-relative">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="stat-icon bg-primary-subtle text-primary" style="transition: all 0.3s ease;">
            <svg width="24" height="24" fill="currentColor">
              <use href="#icon-students"></use>
            </svg>
          </div>
          <?php 
          $studentCount = 0;
          foreach ($userStats as $stat) {
            if ($stat['role'] === 'student') {
              $studentCount = $stat['count'];
              break;
            }
          }
          ?>
          <span class="badge bg-primary-subtle text-primary">Active</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-primary" data-count-to="<?= $studentCount ?>">0</h3>
        <p class="text-muted small mb-0">Total Students</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-primary" style="width: 85%" data-progress-to="85"></div>
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
              <use href="#icon-teachers"></use>
            </svg>
          </div>
          <?php 
          $teacherCount = 0;
          foreach ($userStats as $stat) {
            if ($stat['role'] === 'teacher') {
              $teacherCount = $stat['count'];
              break;
            }
          }
          ?>
          <span class="badge bg-success-subtle text-success">Active</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-success" data-count-to="<?= $teacherCount ?>">0</h3>
        <p class="text-muted small mb-0">Teachers</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-success" style="width: 75%" data-progress-to="75"></div>
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
              <use href="#icon-user"></use>
            </svg>
          </div>
          <?php if ($pendingCount > 0): ?>
          <span class="badge bg-warning-subtle text-warning"><?= $pendingCount ?> pending</span>
          <?php else: ?>
          <span class="badge bg-success-subtle text-success">All approved</span>
          <?php endif; ?>
        </div>
        <h3 class="h4 fw-bold mb-1 text-warning" data-count-to="<?= $pendingCount ?>">0</h3>
        <p class="text-muted small mb-0">Pending Approvals</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-warning" style="width: <?= $pendingCount > 0 ? '60' : '100' ?>%" data-progress-to="<?= $pendingCount > 0 ? '60' : '100' ?>"></div>
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
              <use href="#icon-sections-admin"></use>
            </svg>
          </div>
          <?php 
          $parentCount = 0;
          foreach ($userStats as $stat) {
            if ($stat['role'] === 'parent') {
              $parentCount = $stat['count'];
              break;
            }
          }
          ?>
          <span class="badge bg-info-subtle text-info">Active</span>
        </div>
        <h3 class="h4 fw-bold mb-1 text-info" data-count-to="<?= $parentCount ?>">0</h3>
        <p class="text-muted small mb-0">Parents</p>
        <div class="progress mt-2" style="height: 4px;">
          <div class="progress-bar bg-info" style="width: 70%" data-progress-to="70"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Analytics Dashboard Section -->
<div class="row g-4 mb-4">
  <div class="col-12">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">School Analytics Overview</h5>
        <div class="d-flex gap-2">
          <select class="form-select form-select-sm" style="width: auto;">
            <option value="monthly">This Month</option>
            <option value="quarterly">This Quarter</option>
            <option value="yearly">This Year</option>
          </select>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-8">
          <canvas id="schoolAnalyticsChart" height="100"></canvas>
        </div>
        <div class="col-md-4">
          <div class="text-center">
            <div class="display-6 fw-bold text-primary mb-1"><?= $studentCount + $teacherCount + $parentCount ?></div>
            <div class="text-muted small mb-3">Total Users</div>
            <div class="d-flex justify-content-center gap-3">
              <div class="text-center">
                <div class="h5 fw-bold text-success mb-0"><?= $studentCount ?></div>
                <div class="text-muted small">Students</div>
              </div>
              <div class="text-center">
                <div class="h5 fw-bold text-info mb-0"><?= $teacherCount ?></div>
                <div class="text-muted small">Teachers</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- User Distribution Chart -->
<div class="row g-4 mb-4">
  <div class="col-md-6">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">User Distribution</h5>
      <canvas id="userDistributionChart" height="200"></canvas>
    </div>
  </div>
  <div class="col-md-6">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">System Health</h5>
      <div class="row g-3">
        <div class="col-6">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-success mb-1">98.5%</div>
            <div class="text-muted small">Uptime</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-success" style="width: 98.5%" data-progress-to="98.5"></div>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-primary mb-1">2.3s</div>
            <div class="text-muted small">Avg Response</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-primary" style="width: 85%" data-progress-to="85"></div>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-warning mb-1"><?= $pendingCount ?></div>
            <div class="text-muted small">Pending Tasks</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-warning" style="width: <?= $pendingCount > 0 ? '60' : '0' ?>%" data-progress-to="<?= $pendingCount > 0 ? '60' : '0' ?>"></div>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-info mb-1">15</div>
            <div class="text-muted small">Active Sessions</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-info" style="width: 75%" data-progress-to="75"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Quick Actions</h5>
        <span class="text-muted small">Manage your school</span>
      </div>
      <div class="row g-3">
        <div class="col-md-6">
          <a href="/admin/users" class="action-card d-block p-3 border rounded-3 text-decoration-none position-relative overflow-hidden" style="transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary-subtle text-primary" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">User Management</div>
                  <div class="text-muted small">Approve, manage, and create user accounts</div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="/admin/create-user" class="action-card d-block p-3 border rounded-3 text-decoration-none">
            <div class="d-flex align-items-center gap-3">
              <svg class="action-icon" width="24" height="24" fill="currentColor">
                <use href="#icon-plus"></use>
              </svg>
              <div>
                <div class="fw-semibold">Create New User</div>
                <div class="text-muted small">Add teachers, admins, or other staff</div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="/admin/create-parent" class="action-card d-block p-3 border rounded-3 text-decoration-none">
            <div class="d-flex align-items-center gap-3">
              <svg class="action-icon" width="24" height="24" fill="currentColor">
                <use href="#icon-user"></use>
              </svg>
              <div>
                <div class="fw-semibold">Create Parent Account</div>
                <div class="text-muted small">Link parent accounts to students</div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="#" class="action-card d-block p-3 border rounded-3 text-decoration-none">
            <div class="d-flex align-items-center gap-3">
              <svg class="action-icon" width="24" height="24" fill="currentColor">
                <use href="#icon-students"></use>
              </svg>
              <div>
                <div class="fw-semibold">Manage Students</div>
                <div class="text-muted small">Add, edit, and view student records</div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="#" class="action-card d-block p-3 border rounded-3 text-decoration-none">
            <div class="d-flex align-items-center gap-3">
              <svg class="action-icon" width="24" height="24" fill="currentColor">
                <use href="#icon-sections-admin"></use>
              </svg>
              <div>
                <div class="fw-semibold">Manage Sections</div>
                <div class="text-muted small">Class sections and schedules</div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Recent Activity</h5>
      <div class="activity-list">
        <div class="activity-item d-flex gap-3 mb-3">
          <svg class="activity-icon" width="20" height="20" fill="currentColor">
            <use href="#icon-user"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">New student enrolled</div>
            <div class="text-muted small">John Doe in Grade 10-A</div>
            <div class="text-muted small">2 hours ago</div>
          </div>
        </div>
        <div class="activity-item d-flex gap-3 mb-3">
          <svg class="activity-icon" width="20" height="20" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">Attendance report generated</div>
            <div class="text-muted small">Monthly summary for November</div>
            <div class="text-muted small">4 hours ago</div>
          </div>
        </div>
        <div class="activity-item d-flex gap-3">
          <svg class="activity-icon" width="20" height="20" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">New alert created</div>
            <div class="text-muted small">Low attendance in Grade 9-B</div>
            <div class="text-muted small">6 hours ago</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js and Admin Dashboard Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/assets/admin-dashboard-safe.js"></script>

