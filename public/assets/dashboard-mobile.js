// Dashboard Mobile Functionality
class DashboardMobile {
  constructor() {
    this.init();
  }

  init() {
    this.bindEvents();
    this.handleResize();
  }

  bindEvents() {
    // Mobile toggle button
    const mobileToggle = document.getElementById('mobileToggle');
    if (mobileToggle) {
      mobileToggle.addEventListener('click', () => {
        this.toggleSidebar();
      });
    }

    // Sidebar overlay
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    if (sidebarOverlay) {
      sidebarOverlay.addEventListener('click', () => {
        this.closeSidebar();
      });
    }

    // Close sidebar when clicking on nav links (mobile)
    const navLinks = document.querySelectorAll('.sidebar .nav-link');
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth < 768) {
          this.closeSidebar();
        }
      });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
      this.handleResize();
    });

    // Handle escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && window.innerWidth < 768) {
        this.closeSidebar();
      }
    });
  }

  toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
      const isOpen = sidebar.classList.contains('show');
      
      if (isOpen) {
        this.closeSidebar();
      } else {
        this.openSidebar();
      }
    }
  }

  openSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
      sidebar.classList.add('show');
      overlay.classList.add('show');
      document.body.style.overflow = 'hidden'; // Prevent body scroll
    }
  }

  closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
      sidebar.classList.remove('show');
      overlay.classList.remove('show');
      document.body.style.overflow = ''; // Restore body scroll
    }
  }

  handleResize() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (window.innerWidth >= 768) {
      // Desktop view - ensure sidebar is visible and overlay is hidden
      if (sidebar) sidebar.classList.remove('show');
      if (overlay) overlay.classList.remove('show');
      document.body.style.overflow = '';
    }
  }
}

// Enhanced Sidebar Management (updated)
class SidebarManager {
  constructor() {
    this.init();
  }

  init() {
    this.bindEvents();
    this.initializeCollapseStates();
    this.addActiveStateManagement();
  }

  bindEvents() {
    // Handle section header clicks
    document.querySelectorAll('.nav-section-header').forEach(header => {
      header.addEventListener('click', (e) => {
        e.preventDefault();
        this.toggleSection(header);
      });
    });

    // Handle nav link clicks for active state
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', (e) => {
        this.setActiveLink(link);
      });
    });
  }

  toggleSection(header) {
    const targetId = header.getAttribute('data-bs-target');
    const collapse = document.querySelector(targetId);
    const arrow = header.querySelector('.nav-arrow');
    
    if (collapse) {
      const bsCollapse = new bootstrap.Collapse(collapse, {
        toggle: true
      });
      
      // Rotate arrow
      if (arrow) {
        arrow.style.transform = collapse.classList.contains('show') ? 'rotate(0deg)' : 'rotate(-90deg)';
      }
    }
  }

  setActiveLink(activeLink) {
    // Remove active class from all nav links
    document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.remove('active');
    });
    
    // Add active class to clicked link
    activeLink.classList.add('active');
    
    // Store active state in localStorage
    localStorage.setItem('activeNavLink', activeLink.getAttribute('href'));
  }

  initializeCollapseStates() {
    // Restore collapse states from localStorage
    const savedStates = JSON.parse(localStorage.getItem('sidebarCollapseStates') || '{}');
    
    Object.keys(savedStates).forEach(sectionId => {
      const collapse = document.getElementById(sectionId);
      const header = document.querySelector(`[data-bs-target="#${sectionId}"]`);
      const arrow = header?.querySelector('.nav-arrow');
      
      if (collapse && header) {
        if (savedStates[sectionId]) {
          collapse.classList.add('show');
          if (arrow) arrow.style.transform = 'rotate(0deg)';
        } else {
          collapse.classList.remove('show');
          if (arrow) arrow.style.transform = 'rotate(-90deg)';
        }
      }
    });
  }

  addActiveStateManagement() {
    // Restore active link from localStorage
    const activeNavLink = localStorage.getItem('activeNavLink');
    if (activeNavLink) {
      const link = document.querySelector(`.nav-link[href="${activeNavLink}"]`);
      if (link) {
        link.classList.add('active');
      }
    }
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new DashboardMobile();
  new SidebarManager();
});

// Save collapse states when they change
document.addEventListener('shown.bs.collapse', (e) => {
  const states = JSON.parse(localStorage.getItem('sidebarCollapseStates') || '{}');
  states[e.target.id] = true;
  localStorage.setItem('sidebarCollapseStates', JSON.stringify(states));
});

document.addEventListener('hidden.bs.collapse', (e) => {
  const states = JSON.parse(localStorage.getItem('sidebarCollapseStates') || '{}');
  states[e.target.id] = false;
  localStorage.setItem('sidebarCollapseStates', JSON.stringify(states));
});
