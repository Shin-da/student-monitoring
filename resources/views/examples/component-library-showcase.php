<?php
$title = 'Component Library Showcase';
?>

<!-- Showcase Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Component Library Showcase</h1>
      <p class="text-muted mb-0">Complete collection of reusable UI components</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-secondary" onclick="toggleTheme()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-moon"></use>
        </svg>
        Toggle Theme
      </button>
      <button class="btn btn-outline-primary" onclick="exportComponents()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-download"></use>
        </svg>
        Export Code
      </button>
    </div>
  </div>
</div>

<?php
use App\Helpers\ComponentHelper;
?>

<!-- Component Navigation -->
<div class="row mb-4">
  <div class="col-12">
    <div class="surface p-3">
      <nav class="nav nav-pills nav-fill" id="componentNav" role="tablist">
        <button class="nav-link active" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview" type="button" role="tab">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-dashboard"></use>
          </svg>
          Overview
        </button>
        <button class="nav-link" id="cards-tab" data-bs-toggle="pill" data-bs-target="#cards" type="button" role="tab">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-chart"></use>
          </svg>
          Cards
        </button>
        <button class="nav-link" id="forms-tab" data-bs-toggle="pill" data-bs-target="#forms" type="button" role="tab">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-edit"></use>
          </svg>
          Forms
        </button>
        <button class="nav-link" id="feedback-tab" data-bs-toggle="pill" data-bs-target="#feedback" type="button" role="tab">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
          Feedback
        </button>
        <button class="nav-link" id="navigation-tab" data-bs-toggle="pill" data-bs-target="#navigation" type="button" role="tab">
          <svg class="icon me-2" width="16" height="16" fill="currentColor">
            <use href="#icon-arrow-left"></use>
          </svg>
          Navigation
        </button>
      </nav>
    </div>
  </div>
</div>

<!-- Component Showcase Content -->
<div class="tab-content" id="componentContent">
  
  <!-- Overview Tab -->
  <div class="tab-pane fade show active" id="overview" role="tabpanel">
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="surface p-4">
          <h4 class="mb-3">Welcome to the Component Library</h4>
          <p class="text-muted mb-4">
            This showcase demonstrates all available components in our unified design system. 
            Each component is designed to be consistent, accessible, and performant.
          </p>
          
          <div class="row g-3">
            <div class="col-md-6">
              <div class="d-flex align-items-center gap-3 p-3 border rounded">
                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-primary" width="24" height="24" fill="currentColor">
                    <use href="#icon-check"></use>
                  </svg>
                </div>
                <div>
                  <h6 class="mb-1">Consistent Design</h6>
                  <small class="text-muted">Unified visual language across all components</small>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="d-flex align-items-center gap-3 p-3 border rounded">
                <div class="bg-success bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-success" width="24" height="24" fill="currentColor">
                    <use href="#icon-star"></use>
                  </svg>
                </div>
                <div>
                  <h6 class="mb-1">Accessible</h6>
                  <small class="text-muted">WCAG 2.1 AA compliant with keyboard navigation</small>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="d-flex align-items-center gap-3 p-3 border rounded">
                <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-warning" width="24" height="24" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                </div>
                <div>
                  <h6 class="mb-1">Performance Optimized</h6>
                  <small class="text-muted">Lazy loading and efficient rendering</small>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="d-flex align-items-center gap-3 p-3 border rounded">
                <div class="bg-info bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-info" width="24" height="24" fill="currentColor">
                    <use href="#icon-settings"></use>
                  </svg>
                </div>
                <div>
                  <h6 class="mb-1">Customizable</h6>
                  <small class="text-muted">Easy theming and component variants</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4">
        <div class="surface p-4">
          <h5 class="mb-3">Quick Stats</h5>
          <div class="d-flex justify-content-between mb-2">
            <span>Total Components</span>
            <span class="fw-bold">24</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span>Color Themes</span>
            <span class="fw-bold">5</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span>Form Fields</span>
            <span class="fw-bold">12</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span>Card Types</span>
            <span class="fw-bold">6</span>
          </div>
          <div class="d-flex justify-content-between">
            <span>Accessibility Score</span>
            <span class="fw-bold text-success">100%</span>
          </div>
        </div>
        
        <div class="surface p-4 mt-4">
          <h5 class="mb-3">Color Palette</h5>
          <div class="d-flex gap-2 mb-2">
            <div class="color-swatch bg-primary" style="width: 20px; height: 20px; border-radius: 4px;" title="Primary"></div>
            <div class="color-swatch bg-success" style="width: 20px; height: 20px; border-radius: 4px;" title="Success"></div>
            <div class="color-swatch bg-warning" style="width: 20px; height: 20px; border-radius: 4px;" title="Warning"></div>
            <div class="color-swatch bg-danger" style="width: 20px; height: 20px; border-radius: 4px;" title="Danger"></div>
            <div class="color-swatch bg-info" style="width: 20px; height: 20px; border-radius: 4px;" title="Info"></div>
          </div>
          <small class="text-muted">Hover over colors to see names</small>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Cards Tab -->
  <div class="tab-pane fade" id="cards" role="tabpanel">
    <div class="row g-4">
      <div class="col-12">
        <h4 class="mb-3">Card Components</h4>
        <p class="text-muted mb-4">Various card types for displaying information and actions</p>
      </div>
      
      <!-- Statistics Cards -->
      <div class="col-12">
        <h5 class="mb-3">Statistics Cards</h5>
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <?= ComponentHelper::statCard([
                'icon' => 'icon-students',
                'value' => 1250,
                'label' => 'Total Students',
                'color' => 'primary',
                'badge' => 'Current',
                'progress' => 85
            ]) ?>
          </div>
          
          <div class="col-md-6 col-lg-3">
            <?= ComponentHelper::statCard([
                'icon' => 'icon-check',
                'value' => 1180,
                'label' => 'Present Today',
                'color' => 'success',
                'badge' => '94.4%',
                'progress' => 94.4,
                'decimals' => 1
            ]) ?>
          </div>
          
          <div class="col-md-6 col-lg-3">
            <?= ComponentHelper::statCard([
                'icon' => 'icon-alerts',
                'value' => 23,
                'label' => 'Pending Grades',
                'color' => 'warning',
                'badge' => 'Urgent',
                'progress' => 60
            ]) ?>
          </div>
          
          <div class="col-md-6 col-lg-3">
            <?= ComponentHelper::statCard([
                'icon' => 'icon-chart',
                'value' => 87.5,
                'label' => 'Average Grade',
                'color' => 'info',
                'progress' => 87.5,
                'decimals' => 1
            ]) ?>
          </div>
        </div>
      </div>
      
      <!-- Action Cards -->
      <div class="col-12">
        <h5 class="mb-3 mt-5">Action Cards</h5>
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <?= ComponentHelper::actionCard([
                'title' => 'Mathematics',
                'subtitle' => 'Overall: 87.5',
                'icon' => 'icon-chart',
                'color' => 'success',
                'badge' => 'Passed',
                'progress' => 87.5,
                'meta' => 'WW: 85 | PT: 88 | QE: 90',
                'onclick' => 'alert("Mathematics clicked!")'
            ]) ?>
          </div>
          
          <div class="col-md-6 col-lg-4">
            <?= ComponentHelper::actionCard([
                'title' => 'Science',
                'subtitle' => 'Overall: 82.3',
                'icon' => 'icon-chart',
                'color' => 'warning',
                'badge' => 'Needs Improvement',
                'progress' => 82.3,
                'meta' => 'WW: 80 | PT: 85 | QE: 82',
                'onclick' => 'alert("Science clicked!")'
            ]) ?>
          </div>
          
          <div class="col-md-6 col-lg-4">
            <?= ComponentHelper::actionCard([
                'title' => 'English',
                'subtitle' => 'Overall: 91.2',
                'icon' => 'icon-chart',
                'color' => 'success',
                'badge' => 'Excellent',
                'progress' => 91.2,
                'meta' => 'WW: 92 | PT: 90 | QE: 92',
                'onclick' => 'alert("English clicked!")'
            ]) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Forms Tab -->
  <div class="tab-pane fade" id="forms" role="tabpanel">
    <div class="row g-4">
      <div class="col-12">
        <h4 class="mb-3">Form Components</h4>
        <p class="text-muted mb-4">Comprehensive form field components with validation</p>
      </div>
      
      <div class="col-lg-6">
        <div class="surface p-4">
          <h5 class="mb-4">Basic Form Fields</h5>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-text',
              'name' => 'text',
              'label' => 'Text Input',
              'type' => 'text',
              'placeholder' => 'Enter some text',
              'required' => true,
              'help' => 'This is a basic text input field'
          ]) ?>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-email',
              'name' => 'email',
              'label' => 'Email Input',
              'type' => 'email',
              'placeholder' => 'user@example.com',
              'required' => true
          ]) ?>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-password',
              'name' => 'password',
              'label' => 'Password Input',
              'type' => 'password',
              'placeholder' => 'Enter password',
              'required' => true,
              'help' => 'Password must be at least 8 characters'
          ]) ?>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-select',
              'name' => 'select',
              'label' => 'Select Dropdown',
              'type' => 'select',
              'required' => true,
              'options' => [
                  ['value' => '', 'text' => 'Choose an option'],
                  ['value' => 'option1', 'text' => 'Option 1'],
                  ['value' => 'option2', 'text' => 'Option 2'],
                  ['value' => 'option3', 'text' => 'Option 3']
              ]
          ]) ?>
        </div>
      </div>
      
      <div class="col-lg-6">
        <div class="surface p-4">
          <h5 class="mb-4">Advanced Form Fields</h5>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-date',
              'name' => 'date',
              'label' => 'Date Picker',
              'type' => 'date',
              'required' => true
          ]) ?>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-file',
              'name' => 'file',
              'label' => 'File Upload',
              'type' => 'file',
              'accept' => '.jpg,.jpeg,.png,.pdf',
              'help' => 'Upload images or PDF files'
          ]) ?>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-textarea',
              'name' => 'textarea',
              'label' => 'Textarea',
              'type' => 'textarea',
              'placeholder' => 'Enter multiple lines of text...',
              'rows' => 4
          ]) ?>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-checkbox',
              'name' => 'checkbox',
              'label' => 'Checkbox',
              'type' => 'checkbox',
              'checkboxLabel' => 'I agree to the terms and conditions',
              'required' => true
          ]) ?>
          
          <?= ComponentHelper::formField([
              'id' => 'demo-radio',
              'name' => 'radio',
              'label' => 'Radio Button',
              'type' => 'radio',
              'radioLabel' => 'Option A',
              'required' => true
          ]) ?>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Feedback Tab -->
  <div class="tab-pane fade" id="feedback" role="tabpanel">
    <div class="row g-4">
      <div class="col-12">
        <h4 class="mb-3">Feedback Components</h4>
        <p class="text-muted mb-4">Alerts, notifications, and user feedback elements</p>
      </div>
      
      <div class="col-lg-6">
        <h5 class="mb-3">Alert Types</h5>
        
        <?= ComponentHelper::alert([
            'type' => 'success',
            'message' => 'Operation completed successfully!',
            'dismissible' => true
        ]) ?>
        
        <?= ComponentHelper::alert([
            'type' => 'info',
            'message' => 'Here is some helpful information for you.',
            'dismissible' => true
        ]) ?>
        
        <?= ComponentHelper::alert([
            'type' => 'warning',
            'message' => 'Please review your input before proceeding.',
            'dismissible' => true
        ]) ?>
        
        <?= ComponentHelper::alert([
            'type' => 'danger',
            'message' => 'An error occurred. Please try again.',
            'dismissible' => true
        ]) ?>
      </div>
      
      <div class="col-lg-6">
        <h5 class="mb-3">Interactive Examples</h5>
        
        <div class="d-grid gap-2">
          <button class="btn btn-success" onclick="showNotification('success')">
            Show Success Notification
          </button>
          <button class="btn btn-info" onclick="showNotification('info')">
            Show Info Notification
          </button>
          <button class="btn btn-warning" onclick="showNotification('warning')">
            Show Warning Notification
          </button>
          <button class="btn btn-danger" onclick="showNotification('danger')">
            Show Error Notification
          </button>
        </div>
        
        <div class="mt-4">
          <h6>Progress Indicators</h6>
          <div class="progress mb-2">
            <div class="progress-bar" style="width: 25%"></div>
          </div>
          <div class="progress mb-2">
            <div class="progress-bar bg-success" style="width: 50%"></div>
          </div>
          <div class="progress mb-2">
            <div class="progress-bar bg-warning" style="width: 75%"></div>
          </div>
          <div class="progress">
            <div class="progress-bar bg-danger" style="width: 100%"></div>
          </div>
        </div>
        
        <div class="mt-4">
          <h6>Loading States</h6>
          <div class="d-flex gap-3 align-items-center">
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-border spinner-border-sm text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-border spinner-border-sm text-success" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <span class="text-muted">Loading spinners</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Navigation Tab -->
  <div class="tab-pane fade" id="navigation" role="tabpanel">
    <div class="row g-4">
      <div class="col-12">
        <h4 class="mb-3">Navigation Components</h4>
        <p class="text-muted mb-4">Navigation elements and interactive components</p>
      </div>
      
      <div class="col-lg-6">
        <h5 class="mb-3">Button Variants</h5>
        <div class="d-flex flex-wrap gap-2 mb-4">
          <button class="btn btn-primary">Primary</button>
          <button class="btn btn-secondary">Secondary</button>
          <button class="btn btn-success">Success</button>
          <button class="btn btn-danger">Danger</button>
          <button class="btn btn-warning">Warning</button>
          <button class="btn btn-info">Info</button>
        </div>
        
        <div class="d-flex flex-wrap gap-2 mb-4">
          <button class="btn btn-outline-primary">Primary</button>
          <button class="btn btn-outline-secondary">Secondary</button>
          <button class="btn btn-outline-success">Success</button>
          <button class="btn btn-outline-danger">Danger</button>
          <button class="btn btn-outline-warning">Warning</button>
          <button class="btn btn-outline-info">Info</button>
        </div>
        
        <div class="d-flex flex-wrap gap-2">
          <button class="btn btn-primary btn-sm">Small</button>
          <button class="btn btn-primary">Normal</button>
          <button class="btn btn-primary btn-lg">Large</button>
        </div>
      </div>
      
      <div class="col-lg-6">
        <h5 class="mb-3">Badges & Tags</h5>
        <div class="d-flex flex-wrap gap-2 mb-4">
          <span class="badge bg-primary">Primary</span>
          <span class="badge bg-secondary">Secondary</span>
          <span class="badge bg-success">Success</span>
          <span class="badge bg-danger">Danger</span>
          <span class="badge bg-warning">Warning</span>
          <span class="badge bg-info">Info</span>
        </div>
        
        <div class="d-flex flex-wrap gap-2 mb-4">
          <span class="badge bg-primary rounded-pill">Pill</span>
          <span class="badge bg-success rounded-pill">Active</span>
          <span class="badge bg-warning rounded-pill">Pending</span>
          <span class="badge bg-danger rounded-pill">Error</span>
        </div>
        
        <h6 class="mb-2">Breadcrumbs</h6>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Components</a></li>
            <li class="breadcrumb-item active" aria-current="page">Navigation</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript for Showcase Functionality -->
<script>
function toggleTheme() {
  const root = document.documentElement;
  const currentTheme = root.getAttribute('data-theme');
  const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
  
  root.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme-preference', newTheme);
  
  if (window.componentSystem) {
    window.componentSystem.showNotification(`Switched to ${newTheme} theme`, 'info', 2000);
  }
}

function showNotification(type) {
  const messages = {
    success: 'Success notification displayed!',
    info: 'Info notification displayed!',
    warning: 'Warning notification displayed!',
    danger: 'Error notification displayed!'
  };
  
  if (window.componentSystem) {
    window.componentSystem.showNotification(messages[type], type, 3000);
  }
}

function exportComponents() {
  if (window.componentSystem) {
    const components = {
      statCards: 'ComponentHelper::statCard()',
      actionCards: 'ComponentHelper::actionCard()',
      formFields: 'ComponentHelper::formField()',
      alerts: 'ComponentHelper::alert()',
      modals: 'ComponentHelper::modal()',
      tables: 'ComponentHelper::table()'
    };
    
    const exportText = `// Component System Usage Examples
<?php
use App\\\\Helpers\\\\ComponentHelper;

// Statistics Card
echo ComponentHelper::statCard([
    'icon' => 'icon-students',
    'value' => 1250,
    'label' => 'Total Students',
    'color' => 'primary',
    'progress' => 85
]);

// Action Card
echo ComponentHelper::actionCard([
    'title' => 'Mathematics',
    'subtitle' => 'Overall: 87.5',
    'icon' => 'icon-chart',
    'color' => 'success',
    'onclick' => 'handleClick()'
]);

// Form Field
echo ComponentHelper::formField([
    'id' => 'student-name',
    'label' => 'Student Name',
    'type' => 'text',
    'required' => true
]);

// Alert
echo ComponentHelper::alert([
    'type' => 'success',
    'message' => 'Operation completed!',
    'dismissible' => true
]);
?>`;
    
    // Create and download file
    const blob = new Blob([exportText], { type: 'text/php' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'component-examples.php';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    window.componentSystem.showNotification('Component examples exported!', 'success', 2000);
  }
}

// Initialize showcase when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  console.log('🎨 Component Library Showcase loaded');
  
  // Wait for component system to be available
  const checkComponentSystem = () => {
    if (window.componentSystem) {
      console.log('✅ Component system is ready');
      window.componentSystem.refresh();
    } else {
      setTimeout(checkComponentSystem, 100);
    }
  };
  
  checkComponentSystem();
});
</script>
