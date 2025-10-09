// Admin Reports and Analytics JavaScript
class ReportsManager {
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
    // User Growth Chart
    const growthCtx = document.getElementById('userGrowthChart');
    if (growthCtx) {
      this.charts.growth = new Chart(growthCtx, {
        type: 'line',
        data: {
          labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
          datasets: [{
            label: 'New Users',
            data: [12, 19, 15, 25],
            borderColor: 'rgb(13, 110, 253)',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            tension: 0.4,
            fill: true
          }, {
            label: 'Active Users',
            data: [45, 52, 48, 65],
            borderColor: 'rgb(25, 135, 84)',
            backgroundColor: 'rgba(25, 135, 84, 0.1)',
            tension: 0.4,
            fill: true
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
    if (distributionCtx) {
      this.charts.distribution = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
          labels: ['Students', 'Teachers', 'Parents', 'Admins'],
          datasets: [{
            data: [250, 45, 120, 5],
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

    // Grade Distribution Chart
    const gradeCtx = document.getElementById('gradeDistributionChart');
    if (gradeCtx) {
      this.charts.gradeDistribution = new Chart(gradeCtx, {
        type: 'bar',
        data: {
          labels: ['A+', 'A', 'B+', 'B', 'C+', 'C', 'D', 'F'],
          datasets: [{
            label: 'Number of Students',
            data: [45, 78, 65, 42, 28, 15, 8, 3],
            backgroundColor: [
              'rgba(25, 135, 84, 0.8)',
              'rgba(25, 135, 84, 0.7)',
              'rgba(13, 202, 240, 0.8)',
              'rgba(13, 202, 240, 0.7)',
              'rgba(255, 193, 7, 0.8)',
              'rgba(255, 193, 7, 0.7)',
              'rgba(255, 87, 34, 0.8)',
              'rgba(220, 53, 69, 0.8)'
            ],
            borderWidth: 1,
            borderColor: '#fff'
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
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

    // Attendance Chart
    const attendanceCtx = document.getElementById('attendanceChart');
    if (attendanceCtx) {
      this.charts.attendance = new Chart(attendanceCtx, {
        type: 'line',
        data: {
          labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
          datasets: [{
            label: 'Attendance %',
            data: [95, 92, 88, 94, 96],
            borderColor: 'rgb(13, 110, 253)',
            backgroundColor: 'rgba(13, 110, 253, 0.1)',
            tension: 0.4,
            fill: true
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              max: 100
            }
          }
        }
      });
    }
  }

  bindEvents() {
    // Trend timeframe change
    const timeframeSelect = document.getElementById('trendTimeframe');
    if (timeframeSelect) {
      timeframeSelect.addEventListener('change', (e) => {
        this.updateTrendData(e.target.value);
      });
    }

    // Schedule report checkbox
    const scheduleCheckbox = document.getElementById('scheduleReport');
    if (scheduleCheckbox) {
      scheduleCheckbox.addEventListener('change', (e) => {
        const scheduleOptions = document.getElementById('scheduleOptions');
        if (scheduleOptions) {
          scheduleOptions.style.display = e.target.checked ? 'block' : 'none';
        }
      });
    }
  }

  updateTrendData(timeframe) {
    const data = this.getTrendData(timeframe);
    if (this.charts.growth) {
      this.charts.growth.data.labels = data.labels;
      this.charts.growth.data.datasets[0].data = data.newUsers;
      this.charts.growth.data.datasets[1].data = data.activeUsers;
      this.charts.growth.update();
    }
  }

  getTrendData(timeframe) {
    const data = {
      '7d': {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        newUsers: [3, 5, 2, 7, 4, 1, 2],
        activeUsers: [45, 48, 42, 52, 49, 35, 38]
      },
      '30d': {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        newUsers: [12, 19, 15, 25],
        activeUsers: [45, 52, 48, 65]
      },
      '90d': {
        labels: ['Month 1', 'Month 2', 'Month 3'],
        newUsers: [45, 52, 68],
        activeUsers: [180, 195, 220]
      },
      '1y': {
        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
        newUsers: [120, 145, 165, 180],
        activeUsers: [450, 520, 580, 650]
      }
    };
    return data[timeframe] || data['30d'];
  }

  startRealTimeUpdates() {
    // Update stats every 30 seconds
    setInterval(() => {
      this.updateStats();
    }, 30000);
  }

  updateStats() {
    // Simulate real-time data updates
    const stats = {
      totalUsers: 315 + Math.floor((Math.random() - 0.5) * 10),
      avgPerformance: 92.5 + (Math.random() - 0.5) * 2,
      activeAlerts: 23 + Math.floor((Math.random() - 0.5) * 6),
      daysActive: 156 + Math.floor((Math.random() - 0.5) * 4)
    };

    // Update DOM elements
    const totalUsersEl = document.querySelector('[data-count-to="315"]');
    const avgPerfEl = document.querySelector('[data-count-to="92.5"]');
    const alertsEl = document.querySelector('[data-count-to="23"]');
    const daysEl = document.querySelector('[data-count-to="156"]');

    if (totalUsersEl) totalUsersEl.textContent = stats.totalUsers;
    if (avgPerfEl) avgPerfEl.textContent = stats.avgPerformance.toFixed(1);
    if (alertsEl) alertsEl.textContent = stats.activeAlerts;
    if (daysEl) daysEl.textContent = stats.daysActive;
  }
}

// Global functions for report interactions
function generateUserReport() {
  if (typeof Notification !== 'undefined') {
    new Notification('Generating user analytics report...', { type: 'info', duration: 2000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('User analytics report generated successfully!', { type: 'success' });
    }
  }, 3000);
}

function generateAcademicReport() {
  if (typeof Notification !== 'undefined') {
    new Notification('Generating academic performance report...', { type: 'info', duration: 2000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('Academic performance report generated successfully!', { type: 'success' });
    }
  }, 3000);
}

function generateSystemReport() {
  if (typeof Notification !== 'undefined') {
    new Notification('Generating system analytics report...', { type: 'info', duration: 2000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('System analytics report generated successfully!', { type: 'success' });
    }
  }, 3000);
}

function viewUserAnalytics() {
  if (typeof Notification !== 'undefined') {
    new Notification('Opening user analytics dashboard...', { type: 'info' });
  }
}

function viewAcademicAnalytics() {
  if (typeof Notification !== 'undefined') {
    new Notification('Opening academic analytics dashboard...', { type: 'info' });
  }
}

function viewSystemAnalytics() {
  if (typeof Notification !== 'undefined') {
    new Notification('Opening system analytics dashboard...', { type: 'info' });
  }
}

function exportTrendData() {
  if (typeof Notification !== 'undefined') {
    new Notification('Exporting trend data...', { type: 'info', duration: 2000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('Trend data exported successfully!', { type: 'success' });
    }
  }, 1500);
}

function filterBySubject(subject) {
  if (typeof Notification !== 'undefined') {
    new Notification(`Filtering by subject: ${subject}`, { type: 'info' });
  }
  
  // Update chart data based on subject filter
  const chart = window.reportsManager?.charts?.gradeDistribution;
  if (chart) {
    // Simulate different data for different subjects
    const subjectData = {
      'all': [45, 78, 65, 42, 28, 15, 8, 3],
      'math': [35, 65, 55, 35, 25, 12, 6, 2],
      'science': [40, 70, 60, 38, 30, 18, 10, 4],
      'english': [50, 85, 70, 45, 30, 20, 10, 5]
    };
    
    chart.data.datasets[0].data = subjectData[subject] || subjectData['all'];
    chart.update();
  }
}

function filterByGrade(grade) {
  if (typeof Notification !== 'undefined') {
    new Notification(`Filtering by grade: ${grade}`, { type: 'info' });
  }
  
  // Update attendance chart based on grade filter
  const chart = window.reportsManager?.charts?.attendance;
  if (chart) {
    // Simulate different attendance data for different grades
    const gradeData = {
      'all': [95, 92, 88, 94, 96],
      '7': [98, 95, 92, 96, 98],
      '8': [94, 91, 87, 93, 95],
      '9': [93, 90, 86, 92, 94],
      '10': [96, 93, 89, 95, 97]
    };
    
    chart.data.datasets[0].data = gradeData[grade] || gradeData['all'];
    chart.update();
  }
}

function viewAllReports() {
  if (typeof Notification !== 'undefined') {
    new Notification('Opening all reports view...', { type: 'info' });
  }
}

function downloadReport(reportId) {
  if (typeof Notification !== 'undefined') {
    new Notification(`Downloading report ${reportId}...`, { type: 'info', duration: 2000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification(`Report ${reportId} downloaded successfully!`, { type: 'success' });
    }
  }, 2000);
}

function viewReport(reportId) {
  if (typeof Notification !== 'undefined') {
    new Notification(`Opening report ${reportId}...`, { type: 'info' });
  }
}

function shareReport(reportId) {
  if (typeof Notification !== 'undefined') {
    new Notification(`Sharing report ${reportId}...`, { type: 'info' });
  }
}

function cancelReport(reportId) {
  if (confirm('Are you sure you want to cancel this report generation?')) {
    if (typeof Notification !== 'undefined') {
      new Notification(`Report ${reportId} generation cancelled`, { type: 'warning' });
    }
  }
}

function exportAllReports() {
  if (typeof Notification !== 'undefined') {
    new Notification('Exporting all reports...', { type: 'info', duration: 3000 });
  }
  
  setTimeout(() => {
    if (typeof Notification !== 'undefined') {
      new Notification('All reports exported successfully!', { type: 'success' });
    }
  }, 3000);
}

function generateReport() {
  const form = document.getElementById('reportGenerationForm');
  const submitBtn = document.querySelector('button[onclick="generateReport()"]');
  const btnText = submitBtn.querySelector('.btn-text');
  const btnLoading = submitBtn.querySelector('.btn-loading');
  
  // Show loading state
  submitBtn.disabled = true;
  btnText.style.display = 'none';
  btnLoading.style.display = 'inline-flex';
  
  // Simulate report generation
  setTimeout(() => {
    // Hide modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('generateReportModal'));
    if (modal) modal.hide();
    
    // Reset button state
    submitBtn.disabled = false;
    btnText.style.display = 'inline-flex';
    btnLoading.style.display = 'none';
    
    // Reset form
    form.reset();
    
    // Show success notification
    if (typeof Notification !== 'undefined') {
      new Notification('Report generation started! You will be notified when it\'s ready.', { type: 'success' });
    }
  }, 3000);
}

// Initialize reports manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.reportsManager = new ReportsManager();
});
