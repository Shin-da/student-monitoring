/**
 * COMPLETE SIDEBAR SYSTEM - BULLETPROOF
 * Handles all sidebar functionality with comprehensive error handling
 */

class SidebarSystem {
  constructor() {
    this.config = {
      sidebarSelector: '#sidebar',
      toggleSelector: '#mobileToggle',
      overlaySelector: '#sidebarOverlay',
      mobileBreakpoint: 768,
      animationDuration: 300,
      storageKey: 'sidebarState',
      autoCloseDelay: 100
    };
    
    this.state = {
      isOpen: false,
      isMobile: false,
      isInitialized: false,
      isTransitioning: false
    };
    
    this.elements = {};
    this.eventListeners = [];
    this.observers = [];
    
    this.init();
  }

  /**
   * Initialize the sidebar system
   */
  init() {
    try {
      this.detectElements();
      this.setupEventListeners();
      this.setupResizeObserver();
      this.setupKeyboardNavigation();
      this.restoreState();
      this.setupAccessibility();
      this.state.isInitialized = true;
      
      console.log('Sidebar system initialized successfully');
    } catch (error) {
      console.error('Failed to initialize sidebar system:', error);
      this.fallbackInit();
    }
  }

  /**
   * Detect and cache DOM elements
   */
  detectElements() {
    this.elements.sidebar = document.querySelector(this.config.sidebarSelector);
    this.elements.toggle = document.querySelector(this.config.toggleSelector);
    this.elements.overlay = document.querySelector(this.config.overlaySelector);
    this.elements.body = document.body;
    
    if (!this.elements.sidebar) {
      throw new Error('Sidebar element not found');
    }
    
    if (!this.elements.toggle) {
      console.warn('Mobile toggle button not found');
    }
    
    if (!this.elements.overlay) {
      console.warn('Sidebar overlay not found');
    }
  }

  /**
   * Setup all event listeners
   */
  setupEventListeners() {
    // Mobile toggle button
    if (this.elements.toggle) {
      this.addEventListener(this.elements.toggle, 'click', (e) => {
        e.preventDefault();
        this.toggle();
      });
    }

    // Overlay click to close
    if (this.elements.overlay) {
      this.addEventListener(this.elements.overlay, 'click', () => {
        this.close();
      });
    }

    // Nav link clicks (mobile auto-close)
    const navLinks = this.elements.sidebar.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      this.addEventListener(link, 'click', () => {
        if (this.state.isMobile) {
          setTimeout(() => this.close(), this.config.autoCloseDelay);
        }
      });
    });

    // Section header clicks
    // Section header clicks
    // IMPORTANT: If using Bootstrap's data API (data-bs-toggle="collapse"),
    // do NOT manually toggle here to avoid double-toggling which prevents closing.
    const sectionHeaders = this.elements.sidebar.querySelectorAll('.nav-section-header');
    sectionHeaders.forEach(header => {
      // Only attach a manual toggle if no data API is present (fallback mode)
      if (!header.hasAttribute('data-bs-toggle')) {
        this.addEventListener(header, 'click', (e) => {
          e.preventDefault();
          this.toggleSection(header);
        });
      }
    });

    // Window resize
    this.addEventListener(window, 'resize', this.debounce(() => {
      this.handleResize();
    }, 100));

    // Escape key
    this.addEventListener(document, 'keydown', (e) => {
      if (e.key === 'Escape' && this.state.isOpen && this.state.isMobile) {
        this.close();
      }
    });

    // Focus trap when sidebar is open
    this.addEventListener(document, 'keydown', (e) => {
      if (e.key === 'Tab' && this.state.isOpen && this.state.isMobile) {
        this.handleFocusTrap(e);
      }
    });
  }

  /**
   * Setup resize observer for responsive behavior
   */
  setupResizeObserver() {
    if ('ResizeObserver' in window) {
      const resizeObserver = new ResizeObserver(this.debounce(() => {
        this.handleResize();
      }, 100));
      
      resizeObserver.observe(document.body);
      this.observers.push(resizeObserver);
    }
  }

  /**
   * Setup keyboard navigation
   */
  setupKeyboardNavigation() {
    // Arrow key navigation
    this.addEventListener(this.elements.sidebar, 'keydown', (e) => {
      this.handleArrowNavigation(e);
    });
  }

  /**
   * Setup accessibility features
   */
  setupAccessibility() {
    // Set ARIA attributes
    if (this.elements.sidebar) {
      this.elements.sidebar.setAttribute('role', 'navigation');
      this.elements.sidebar.setAttribute('aria-label', 'Main navigation');
    }

    if (this.elements.toggle) {
      this.elements.toggle.setAttribute('aria-label', 'Toggle navigation menu');
      this.elements.toggle.setAttribute('aria-expanded', 'false');
      this.elements.toggle.setAttribute('aria-controls', 'sidebar');
    }

    // Set tabindex for focusable elements
    const focusableElements = this.elements.sidebar.querySelectorAll(
      'a, button, [tabindex]:not([tabindex="-1"])'
    );
    focusableElements.forEach((element, index) => {
      element.setAttribute('tabindex', index === 0 ? '0' : '-1');
    });
  }

  /**
   * Toggle sidebar open/closed
   */
  toggle() {
    if (this.state.isTransitioning) return;
    
    if (this.state.isOpen) {
      this.close();
    } else {
      this.open();
    }
  }

  /**
   * Open sidebar
   */
  open() {
    if (this.state.isTransitioning || this.state.isOpen) return;
    
    this.state.isTransitioning = true;
    this.state.isOpen = true;

    try {
      // Add classes
      this.elements.sidebar.classList.add('show');
      if (this.elements.overlay) {
        this.elements.overlay.classList.add('show');
      }
      this.elements.body.classList.add('sidebar-open');

      // Update ARIA attributes
      if (this.elements.toggle) {
        this.elements.toggle.setAttribute('aria-expanded', 'true');
      }

      // Focus first element
      this.focusFirstElement();

      // Save state
      this.saveState();

      // Transition complete
      setTimeout(() => {
        this.state.isTransitioning = false;
      }, this.config.animationDuration);

    } catch (error) {
      console.error('Error opening sidebar:', error);
      this.state.isTransitioning = false;
    }
  }

  /**
   * Close sidebar
   */
  close() {
    if (this.state.isTransitioning || !this.state.isOpen) return;
    
    this.state.isTransitioning = true;
    this.state.isOpen = false;

    try {
      // Remove classes
      this.elements.sidebar.classList.remove('show');
      if (this.elements.overlay) {
        this.elements.overlay.classList.remove('show');
      }
      this.elements.body.classList.remove('sidebar-open');

      // Update ARIA attributes
      if (this.elements.toggle) {
        this.elements.toggle.setAttribute('aria-expanded', 'false');
      }

      // Return focus to toggle button
      if (this.elements.toggle && this.state.isMobile) {
        this.elements.toggle.focus();
      }

      // Save state
      this.saveState();

      // Transition complete
      setTimeout(() => {
        this.state.isTransitioning = false;
      }, this.config.animationDuration);

    } catch (error) {
      console.error('Error closing sidebar:', error);
      this.state.isTransitioning = false;
    }
  }

  /**
   * Handle window resize
   */
  handleResize() {
    const wasMobile = this.state.isMobile;
    this.state.isMobile = window.innerWidth < this.config.mobileBreakpoint;

    // If switching from mobile to desktop, ensure sidebar is visible
    if (wasMobile && !this.state.isMobile) {
      this.elements.sidebar.classList.remove('show');
      if (this.elements.overlay) {
        this.elements.overlay.classList.remove('show');
      }
      this.elements.body.classList.remove('sidebar-open');
      this.state.isOpen = false;
    }

    // Update toggle button visibility
    if (this.elements.toggle) {
      this.elements.toggle.style.display = this.state.isMobile ? 'flex' : 'none';
    }
  }

  /**
   * Toggle navigation section
   */
  toggleSection(header) {
    try {
      const targetId = header.getAttribute('data-bs-target');
      const collapse = document.querySelector(targetId);
      const arrow = header.querySelector('.nav-section-arrow');
      
      if (collapse) {
        // If Bootstrap data API is used on header, let it handle toggling; only update visuals shortly after
        if (header.hasAttribute('data-bs-toggle') && typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
          // Visual sync after Bootstrap toggles
          setTimeout(() => {
            const isExpanded = collapse.classList.contains('show');
            if (arrow) arrow.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(-90deg)';
            header.setAttribute('aria-expanded', isExpanded);
          }, 50);
        } else if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
          const bsCollapse = new bootstrap.Collapse(collapse, { toggle: true });
        } else {
          // Fallback: Manual toggle
          collapse.classList.toggle('show');
        }
        
        // Update arrow rotation and aria-expanded
        if (arrow) {
          setTimeout(() => {
            const isExpanded = collapse.classList.contains('show');
            arrow.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(-90deg)';
            header.setAttribute('aria-expanded', isExpanded);
          }, 50);
        }
      }
    } catch (error) {
      console.error('Error toggling section:', error);
    }
  }

  /**
   * Handle arrow key navigation
   */
  handleArrowNavigation(e) {
    const focusableElements = Array.from(
      this.elements.sidebar.querySelectorAll(
        'a, button, [tabindex]:not([tabindex="-1"])'
      )
    );

    const currentIndex = focusableElements.indexOf(document.activeElement);

    switch (e.key) {
      case 'ArrowDown':
        e.preventDefault();
        const nextIndex = (currentIndex + 1) % focusableElements.length;
        focusableElements[nextIndex].focus();
        break;
      case 'ArrowUp':
        e.preventDefault();
        const prevIndex = currentIndex <= 0 ? focusableElements.length - 1 : currentIndex - 1;
        focusableElements[prevIndex].focus();
        break;
      case 'Home':
        e.preventDefault();
        focusableElements[0].focus();
        break;
      case 'End':
        e.preventDefault();
        focusableElements[focusableElements.length - 1].focus();
        break;
    }
  }

  /**
   * Handle focus trap for mobile
   */
  handleFocusTrap(e) {
    if (!this.state.isOpen || !this.state.isMobile) return;

    const focusableElements = Array.from(
      this.elements.sidebar.querySelectorAll(
        'a, button, [tabindex]:not([tabindex="-1"])'
      )
    );

    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];

    if (e.shiftKey) {
      if (document.activeElement === firstElement) {
        e.preventDefault();
        lastElement.focus();
      }
    } else {
      if (document.activeElement === lastElement) {
        e.preventDefault();
        firstElement.focus();
      }
    }
  }

  /**
   * Focus first focusable element
   */
  focusFirstElement() {
    const firstElement = this.elements.sidebar.querySelector(
      'a, button, [tabindex]:not([tabindex="-1"])'
    );
    if (firstElement) {
      firstElement.focus();
    }
  }

  /**
   * Save sidebar state to localStorage
   */
  saveState() {
    try {
      const state = {
        isOpen: this.state.isOpen,
        timestamp: Date.now()
      };
      localStorage.setItem(this.config.storageKey, JSON.stringify(state));
    } catch (error) {
      console.warn('Could not save sidebar state:', error);
    }
  }

  /**
   * Restore sidebar state from localStorage
   */
  restoreState() {
    try {
      const saved = localStorage.getItem(this.config.storageKey);
      if (saved) {
        // Validate JSON before parsing
        if (saved.trim().startsWith('{') && saved.trim().endsWith('}')) {
          const state = JSON.parse(saved);
          // Only restore if saved within last 24 hours and has valid structure
          if (state && typeof state === 'object' && state.timestamp && state.isOpen !== undefined) {
            if (Date.now() - state.timestamp < 24 * 60 * 60 * 1000) {
              if (state.isOpen && this.state.isMobile) {
                this.open();
              }
            }
          }
        } else {
          // Invalid JSON, remove it
          localStorage.removeItem(this.config.storageKey);
        }
      }
    } catch (error) {
      console.warn('Could not restore sidebar state:', error);
      // Clean up corrupted data
      localStorage.removeItem(this.config.storageKey);
    }
  }

  /**
   * Add event listener with cleanup tracking
   */
  addEventListener(element, event, handler) {
    element.addEventListener(event, handler);
    this.eventListeners.push({ element, event, handler });
  }

  /**
   * Debounce function
   */
  debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  /**
   * Fallback initialization for when main init fails
   */
  fallbackInit() {
    console.log('Using fallback sidebar initialization');
    
    // Basic mobile toggle functionality
    if (this.elements.toggle && this.elements.sidebar) {
      this.elements.toggle.addEventListener('click', () => {
        this.elements.sidebar.classList.toggle('show');
      });
    }
  }

  /**
   * Cleanup method
   */
  destroy() {
    // Remove event listeners
    this.eventListeners.forEach(({ element, event, handler }) => {
      element.removeEventListener(event, handler);
    });
    this.eventListeners = [];

    // Disconnect observers
    this.observers.forEach(observer => observer.disconnect());
    this.observers = [];

    // Reset state
    this.state.isInitialized = false;
  }

  /**
   * Public API methods
   */
  getState() {
    return { ...this.state };
  }

  isOpen() {
    return this.state.isOpen;
  }

  isMobile() {
    return this.state.isMobile;
  }

  openSidebar() {
    this.open();
  }

  closeSidebar() {
    this.close();
  }

  toggleSidebar() {
    this.toggle();
  }
}

/**
 * Sidebar State Management for Collapsible Sections
 */
class SidebarStateManager {
  constructor() {
    this.storageKey = 'sidebarCollapseStates';
    this.init();
  }

  init() {
    this.bindEvents();
    this.restoreStates();
  }

  bindEvents() {
    // Save states when collapse events occur
    document.addEventListener('shown.bs.collapse', (e) => {
      this.saveState(e.target.id, true);
      // Update arrow rotation
      const header = document.querySelector(`[data-bs-target="#${e.target.id}"]`);
      const arrow = header?.querySelector('.nav-section-arrow');
      if (arrow) {
        arrow.style.transform = 'rotate(0deg)';
        header.setAttribute('aria-expanded', 'true');
      }

      // Optional accordion behavior: close other open sections if sidebar opts in via data-accordion="true"
      try {
        const currentCollapse = e.target;
        const currentSection = currentCollapse.closest('.nav-section');
        const sidebar = currentCollapse.closest('.sidebar');
        // Limit the scope within the sidebar to avoid unintended collapses elsewhere
        if (sidebar && currentSection && sidebar.getAttribute('data-accordion') === 'true') {
          const openCollapses = sidebar.querySelectorAll('.nav-section .collapse.show');
          openCollapses.forEach(col => {
            if (col !== currentCollapse) {
              if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                const inst = bootstrap.Collapse.getInstance(col) || new bootstrap.Collapse(col, { toggle: false });
                inst.hide();
              } else {
                col.classList.remove('show');
                const hdr = sidebar.querySelector(`[data-bs-target="#${col.id}"]`);
                const arr = hdr?.querySelector('.nav-section-arrow');
                if (hdr) hdr.setAttribute('aria-expanded', 'false');
                if (arr) arr.style.transform = 'rotate(-90deg)';
              }
            }
          });
        }
      } catch (err) {
        console.warn('Accordion auto-close failed:', err);
      }
    });

    document.addEventListener('hidden.bs.collapse', (e) => {
      this.saveState(e.target.id, false);
      // Update arrow rotation
      const header = document.querySelector(`[data-bs-target="#${e.target.id}"]`);
      const arrow = header?.querySelector('.nav-section-arrow');
      if (arrow) {
        arrow.style.transform = 'rotate(-90deg)';
        header.setAttribute('aria-expanded', 'false');
      }
    });
  }

  saveState(sectionId, isExpanded) {
    try {
      const states = this.getStates();
      states[sectionId] = isExpanded;
      localStorage.setItem(this.storageKey, JSON.stringify(states));
    } catch (error) {
      console.warn('Could not save collapse state:', error);
    }
  }

  getStates() {
    try {
      const saved = localStorage.getItem(this.storageKey);
      if (saved && saved.trim().startsWith('{') && saved.trim().endsWith('}')) {
        return JSON.parse(saved);
      }
      return {};
    } catch (error) {
      // Clean up corrupted data
      localStorage.removeItem(this.storageKey);
      return {};
    }
  }

  restoreStates() {
    const states = this.getStates();
    
    Object.keys(states).forEach(sectionId => {
      const collapse = document.getElementById(sectionId);
      const header = document.querySelector(`[data-bs-target="#${sectionId}"]`);
      const arrow = header?.querySelector('.nav-section-arrow');
      
      if (collapse && header) {
        if (states[sectionId]) {
          collapse.classList.add('show');
          if (arrow) arrow.style.transform = 'rotate(0deg)';
          header.setAttribute('aria-expanded', 'true');
        } else {
          collapse.classList.remove('show');
          if (arrow) arrow.style.transform = 'rotate(-90deg)';
          header.setAttribute('aria-expanded', 'false');
        }
      }
    });
  }
}

/**
 * Active Link Management
 */
class ActiveLinkManager {
  constructor() {
    this.storageKey = 'activeNavLink';
    this.init();
  }

  init() {
    this.bindEvents();
    this.restoreActiveLink();
  }

  bindEvents() {
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', (e) => {
        this.setActiveLink(link);
      });
    });
  }

  setActiveLink(activeLink) {
    // Remove active class from all nav links
    document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.remove('active');
    });
    
    // Add active class to clicked link
    activeLink.classList.add('active');
    
    // Store active state
    try {
      localStorage.setItem(this.storageKey, activeLink.getAttribute('href'));
    } catch (error) {
      console.warn('Could not save active link:', error);
    }
  }

  restoreActiveLink() {
    try {
      const activeNavLink = localStorage.getItem(this.storageKey);
      if (activeNavLink && activeNavLink.trim()) {
        const link = document.querySelector(`.nav-link[href="${activeNavLink}"]`);
        if (link) {
          link.classList.add('active');
        }
      }
    } catch (error) {
      console.warn('Could not restore active link:', error);
      // Clean up corrupted data
      localStorage.removeItem(this.storageKey);
    }
  }
}

/**
 * Clean up corrupted localStorage data
 */
function cleanupLocalStorage() {
  const keys = ['sidebarState', 'sidebarCollapseStates', 'activeNavLink'];
  keys.forEach(key => {
    try {
      const value = localStorage.getItem(key);
      if (value) {
        // Try to parse as JSON to validate
        if (key === 'sidebarState' || key === 'sidebarCollapseStates') {
          JSON.parse(value);
        }
      }
    } catch (error) {
      console.log(`Cleaning up corrupted localStorage key: ${key}`);
      localStorage.removeItem(key);
    }
  });
}

/**
 * Initialize everything when DOM is ready
 */
document.addEventListener('DOMContentLoaded', () => {
  try {
    // Clean up any corrupted localStorage data first
    cleanupLocalStorage();
    
    // Initialize main sidebar system
    window.sidebarSystem = new SidebarSystem();
    
    // Initialize state managers
    window.sidebarStateManager = new SidebarStateManager();
    window.activeLinkManager = new ActiveLinkManager();
    
    console.log('✅ Complete sidebar system initialized successfully');
  const _dbgSidebar = document.querySelector('#sidebar');
  const _dbgToggle = document.querySelector('#mobileToggle');
  console.log('📱 Mobile toggle:', _dbgToggle ? 'Available' : 'Not found');
  console.log('🎨 Sidebar element:', _dbgSidebar ? 'Found' : 'Not found');
    console.log('📊 State management:', 'Active');
    console.log('🔧 Bootstrap available:', typeof bootstrap !== 'undefined' ? 'Yes' : 'No');
    
    // Debug collapse functionality
    const collapseElements = document.querySelectorAll('.nav-section .collapse');
    console.log('📋 Collapse elements found:', collapseElements.length);
    
    const sectionHeaders = document.querySelectorAll('.nav-section-header');
    console.log('📋 Section headers found:', sectionHeaders.length);
  } catch (error) {
    console.error('Failed to initialize sidebar system:', error);
  }
});

/**
 * Export for module systems
 */
if (typeof module !== 'undefined' && module.exports) {
  module.exports = { SidebarSystem, SidebarStateManager, ActiveLinkManager };
}
