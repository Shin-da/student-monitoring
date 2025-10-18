// =============================================================================
// MAIN APPLICATION JAVASCRIPT BUNDLE
// Core functionality that loads on every page
// =============================================================================

// Import core utilities
import './core/utils.js';
import './core/performance.js';

// Import theme management
import './features/theme-manager.js';

// Import notification system
import './features/notification-system.js';

// Import accessibility enhancements
import './features/accessibility.js';

// Initialize core functionality when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  // Initialize theme manager
  if (window.ThemeManager) {
    window.ThemeManager.init();
  }
  
  // Initialize notification system
  if (window.NotificationSystem) {
    window.notificationSystem = new window.NotificationSystem();
  }
  
  // Initialize accessibility enhancements
  if (window.AccessibilityManager) {
    window.accessibilityManager = new window.AccessibilityManager();
  }
  
  // Initialize performance monitoring
  if (window.PerformanceMonitor) {
    window.performanceMonitor = new window.PerformanceMonitor();
  }
  
  console.log('🚀 Core application initialized');
});

// Export for use in other bundles
export {
  ThemeManager: window.ThemeManager,
  NotificationSystem: window.NotificationSystem,
  AccessibilityManager: window.AccessibilityManager,
  PerformanceMonitor: window.PerformanceMonitor
};
