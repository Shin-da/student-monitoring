// Enhanced Admin Dashboard JavaScript
class AdminDashboard {
  constructor() {
    this.charts = {};
    this.init();
  }

  init() {
    this.initializeCharts();
    this.bindEvents();
    this.startRealTimeUpdates();
  }

  initializeCharts() {
    // Clean up any existing charts first
    this.destroyCharts();
    
    // School Analytics Chart
    const analyticsCtx = document.getElementById('schoolAnalyticsChart');
    if (analyticsCtx && !window.schoolChartInitialized) {
      window.schoolChartInitialized = true;
      this.charts.analytics = new Chart(analyticsCtx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
          datasets: [{
            label: 'Students',
            data: [120, 135, 142, 138, 145, 150],
            borderColor: 'rgb(13, 110, 253)',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            tension: 0.4
          }, {
            label: 'Teachers',
            data: [25, 28, 30, 32, 35, 38],
            borderColor: 'rgb(25, 135, 84)',
            backgroundColor: 'rgba(25, 135, 84, 0.1)',
            tension: 0.4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }

    // User Distribution Chart
    const distributionCtx = document.getElementById('userDistributionChart');
    if (distributionCtx && !window.distributionChartInitialized) {
      window.distributionChartInitialized = true;
      this.charts.distribution = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
          labels: ['Students', 'Teachers', 'Parents', 'Admins'],
          datasets: [{
            data: [150, 40, 120, 5],
            backgroundColor: [
              'rgba(13, 110, 253, 0.8)',
              'rgba(25, 135, 84, 0.8)',
              'rgba(255, 193, 7, 0.8)',
              'rgba(220, 53, 69, 0.8)'
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

  destroyCharts() {
    // Destroy existing chart instances
    if (this.charts.analytics) {
      this.charts.analytics.destroy();
      this.charts.analytics = null;
    }
    if (this.charts.distribution) {
      this.charts.distribution.destroy();
      this.charts.distribution = null;
    }
  }

  bindEvents() {
    // Analytics timeframe change
    const timeframeSelect = document.getElementById('analyticsTimeframe');
    if (timeframeSelect) {
      timeframeSelect.addEventListener('change', (e) => {
        this.updateAnalytics(e.target.value);
      });
    }
  }

  updateAnalytics(timeframe) {
    // Update chart data based on timeframe
    const data = this.getAnalyticsData(timeframe);
    if (this.charts.analytics) {
      this.charts.analytics.data.labels = data.labels;
      this.charts.analytics.data.datasets[0].data = data.students;
      this.charts.analytics.data.datasets[1].data = data.teachers;
      this.charts.analytics.update();
    }
  }

  getAnalyticsData(timeframe) {
    const data = {
      weekly: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        students: [145, 147, 149, 148, 150, 152, 150],
        teachers: [38, 38, 39, 38, 40, 40, 38]
      },
      monthly: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        students: [145, 147, 149, 150],
        teachers: [38, 38, 39, 40]
      },
      quarterly: {
        labels: ['Month 1', 'Month 2', 'Month 3'],
        students: [140, 145, 150],
        teachers: [35, 38, 40]
      },
      yearly: {
        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
        students: [120, 135, 145, 150],
        teachers: [25, 30, 35, 40]
      }
    };
    return data[timeframe] || data.monthly;
  }

  startRealTimeUpdates() {
    // Update system stats every 30 seconds
    setInterval(() => {
      this.updateSystemStats();
    }, 30000);
  }

  updateSystemStats() {
    // Simulate real-time data updates
    const stats = {
      uptime: 98.5 + (Math.random() - 0.5) * 0.5,
      responseTime: 2.3 + (Math.random() - 0.5) * 0.4,
      activeSessions: 15 + Math.floor((Math.random() - 0.5) * 6)
    };

    // Update DOM elements
    const uptimeElement = document.querySelector('[data-count-to="98.5"]');
    const responseElement = document.querySelector('[data-count-to="2.3"]');
    const sessionsElement = document.querySelector('[data-count-to="15"]');
    
    if (uptimeElement) uptimeElement.textContent = stats.uptime.toFixed(1);
    if (responseElement) responseElement.textContent = stats.responseTime.toFixed(1);
    if (sessionsElement) sessionsElement.textContent = stats.activeSessions;
  }

  // Cleanup method
  destroy() {
    this.destroyCharts();
    if (this.realTimeInterval) {
      clearInterval(this.realTimeInterval);
    }
  }
}

// Global functions for modal interactions
function generateReport(type) {
  const modal = bootstrap.Modal.getInstance(document.getElementById('quickReportsModal'));
  if (modal) modal.hide();
  
  // Show loading notification
  if (typeof Notification !== 'undefined') {
    new Notification('Generating report...', { type: 'info', duration: 2000 });
  }
  
  // Simulate report generation
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification(`${type.charAt(0).toUpperCase() + type.slice(1)} report generated successfully!`, { type: 'success' });
    }
  }, 2000);
}

function exportAnalytics() {
  if (typeof Notification !== 'undefined') {
    new Notification('Exporting analytics data...', { type: 'info', duration: 2000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('Analytics data exported successfully!', { type: 'success' });
    }
  }, 1500);
}

function refreshSystemStats() {
  const btn = event.target.closest('button');
  const originalContent = btn.innerHTML;
  
  btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
  btn.disabled = true;
  
  setTimeout(() => {
    btn.innerHTML = originalContent;
    btn.disabled = false;
    
    if (typeof Notification !== 'undefined') {
      new Notification('System stats refreshed!', { type: 'success' });
    }
  }, 1000);
}

function handleFileSelect(event) {
  const file = event.target.files[0];
  if (file) {
    const preview = document.getElementById('importPreview');
    const previewBody = document.getElementById('importPreviewBody');
    const importBtn = document.getElementById('importBtn');
    
    // Show preview
    if (preview) preview.style.display = 'block';
    
    // Mock preview data
    if (previewBody) {
      previewBody.innerHTML = `
        <tr>
          <td>John Doe</td>
          <td>john@example.com</td>
          <td>Student</td>
          <td>Active</td>
        </tr>
        <tr>
          <td>Jane Smith</td>
          <td>jane@example.com</td>
          <td>Teacher</td>
          <td>Active</td>
        </tr>
      `;
    }
    
    if (importBtn) importBtn.disabled = false;
  }
}

function downloadTemplate() {
  const csvContent = 'Name,Email,Role,Status\nJohn Doe,john@example.com,student,active\nJane Smith,jane@example.com,teacher,active';
  const blob = new Blob([csvContent], { type: 'text/csv' });
  const url = window.URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'user_import_template.csv';
  a.click();
  window.URL.revokeObjectURL(url);
}

function processImport() {
  const importBtn = document.getElementById('importBtn');
  const originalContent = importBtn.innerHTML;
  
  importBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Importing...';
  importBtn.disabled = true;
  
  setTimeout(() => {
    importBtn.innerHTML = originalContent;
    importBtn.disabled = false;
    
    const modal = bootstrap.Modal.getInstance(document.getElementById('bulkImportModal'));
    if (modal) modal.hide();
    
    if (typeof Notification !== 'undefined') {
      new Notification('Users imported successfully!', { type: 'success' });
    }
  }, 3000);
}

function saveSystemSettings() {
  if (typeof Notification !== 'undefined') {
    new Notification('System settings saved successfully!', { type: 'success' });
  }
  
  const modal = bootstrap.Modal.getInstance(document.getElementById('systemSettingsModal'));
  if (modal) modal.hide();
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  // Clean up any existing instance
  if (window.adminDashboardInstance) {
    window.adminDashboardInstance.destroy();
  }
  
  window.adminDashboardInstance = new AdminDashboard();
});
