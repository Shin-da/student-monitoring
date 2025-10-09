// Enhanced Settings Management JavaScript
class SettingsManager {
  constructor() {
    this.forms = {};
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadSettings();
  }

  bindEvents() {
    // Form change events
    document.querySelectorAll('form[id$="Form"]').forEach(form => {
      form.addEventListener('change', () => this.markFormChanged(form));
    });

    // Navigation events
    const settingsNav = document.getElementById('settingsNav');
    if (settingsNav) {
      settingsNav.addEventListener('click', (e) => {
        if (e.target.classList.contains('nav-link')) {
          this.updateActiveTab(e.target);
        }
      });
    }
  }

  markFormChanged(form) {
    const saveBtn = document.querySelector('button[onclick="saveAllSettings()"]');
    if (saveBtn) {
      saveBtn.classList.add('btn-warning');
      saveBtn.classList.remove('btn-primary');
      saveBtn.innerHTML = `
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-alerts"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Save Changes</span>
      `;
    }
  }

  updateActiveTab(activeLink) {
    document.querySelectorAll('#settingsNav .nav-link').forEach(link => {
      link.classList.remove('active');
    });
    activeLink.classList.add('active');
  }

  loadSettings() {
    // Load settings from localStorage or API
    const settings = this.getDefaultSettings();
    this.populateForms(settings);
  }

  getDefaultSettings() {
    return {
      general: {
        schoolName: 'Sample High School',
        schoolCode: 'SHS001',
        schoolYear: '2024-2025',
        timezone: 'UTC+8',
        language: 'en',
        dateFormat: 'Y-m-d',
        schoolAddress: '123 Education Street, Learning City, 1234',
        schoolPhone: '+63 2 1234 5678',
        schoolEmail: 'info@school.edu'
      },
      security: {
        minPasswordLength: 8,
        passwordExpiry: 90,
        requireUppercase: true,
        requireLowercase: true,
        requireNumbers: true,
        requireSymbols: true,
        sessionTimeout: 30,
        maxLoginAttempts: 5,
        twoFactorAuth: true,
        ipWhitelist: true,
        auditLogging: true
      },
      notifications: {
        smtpHost: 'smtp.gmail.com',
        smtpPort: 587,
        smtpUsername: 'noreply@school.edu',
        smtpEncryption: true,
        newUserNotifications: true,
        gradeNotifications: true,
        attendanceNotifications: true,
        systemAlerts: true,
        backupNotifications: true,
        securityAlerts: true
      },
      backup: {
        autoBackup: true,
        backupFrequency: 'daily',
        backupTime: '02:00',
        backupRetention: 30,
        backupLocation: 'local',
        backupPath: '/backups/'
      },
      maintenance: {
        maintenanceMode: false,
        maintenanceMessage: 'System is under maintenance. Please try again later.'
      },
      integrations: {
        googleAuth: true,
        googleDrive: true,
        smsNotifications: true,
        smsProvider: 'twilio'
      }
    };
  }

  populateForms(settings) {
    // Populate all forms with settings data
    Object.keys(settings).forEach(category => {
      const form = document.getElementById(`${category}SettingsForm`);
      if (form) {
        Object.keys(settings[category]).forEach(key => {
          const element = document.getElementById(key);
          if (element) {
            if (element.type === 'checkbox') {
              element.checked = settings[category][key];
            } else {
              element.value = settings[category][key];
            }
          }
        });
      }
    });
  }

  saveSettings() {
    const settings = {};
    
    // Collect data from all forms
    document.querySelectorAll('form[id$="Form"]').forEach(form => {
      const formId = form.id.replace('SettingsForm', '');
      settings[formId] = {};
      
      const formData = new FormData(form);
      for (let [key, value] of formData.entries()) {
        settings[formId][key] = value;
      }
      
      // Handle checkboxes
      form.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        settings[formId][checkbox.id] = checkbox.checked;
      });
    });

    // Save to localStorage (replace with API call)
    localStorage.setItem('systemSettings', JSON.stringify(settings));
    
    return settings;
  }
}

// Global functions
function saveAllSettings() {
  const settingsManager = new SettingsManager();
  const settings = settingsManager.saveSettings();
  
  // Show success notification
  if (typeof Notification !== 'undefined') {
    new Notification('Settings saved successfully!', { type: 'success' });
  }
  
  // Reset save button
  const saveBtn = document.querySelector('button[onclick="saveAllSettings()"]');
  if (saveBtn) {
    saveBtn.classList.remove('btn-warning');
    saveBtn.classList.add('btn-primary');
    saveBtn.innerHTML = `
      <svg width="16" height="16" fill="currentColor">
        <use href="#icon-check"></use>
      </svg>
      <span class="d-none d-md-inline ms-1">Save All</span>
    `;
  }
}

function exportSettings() {
  const settingsManager = new SettingsManager();
  const settings = settingsManager.saveSettings();
  
  const dataStr = JSON.stringify(settings, null, 2);
  const dataBlob = new Blob([dataStr], { type: 'application/json' });
  const url = URL.createObjectURL(dataBlob);
  
  const link = document.createElement('a');
  link.href = url;
  link.download = 'system_settings.json';
  link.click();
  
  URL.revokeObjectURL(url);
  
  if (typeof Notification !== 'undefined') {
    new Notification('Settings exported successfully!', { type: 'success' });
  }
}

function createBackup() {
  const btn = event.target.closest('button');
  const originalContent = btn.innerHTML;
  
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Creating...';
  btn.disabled = true;
  
  setTimeout(() => {
    btn.innerHTML = originalContent;
    btn.disabled = false;
    
    if (typeof Notification !== 'undefined') {
      new Notification('Backup created successfully!', { type: 'success' });
    }
  }, 3000);
}

function viewBackups() {
  if (typeof Notification !== 'undefined') {
    new Notification('Opening backup manager...', { type: 'info' });
  }
}

function clearCache() {
  const btn = event.target.closest('button');
  const originalContent = btn.innerHTML;
  
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Clearing...';
  btn.disabled = true;
  
  setTimeout(() => {
    btn.innerHTML = originalContent;
    btn.disabled = false;
    
    if (typeof Notification !== 'undefined') {
      new Notification('Cache cleared successfully!', { type: 'success' });
    }
  }, 2000);
}

function optimizeDatabase() {
  const btn = event.target.closest('button');
  const originalContent = btn.innerHTML;
  
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Optimizing...';
  btn.disabled = true;
  
  setTimeout(() => {
    btn.innerHTML = originalContent;
    btn.disabled = false;
    
    if (typeof Notification !== 'undefined') {
      new Notification('Database optimized successfully!', { type: 'success' });
    }
  }, 4000);
}

function resetSystem() {
  if (confirm('Are you sure you want to reset the system? This action cannot be undone.')) {
    if (typeof Notification !== 'undefined') {
      new Notification('System reset initiated...', { type: 'warning' });
    }
  }
}

// Initialize settings manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new SettingsManager();
});
