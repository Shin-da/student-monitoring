// =============================================================================
// UNIFIED COMPONENT SYSTEM
// Centralized component creation and management
// =============================================================================

class ComponentSystem {
  constructor() {
    this.components = new Map();
    this.templates = new Map();
    this.init();
  }
  
  init() {
    this.registerTemplates();
    this.initializeComponents();
    console.log('🧩 Component System initialized');
  }
  
  // =============================================================================
  // COMPONENT REGISTRATION
  // =============================================================================
  
  registerTemplates() {
    // Dashboard Stat Card Template
    this.templates.set('statCard', (data) => `
      <div class="stat-card surface p-4 h-100 position-relative overflow-hidden" 
           data-component="statCard" 
           data-card-id="${data.id || 'default'}">
        <div class="position-absolute top-0 end-0 w-100 h-100" 
             style="background: linear-gradient(135deg, ${data.color || 'rgba(13, 110, 253, 0.1)'} 0%, ${data.colorLight || 'rgba(13, 110, 253, 0.05)'} 100%);"></div>
        <div class="position-relative">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="stat-icon ${data.iconBg || 'bg-primary-subtle'} ${data.iconColor || 'text-primary'}" 
                 style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <svg width="24" height="24" fill="currentColor">
                <use href="#${data.icon}"></use>
              </svg>
            </div>
            ${data.badge ? `<span class="badge ${data.badgeClass || 'bg-primary-subtle text-primary'}">${data.badge}</span>` : ''}
          </div>
          <h3 class="h4 fw-bold mb-1 ${data.valueColor || 'text-primary'}" 
              data-count-to="${data.value}" 
              data-count-decimals="${data.decimals || 0}">0</h3>
          <p class="text-muted small mb-0">${data.label}</p>
          ${data.progress ? `
            <div class="progress mt-2" style="height: 4px;">
              <div class="progress-bar ${data.progressClass || 'bg-primary'}" 
                   style="width: ${data.progress}%" 
                   data-progress-to="${data.progress}"></div>
            </div>
          ` : ''}
        </div>
      </div>
    `);
    
    // Action Card Template
    this.templates.set('actionCard', (data) => `
      <div class="action-card d-block p-3 border rounded-3 position-relative overflow-hidden" 
           data-component="actionCard" 
           data-card-id="${data.id || 'default'}"
           ${data.onclick ? `onclick="${data.onclick}"` : ''}
           style="transition: all 0.3s ease; cursor: pointer;">
        <div class="position-absolute top-0 start-0 w-100 h-100" 
             style="background: linear-gradient(135deg, ${data.color || 'rgba(13, 110, 253, 0.05)'} 0%, ${data.colorLight || 'rgba(13, 110, 253, 0.02)'} 100%);"></div>
        <div class="position-relative">
          <div class="d-flex align-items-center gap-3">
            <div class="stat-icon ${data.iconBg || 'bg-primary-subtle'} ${data.iconColor || 'text-primary'}" 
                 style="width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
              <svg width="20" height="20" fill="currentColor">
                <use href="#${data.icon}"></use>
              </svg>
            </div>
            <div class="flex-grow-1">
              <div class="fw-semibold">${data.title}</div>
              <div class="text-muted small">${data.subtitle}</div>
              ${data.progress ? `
                <div class="progress mt-1" style="height: 4px;">
                  <div class="progress-bar ${data.progressClass || 'bg-success'}" 
                       style="width: ${data.progress}%" 
                       data-progress-to="${data.progress}"></div>
                </div>
              ` : ''}
              ${data.meta ? `<div class="d-flex justify-content-between mt-1"><small class="text-muted">${data.meta}</small></div>` : ''}
            </div>
            ${data.badge ? `<div class="text-end"><span class="badge ${data.badgeClass || 'bg-success-subtle text-success'}">${data.badge}</span></div>` : ''}
          </div>
        </div>
      </div>
    `);
    
    // Form Field Template
    this.templates.set('formField', (data) => `
      <div class="form-group mb-3" data-component="formField">
        <label for="${data.id}" class="form-label">${data.label}${data.required ? ' *' : ''}</label>
        ${this.generateFormInput(data)}
        ${data.help ? `<div class="form-help">${data.help}</div>` : ''}
        ${data.validation ? `<div class="invalid-feedback">${data.validation}</div>` : ''}
      </div>
    `);
    
    // Alert Template
    this.templates.set('alert', (data) => `
      <div class="alert alert-${data.type || 'info'} ${data.dismissible ? 'alert-dismissible' : ''} d-flex align-items-center gap-2" 
           role="alert" 
           data-component="alert"
           data-alert-id="${data.id || 'default'}">
        <span>${data.icon || 'ℹ️'}</span>
        <span>${data.message}</span>
        ${data.dismissible ? `
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        ` : ''}
      </div>
    `);
    
    // Modal Template
    this.templates.set('modal', (data) => `
      <div class="modal fade" id="${data.id}" tabindex="-1" data-component="modal">
        <div class="modal-dialog ${data.size ? `modal-${data.size}` : ''}">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">${data.title}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ${data.content || ''}
            </div>
            ${data.footer ? `
              <div class="modal-footer">
                ${data.footer}
              </div>
            ` : ''}
          </div>
        </div>
      </div>
    `);
    
    // Table Template
    this.templates.set('table', (data) => `
      <div class="table-responsive" data-component="table">
        <table class="table table-hover">
          <thead>
            <tr>
              ${data.columns.map(col => `<th>${col.label}</th>`).join('')}
            </tr>
          </thead>
          <tbody>
            ${data.rows.map(row => `
              <tr>
                ${data.columns.map(col => `<td>${row[col.key] || ''}</td>`).join('')}
              </tr>
            `).join('')}
          </tbody>
        </table>
      </div>
    `);
  }
  
  generateFormInput(data) {
    const baseAttrs = `id="${data.id}" name="${data.name}" ${data.required ? 'required' : ''} ${data.readonly ? 'readonly' : ''}`;
    const placeholder = data.placeholder ? `placeholder="${data.placeholder}"` : '';
    
    switch (data.type) {
      case 'select':
        return `
          <select class="form-select" ${baseAttrs}>
            ${data.options ? data.options.map(opt => 
              `<option value="${opt.value}" ${opt.selected ? 'selected' : ''}>${opt.text}</option>`
            ).join('') : ''}
          </select>
        `;
      
      case 'textarea':
        return `
          <textarea class="form-control" ${baseAttrs} rows="${data.rows || 3}">${data.value || ''}</textarea>
        `;
      
      case 'checkbox':
        return `
          <div class="form-check">
            <input class="form-check-input" type="checkbox" ${baseAttrs} ${data.checked ? 'checked' : ''}>
            <label class="form-check-label" for="${data.id}">
              ${data.checkboxLabel || data.label}
            </label>
          </div>
        `;
      
      case 'radio':
        return `
          <div class="form-check">
            <input class="form-check-input" type="radio" ${baseAttrs} ${data.checked ? 'checked' : ''}>
            <label class="form-check-label" for="${data.id}">
              ${data.radioLabel || data.label}
            </label>
          </div>
        `;
      
      case 'file':
        return `
          <input type="file" class="form-control" ${baseAttrs} ${data.accept ? `accept="${data.accept}"` : ''} ${data.multiple ? 'multiple' : ''}>
        `;
      
      case 'password':
        return `
          <div class="input-group">
            <input type="password" class="form-control" ${baseAttrs} ${placeholder}>
            <button type="button" class="btn btn-outline-secondary password-toggle" tabindex="-1">
              <svg class="icon" width="16" height="16" fill="currentColor">
                <use href="#icon-eye"></use>
              </svg>
            </button>
          </div>
        `;
      
      default:
        return `
          <input type="${data.type || 'text'}" class="form-control" ${baseAttrs} ${placeholder} value="${data.value || ''}">
        `;
    }
  }
  
  // =============================================================================
  // COMPONENT CREATION METHODS
  // =============================================================================
  
  createStatCard(data, container) {
    const template = this.templates.get('statCard');
    const html = template(data);
    
    if (typeof container === 'string') {
      container = document.querySelector(container);
    }
    
    if (container) {
      container.innerHTML = html;
      this.initializeComponent(container.querySelector('[data-component="statCard"]'));
    }
    
    return html;
  }
  
  createActionCard(data, container) {
    const template = this.templates.get('actionCard');
    const html = template(data);
    
    if (typeof container === 'string') {
      container = document.querySelector(container);
    }
    
    if (container) {
      container.innerHTML = html;
      this.initializeComponent(container.querySelector('[data-component="actionCard"]'));
    }
    
    return html;
  }
  
  createFormField(data, container) {
    const template = this.templates.get('formField');
    const html = template(data);
    
    if (typeof container === 'string') {
      container = document.querySelector(container);
    }
    
    if (container) {
      container.innerHTML = html;
      this.initializeComponent(container.querySelector('[data-component="formField"]'));
    }
    
    return html;
  }
  
  createAlert(data, container) {
    const template = this.templates.get('alert');
    const html = template(data);
    
    if (typeof container === 'string') {
      container = document.querySelector(container);
    }
    
    if (container) {
      container.innerHTML = html;
      this.initializeComponent(container.querySelector('[data-component="alert"]'));
    }
    
    return html;
  }
  
  createModal(data) {
    const template = this.templates.get('modal');
    const html = template(data);
    
    // Remove existing modal if it exists
    const existing = document.getElementById(data.id);
    if (existing) {
      existing.remove();
    }
    
    // Add to body
    document.body.insertAdjacentHTML('beforeend', html);
    
    // Initialize
    const modalElement = document.getElementById(data.id);
    this.initializeComponent(modalElement);
    
    return modalElement;
  }
  
  createTable(data, container) {
    const template = this.templates.get('table');
    const html = template(data);
    
    if (typeof container === 'string') {
      container = document.querySelector(container);
    }
    
    if (container) {
      container.innerHTML = html;
      this.initializeComponent(container.querySelector('[data-component="table"]'));
    }
    
    return html;
  }
  
  // =============================================================================
  // COMPONENT INITIALIZATION
  // =============================================================================
  
  initializeComponents() {
    // Initialize all existing components
    document.querySelectorAll('[data-component]').forEach(element => {
      this.initializeComponent(element);
    });
  }
  
  initializeComponent(element) {
    const componentType = element.dataset.component;
    
    switch (componentType) {
      case 'statCard':
        this.initializeStatCard(element);
        break;
      case 'actionCard':
        this.initializeActionCard(element);
        break;
      case 'formField':
        this.initializeFormField(element);
        break;
      case 'alert':
        this.initializeAlert(element);
        break;
      case 'modal':
        this.initializeModal(element);
        break;
      case 'table':
        this.initializeTable(element);
        break;
    }
  }
  
  initializeStatCard(element) {
    // Add hover effects
    element.addEventListener('mouseenter', () => {
      element.style.transform = 'translateY(-5px)';
      element.style.boxShadow = '0 10px 25px rgba(0,0,0,0.1)';
    });
    
    element.addEventListener('mouseleave', () => {
      element.style.transform = 'translateY(0)';
      element.style.boxShadow = 'none';
    });
    
    // Initialize counter animation
    const counter = element.querySelector('[data-count-to]');
    if (counter) {
      this.animateCounter(counter);
    }
    
    // Initialize progress bar animation
    const progressBar = element.querySelector('[data-progress-to]');
    if (progressBar) {
      this.animateProgressBar(progressBar);
    }
  }
  
  initializeActionCard(element) {
    // Add hover effects
    element.addEventListener('mouseenter', () => {
      element.style.transform = 'translateY(-3px)';
      element.style.boxShadow = '0 8px 20px rgba(0,0,0,0.08)';
    });
    
    element.addEventListener('mouseleave', () => {
      element.style.transform = 'translateY(0)';
      element.style.boxShadow = 'none';
    });
    
    // Initialize progress bar animation
    const progressBar = element.querySelector('[data-progress-to]');
    if (progressBar) {
      this.animateProgressBar(progressBar);
    }
  }
  
  initializeFormField(element) {
    // Add password toggle functionality
    const passwordToggle = element.querySelector('.password-toggle');
    if (passwordToggle) {
      passwordToggle.addEventListener('click', () => {
        const input = element.querySelector('input');
        const icon = passwordToggle.querySelector('use');
        
        if (input.type === 'password') {
          input.type = 'text';
          icon.setAttribute('href', '#icon-eye-off');
        } else {
          input.type = 'password';
          icon.setAttribute('href', '#icon-eye');
        }
      });
    }
  }
  
  initializeAlert(element) {
    // Auto-dismiss alerts after 5 seconds
    if (element.classList.contains('alert-dismissible')) {
      setTimeout(() => {
        if (element.parentNode) {
          element.remove();
        }
      }, 5000);
    }
  }
  
  initializeModal(element) {
    // Initialize Bootstrap modal
    if (typeof bootstrap !== 'undefined') {
      new bootstrap.Modal(element);
    }
  }
  
  initializeTable(element) {
    // Add sorting functionality
    const headers = element.querySelectorAll('th');
    headers.forEach((header, index) => {
      header.style.cursor = 'pointer';
      header.addEventListener('click', () => {
        this.sortTable(element, index);
      });
    });
  }
  
  // =============================================================================
  // ANIMATION HELPERS
  // =============================================================================
  
  animateCounter(element) {
    const target = parseFloat(element.dataset.countTo);
    const decimals = parseInt(element.dataset.countDecimals || '0');
    const duration = 2000; // 2 seconds
    const start = performance.now();
    
    const updateCounter = (currentTime) => {
      const elapsed = currentTime - start;
      const progress = Math.min(elapsed / duration, 1);
      
      // Easing function (ease-out)
      const easeOut = 1 - Math.pow(1 - progress, 3);
      const current = target * easeOut;
      
      element.textContent = current.toFixed(decimals);
      
      if (progress < 1) {
        requestAnimationFrame(updateCounter);
      } else {
        element.textContent = target.toFixed(decimals);
      }
    };
    
    requestAnimationFrame(updateCounter);
  }
  
  animateProgressBar(element) {
    const target = parseFloat(element.dataset.progressTo);
    const duration = 1500; // 1.5 seconds
    const start = performance.now();
    
    const updateProgress = (currentTime) => {
      const elapsed = currentTime - start;
      const progress = Math.min(elapsed / duration, 1);
      
      // Easing function (ease-out)
      const easeOut = 1 - Math.pow(1 - progress, 3);
      const current = target * easeOut;
      
      element.style.width = current + '%';
      
      if (progress < 1) {
        requestAnimationFrame(updateProgress);
      } else {
        element.style.width = target + '%';
      }
    };
    
    requestAnimationFrame(updateProgress);
  }
  
  sortTable(tableElement, columnIndex) {
    const tbody = tableElement.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    rows.sort((a, b) => {
      const aText = a.cells[columnIndex].textContent.trim();
      const bText = b.cells[columnIndex].textContent.trim();
      
      // Try to parse as numbers
      const aNum = parseFloat(aText);
      const bNum = parseFloat(bText);
      
      if (!isNaN(aNum) && !isNaN(bNum)) {
        return aNum - bNum;
      }
      
      // Sort as strings
      return aText.localeCompare(bText);
    });
    
    rows.forEach(row => tbody.appendChild(row));
  }
  
  // =============================================================================
  // UTILITY METHODS
  // =============================================================================
  
  showNotification(message, type = 'info', duration = 3000) {
    const alertData = {
      id: `notification-${Date.now()}`,
      type: type,
      message: message,
      dismissible: true,
      icon: this.getNotificationIcon(type)
    };
    
    const container = document.querySelector('.notification-container') || this.createNotificationContainer();
    this.createAlert(alertData, container);
  }
  
  getNotificationIcon(type) {
    const icons = {
      success: '✅',
      error: '❌',
      warning: '⚠️',
      info: 'ℹ️'
    };
    return icons[type] || icons.info;
  }
  
  createNotificationContainer() {
    const container = document.createElement('div');
    container.className = 'notification-container position-fixed top-0 end-0 p-3';
    container.style.zIndex = '9999';
    document.body.appendChild(container);
    return container;
  }
  
  // Public API
  getComponent(id) {
    return this.components.get(id);
  }
  
  destroyComponent(id) {
    const component = this.components.get(id);
    if (component && component.element) {
      component.element.remove();
      this.components.delete(id);
    }
  }
  
  refresh() {
    this.initializeComponents();
  }
}

// Initialize component system when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  window.ComponentSystem = ComponentSystem;
  window.componentSystem = new ComponentSystem();
});

// Export for use in other modules
window.ComponentSystem = ComponentSystem;
