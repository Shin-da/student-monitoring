// =============================================================================
// DASHBOARD-SPECIFIC JAVASCRIPT BUNDLE
// Features that only load on dashboard pages
// =============================================================================

// Import core app functionality
import './app.js';

// Import dashboard-specific features
import './features/sidebar-system.js';
import './features/charts.js';
import './features/real-time-updates.js';

// Import enhanced forms for dashboard
import './features/enhanced-forms.js';

// Initialize dashboard functionality when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  // Initialize sidebar system
  if (window.SidebarSystem) {
    window.sidebarSystem = new window.SidebarSystem();
  }
  
  // Initialize enhanced forms
  if (window.EnhancedFormsSystem) {
    window.enhancedFormsSystem = new window.EnhancedFormsSystem();
  }
  
  // Initialize charts
  if (window.ChartManager) {
    window.chartManager = new window.ChartManager();
  }
  
  // Initialize real-time updates
  if (window.RealTimeManager) {
    window.realTimeManager = new window.RealTimeManager();
  }
  
  console.log('📊 Dashboard functionality initialized');
});

// Export for use in other bundles
export {
  SidebarSystem: window.SidebarSystem,
  EnhancedFormsSystem: window.EnhancedFormsSystem,
  ChartManager: window.ChartManager,
  RealTimeManager: window.RealTimeManager
};
