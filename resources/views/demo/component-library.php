<?php
$title = 'Component Library Demo';
?>

<!-- Component Library Demo Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Component Library Demo</h1>
      <p class="text-muted mb-0">Comprehensive showcase of reusable UI components</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" onclick="showNotification('Component library loaded!', 'success')">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-check"></use>
        </svg>
        Test Notification
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#componentModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Add Component
      </button>
    </div>
  </div>
</div>

<!-- Component Showcase -->
<div class="row g-4">
  <!-- Modal Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Modal Components</h5>
      <div class="d-flex gap-2 mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Standard Modal
        </button>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModal">
          Large Modal
        </button>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#smallModal">
          Small Modal
        </button>
      </div>
      
      <!-- Component Library Modal -->
      <div data-component="modal" data-title="Component Library Modal" data-size="lg" data-closable="true">
        <p>This is a modal created using the component library system.</p>
        <div class="form-group mb-3">
          <label class="form-label">Component Name</label>
          <input type="text" class="form-control" placeholder="Enter component name">
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Component Type</label>
          <select class="form-select">
            <option value="">Select type</option>
            <option value="modal">Modal</option>
            <option value="card">Card</option>
            <option value="form">Form</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Card Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Card Components</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <div data-component="card" 
               data-card-title="Primary Card" 
               data-card-subtitle="Component library card"
               data-card-variant="primary"
               data-card-actions='[{"text": "Action", "variant": "primary", "action": "card-action"}]'>
            <p>This is a primary card component with actions.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div data-component="card" 
               data-card-title="Success Card" 
               data-card-subtitle="Another example"
               data-card-variant="success">
            <p>This is a success card component without actions.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Form Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Form Components</h5>
      <div data-component="form" 
           data-form-fields='[
             {"type": "text", "id": "name", "name": "name", "label": "Full Name", "placeholder": "Enter your name", "required": true},
             {"type": "email", "id": "email", "name": "email", "label": "Email", "placeholder": "Enter your email", "required": true},
             {"type": "select", "id": "role", "name": "role", "label": "Role", "required": true, "options": [{"value": "admin", "text": "Administrator"}, {"value": "teacher", "text": "Teacher"}, {"value": "student", "text": "Student"}]},
             {"type": "textarea", "id": "message", "name": "message", "label": "Message", "placeholder": "Enter your message", "rows": 3},
             {"type": "checkbox", "id": "agree", "name": "agree", "label": "I agree to the terms", "required": true}
           ]'
           data-form-submit-text="Submit Form"
           data-form-reset-text="Reset">
      </div>
    </div>
  </div>
  
  <!-- Table Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Table Components</h5>
      <div data-component="table" 
           data-table-columns='[
             {"key": "name", "title": "Name"},
             {"key": "email", "title": "Email"},
             {"key": "role", "title": "Role"},
             {"key": "status", "title": "Status"}
           ]'
           data-table-data='[
             {"name": "John Doe", "email": "john@example.com", "role": "Admin", "status": "Active"},
             {"name": "Jane Smith", "email": "jane@example.com", "role": "Teacher", "status": "Active"},
             {"name": "Bob Johnson", "email": "bob@example.com", "role": "Student", "status": "Inactive"}
           ]'
           data-table-sortable="true"
           data-table-searchable="true"
           data-table-paginated="true"
           data-table-page-size="5">
      </div>
    </div>
  </div>
  
  <!-- Navigation Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Navigation Components</h5>
      <div data-component="nav" 
           data-nav-variant="tabs"
           data-nav-items='[
             {"id": "tab1", "text": "Overview", "icon": "icon-dashboard", "content": "<p>This is the overview tab content.</p>"},
             {"id": "tab2", "text": "Settings", "icon": "icon-settings", "content": "<p>This is the settings tab content.</p>"},
             {"id": "tab3", "text": "Reports", "icon": "icon-chart", "content": "<p>This is the reports tab content.</p>"}
           ]'
           data-nav-active="0">
      </div>
    </div>
  </div>
  
  <!-- Chart Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Chart Components</h5>
      <div data-component="chart" 
           data-chart-type="doughnut"
           data-chart-height="300"
           data-chart-data='{
             "labels": ["Admin", "Teacher", "Student", "Parent"],
             "datasets": [{
               "data": [5, 25, 150, 120],
               "backgroundColor": ["#0d6efd", "#198754", "#fd7e14", "#dc3545"]
             }]
           }'
           data-chart-options='{
             "plugins": {
               "legend": {
                 "position": "bottom"
               }
             }
           }'>
      </div>
    </div>
  </div>
  
  <!-- Alert Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Alert Components</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <div data-component="alert" 
               data-alert-type="success"
               data-alert-message="Success! Operation completed successfully."
               data-alert-dismissible="true">
          </div>
        </div>
        <div class="col-md-6">
          <div data-component="alert" 
               data-alert-type="warning"
               data-alert-message="Warning! Please check your input."
               data-alert-dismissible="true">
          </div>
        </div>
        <div class="col-md-6">
          <div data-component="alert" 
               data-alert-type="danger"
               data-alert-message="Error! Something went wrong."
               data-alert-dismissible="true">
          </div>
        </div>
        <div class="col-md-6">
          <div data-component="alert" 
               data-alert-type="info"
               data-alert-message="Info! Here's some useful information."
               data-alert-dismissible="true">
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Dropdown Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Dropdown Components</h5>
      <div class="d-flex gap-3">
        <div data-component="dropdown" 
             data-dropdown-label="Actions"
             data-dropdown-items='[
               {"text": "Edit", "icon": "icon-edit", "action": "edit"},
               {"text": "Delete", "icon": "icon-trash", "action": "delete", "class": "text-danger"},
               {"text": "View", "icon": "icon-eye", "action": "view"}
             ]'>
        </div>
        <div data-component="dropdown" 
             data-dropdown-label="More Options"
             data-dropdown-items='[
               {"text": "Export", "icon": "icon-download", "action": "export"},
               {"text": "Import", "icon": "icon-upload", "action": "import"},
               {"text": "Settings", "icon": "icon-settings", "action": "settings"}
             ]'>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Tooltip Components -->
  <div class="col-lg-6">
    <div class="surface">
      <h5 class="mb-4">Tooltip Components</h5>
      <div class="d-flex gap-3">
        <button class="btn btn-outline-primary" 
                data-component="tooltip" 
                data-tooltip-text="This is a tooltip on the left"
                data-tooltip-placement="left">
          Left Tooltip
        </button>
        <button class="btn btn-outline-success" 
                data-component="tooltip" 
                data-tooltip-text="This is a tooltip on the top"
                data-tooltip-placement="top">
          Top Tooltip
        </button>
        <button class="btn btn-outline-warning" 
                data-component="tooltip" 
                data-tooltip-text="This is a tooltip on the bottom"
                data-tooltip-placement="bottom">
          Bottom Tooltip
        </button>
        <button class="btn btn-outline-danger" 
                data-component="tooltip" 
                data-tooltip-text="This is a tooltip on the right"
                data-tooltip-placement="right">
          Right Tooltip
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Utility Components Demo -->
<div class="row g-4 mt-4">
  <div class="col-12">
    <div class="surface">
      <h5 class="mb-4">Utility Components</h5>
      <div class="row g-4">
        <div class="col-md-3">
          <h6>Loading Spinners</h6>
          <div class="d-flex gap-2">
            <div id="spinner-sm"></div>
            <div id="spinner-md"></div>
            <div id="spinner-lg"></div>
          </div>
        </div>
        <div class="col-md-3">
          <h6>Progress Bars</h6>
          <div id="progress-bars"></div>
        </div>
        <div class="col-md-3">
          <h6>Badges</h6>
          <div id="badges"></div>
        </div>
        <div class="col-md-3">
          <h6>Buttons</h6>
          <div id="buttons"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Example Modals -->
<div class="modal fade" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Example Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>This is an example modal created manually.</p>
        <div class="form-group mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" placeholder="Enter your name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="largeModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Large Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>This is a large modal example.</p>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="smallModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Small Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>This is a small modal example.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="componentModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Component</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="componentForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Component Name</label>
              <input type="text" class="form-control" id="componentName" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Component Type</label>
              <select class="form-select" id="componentType" required>
                <option value="">Select type</option>
                <option value="modal">Modal</option>
                <option value="card">Card</option>
                <option value="form">Form</option>
                <option value="table">Table</option>
                <option value="chart">Chart</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="3" id="componentDescription"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="addComponent()">Add Component</button>
      </div>
    </div>
  </div>
</div>

<script>
// Component Library Demo
document.addEventListener('DOMContentLoaded', function() {
  // Initialize utility components
  initializeUtilityComponents();
  
  // Bind demo events
  bindDemoEvents();
});

function initializeUtilityComponents() {
  // Loading Spinners
  document.getElementById('spinner-sm').innerHTML = ComponentUtils.createLoadingSpinner('sm');
  document.getElementById('spinner-md').innerHTML = ComponentUtils.createLoadingSpinner();
  document.getElementById('spinner-lg').innerHTML = ComponentUtils.createLoadingSpinner('lg');
  
  // Progress Bars
  const progressContainer = document.getElementById('progress-bars');
  progressContainer.innerHTML = `
    ${ComponentUtils.createProgressBar(25, 'primary')}
    <div class="mt-2">${ComponentUtils.createProgressBar(50, 'success')}</div>
    <div class="mt-2">${ComponentUtils.createProgressBar(75, 'warning')}</div>
    <div class="mt-2">${ComponentUtils.createProgressBar(100, 'danger')}</div>
  `;
  
  // Badges
  const badgesContainer = document.getElementById('badges');
  badgesContainer.innerHTML = `
    ${ComponentUtils.createBadge('Primary', 'primary')}
    ${ComponentUtils.createBadge('Success', 'success')}
    ${ComponentUtils.createBadge('Warning', 'warning')}
    ${ComponentUtils.createBadge('Danger', 'danger')}
    ${ComponentUtils.createBadge('Info', 'info')}
  `;
  
  // Buttons
  const buttonsContainer = document.getElementById('buttons');
  buttonsContainer.innerHTML = `
    ${ComponentUtils.createButton('Primary', 'primary', 'sm', 'icon-check')}
    ${ComponentUtils.createButton('Success', 'success', 'sm', 'icon-check')}
    ${ComponentUtils.createButton('Warning', 'warning', 'sm', 'icon-alerts')}
    ${ComponentUtils.createButton('Danger', 'danger', 'sm', 'icon-close')}
  `;
}

function bindDemoEvents() {
  // Handle component actions
  document.addEventListener('click', function(e) {
    if (e.target.dataset.action) {
      handleComponentAction(e.target.dataset.action, e.target);
    }
  });
}

function handleComponentAction(action, element) {
  switch (action) {
    case 'card-action':
      showNotification('Card action triggered!', 'info');
      break;
    case 'edit':
      showNotification('Edit action triggered!', 'info');
      break;
    case 'delete':
      showNotification('Delete action triggered!', 'warning');
      break;
    case 'view':
      showNotification('View action triggered!', 'info');
      break;
    case 'export':
      showNotification('Export action triggered!', 'success');
      break;
    case 'import':
      showNotification('Import action triggered!', 'info');
      break;
    case 'settings':
      showNotification('Settings action triggered!', 'info');
      break;
    default:
      showNotification(`Action "${action}" triggered!`, 'info');
  }
}

function addComponent() {
  const name = document.getElementById('componentName').value;
  const type = document.getElementById('componentType').value;
  const description = document.getElementById('componentDescription').value;
  
  if (!name || !type) {
    showNotification('Please fill in all required fields', 'warning');
    return;
  }
  
  showNotification(`Component "${name}" of type "${type}" added successfully!`, 'success');
  
  // Close modal
  const modal = bootstrap.Modal.getInstance(document.getElementById('componentModal'));
  modal.hide();
  
  // Reset form
  document.getElementById('componentForm').reset();
}

function showNotification(message, type = 'info') {
  ComponentUtils.createNotification(message, type, 3000);
}
</script>

<style>
/* Component Library Demo Specific Styles */
.surface {
  background-color: var(--bs-body-bg);
  border-radius: 0.75rem;
  padding: 1.5rem;
  border: 1px solid var(--bs-border-color);
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.surface h5 {
  color: var(--bs-primary);
  font-weight: 600;
  margin-bottom: 1rem;
}

.surface h6 {
  color: var(--bs-body-color);
  font-weight: 500;
  margin-bottom: 0.75rem;
}

#spinner-sm,
#spinner-md,
#spinner-lg {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

#progress-bars > div {
  margin-bottom: 0.5rem;
}

#badges {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

#buttons {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}
</style>
