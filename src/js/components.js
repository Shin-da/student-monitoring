// =============================================================================
// COMPONENT LIBRARY JAVASCRIPT BUNDLE
// Reusable UI components that can be loaded on-demand
// =============================================================================

// Import component library
import './components/modal.js';
import './components/dropdown.js';
import './components/tooltip.js';
import './components/alert.js';
import './components/table.js';
import './components/form.js';
import './components/navigation.js';

// Initialize component library when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  // Initialize component library
  if (window.ComponentLibrary) {
    window.componentLibrary = new window.ComponentLibrary();
  }
  
  console.log('🧩 Component library initialized');
});

// Export for use in other bundles
export {
  ComponentLibrary: window.ComponentLibrary
};
