// Admin Logs and Audit Trail JavaScript
class LogsManager {
  constructor() {
    this.charts = {};
    this.realTimeEnabled = true;
    this.logInterval = null;
    this.init();
  }

  init() {
    this.initializeCharts();
    this.bindEvents();
    this.startRealTimeLogs();
    this.initializeFilters();
  }

  initializeCharts() {
    // Log Statistics Chart
    const statsCtx = document.getElementById('logStatsChart');
    if (statsCtx) {
      this.charts.stats = new Chart(statsCtx, {
        type: 'doughnut',
        data: {
          labels: ['Info', 'Warning', 'Error', 'Critical'],
          datasets: [{
            data: [1200, 23, 15, 3],
            backgroundColor: [
              'rgba(13, 202, 240, 0.8)',
              'rgba(255, 193, 7, 0.8)',
              'rgba(220, 53, 69, 0.8)',
              'rgba(108, 117, 125, 0.8)'
            ],
            borderWidth: 2,
            borderColor: '#fff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
            }
          }
        }
      });
    }
  }

  bindEvents() {
    // Real-time toggle
    const realTimeToggle = document.getElementById('realTimeToggle');
    if (realTimeToggle) {
      realTimeToggle.addEventListener('change', (e) => {
        this.realTimeEnabled = e.target.checked;
        if (this.realTimeEnabled) {
          this.startRealTimeLogs();
        } else {
          this.stopRealTimeLogs();
        }
      });
    }

    // Search input
    const searchInput = document.getElementById('logSearchInput');
    if (searchInput) {
      searchInput.addEventListener('input', (e) => {
        this.filterLogs();
      });
    }

    // Filter dropdowns
    const filters = ['logLevelFilter', 'logCategoryFilter', 'logUserFilter'];
    filters.forEach(filterId => {
      const filter = document.getElementById(filterId);
      if (filter) {
        filter.addEventListener('change', () => {
          this.filterLogs();
        });
      }
    });

    // Date filter
    const dateFilter = document.getElementById('logDateFilter');
    if (dateFilter) {
      dateFilter.addEventListener('change', () => {
        this.filterLogs();
      });
    }
  }

  initializeFilters() {
    // Set today's date as default
    const dateFilter = document.getElementById('logDateFilter');
    if (dateFilter) {
      const today = new Date().toISOString().split('T')[0];
      dateFilter.value = today;
    }
  }

  startRealTimeLogs() {
    if (this.logInterval) {
      clearInterval(this.logInterval);
    }

    this.logInterval = setInterval(() => {
      if (this.realTimeEnabled) {
        this.addNewLogEntry();
      }
    }, 5000); // Add new log every 5 seconds
  }

  stopRealTimeLogs() {
    if (this.logInterval) {
      clearInterval(this.logInterval);
      this.logInterval = null;
    }
  }

  addNewLogEntry() {
    const logContainer = document.getElementById('logContainer');
    if (!logContainer) return;

    const logTypes = [
      { level: 'info', category: 'AUTH', message: 'User session refreshed', user: 'admin' },
      { level: 'info', category: 'USER', message: 'Profile updated', user: 'teacher1' },
      { level: 'warning', category: 'SECURITY', message: 'Suspicious activity detected', user: 'system' },
      { level: 'info', category: 'SYSTEM', message: 'Database backup completed', user: 'system' },
      { level: 'error', category: 'DATABASE', message: 'Connection pool exhausted', user: 'system' }
    ];

    const randomLog = logTypes[Math.floor(Math.random() * logTypes.length)];
    const timestamp = new Date().toISOString().replace('T', ' ').substring(0, 19);
    
    const logEntry = document.createElement('div');
    logEntry.className = `log-entry log-${randomLog.level}`;
    logEntry.innerHTML = `
      <span class="log-timestamp">${timestamp}</span>
      <span class="log-level badge bg-${randomLog.level === 'info' ? 'info' : randomLog.level === 'warning' ? 'warning' : 'danger'}-subtle text-${randomLog.level === 'info' ? 'info' : randomLog.level === 'warning' ? 'warning' : 'danger'}">${randomLog.level.toUpperCase()}</span>
      <span class="log-category badge bg-primary-subtle text-primary">${randomLog.category}</span>
      <span class="log-user">${randomLog.user}</span>
      <span class="log-message">${randomLog.message}</span>
    `;

    // Add to top of container
    logContainer.insertBefore(logEntry, logContainer.firstChild);

    // Remove old entries if more than 50
    const entries = logContainer.querySelectorAll('.log-entry');
    if (entries.length > 50) {
      entries[entries.length - 1].remove();
    }

    // Scroll to top
    logContainer.scrollTop = 0;
  }

  filterLogs() {
    const searchTerm = document.getElementById('logSearchInput')?.value.toLowerCase() || '';
    const levelFilter = document.getElementById('logLevelFilter')?.value || '';
    const categoryFilter = document.getElementById('logCategoryFilter')?.value || '';
    const userFilter = document.getElementById('logUserFilter')?.value || '';
    const dateFilter = document.getElementById('logDateFilter')?.value || '';

    const logEntries = document.querySelectorAll('.log-entry');
    
    logEntries.forEach(entry => {
      const timestamp = entry.querySelector('.log-timestamp')?.textContent || '';
      const level = entry.querySelector('.log-level')?.textContent.toLowerCase() || '';
      const category = entry.querySelector('.log-category')?.textContent.toLowerCase() || '';
      const user = entry.querySelector('.log-user')?.textContent.toLowerCase() || '';
      const message = entry.querySelector('.log-message')?.textContent.toLowerCase() || '';

      let show = true;

      // Search filter
      if (searchTerm && !message.includes(searchTerm) && !user.includes(searchTerm)) {
        show = false;
      }

      // Level filter
      if (levelFilter && level !== levelFilter) {
        show = false;
      }

      // Category filter
      if (categoryFilter && category !== categoryFilter) {
        show = false;
      }

      // User filter
      if (userFilter && user !== userFilter) {
        show = false;
      }

      // Date filter
      if (dateFilter && !timestamp.includes(dateFilter)) {
        show = false;
      }

      entry.style.display = show ? 'block' : 'none';
    });
  }
}

// Global functions for log interactions
function exportLogs() {
  if (typeof Notification !== 'undefined') {
    new Notification('Exporting system logs...', { type: 'info', duration: 3000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('System logs exported successfully!', { type: 'success' });
    }
  }, 3000);
}

function clearOldLogs() {
  if (confirm('Are you sure you want to clear logs older than 30 days? This action cannot be undone.')) {
    if (typeof Notification !== 'undefined') {
      new Notification('Clearing old logs...', { type: 'info', duration: 2000 });
    }
    
    setTimeout(() => {
      if (typeof Notification !== 'undefined') {
        new Notification('Old logs cleared successfully!', { type: 'success' });
      }
    }, 2000);
  }
}

function refreshLogs() {
  if (typeof Notification !== 'undefined') {
    new Notification('Refreshing logs...', { type: 'info' });
  }
  
  // Simulate refresh
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('Logs refreshed!', { type: 'success' });
    }
  }, 1000);
}

function clearLogFilters() {
  document.getElementById('logSearchInput').value = '';
  document.getElementById('logLevelFilter').value = '';
  document.getElementById('logCategoryFilter').value = '';
  document.getElementById('logUserFilter').value = '';
  document.getElementById('logDateFilter').value = '';
  
  // Show all log entries
  const logEntries = document.querySelectorAll('.log-entry');
  logEntries.forEach(entry => {
    entry.style.display = 'block';
  });
  
  if (typeof Notification !== 'undefined') {
    new Notification('Filters cleared!', { type: 'info' });
  }
}

function exportAuditTrail() {
  if (typeof Notification !== 'undefined') {
    new Notification('Exporting audit trail...', { type: 'info', duration: 3000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('Audit trail exported successfully!', { type: 'success' });
    }
  }, 3000);
}

function refreshAuditTrail() {
  if (typeof Notification !== 'undefined') {
    new Notification('Refreshing audit trail...', { type: 'info' });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('Audit trail refreshed!', { type: 'success' });
    }
  }, 1000);
}

function viewAuditDetails(auditId) {
  // Create modal for audit details
  const modalHtml = `
    <div class="modal fade" id="auditDetailsModal" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Audit Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Timestamp</label>
                <p class="form-control-plaintext">2024-10-09 10:33:15</p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">User</label>
                <p class="form-control-plaintext">Administrator (admin@example.com)</p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Action</label>
                <p class="form-control-plaintext"><span class="badge bg-success-subtle text-success">LOGIN</span></p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Resource</label>
                <p class="form-control-plaintext">Authentication System</p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">IP Address</label>
                <p class="form-control-plaintext"><code>192.168.1.50</code></p>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">User Agent</label>
                <p class="form-control-plaintext">Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36</p>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Additional Details</label>
                <div class="bg-light p-3 rounded">
                  <pre class="mb-0">{
  "session_id": "sess_abc123def456",
  "login_method": "password",
  "two_factor_enabled": true,
  "device_fingerprint": "fp_xyz789",
  "location": "Manila, Philippines"
}</pre>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  `;

  // Remove existing modal if any
  const existingModal = document.getElementById('auditDetailsModal');
  if (existingModal) {
    existingModal.remove();
  }

  // Add modal to body
  document.body.insertAdjacentHTML('beforeend', modalHtml);

  // Show modal
  const modal = new bootstrap.Modal(document.getElementById('auditDetailsModal'));
  modal.show();
}

function saveLogSettings() {
  const form = document.getElementById('logSettingsForm');
  const formData = new FormData(form);
  
  if (typeof Notification !== 'undefined') {
    new Notification('Saving log settings...', { type: 'info', duration: 2000 });
  }
  
  setTimeout(() => {
    // Hide modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('logSettingsModal'));
    if (modal) modal.hide();
    
    if (typeof Notification !== 'undefined') {
      new Notification('Log settings saved successfully!', { type: 'success' });
    }
  }, 2000);
}

// Initialize logs manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.logsManager = new LogsManager();
});
