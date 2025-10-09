// Enhanced Sidebar Management
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

    // Handle sidebar collapse on mobile
    this.handleMobileCollapse();
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

  handleMobileCollapse() {
    // Add mobile-specific functionality
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.createElement('button');
    toggleBtn.className = 'btn btn-primary d-md-none position-fixed';
    toggleBtn.style.cssText = 'top: 10px; left: 10px; z-index: 1050;';
    toggleBtn.innerHTML = '<svg width="16" height="16" fill="currentColor"><use href="#icon-menu"></use></svg>';
    
    // Add toggle button to header
    const header = document.querySelector('.dashboard-header');
    if (header) {
      header.appendChild(toggleBtn);
      
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
      });
    }
  }
}

// Initialize sidebar when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
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
