<!-- Static Data Indicator -->
<?= $staticDataIndicator ?? '' ?>

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
        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#quickReportsModal">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-report"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">Quick Reports</span>
        </button>
        <div class="dropdown">
          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <svg width="16" height="16" fill="currentColor">
              <use href="#icon-plus"></use>
            </svg>
            <span class="d-none d-md-inline ms-1">Add New</span>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= \Helpers\Url::to('/admin/create-user') ?>">
              <svg width="16" height="16" fill="currentColor" class="me-2">
                <use href="#icon-user"></use>
              </svg>
              Create User
            </a></li>
            <li><a class="dropdown-item" href="<?= \Helpers\Url::to('/admin/create-parent') ?>">
              <svg width="16" height="16" fill="currentColor" class="me-2">
                <use href="#icon-user"></use>
              </svg>
              Create Parent
            </a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
              <svg width="16" height="16" fill="currentColor" class="me-2">
                <use href="#icon-download"></use>
              </svg>
              Bulk Import
            </a></li>
          </ul>
        </div>
        <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#systemSettingsModal">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-settings"></use>
          </svg>
          <span class="d-none d-md-inline ms-1">Settings</span>
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
        <p class="text-muted small mb-0">Total Students <?= \Helpers\StaticData::getStaticDataBadge() ?></p>
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
        <p class="text-muted small mb-0">Teachers <?= \Helpers\StaticData::getStaticDataBadge() ?></p>
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
        <p class="text-muted small mb-0">Pending Approvals <?= \Helpers\StaticData::getStaticDataBadge() ?></p>
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

<!-- Advanced Analytics Dashboard Section -->
<div class="row g-4 mb-4">
  <div class="col-12">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">School Analytics Overview</h5>
        <div class="d-flex gap-2">
          <select class="form-select form-select-sm" id="analyticsTimeframe" style="width: auto;">
            <option value="weekly">This Week</option>
            <option value="monthly" selected>This Month</option>
            <option value="quarterly">This Quarter</option>
            <option value="yearly">This Year</option>
          </select>
          <button class="btn btn-outline-primary btn-sm" onclick="exportAnalytics()">
            <svg width="14" height="14" fill="currentColor">
              <use href="#icon-download"></use>
            </svg>
          </button>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-md-8">
          <canvas id="schoolAnalyticsChart" height="100"></canvas>
        </div>
        <div class="col-md-4">
          <div class="text-center">
            <div class="display-6 fw-bold text-primary mb-1" data-count-to="<?= $studentCount + $teacherCount + $parentCount ?>">0</div>
            <div class="text-muted small mb-3">Total Users</div>
            <div class="d-flex justify-content-center gap-3">
              <div class="text-center">
                <div class="h5 fw-bold text-success mb-0" data-count-to="<?= $studentCount ?>">0</div>
                <div class="text-muted small">Students</div>
              </div>
              <div class="text-center">
                <div class="h5 fw-bold text-info mb-0" data-count-to="<?= $teacherCount ?>">0</div>
                <div class="text-muted small">Teachers</div>
              </div>
            </div>
            <div class="mt-3">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="small text-muted">Growth Rate</span>
                <span class="small fw-semibold text-success">+12.5%</span>
              </div>
              <div class="progress" style="height: 4px;">
                <div class="progress-bar bg-success" style="width: 75%" data-progress-to="75"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- System Performance & Alerts -->
<div class="row g-4 mb-4">
  <div class="col-md-8">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">System Performance</h5>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-primary btn-sm" onclick="refreshSystemStats()">
            <svg width="14" height="14" fill="currentColor">
              <use href="#icon-refresh"></use>
            </svg>
          </button>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-md-3">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-success mb-1" data-count-to="98.5" data-count-decimals="1">0.0</div>
            <div class="text-muted small">Uptime %</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-success" style="width: 98.5%" data-progress-to="98.5"></div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-primary mb-1" data-count-to="2.3" data-count-decimals="1">0.0</div>
            <div class="text-muted small">Avg Response (s)</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-primary" style="width: 85%" data-progress-to="85"></div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-info mb-1" data-count-to="15">0</div>
            <div class="text-muted small">Active Sessions</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-info" style="width: 75%" data-progress-to="75"></div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="text-center p-3 border rounded-3">
            <div class="h4 fw-bold text-warning mb-1" data-count-to="<?= $pendingCount ?>">0</div>
            <div class="text-muted small">Pending Tasks</div>
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar bg-warning" style="width: <?= $pendingCount > 0 ? '60' : '0' ?>%" data-progress-to="<?= $pendingCount > 0 ? '60' : '0' ?>"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">System Alerts</h5>
        <span class="badge bg-warning-subtle text-warning" id="alertCount">3</span>
      </div>
      <div class="alert-list">
        <div class="alert alert-warning alert-sm d-flex align-items-center mb-2">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-alerts"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">Low Disk Space</div>
            <div class="text-muted small">85% used</div>
          </div>
        </div>
        <div class="alert alert-info alert-sm d-flex align-items-center mb-2">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-user"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">New User Registrations</div>
            <div class="text-muted small">5 pending approval</div>
          </div>
        </div>
        <div class="alert alert-success alert-sm d-flex align-items-center">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-check"></use>
          </svg>
          <div class="flex-grow-1">
            <div class="small fw-semibold">Backup Completed</div>
            <div class="text-muted small">Last night at 2:00 AM</div>
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
          <a href="<?= \Helpers\Url::to('/admin/users') ?>" class="action-card d-block p-3 border rounded-3 text-decoration-none position-relative overflow-hidden" style="transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
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
          <a href="<?= \Helpers\Url::to('/admin/create-user') ?>" class="action-card d-block p-3 border rounded-3 text-decoration-none position-relative overflow-hidden" style="transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(25, 135, 84, 0.05) 0%, rgba(25, 135, 84, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-success-subtle text-success" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-plus"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">Create New User</div>
                  <div class="text-muted small">Add teachers, admins, or other staff</div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="<?= \Helpers\Url::to('/admin/create-parent') ?>" class="action-card d-block p-3 border rounded-3 text-decoration-none position-relative overflow-hidden" style="transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.05) 0%, rgba(255, 193, 7, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning-subtle text-warning" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">Create Parent Account</div>
                  <div class="text-muted small">Link parent accounts to students</div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="#" class="action-card d-block p-3 border rounded-3 text-decoration-none position-relative overflow-hidden" style="transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 202, 240, 0.05) 0%, rgba(13, 202, 240, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-info-subtle text-info" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-students"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">Manage Students</div>
                  <div class="text-muted small">Add, edit, and view student records</div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="#" class="action-card d-block p-3 border rounded-3 text-decoration-none position-relative overflow-hidden" style="transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(220, 53, 69, 0.05) 0%, rgba(220, 53, 69, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-danger-subtle text-danger" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-sections-admin"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">Manage Sections</div>
                  <div class="text-muted small">Class sections and schedules</div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="#" class="action-card d-block p-3 border rounded-3 text-decoration-none position-relative overflow-hidden" style="transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(111, 66, 193, 0.05) 0%, rgba(111, 66, 193, 0.02) 100%);"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-purple-subtle text-purple" style="width: 40px; height: 40px; transition: all 0.3s ease;">
                  <svg width="20" height="20" fill="currentColor">
                    <use href="#icon-settings"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">System Settings</div>
                  <div class="text-muted small">Configure system preferences</div>
                </div>
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

<!-- Quick Reports Modal -->
<div class="modal fade" id="quickReportsModal" tabindex="-1" aria-labelledby="quickReportsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quickReportsModalLabel">Quick Reports</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <div class="card border-0 bg-light">
              <div class="card-body text-center">
                <svg width="48" height="48" fill="currentColor" class="text-primary mb-3">
                  <use href="#icon-user"></use>
                </svg>
                <h6 class="fw-bold">User Report</h6>
                <p class="text-muted small">Generate comprehensive user statistics</p>
                <button class="btn btn-primary btn-sm" onclick="generateReport('users')">Generate</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card border-0 bg-light">
              <div class="card-body text-center">
                <svg width="48" height="48" fill="currentColor" class="text-success mb-3">
                  <use href="#icon-chart"></use>
                </svg>
                <h6 class="fw-bold">Analytics Report</h6>
                <p class="text-muted small">System performance and usage analytics</p>
                <button class="btn btn-success btn-sm" onclick="generateReport('analytics')">Generate</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card border-0 bg-light">
              <div class="card-body text-center">
                <svg width="48" height="48" fill="currentColor" class="text-warning mb-3">
                  <use href="#icon-alerts"></use>
                </svg>
                <h6 class="fw-bold">Activity Report</h6>
                <p class="text-muted small">Recent system activities and logs</p>
                <button class="btn btn-warning btn-sm" onclick="generateReport('activity')">Generate</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card border-0 bg-light">
              <div class="card-body text-center">
                <svg width="48" height="48" fill="currentColor" class="text-info mb-3">
                  <use href="#icon-download"></use>
                </svg>
                <h6 class="fw-bold">Export Data</h6>
                <p class="text-muted small">Export all system data to CSV</p>
                <button class="btn btn-info btn-sm" onclick="generateReport('export')">Export</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bulk Import Modal -->
<div class="modal fade" id="bulkImportModal" tabindex="-1" aria-labelledby="bulkImportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bulkImportModalLabel">Bulk Import Users</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-4">
          <label for="importFile" class="form-label">Select CSV File</label>
          <input type="file" class="form-control" id="importFile" accept=".csv" onchange="handleFileSelect(event)">
          <div class="form-text">Upload a CSV file with user data. <a href="#" onclick="downloadTemplate()">Download template</a></div>
        </div>
        <div id="importPreview" style="display: none;">
          <h6>Import Preview</h6>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="importPreviewBody">
                <!-- Preview data will be loaded here -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="importBtn" onclick="processImport()" disabled>Import Users</button>
      </div>
    </div>
  </div>
</div>

<!-- System Settings Modal -->
<div class="modal fade" id="systemSettingsModal" tabindex="-1" aria-labelledby="systemSettingsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="systemSettingsModalLabel">System Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h6 class="fw-bold mb-0">General Settings</h6>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="schoolName" class="form-label">School Name</label>
                  <input type="text" class="form-control" id="schoolName" value="Sample High School">
                </div>
                <div class="mb-3">
                  <label for="schoolYear" class="form-label">Current School Year</label>
                  <input type="text" class="form-control" id="schoolYear" value="2024-2025">
                </div>
                <div class="mb-3">
                  <label for="timezone" class="form-label">Timezone</label>
                  <select class="form-select" id="timezone">
                    <option value="UTC+8">UTC+8 (Philippines)</option>
                    <option value="UTC+0">UTC+0 (GMT)</option>
                    <option value="UTC-5">UTC-5 (EST)</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h6 class="fw-bold mb-0">Security Settings</h6>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="twoFactorAuth" checked>
                    <label class="form-check-label" for="twoFactorAuth">Enable Two-Factor Authentication</label>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="sessionTimeout" checked>
                    <label class="form-check-label" for="sessionTimeout">Auto Session Timeout</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="passwordPolicy" class="form-label">Password Policy</label>
                  <select class="form-select" id="passwordPolicy">
                    <option value="strong">Strong (8+ chars, mixed case, numbers, symbols)</option>
                    <option value="medium">Medium (6+ chars, mixed case, numbers)</option>
                    <option value="basic">Basic (6+ chars)</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h6 class="fw-bold mb-0">Backup Settings</h6>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="autoBackup" checked>
                    <label class="form-check-label" for="autoBackup">Automatic Daily Backup</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="backupTime" class="form-label">Backup Time</label>
                  <input type="time" class="form-control" id="backupTime" value="02:00">
                </div>
                <div class="mb-3">
                  <label for="backupRetention" class="form-label">Backup Retention (days)</label>
                  <input type="number" class="form-control" id="backupRetention" value="30" min="1" max="365">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h6 class="fw-bold mb-0">Notification Settings</h6>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                    <label class="form-check-label" for="emailNotifications">Email Notifications</label>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="systemAlerts" checked>
                    <label class="form-check-label" for="systemAlerts">System Alerts</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="alertEmail" class="form-label">Alert Email</label>
                  <input type="email" class="form-control" id="alertEmail" value="admin@school.edu">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="saveSystemSettings()">Save Settings</button>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js and Admin Dashboard Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= \Helpers\Url::asset('admin-dashboard-safe.js') ?>"></script>
<script src="<?= \Helpers\Url::asset('admin-dashboard-enhanced.js') ?>"></script>

