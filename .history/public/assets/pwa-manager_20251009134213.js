/**
 * PWA Manager for Smart Student Monitoring System
 * Handles PWA installation, updates, offline functionality, and push notifications
 */

class PWAManager {
  constructor() {
    this.isOnline = navigator.onLine;
    this.deferredPrompt = null;
    this.registration = null;
    this.updateAvailable = false;
    
    this.init();
  }

  async init() {
    console.log('[PWA] Initializing PWA Manager...');
    
    // Register service worker
    await this.registerServiceWorker();
    
    // Setup event listeners
    this.setupEventListeners();
    
    // Check for updates
    this.checkForUpdates();
    
    // Setup offline detection
    this.setupOfflineDetection();
    
    // Request notification permission
    this.requestNotificationPermission();
    
    console.log('[PWA] PWA Manager initialized successfully');
  }

  // Register service worker
  async registerServiceWorker() {
    if ('serviceWorker' in navigator) {
      try {
        const base = (window.__BASE_PATH__ || '').replace(/\/+$/, '');
        const swUrl = (base || '') + '/sw.js';
        const scope = (base || '') + '/';
        this.registration = await navigator.serviceWorker.register(swUrl, { scope });
        
        console.log('[PWA] Service worker registered:', this.registration);
        
        // Handle updates
        this.registration.addEventListener('updatefound', () => {
          const newWorker = this.registration.installing;
          
          newWorker.addEventListener('statechange', () => {
            if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
              this.updateAvailable = true;
              this.showUpdateNotification();
            }
          });
        });
        
        // Handle controller change
        navigator.serviceWorker.addEventListener('controllerchange', () => {
          window.location.reload();
        });
        
      } catch (error) {
        console.error('[PWA] Service worker registration failed:', error);
      }
    } else {
      console.warn('[PWA] Service worker not supported');
    }
  }

  // Setup event listeners
  setupEventListeners() {
    // Install prompt
    window.addEventListener('beforeinstallprompt', (e) => {
      console.log('[PWA] Install prompt triggered');
      e.preventDefault();
      this.deferredPrompt = e;
      this.showInstallButton();
    });

    // App installed
    window.addEventListener('appinstalled', () => {
      console.log('[PWA] App installed successfully');
      this.hideInstallButton();
      this.showNotification('App installed successfully!', 'success');
    });

    // Online/offline events
    window.addEventListener('online', () => {
      console.log('[PWA] Connection restored');
      this.isOnline = true;
      this.handleOnline();
    });

    window.addEventListener('offline', () => {
      console.log('[PWA] Connection lost');
      this.isOnline = false;
      this.handleOffline();
    });

    // Visibility change (app focus/blur)
    document.addEventListener('visibilitychange', () => {
      if (document.visibilityState === 'visible') {
        this.handleAppFocus();
      } else {
        this.handleAppBlur();
      }
    });

    // Before unload (app closing)
    window.addEventListener('beforeunload', () => {
      this.handleAppClosing();
    });
  }

  // Show install button
  showInstallButton() {
    // Remove existing install button
    const existingBtn = document.getElementById('pwa-install-btn');
    if (existingBtn) {
      existingBtn.remove();
    }

    // Create install button
    const installBtn = document.createElement('button');
    installBtn.id = 'pwa-install-btn';
    installBtn.className = 'btn btn-primary position-fixed';
    installBtn.style.cssText = `
      bottom: 20px;
      right: 20px;
      z-index: 9999;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      border-radius: 50px;
      padding: 12px 20px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      animation: slideInUp 0.3s ease-out;
    `;
    
    installBtn.innerHTML = `
      <svg width="20" height="20" fill="currentColor">
        <use href="#icon-download"></use>
      </svg>
      Install App
    `;

    // Add animation keyframes
    if (!document.getElementById('pwa-animations')) {
      const style = document.createElement('style');
      style.id = 'pwa-animations';
      style.textContent = `
        @keyframes slideInUp {
          from { transform: translateY(100px); opacity: 0; }
          to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideOutDown {
          from { transform: translateY(0); opacity: 1; }
          to { transform: translateY(100px); opacity: 0; }
        }
      `;
      document.head.appendChild(style);
    }

    document.body.appendChild(installBtn);

    // Add click handler
    installBtn.addEventListener('click', () => {
      this.installApp();
    });
  }

  // Hide install button
  hideInstallButton() {
    const installBtn = document.getElementById('pwa-install-btn');
    if (installBtn) {
      installBtn.style.animation = 'slideOutDown 0.3s ease-out';
      setTimeout(() => {
        installBtn.remove();
      }, 300);
    }
  }

  // Install app
  async installApp() {
    if (!this.deferredPrompt) {
      console.warn('[PWA] No install prompt available');
      return;
    }

    try {
      this.deferredPrompt.prompt();
      const { outcome } = await this.deferredPrompt.userChoice;
      
      console.log('[PWA] Install prompt outcome:', outcome);
      
      if (outcome === 'accepted') {
        this.showNotification('Installing app...', 'info');
      }
      
      this.deferredPrompt = null;
      this.hideInstallButton();
      
    } catch (error) {
      console.error('[PWA] Install prompt failed:', error);
    }
  }

  // Check for updates
  checkForUpdates() {
    if (this.registration) {
      this.registration.update();
    }
  }

  // Show update notification
  showUpdateNotification() {
    const updateToast = document.createElement('div');
    updateToast.id = 'pwa-update-toast';
    updateToast.className = 'toast position-fixed';
    updateToast.style.cssText = `
      top: 20px;
      right: 20px;
      z-index: 9999;
      min-width: 300px;
    `;
    
    updateToast.innerHTML = `
      <div class="toast-header bg-primary text-white">
        <svg class="me-2" width="20" height="20" fill="currentColor">
          <use href="#icon-update"></use>
        </svg>
        <strong class="me-auto">Update Available</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
      </div>
      <div class="toast-body">
        A new version of the app is available. Would you like to update now?
        <div class="mt-3">
          <button class="btn btn-primary btn-sm me-2" id="pwa-update-btn">Update Now</button>
          <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="toast">Later</button>
        </div>
      </div>
    `;

    document.body.appendChild(updateToast);

    // Show toast
    const toast = new bootstrap.Toast(updateToast, { delay: 0 });
    toast.show();

    // Add update button handler
    document.getElementById('pwa-update-btn').addEventListener('click', () => {
      this.updateApp();
      toast.hide();
    });
  }

  // Update app
  updateApp() {
    if (this.registration && this.registration.waiting) {
      this.registration.waiting.postMessage({ type: 'SKIP_WAITING' });
    }
  }

  // Setup offline detection
  setupOfflineDetection() {
    // Show offline indicator
    if (!this.isOnline) {
      this.showOfflineIndicator();
    }
  }

  // Handle online event
  handleOnline() {
    this.hideOfflineIndicator();
    this.showNotification('Connection restored', 'success');
    
    // Sync offline data
    this.syncOfflineData();
  }

  // Handle offline event
  handleOffline() {
    this.showOfflineIndicator();
    this.showNotification('You are now offline', 'warning');
  }

  // Show offline indicator
  showOfflineIndicator() {
    // Remove existing indicator
    const existing = document.getElementById('pwa-offline-indicator');
    if (existing) {
      existing.remove();
    }

    const indicator = document.createElement('div');
    indicator.id = 'pwa-offline-indicator';
    indicator.className = 'alert alert-warning position-fixed';
    indicator.style.cssText = `
      top: 0;
      left: 0;
      right: 0;
      z-index: 9999;
      margin: 0;
      border-radius: 0;
      text-align: center;
    `;
    
    indicator.innerHTML = `
      <svg class="me-2" width="16" height="16" fill="currentColor">
        <use href="#icon-wifi-off"></use>
      </svg>
      You are currently offline. Some features may be limited.
    `;

    document.body.appendChild(indicator);
  }

  // Hide offline indicator
  hideOfflineIndicator() {
    const indicator = document.getElementById('pwa-offline-indicator');
    if (indicator) {
      indicator.remove();
    }
  }

  // Request notification permission
  async requestNotificationPermission() {
    if ('Notification' in window && Notification.permission === 'default') {
      try {
        const permission = await Notification.requestPermission();
        console.log('[PWA] Notification permission:', permission);
      } catch (error) {
        console.error('[PWA] Notification permission request failed:', error);
      }
    }
  }

  // Show notification
  showNotification(message, type = 'info') {
    // Use existing notification system if available
    if (window.showNotification) {
      window.showNotification(message, type);
      return;
    }

    // Fallback notification
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} position-fixed`;
    notification.style.cssText = `
      top: 20px;
      right: 20px;
      z-index: 9999;
      min-width: 300px;
      animation: slideInRight 0.3s ease-out;
    `;
    
    notification.innerHTML = `
      <div class="d-flex align-items-center">
        <span class="me-2">${message}</span>
        <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
      </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
      if (notification.parentElement) {
        notification.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => {
          notification.remove();
        }, 300);
      }
    }, 5000);
  }

  // Handle app focus
  handleAppFocus() {
    console.log('[PWA] App focused');
    
    // Check for updates when app comes into focus
    this.checkForUpdates();
    
    // Sync data if online
    if (this.isOnline) {
      this.syncOfflineData();
    }
  }

  // Handle app blur
  handleAppBlur() {
    console.log('[PWA] App blurred');
    
    // Save current state
    this.saveAppState();
  }

  // Handle app closing
  handleAppClosing() {
    console.log('[PWA] App closing');
    
    // Save current state
    this.saveAppState();
  }

  // Save app state
  saveAppState() {
    try {
      const state = {
        timestamp: Date.now(),
        url: window.location.href,
        scrollPosition: window.scrollY,
        formData: this.collectFormData()
      };
      
      localStorage.setItem('pwa-app-state', JSON.stringify(state));
    } catch (error) {
      console.error('[PWA] Failed to save app state:', error);
    }
  }

  // Collect form data
  collectFormData() {
    const forms = document.querySelectorAll('form');
    const formData = {};
    
    forms.forEach((form, index) => {
      const data = new FormData(form);
      const obj = {};
      
      for (const [key, value] of data.entries()) {
        obj[key] = value;
      }
      
      if (Object.keys(obj).length > 0) {
        formData[`form-${index}`] = obj;
      }
    });
    
    return formData;
  }

  // Sync offline data
  async syncOfflineData() {
    if (!this.isOnline) {
      return;
    }

    try {
      // Get pending offline actions
      const pendingActions = this.getPendingOfflineActions();
      
      for (const action of pendingActions) {
        try {
          await this.syncOfflineAction(action);
        } catch (error) {
          console.error('[PWA] Failed to sync offline action:', error);
        }
      }
      
      console.log('[PWA] Offline data sync completed');
      
    } catch (error) {
      console.error('[PWA] Offline data sync failed:', error);
    }
  }

  // Get pending offline actions
  getPendingOfflineActions() {
    try {
      const pending = localStorage.getItem('pwa-pending-actions');
      return pending ? JSON.parse(pending) : [];
    } catch (error) {
      console.error('[PWA] Failed to get pending actions:', error);
      return [];
    }
  }

  // Sync offline action
  async syncOfflineAction(action) {
    const response = await fetch(action.url, {
      method: action.method,
      headers: action.headers,
      body: action.body
    });
    
    if (response.ok) {
      // Remove from pending actions
      this.removePendingAction(action.id);
    }
  }

  // Remove pending action
  removePendingAction(actionId) {
    try {
      const pending = this.getPendingOfflineActions();
      const updated = pending.filter(action => action.id !== actionId);
      localStorage.setItem('pwa-pending-actions', JSON.stringify(updated));
    } catch (error) {
      console.error('[PWA] Failed to remove pending action:', error);
    }
  }

  // Check if app is installed
  isAppInstalled() {
    return window.matchMedia('(display-mode: standalone)').matches ||
           window.navigator.standalone === true;
  }

  // Get app info
  getAppInfo() {
    return {
      isInstalled: this.isAppInstalled(),
      isOnline: this.isOnline,
      hasServiceWorker: 'serviceWorker' in navigator,
      hasNotifications: 'Notification' in window,
      hasPushManager: 'PushManager' in window,
      userAgent: navigator.userAgent,
      platform: navigator.platform
    };
  }
}

// Initialize PWA Manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  window.pwaManager = new PWAManager();
});

// Export for global access
window.PWAManager = PWAManager;
