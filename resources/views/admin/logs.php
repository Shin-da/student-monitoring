<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">System Logs & Audit Trail</h1>
      <p class="text-muted mb-0">Monitor system activities, security events, and user actions</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" onclick="exportLogs()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Export Logs</span>
      </button>
      <button class="btn btn-outline-warning btn-sm" onclick="clearOldLogs()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-refresh"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Clear Old Logs</span>
      </button>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#logSettingsModal">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-settings"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Log Settings</span>
      </button>
    </div>
  </div>
</div>

<!-- Log Statistics -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="stat-card surface p-4 text-center">
      <div class="stat-icon bg-info-subtle text-info mx-auto mb-3">
        <svg width="32" height="32" fill="currentColor">
          <use href="#icon-chart"></use>
        </svg>
      </div>
      <h3 class="h4 fw-bold text-info mb-1" data-count-to="1247">0</h3>
      <p class="text-muted mb-0">Total Logs Today</p>
      <div class="progress mt-2" style="height: 4px;">
        <div class="progress-bar bg-info" style="width: 75%" data-progress-to="75"></div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stat-card surface p-4 text-center">
      <div class="stat-icon bg-success-subtle text-success mx-auto mb-3">
        <svg width="32" height="32" fill="currentColor">
          <use href="#icon-check"></use>
        </svg>
      </div>
      <h3 class="h4 fw-bold text-success mb-1" data-count-to="98.2" data-count-decimals="1">0.0</h3>
      <p class="text-muted mb-0">System Health %</p>
      <div class="progress mt-2" style="height: 4px;">
        <div class="progress-bar bg-success" style="width: 98.2%" data-progress-to="98.2"></div>
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
      <p class="text-muted mb-0">Warnings</p>
      <div class="progress mt-2" style="height: 4px;">
        <div class="progress-bar bg-warning" style="width: 60%" data-progress-to="60"></div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="stat-card surface p-4 text-center">
      <div class="stat-icon bg-danger-subtle text-danger mx-auto mb-3">
        <svg width="32" height="32" fill="currentColor">
          <use href="#icon-alerts"></use>
        </svg>
      </div>
      <h3 class="h4 fw-bold text-danger mb-1" data-count-to="3">0</h3>
      <p class="text-muted mb-0">Critical Errors</p>
      <div class="progress mt-2" style="height: 4px;">
        <div class="progress-bar bg-danger" style="width: 15%" data-progress-to="15"></div>
      </div>
    </div>
  </div>
</div>

<!-- Log Filters and Search -->
<div class="surface p-4 mb-4">
  <div class="row g-3">
    <div class="col-md-3">
      <div class="input-group">
        <span class="input-group-text">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-search"></use>
          </svg>
        </span>
        <input type="text" class="form-control" id="logSearchInput" placeholder="Search logs...">
      </div>
    </div>
    <div class="col-md-2">
      <select class="form-select" id="logLevelFilter">
        <option value="">All Levels</option>
        <option value="info">Info</option>
        <option value="warning">Warning</option>
        <option value="error">Error</option>
        <option value="critical">Critical</option>
      </select>
    </div>
    <div class="col-md-2">
      <select class="form-select" id="logCategoryFilter">
        <option value="">All Categories</option>
        <option value="auth">Authentication</option>
        <option value="user">User Actions</option>
        <option value="system">System</option>
        <option value="security">Security</option>
        <option value="database">Database</option>
      </select>
    </div>
    <div class="col-md-2">
      <input type="date" class="form-control" id="logDateFilter">
    </div>
    <div class="col-md-2">
      <select class="form-select" id="logUserFilter">
        <option value="">All Users</option>
        <option value="admin">Administrator</option>
        <option value="teacher1">Teacher 1</option>
        <option value="student1">Student 1</option>
        <option value="system">System</option>
      </select>
    </div>
    <div class="col-md-1">
      <button class="btn btn-outline-secondary w-100" onclick="clearLogFilters()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-refresh"></use>
        </svg>
      </button>
    </div>
  </div>
</div>

<!-- Real-time Log Monitor -->
<div class="row g-4 mb-4">
  <div class="col-md-8">
    <div class="surface p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">System Logs</h5>
        <div class="d-flex gap-2">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="realTimeToggle" checked>
            <label class="form-check-label" for="realTimeToggle">Real-time</label>
          </div>
          <button class="btn btn-outline-primary btn-sm" onclick="refreshLogs()">
            <svg width="14" height="14" fill="currentColor">
              <use href="#icon-refresh"></use>
            </svg>
          </button>
        </div>
      </div>
      <div class="log-container" id="logContainer" style="height: 400px; overflow-y: auto; background: #f8f9fa; border-radius: 0.5rem; padding: 1rem; font-family: 'Courier New', monospace; font-size: 0.875rem;">
        <div class="log-entry log-info">
          <span class="log-timestamp">2024-10-09 10:33:15</span>
          <span class="log-level badge bg-info-subtle text-info">INFO</span>
          <span class="log-category badge bg-primary-subtle text-primary">AUTH</span>
          <span class="log-user">admin</span>
          <span class="log-message">User login successful: admin@example.com</span>
        </div>
        <div class="log-entry log-warning">
          <span class="log-timestamp">2024-10-09 10:32:45</span>
          <span class="log-level badge bg-warning-subtle text-warning">WARN</span>
          <span class="log-category badge bg-warning-subtle text-warning">SECURITY</span>
          <span class="log-user">system</span>
          <span class="log-message">Multiple failed login attempts detected from IP: 192.168.1.100</span>
        </div>
        <div class="log-entry log-info">
          <span class="log-timestamp">2024-10-09 10:32:12</span>
          <span class="log-level badge bg-info-subtle text-info">INFO</span>
          <span class="log-category badge bg-success-subtle text-success">USER</span>
          <span class="log-user">teacher1</span>
          <span class="log-message">Grade updated for student ID: 12345</span>
        </div>
        <div class="log-entry log-error">
          <span class="log-timestamp">2024-10-09 10:31:58</span>
          <span class="log-level badge bg-danger-subtle text-danger">ERROR</span>
          <span class="log-category badge bg-danger-subtle text-danger">DATABASE</span>
          <span class="log-user">system</span>
          <span class="log-message">Database connection timeout - retrying...</span>
        </div>
        <div class="log-entry log-info">
          <span class="log-timestamp">2024-10-09 10:31:30</span>
          <span class="log-level badge bg-info-subtle text-info">INFO</span>
          <span class="log-category badge bg-info-subtle text-info">SYSTEM</span>
          <span class="log-user">system</span>
          <span class="log-message">Scheduled backup completed successfully</span>
        </div>
        <div class="log-entry log-critical">
          <span class="log-timestamp">2024-10-09 10:30:45</span>
          <span class="log-level badge bg-danger-subtle text-danger">CRITICAL</span>
          <span class="log-category badge bg-danger-subtle text-danger">SECURITY</span>
          <span class="log-user">system</span>
          <span class="log-message">Unauthorized access attempt blocked - IP: 203.0.113.42</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="surface p-4">
      <h5 class="fw-bold mb-4">Log Statistics</h5>
      <canvas id="logStatsChart" height="200"></canvas>
    </div>
  </div>
</div>

<!-- Audit Trail Table -->
<div class="surface p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Audit Trail</h5>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" onclick="exportAuditTrail()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Export</span>
      </button>
      <button class="btn btn-outline-secondary btn-sm" onclick="refreshAuditTrail()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-refresh"></use>
        </svg>
      </button>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Timestamp</th>
          <th>User</th>
          <th>Action</th>
          <th>Resource</th>
          <th>IP Address</th>
          <th>Status</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody id="auditTrailBody">
        <tr>
          <td>
            <div class="small">
              <div class="fw-semibold">2024-10-09 10:33:15</div>
              <div class="text-muted">2 minutes ago</div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                <svg width="16" height="16" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Administrator</div>
                <div class="text-muted small">admin@example.com</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-success-subtle text-success">LOGIN</span></td>
          <td>Authentication System</td>
          <td><code>192.168.1.50</code></td>
          <td><span class="badge bg-success-subtle text-success">Success</span></td>
          <td>
            <button class="btn btn-sm btn-outline-secondary" onclick="viewAuditDetails(1)">
              <svg width="14" height="14" fill="currentColor">
                <use href="#icon-eye"></use>
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="small">
              <div class="fw-semibold">2024-10-09 10:32:45</div>
              <div class="text-muted">3 minutes ago</div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="avatar-sm bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center me-2">
                <svg width="16" height="16" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Unknown User</div>
                <div class="text-muted small">192.168.1.100</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-danger-subtle text-danger">LOGIN_FAILED</span></td>
          <td>Authentication System</td>
          <td><code>192.168.1.100</code></td>
          <td><span class="badge bg-danger-subtle text-danger">Failed</span></td>
          <td>
            <button class="btn btn-sm btn-outline-secondary" onclick="viewAuditDetails(2)">
              <svg width="14" height="14" fill="currentColor">
                <use href="#icon-eye"></use>
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="small">
              <div class="fw-semibold">2024-10-09 10:32:12</div>
              <div class="text-muted">4 minutes ago</div>
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center">
              <div class="avatar-sm bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center me-2">
                <svg width="16" height="16" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold">Teacher 1</div>
                <div class="text-muted small">teacher@example.com</div>
              </div>
            </div>
          </td>
          <td><span class="badge bg-primary-subtle text-primary">UPDATE</span></td>
          <td>Student Grades</td>
          <td><code>192.168.1.75</code></td>
          <td><span class="badge bg-success-subtle text-success">Success</span></td>
          <td>
            <button class="btn btn-sm btn-outline-secondary" onclick="viewAuditDetails(3)">
              <svg width="14" height="14" fill="currentColor">
                <use href="#icon-eye"></use>
              </svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Log Settings Modal -->
<div class="modal fade" id="logSettingsModal" tabindex="-1" aria-labelledby="logSettingsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logSettingsModalLabel">Log Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="logSettingsForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="logLevel" class="form-label">Minimum Log Level</label>
              <select class="form-select" id="logLevel">
                <option value="debug">Debug</option>
                <option value="info" selected>Info</option>
                <option value="warning">Warning</option>
                <option value="error">Error</option>
                <option value="critical">Critical</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="logRetention" class="form-label">Log Retention (days)</label>
              <input type="number" class="form-control" id="logRetention" value="30" min="1" max="365">
            </div>
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="enableRealTimeLogs" checked>
                <label class="form-check-label" for="enableRealTimeLogs">Enable Real-time Log Monitoring</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="enableAuditTrail" checked>
                <label class="form-check-label" for="enableAuditTrail">Enable Audit Trail</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="enableSecurityLogs" checked>
                <label class="form-check-label" for="enableSecurityLogs">Enable Security Logging</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="enablePerformanceLogs">
                <label class="form-check-label" for="enablePerformanceLogs">Enable Performance Logging</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="saveLogSettings()">Save Settings</button>
      </div>
    </div>
  </div>
</div>

<!-- Include Chart.js and Logs JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= \Helpers\Url::asset('admin-logs.js') ?>"></script>
