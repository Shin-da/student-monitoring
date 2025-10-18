<?php
$title = 'Component System Demo';
?>

<!-- Demo Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Component System Demo</h1>
      <p class="text-muted mb-0">Unified component library in action</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" onclick="showDemoNotification()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-check"></use>
        </svg>
        Test Notification
      </button>
      <button class="btn btn-primary" onclick="openDemoModal()">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Open Modal
      </button>
    </div>
  </div>
</div>

<?php
use App\Helpers\ComponentHelper;
?>

<!-- Statistics Cards Demo -->
<div class="row g-4 mb-5">
  <div class="col-12">
    <h4 class="mb-3">Statistics Cards</h4>
  </div>
  
  <div class="col-md-6 col-lg-3">
    <?= ComponentHelper::statCard([
        'id' => 'total-students',
        'icon' => 'icon-students',
        'value' => 1250,
        'label' => 'Total Students',
        'color' => 'primary',
        'badge' => 'Current',
        'progress' => 85,
        'decimals' => 0
    ]) ?>
  </div>
  
  <div class="col-md-6 col-lg-3">
    <?= ComponentHelper::statCard([
        'id' => 'present-today',
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
        'id' => 'pending-grades',
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
        'id' => 'average-grade',
        'icon' => 'icon-chart',
        'value' => 87.5,
        'label' => 'Average Grade',
        'color' => 'info',
        'progress' => 87.5,
        'decimals' => 1
    ]) ?>
  </div>
</div>

<!-- Action Cards Demo -->
<div class="row g-4 mb-5">
  <div class="col-12">
    <h4 class="mb-3">Action Cards</h4>
  </div>
  
  <div class="col-md-6 col-lg-4">
    <?= ComponentHelper::actionCard([
        'id' => 'math-subject',
        'title' => 'Mathematics',
        'subtitle' => 'Overall: 87.5',
        'icon' => 'icon-chart',
        'color' => 'success',
        'badge' => 'Passed',
        'progress' => 87.5,
        'meta' => 'WW: 85 | PT: 88 | QE: 90',
        'onclick' => 'viewSubjectDetails("math")'
    ]) ?>
  </div>
  
  <div class="col-md-6 col-lg-4">
    <?= ComponentHelper::actionCard([
        'id' => 'science-subject',
        'title' => 'Science',
        'subtitle' => 'Overall: 82.3',
        'icon' => 'icon-chart',
        'color' => 'warning',
        'badge' => 'Needs Improvement',
        'progress' => 82.3,
        'meta' => 'WW: 80 | PT: 85 | QE: 82',
        'onclick' => 'viewSubjectDetails("science")'
    ]) ?>
  </div>
  
  <div class="col-md-6 col-lg-4">
    <?= ComponentHelper::actionCard([
        'id' => 'english-subject',
        'title' => 'English',
        'subtitle' => 'Overall: 91.2',
        'icon' => 'icon-chart',
        'color' => 'success',
        'badge' => 'Excellent',
        'progress' => 91.2,
        'meta' => 'WW: 92 | PT: 90 | QE: 92',
        'onclick' => 'viewSubjectDetails("english")'
    ]) ?>
  </div>
</div>

<!-- Form Components Demo -->
<div class="row g-4 mb-5">
  <div class="col-12">
    <h4 class="mb-3">Form Components</h4>
  </div>
  
  <div class="col-lg-6">
    <div class="surface p-4">
      <h5 class="mb-4">Student Information Form</h5>
      <form id="demoForm">
        <?= ComponentHelper::formField([
            'id' => 'student-name',
            'name' => 'name',
            'label' => 'Student Name',
            'type' => 'text',
            'placeholder' => 'Enter student full name',
            'required' => true,
            'help' => 'Enter the complete name as it appears on official documents'
        ]) ?>
        
        <?= ComponentHelper::formField([
            'id' => 'student-email',
            'name' => 'email',
            'label' => 'Email Address',
            'type' => 'email',
            'placeholder' => 'student@example.com',
            'required' => true,
            'help' => 'We\'ll use this to send important updates'
        ]) ?>
        
        <?= ComponentHelper::formField([
            'id' => 'student-grade',
            'name' => 'grade',
            'label' => 'Grade Level',
            'type' => 'select',
            'required' => true,
            'options' => [
                ['value' => '1', 'text' => 'Grade 1'],
                ['value' => '2', 'text' => 'Grade 2'],
                ['value' => '3', 'text' => 'Grade 3'],
                ['value' => '4', 'text' => 'Grade 4'],
                ['value' => '5', 'text' => 'Grade 5']
            ]
        ]) ?>
        
        <?= ComponentHelper::formField([
            'id' => 'student-notes',
            'name' => 'notes',
            'label' => 'Additional Notes',
            'type' => 'textarea',
            'placeholder' => 'Enter any additional information...',
            'rows' => 3
        ]) ?>
        
        <?= ComponentHelper::formField([
            'id' => 'student-active',
            'name' => 'active',
            'label' => 'Active Student',
            'type' => 'checkbox',
            'checkboxLabel' => 'This student is currently active',
            'checked' => true
        ]) ?>
        
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Save Student</button>
          <button type="button" class="btn btn-outline-secondary">Cancel</button>
        </div>
      </form>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="surface p-4">
      <h5 class="mb-4">Advanced Form Fields</h5>
      
      <?= ComponentHelper::formField([
          'id' => 'birth-date',
          'name' => 'birth_date',
          'label' => 'Birth Date',
          'type' => 'date',
          'required' => true
      ]) ?>
      
      <?= ComponentHelper::formField([
          'id' => 'phone-number',
          'name' => 'phone',
          'label' => 'Phone Number',
          'type' => 'tel',
          'placeholder' => '+1 (555) 123-4567'
      ]) ?>
      
      <?= ComponentHelper::formField([
          'id' => 'profile-picture',
          'name' => 'picture',
          'label' => 'Profile Picture',
          'type' => 'file',
          'accept' => '.jpg,.jpeg,.png,.gif',
          'help' => 'Upload a clear photo of the student'
      ]) ?>
      
      <?= ComponentHelper::formField([
          'id' => 'password',
          'name' => 'password',
          'label' => 'Password',
          'type' => 'password',
          'placeholder' => 'Create a strong password',
          'required' => true,
          'help' => 'Password must be at least 8 characters'
      ]) ?>
      
      <?= ComponentHelper::formField([
          'id' => 'gender',
          'name' => 'gender',
          'label' => 'Gender',
          'type' => 'radio',
          'radioLabel' => 'Male',
          'required' => true
      ]) ?>
    </div>
  </div>
</div>

<!-- Alerts Demo -->
<div class="row g-4 mb-5">
  <div class="col-12">
    <h4 class="mb-3">Alert Components</h4>
  </div>
  
  <div class="col-lg-6">
    <?= ComponentHelper::alert([
        'type' => 'success',
        'message' => 'Student created successfully!',
        'dismissible' => true
    ]) ?>
    
    <?= ComponentHelper::alert([
        'type' => 'warning',
        'message' => 'Please review the student information before submitting.',
        'dismissible' => true
    ]) ?>
  </div>
  
  <div class="col-lg-6">
    <?= ComponentHelper::alert([
        'type' => 'danger',
        'message' => 'Failed to save student data. Please try again.',
        'dismissible' => true
    ]) ?>
    
    <?= ComponentHelper::alert([
        'type' => 'info',
        'message' => 'All form fields marked with * are required.',
        'dismissible' => false
    ]) ?>
  </div>
</div>

<!-- Table Demo -->
<div class="row g-4 mb-5">
  <div class="col-12">
    <h4 class="mb-3">Data Table</h4>
  </div>
  
  <div class="col-12">
    <div class="surface p-4">
      <?= ComponentHelper::table([
          'columns' => [
              ['key' => 'name', 'label' => 'Student Name'],
              ['key' => 'grade', 'label' => 'Grade Level'],
              ['key' => 'average', 'label' => 'Average Grade'],
              ['key' => 'status', 'label' => 'Status']
          ],
          'rows' => [
              ['name' => 'John Doe', 'grade' => 'Grade 5', 'average' => '87.5', 'status' => 'Active'],
              ['name' => 'Jane Smith', 'grade' => 'Grade 4', 'average' => '92.3', 'status' => 'Active'],
              ['name' => 'Mike Johnson', 'grade' => 'Grade 5', 'average' => '78.9', 'status' => 'Active'],
              ['name' => 'Sarah Wilson', 'grade' => 'Grade 3', 'average' => '95.1', 'status' => 'Active']
          ]
      ]) ?>
    </div>
  </div>
</div>

<!-- JavaScript for Demo Functionality -->
<script>
function showDemoNotification() {
  if (window.componentSystem) {
    window.componentSystem.showNotification('Component system is working perfectly!', 'success', 3000);
  } else {
    alert('Component system not loaded yet. Please wait a moment and try again.');
  }
}

function openDemoModal() {
  if (window.componentSystem) {
    const modal = window.componentSystem.createModal({
      id: 'demo-modal',
      title: 'Demo Modal',
      size: 'lg',
      content: `
        <p>This is a demo modal created using the component system.</p>
        <div class="mb-3">
          <label class="form-label">Demo Input</label>
          <input type="text" class="form-control" placeholder="Enter some text">
        </div>
        <div class="alert alert-info">
          <strong>Note:</strong> This modal demonstrates the unified component system in action.
        </div>
      `,
      footer: `
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save Changes</button>
      `
    });
    
    // Show the modal
    const modalInstance = new bootstrap.Modal(modal);
    modalInstance.show();
  } else {
    alert('Component system not loaded yet. Please wait a moment and try again.');
  }
}

function viewSubjectDetails(subject) {
  if (window.componentSystem) {
    window.componentSystem.showNotification(`Opening details for ${subject}`, 'info', 2000);
  }
}

// Form submission handler
document.getElementById('demoForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  if (window.componentSystem) {
    window.componentSystem.showNotification('Form submitted successfully!', 'success', 3000);
  } else {
    alert('Form submitted! (Component system not available)');
  }
});

// Initialize components when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  console.log('🚀 Component System Demo loaded');
  
  // Wait for component system to be available
  const checkComponentSystem = () => {
    if (window.componentSystem) {
      console.log('✅ Component system is ready');
      // Refresh components to ensure proper initialization
      window.componentSystem.refresh();
    } else {
      setTimeout(checkComponentSystem, 100);
    }
  };
  
  checkComponentSystem();
});
</script>

<!-- Demo Modal (will be created dynamically) -->
<!-- The modal will be inserted here by JavaScript when needed -->
