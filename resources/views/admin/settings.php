<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">System Settings</h1>
      <p class="text-muted mb-0">Configure system preferences, security, and maintenance settings</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" onclick="exportSettings()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Export Config</span>
      </button>
      <button class="btn btn-primary btn-sm" onclick="saveAllSettings()">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-check"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Save All</span>
      </button>
    </div>
  </div>
</div>

<!-- Settings Navigation -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface p-3">
      <nav class="nav nav-pills flex-column" id="settingsNav">
        <a class="nav-link active" data-bs-toggle="pill" href="#general-settings">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-settings"></use>
          </svg>
          General
        </a>
        <a class="nav-link" data-bs-toggle="pill" href="#security-settings">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-lock"></use>
          </svg>
          Security
        </a>
        <a class="nav-link" data-bs-toggle="pill" href="#notification-settings">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-alerts"></use>
          </svg>
          Notifications
        </a>
        <a class="nav-link" data-bs-toggle="pill" href="#backup-settings">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-download"></use>
          </svg>
          Backup
        </a>
        <a class="nav-link" data-bs-toggle="pill" href="#maintenance-settings">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-settings"></use>
          </svg>
          Maintenance
        </a>
        <a class="nav-link" data-bs-toggle="pill" href="#integration-settings">
          <svg width="16" height="16" fill="currentColor" class="me-2">
            <use href="#icon-settings"></use>
          </svg>
          Integrations
        </a>
      </nav>
    </div>
  </div>
  
  <div class="col-md-9">
    <div class="tab-content" id="settingsTabContent">
      <!-- General Settings -->
      <div class="tab-pane fade show active" id="general-settings">
        <div class="surface p-4">
          <h5 class="fw-bold mb-4">General Settings</h5>
          <form id="generalSettingsForm">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="schoolName" class="form-label">School Name</label>
                <input type="text" class="form-control" id="schoolName" value="Sample High School" required>
              </div>
              <div class="col-md-6">
                <label for="schoolCode" class="form-label">School Code</label>
                <input type="text" class="form-control" id="schoolCode" value="SHS001" required>
              </div>
              <div class="col-md-6">
                <label for="schoolYear" class="form-label">Current School Year</label>
                <input type="text" class="form-control" id="schoolYear" value="2024-2025" required>
              </div>
              <div class="col-md-6">
                <label for="timezone" class="form-label">Timezone</label>
                <select class="form-select" id="timezone" required>
                  <option value="UTC+8">UTC+8 (Philippines)</option>
                  <option value="UTC+0">UTC+0 (GMT)</option>
                  <option value="UTC-5">UTC-5 (EST)</option>
                  <option value="UTC-8">UTC-8 (PST)</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="language" class="form-label">Default Language</label>
                <select class="form-select" id="language" required>
                  <option value="en">English</option>
                  <option value="fil">Filipino</option>
                  <option value="es">Spanish</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="dateFormat" class="form-label">Date Format</label>
                <select class="form-select" id="dateFormat" required>
                  <option value="Y-m-d">YYYY-MM-DD</option>
                  <option value="m/d/Y">MM/DD/YYYY</option>
                  <option value="d/m/Y">DD/MM/YYYY</option>
                </select>
              </div>
              <div class="col-12">
                <label for="schoolAddress" class="form-label">School Address</label>
                <textarea class="form-control" id="schoolAddress" rows="3" placeholder="Enter complete school address">123 Education Street, Learning City, 1234</textarea>
              </div>
              <div class="col-md-6">
                <label for="schoolPhone" class="form-label">School Phone</label>
                <input type="tel" class="form-control" id="schoolPhone" value="+63 2 1234 5678">
              </div>
              <div class="col-md-6">
                <label for="schoolEmail" class="form-label">School Email</label>
                <input type="email" class="form-control" id="schoolEmail" value="info@school.edu">
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Security Settings -->
      <div class="tab-pane fade" id="security-settings">
        <div class="surface p-4">
          <h5 class="fw-bold mb-4">Security Settings</h5>
          <form id="securitySettingsForm">
            <div class="row g-3">
              <div class="col-12">
                <div class="card border-warning">
                  <div class="card-header bg-warning-subtle">
                    <h6 class="fw-bold mb-0 text-warning">Password Policy</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="minPasswordLength" class="form-label">Minimum Password Length</label>
                        <input type="number" class="form-control" id="minPasswordLength" value="8" min="6" max="20">
                      </div>
                      <div class="col-md-6">
                        <label for="passwordExpiry" class="form-label">Password Expiry (days)</label>
                        <input type="number" class="form-control" id="passwordExpiry" value="90" min="30" max="365">
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="requireUppercase" checked>
                          <label class="form-check-label" for="requireUppercase">Require uppercase letters</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="requireLowercase" checked>
                          <label class="form-check-label" for="requireLowercase">Require lowercase letters</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="requireNumbers" checked>
                          <label class="form-check-label" for="requireNumbers">Require numbers</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="requireSymbols" checked>
                          <label class="form-check-label" for="requireSymbols">Require special characters</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card border-info">
                  <div class="card-header bg-info-subtle">
                    <h6 class="fw-bold mb-0 text-info">Session Management</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="sessionTimeout" class="form-label">Session Timeout (minutes)</label>
                        <input type="number" class="form-control" id="sessionTimeout" value="30" min="5" max="480">
                      </div>
                      <div class="col-md-6">
                        <label for="maxLoginAttempts" class="form-label">Max Login Attempts</label>
                        <input type="number" class="form-control" id="maxLoginAttempts" value="5" min="3" max="10">
                      </div>
                      <div class="col-12">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="twoFactorAuth" checked>
                          <label class="form-check-label" for="twoFactorAuth">Enable Two-Factor Authentication</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="ipWhitelist" checked>
                          <label class="form-check-label" for="ipWhitelist">Enable IP Whitelist</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="auditLogging" checked>
                          <label class="form-check-label" for="auditLogging">Enable Audit Logging</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Notification Settings -->
      <div class="tab-pane fade" id="notification-settings">
        <div class="surface p-4">
          <h5 class="fw-bold mb-4">Notification Settings</h5>
          <form id="notificationSettingsForm">
            <div class="row g-3">
              <div class="col-12">
                <div class="card border-primary">
                  <div class="card-header bg-primary-subtle">
                    <h6 class="fw-bold mb-0 text-primary">Email Notifications</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="smtpHost" class="form-label">SMTP Host</label>
                        <input type="text" class="form-control" id="smtpHost" value="smtp.gmail.com">
                      </div>
                      <div class="col-md-6">
                        <label for="smtpPort" class="form-label">SMTP Port</label>
                        <input type="number" class="form-control" id="smtpPort" value="587">
                      </div>
                      <div class="col-md-6">
                        <label for="smtpUsername" class="form-label">SMTP Username</label>
                        <input type="email" class="form-control" id="smtpUsername" value="noreply@school.edu">
                      </div>
                      <div class="col-md-6">
                        <label for="smtpPassword" class="form-label">SMTP Password</label>
                        <input type="password" class="form-control" id="smtpPassword" placeholder="Enter SMTP password">
                      </div>
                      <div class="col-12">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="smtpEncryption" checked>
                          <label class="form-check-label" for="smtpEncryption">Use SSL/TLS Encryption</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card border-success">
                  <div class="card-header bg-success-subtle">
                    <h6 class="fw-bold mb-0 text-success">Notification Types</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="newUserNotifications" checked>
                          <label class="form-check-label" for="newUserNotifications">New User Registrations</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="gradeNotifications" checked>
                          <label class="form-check-label" for="gradeNotifications">Grade Updates</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="attendanceNotifications" checked>
                          <label class="form-check-label" for="attendanceNotifications">Attendance Alerts</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="systemAlerts" checked>
                          <label class="form-check-label" for="systemAlerts">System Alerts</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="backupNotifications" checked>
                          <label class="form-check-label" for="backupNotifications">Backup Notifications</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="securityAlerts" checked>
                          <label class="form-check-label" for="securityAlerts">Security Alerts</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Backup Settings -->
      <div class="tab-pane fade" id="backup-settings">
        <div class="surface p-4">
          <h5 class="fw-bold mb-4">Backup & Recovery</h5>
          <form id="backupSettingsForm">
            <div class="row g-3">
              <div class="col-12">
                <div class="card border-warning">
                  <div class="card-header bg-warning-subtle">
                    <h6 class="fw-bold mb-0 text-warning">Automatic Backup</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="autoBackup" checked>
                          <label class="form-check-label" for="autoBackup">Enable Automatic Backup</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="backupFrequency" class="form-label">Backup Frequency</label>
                        <select class="form-select" id="backupFrequency">
                          <option value="daily">Daily</option>
                          <option value="weekly">Weekly</option>
                          <option value="monthly">Monthly</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="backupTime" class="form-label">Backup Time</label>
                        <input type="time" class="form-control" id="backupTime" value="02:00">
                      </div>
                      <div class="col-md-6">
                        <label for="backupRetention" class="form-label">Backup Retention (days)</label>
                        <input type="number" class="form-control" id="backupRetention" value="30" min="1" max="365">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card border-info">
                  <div class="card-header bg-info-subtle">
                    <h6 class="fw-bold mb-0 text-info">Backup Storage</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="backupLocation" class="form-label">Backup Location</label>
                        <select class="form-select" id="backupLocation">
                          <option value="local">Local Storage</option>
                          <option value="cloud">Cloud Storage</option>
                          <option value="ftp">FTP Server</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="backupPath" class="form-label">Backup Path</label>
                        <input type="text" class="form-control" id="backupPath" value="/backups/">
                      </div>
                      <div class="col-12">
                        <div class="d-flex gap-2">
                          <button type="button" class="btn btn-primary" onclick="createBackup()">
                            <svg width="16" height="16" fill="currentColor" class="me-1">
                              <use href="#icon-download"></use>
                            </svg>
                            Create Backup Now
                          </button>
                          <button type="button" class="btn btn-outline-primary" onclick="viewBackups()">
                            <svg width="16" height="16" fill="currentColor" class="me-1">
                              <use href="#icon-eye"></use>
                            </svg>
                            View Backups
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Maintenance Settings -->
      <div class="tab-pane fade" id="maintenance-settings">
        <div class="surface p-4">
          <h5 class="fw-bold mb-4">System Maintenance</h5>
          <form id="maintenanceSettingsForm">
            <div class="row g-3">
              <div class="col-12">
                <div class="card border-danger">
                  <div class="card-header bg-danger-subtle">
                    <h6 class="fw-bold mb-0 text-danger">System Maintenance</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="maintenanceMode" class="form-label">Maintenance Mode</label>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="maintenanceMode">
                          <label class="form-check-label" for="maintenanceMode">Enable Maintenance Mode</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="maintenanceMessage" class="form-label">Maintenance Message</label>
                        <input type="text" class="form-control" id="maintenanceMessage" value="System is under maintenance. Please try again later.">
                      </div>
                      <div class="col-12">
                        <div class="d-flex gap-2">
                          <button type="button" class="btn btn-warning" onclick="clearCache()">
                            <svg width="16" height="16" fill="currentColor" class="me-1">
                              <use href="#icon-refresh"></use>
                            </svg>
                            Clear Cache
                          </button>
                          <button type="button" class="btn btn-info" onclick="optimizeDatabase()">
                            <svg width="16" height="16" fill="currentColor" class="me-1">
                              <use href="#icon-settings"></use>
                            </svg>
                            Optimize Database
                          </button>
                          <button type="button" class="btn btn-danger" onclick="resetSystem()">
                            <svg width="16" height="16" fill="currentColor" class="me-1">
                              <use href="#icon-refresh"></use>
                            </svg>
                            Reset System
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card border-success">
                  <div class="card-header bg-success-subtle">
                    <h6 class="fw-bold mb-0 text-success">System Health</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-4">
                        <div class="text-center p-3 border rounded-3">
                          <div class="h4 fw-bold text-success mb-1">98.5%</div>
                          <div class="text-muted small">System Uptime</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="text-center p-3 border rounded-3">
                          <div class="h4 fw-bold text-primary mb-1">2.3s</div>
                          <div class="text-muted small">Avg Response Time</div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="text-center p-3 border rounded-3">
                          <div class="h4 fw-bold text-info mb-1">15</div>
                          <div class="text-muted small">Active Sessions</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Integration Settings -->
      <div class="tab-pane fade" id="integration-settings">
        <div class="surface p-4">
          <h5 class="fw-bold mb-4">Third-Party Integrations</h5>
          <form id="integrationSettingsForm">
            <div class="row g-3">
              <div class="col-12">
                <div class="card border-primary">
                  <div class="card-header bg-primary-subtle">
                    <h6 class="fw-bold mb-0 text-primary">Google Services</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="googleAuth" checked>
                          <label class="form-check-label" for="googleAuth">Google Authentication</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="googleDrive" checked>
                          <label class="form-check-label" for="googleDrive">Google Drive Integration</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="googleClientId" class="form-label">Google Client ID</label>
                        <input type="text" class="form-control" id="googleClientId" placeholder="Enter Google Client ID">
                      </div>
                      <div class="col-md-6">
                        <label for="googleClientSecret" class="form-label">Google Client Secret</label>
                        <input type="password" class="form-control" id="googleClientSecret" placeholder="Enter Google Client Secret">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card border-info">
                  <div class="card-header bg-info-subtle">
                    <h6 class="fw-bold mb-0 text-info">SMS Integration</h6>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="smsNotifications" checked>
                          <label class="form-check-label" for="smsNotifications">SMS Notifications</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="smsProvider" class="form-label">SMS Provider</label>
                        <select class="form-select" id="smsProvider">
                          <option value="twilio">Twilio</option>
                          <option value="nexmo">Nexmo</option>
                          <option value="local">Local SMS Gateway</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="smsApiKey" class="form-label">SMS API Key</label>
                        <input type="text" class="form-control" id="smsApiKey" placeholder="Enter SMS API Key">
                      </div>
                      <div class="col-md-6">
                        <label for="smsApiSecret" class="form-label">SMS API Secret</label>
                        <input type="password" class="form-control" id="smsApiSecret" placeholder="Enter SMS API Secret">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include external CSS and JS files -->
<script src="<?= \Helpers\Url::asset('admin-settings.js') ?>"></script>
