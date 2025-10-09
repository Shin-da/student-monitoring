/**
 * Reusable Component Library
 * Comprehensive set of reusable UI components for consistent design
 */

class ComponentLibrary {
  constructor() {
    this.init();
  }

  init() {
    this.initializeComponents();
    this.bindGlobalEvents();
  }

  initializeComponents() {
    // Initialize all components
    this.initializeModals();
    this.initializeDropdowns();
    this.initializeTooltips();
    this.initializeAlerts();
    this.initializeCards();
    this.initializeTables();
    this.initializeForms();
    this.initializeNavigation();
    this.initializeCharts();
  }

  bindGlobalEvents() {
    // Global event handlers
    document.addEventListener('click', this.handleGlobalClick.bind(this));
    document.addEventListener('keydown', this.handleGlobalKeydown.bind(this));
  }

  // Modal Components
  initializeModals() {
    document.querySelectorAll('[data-component="modal"]').forEach(element => {
      this.createModal(element);
    });
  }

  createModal(element) {
    const modalId = element.dataset.modalId || 'modal-' + Math.random().toString(36).substr(2, 9);
    const title = element.dataset.title || 'Modal Title';
    const size = element.dataset.size || 'md';
    const closable = element.dataset.closable !== 'false';

    const modalHTML = `
      <div class="modal fade" id="${modalId}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-${size}">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">${title}</h5>
              ${closable ? '<button type="button" class="btn-close" data-bs-dismiss="modal"></button>' : ''}
            </div>
            <div class="modal-body">
              ${element.innerHTML}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" data-action="confirm">Confirm</button>
            </div>
          </div>
        </div>
      </div>
    `;

    element.innerHTML = modalHTML;
  }

  // Dropdown Components
  initializeDropdowns() {
    document.querySelectorAll('[data-component="dropdown"]').forEach(element => {
      this.createDropdown(element);
    });
  }

  createDropdown(element) {
    const items = JSON.parse(element.dataset.items || '[]');
    const trigger = element.dataset.trigger || 'click';
    const placement = element.dataset.placement || 'bottom-start';

    const dropdownHTML = `
      <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          ${element.dataset.label || 'Actions'}
        </button>
        <ul class="dropdown-menu dropdown-menu-${placement}">
          ${items.map(item => `
            <li>
              <a class="dropdown-item ${item.class || ''}" href="${item.href || '#'}" data-action="${item.action || ''}">
                ${item.icon ? `<svg class="icon me-2" width="16" height="16" fill="currentColor"><use href="#${item.icon}"></use></svg>` : ''}
                ${item.text}
              </a>
            </li>
          `).join('')}
        </ul>
      </div>
    `;

    element.innerHTML = dropdownHTML;
  }

  // Tooltip Components
  initializeTooltips() {
    document.querySelectorAll('[data-component="tooltip"]').forEach(element => {
      this.createTooltip(element);
    });
  }

  createTooltip(element) {
    const text = element.dataset.tooltipText || 'Tooltip text';
    const placement = element.dataset.tooltipPlacement || 'top';
    const trigger = element.dataset.tooltipTrigger || 'hover';

    element.setAttribute('data-bs-toggle', 'tooltip');
    element.setAttribute('data-bs-placement', placement);
    element.setAttribute('data-bs-trigger', trigger);
    element.setAttribute('title', text);

    // Initialize Bootstrap tooltip
    new bootstrap.Tooltip(element);
  }

  // Alert Components
  initializeAlerts() {
    document.querySelectorAll('[data-component="alert"]').forEach(element => {
      this.createAlert(element);
    });
  }

  createAlert(element) {
    const type = element.dataset.alertType || 'info';
    const message = element.dataset.alertMessage || 'Alert message';
    const dismissible = element.dataset.alertDismissible !== 'false';
    const autoHide = element.dataset.alertAutoHide || 'false';
    const duration = parseInt(element.dataset.alertDuration) || 5000;

    const alertHTML = `
      <div class="alert alert-${type} ${dismissible ? 'alert-dismissible' : ''} fade show" role="alert">
        ${message}
        ${dismissible ? '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' : ''}
      </div>
    `;

    element.innerHTML = alertHTML;

    // Auto-hide functionality
    if (autoHide === 'true') {
      setTimeout(() => {
        const alert = element.querySelector('.alert');
        if (alert) {
          bootstrap.Alert.getOrCreateInstance(alert).close();
        }
      }, duration);
    }
  }

  // Card Components
  initializeCards() {
    document.querySelectorAll('[data-component="card"]').forEach(element => {
      this.createCard(element);
    });
  }

  createCard(element) {
    const title = element.dataset.cardTitle || 'Card Title';
    const subtitle = element.dataset.cardSubtitle || '';
    const content = element.dataset.cardContent || element.innerHTML;
    const actions = JSON.parse(element.dataset.cardActions || '[]');
    const variant = element.dataset.cardVariant || 'default';

    const cardHTML = `
      <div class="card card-${variant}">
        <div class="card-header">
          <h5 class="card-title mb-0">${title}</h5>
          ${subtitle ? `<p class="card-subtitle text-muted mb-0">${subtitle}</p>` : ''}
        </div>
        <div class="card-body">
          ${content}
        </div>
        ${actions.length > 0 ? `
          <div class="card-footer">
            ${actions.map(action => `
              <button type="button" class="btn btn-${action.variant || 'primary'} btn-sm" data-action="${action.action}">
                ${action.icon ? `<svg class="icon me-1" width="14" height="14" fill="currentColor"><use href="#${action.icon}"></use></svg>` : ''}
                ${action.text}
              </button>
            `).join('')}
          </div>
        ` : ''}
      </div>
    `;

    element.innerHTML = cardHTML;
  }

  // Table Components
  initializeTables() {
    document.querySelectorAll('[data-component="table"]').forEach(element => {
      this.createTable(element);
    });
  }

  createTable(element) {
    const columns = JSON.parse(element.dataset.tableColumns || '[]');
    const data = JSON.parse(element.dataset.tableData || '[]');
    const sortable = element.dataset.tableSortable !== 'false';
    const searchable = element.dataset.tableSearchable !== 'false';
    const paginated = element.dataset.tablePaginated !== 'false';
    const pageSize = parseInt(element.dataset.tablePageSize) || 10;

    let tableHTML = `
      <div class="table-container">
        ${searchable ? `
          <div class="table-search mb-3">
            <div class="input-group">
              <span class="input-group-text">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-search"></use>
                </svg>
              </span>
              <input type="text" class="form-control" placeholder="Search table..." data-table-search>
            </div>
          </div>
        ` : ''}
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                ${columns.map(col => `
                  <th ${sortable ? 'data-sortable="true"' : ''}>
                    ${col.title}
                    ${sortable ? '<svg class="icon ms-1" width="12" height="12" fill="currentColor"><use href="#icon-sort"></use></svg>' : ''}
                  </th>
                `).join('')}
              </tr>
            </thead>
            <tbody>
              ${data.map(row => `
                <tr>
                  ${columns.map(col => `<td>${row[col.key] || ''}</td>`).join('')}
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
        ${paginated ? `
          <nav aria-label="Table pagination" class="mt-3">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
              </li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
        ` : ''}
      </div>
    `;

    element.innerHTML = tableHTML;
  }

  // Form Components
  initializeForms() {
    document.querySelectorAll('[data-component="form"]').forEach(element => {
      this.createForm(element);
    });
  }

  createForm(element) {
    const fields = JSON.parse(element.dataset.formFields || '[]');
    const submitText = element.dataset.formSubmitText || 'Submit';
    const resetText = element.dataset.formResetText || 'Reset';

    const formHTML = `
      <form class="enhanced-form">
        ${fields.map(field => `
          <div class="form-group mb-3">
            <label for="${field.id}" class="form-label">${field.label}</label>
            ${this.createFormField(field)}
            ${field.help ? `<div class="form-help">${field.help}</div>` : ''}
          </div>
        `).join('')}
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" data-action="reset">${resetText}</button>
          <button type="submit" class="btn btn-primary" data-action="submit">${submitText}</button>
        </div>
      </form>
    `;

    element.innerHTML = formHTML;
  }

  createFormField(field) {
    switch (field.type) {
      case 'text':
      case 'email':
      case 'password':
      case 'number':
        return `<input type="${field.type}" class="form-control" id="${field.id}" name="${field.name}" placeholder="${field.placeholder || ''}" ${field.required ? 'required' : ''}>`;
      
      case 'textarea':
        return `<textarea class="form-control" id="${field.id}" name="${field.name}" rows="${field.rows || 3}" placeholder="${field.placeholder || ''}" ${field.required ? 'required' : ''}></textarea>`;
      
      case 'select':
        return `
          <select class="form-select" id="${field.id}" name="${field.name}" ${field.required ? 'required' : ''}>
            <option value="">Select ${field.label}</option>
            ${field.options ? field.options.map(option => `<option value="${option.value}">${option.text}</option>`).join('') : ''}
          </select>
        `;
      
      case 'checkbox':
        return `
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="${field.id}" name="${field.name}" ${field.required ? 'required' : ''}>
            <label class="form-check-label" for="${field.id}">${field.label}</label>
          </div>
        `;
      
      case 'radio':
        return `
          <div class="form-check-group">
            ${field.options ? field.options.map(option => `
              <div class="form-check">
                <input class="form-check-input" type="radio" name="${field.name}" id="${field.id}-${option.value}" value="${option.value}" ${field.required ? 'required' : ''}>
                <label class="form-check-label" for="${field.id}-${option.value}">${option.text}</label>
              </div>
            `).join('') : ''}
          </div>
        `;
      
      default:
        return `<input type="text" class="form-control" id="${field.id}" name="${field.name}">`;
    }
  }

  // Navigation Components
  initializeNavigation() {
    document.querySelectorAll('[data-component="nav"]').forEach(element => {
      this.createNavigation(element);
    });
  }

  createNavigation(element) {
    const items = JSON.parse(element.dataset.navItems || '[]');
    const variant = element.dataset.navVariant || 'tabs';
    const active = element.dataset.navActive || '0';

    const navHTML = `
      <ul class="nav nav-${variant}" role="tablist">
        ${items.map((item, index) => `
          <li class="nav-item" role="presentation">
            <button class="nav-link ${index == active ? 'active' : ''}" id="${item.id}-tab" data-bs-toggle="tab" data-bs-target="#${item.id}" type="button" role="tab">
              ${item.icon ? `<svg class="icon me-2" width="16" height="16" fill="currentColor"><use href="#${item.icon}"></use></svg>` : ''}
              ${item.text}
            </button>
          </li>
        `).join('')}
      </ul>
      <div class="tab-content">
        ${items.map((item, index) => `
          <div class="tab-pane fade ${index == active ? 'show active' : ''}" id="${item.id}" role="tabpanel">
            ${item.content || ''}
          </div>
        `).join('')}
      </div>
    `;

    element.innerHTML = navHTML;
  }

  // Chart Components
  initializeCharts() {
    document.querySelectorAll('[data-component="chart"]').forEach(element => {
      this.createChart(element);
    });
  }

  createChart(element) {
    const type = element.dataset.chartType || 'line';
    const data = JSON.parse(element.dataset.chartData || '{}');
    const options = JSON.parse(element.dataset.chartOptions || '{}');
    const height = element.dataset.chartHeight || '300';

    const chartHTML = `
      <div class="chart-container" style="height: ${height}px;">
        <canvas id="chart-${Math.random().toString(36).substr(2, 9)}"></canvas>
      </div>
    `;

    element.innerHTML = chartHTML;

    // Initialize Chart.js
    const canvas = element.querySelector('canvas');
    if (canvas && typeof Chart !== 'undefined') {
      new Chart(canvas, {
        type: type,
        data: data,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          ...options
        }
      });
    }
  }

  // Global Event Handlers
  handleGlobalClick(event) {
    const target = event.target;
    
    // Handle component actions
    if (target.dataset.action) {
      this.handleComponentAction(target.dataset.action, target);
    }
  }

  handleGlobalKeydown(event) {
    // Handle keyboard shortcuts
    if (event.ctrlKey || event.metaKey) {
      switch (event.key) {
        case 'k':
          event.preventDefault();
          this.focusSearch();
          break;
        case 's':
          event.preventDefault();
          this.saveForm();
          break;
      }
    }
  }

  handleComponentAction(action, element) {
    switch (action) {
      case 'confirm':
        this.handleConfirm(element);
        break;
      case 'reset':
        this.handleReset(element);
        break;
      case 'submit':
        this.handleSubmit(element);
        break;
      case 'search':
        this.handleSearch(element);
        break;
      case 'sort':
        this.handleSort(element);
        break;
      default:
        console.log(`Unknown action: ${action}`);
    }
  }

  handleConfirm(element) {
    const modal = element.closest('.modal');
    if (modal) {
      const modalInstance = bootstrap.Modal.getInstance(modal);
      if (modalInstance) {
        modalInstance.hide();
      }
    }
  }

  handleReset(element) {
    const form = element.closest('form');
    if (form) {
      form.reset();
      form.querySelectorAll('.is-invalid').forEach(field => {
        field.classList.remove('is-invalid');
      });
    }
  }

  handleSubmit(element) {
    const form = element.closest('form');
    if (form) {
      form.dispatchEvent(new Event('submit'));
    }
  }

  handleSearch(element) {
    const searchTerm = element.value;
    const table = element.closest('.table-container');
    if (table) {
      this.filterTable(table, searchTerm);
    }
  }

  handleSort(element) {
    const column = element.closest('th');
    const table = element.closest('table');
    if (table) {
      this.sortTable(table, column);
    }
  }

  filterTable(container, searchTerm) {
    const rows = container.querySelectorAll('tbody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      if (text.includes(searchTerm.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  sortTable(table, column) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const columnIndex = Array.from(column.parentNode.children).indexOf(column);
    
    rows.sort((a, b) => {
      const aText = a.children[columnIndex].textContent.trim();
      const bText = b.children[columnIndex].textContent.trim();
      return aText.localeCompare(bText);
    });
    
    rows.forEach(row => tbody.appendChild(row));
  }

  focusSearch() {
    const searchInput = document.querySelector('[data-table-search]');
    if (searchInput) {
      searchInput.focus();
    }
  }

  saveForm() {
    const form = document.querySelector('form');
    if (form) {
      form.dispatchEvent(new Event('submit'));
    }
  }
}

// Utility Functions
class ComponentUtils {
  static createNotification(message, type = 'info', duration = 5000) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
    notification.style.zIndex = '9999';
    notification.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    if (duration > 0) {
      setTimeout(() => {
        if (notification.parentNode) {
          notification.remove();
        }
      }, duration);
    }
    
    return notification;
  }

  static createLoadingSpinner(size = 'sm') {
    return `
      <div class="spinner-border spinner-border-${size}" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    `;
  }

  static createProgressBar(percentage, variant = 'primary') {
    return `
      <div class="progress">
        <div class="progress-bar bg-${variant}" role="progressbar" style="width: ${percentage}%">
          ${percentage}%
        </div>
      </div>
    `;
  }

  static createBadge(text, variant = 'primary') {
    return `<span class="badge bg-${variant}">${text}</span>`;
  }

  static createButton(text, variant = 'primary', size = 'md', icon = null) {
    return `
      <button type="button" class="btn btn-${variant} btn-${size}">
        ${icon ? `<svg class="icon me-1" width="14" height="14" fill="currentColor"><use href="#${icon}"></use></svg>` : ''}
        ${text}
      </button>
    `;
  }
}

// Initialize Component Library
document.addEventListener('DOMContentLoaded', () => {
  window.ComponentLibrary = new ComponentLibrary();
  window.ComponentUtils = ComponentUtils;
});

// Export for global access
window.ComponentLibrary = ComponentLibrary;
window.ComponentUtils = ComponentUtils;
