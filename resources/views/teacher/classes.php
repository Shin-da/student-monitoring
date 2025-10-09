<?php
$title = 'Class Management';
?>

<!-- Teacher Class Management Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Class Management</h1>
      <p class="text-muted mb-0">Manage your classes, students, and classroom activities</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Add Student
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClassModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Create Class
      </button>
    </div>
  </div>
</div>

<!-- Class Overview Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-sections"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="3">0</div>
          <div class="text-muted small">Active Classes</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-success" width="24" height="24" fill="currentColor">
            <use href="#icon-students"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-success mb-0" data-count-to="125">0</div>
          <div class="text-muted small">Total Students</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-calendar"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0" data-count-to="15">0</div>
          <div class="text-muted small">Upcoming Events</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-warning" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-warning mb-0" data-count-to="8">0</div>
          <div class="text-muted small">Pending Tasks</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Class Management Tabs -->
<div class="surface mb-4">
  <ul class="nav nav-tabs" id="classTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="classes-tab" data-bs-toggle="tab" data-bs-target="#classes" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-sections"></use>
        </svg>
        My Classes
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="students-tab" data-bs-toggle="tab" data-bs-target="#students" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-students"></use>
        </svg>
        All Students
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="schedule-tab" data-bs-toggle="tab" data-bs-target="#schedule" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-calendar"></use>
        </svg>
        Schedule
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="activities-tab" data-bs-toggle="tab" data-bs-target="#activities" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-chart"></use>
        </svg>
        Activities
      </button>
    </li>
  </ul>
  
  <div class="tab-content" id="classTabsContent">
    <!-- My Classes Tab -->
    <div class="tab-pane fade show active" id="classes" role="tabpanel">
      <div class="p-4">
        <div class="row g-4">
          <div class="col-lg-4">
            <div class="class-card surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h5 class="fw-bold text-primary mb-1">Grade 10-A</h5>
                  <p class="text-muted small mb-0">Mathematics</p>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="editClass(1)">Edit Class</a></li>
                    <li><a class="dropdown-item" href="#" onclick="viewClassDetails(1)">View Details</a></li>
                    <li><a class="dropdown-item" href="#" onclick="archiveClass(1)">Archive Class</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="row g-3 mb-3">
                <div class="col-6">
                  <div class="text-center">
                    <div class="h4 fw-bold text-success mb-0">42</div>
                    <div class="text-muted small">Students</div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="text-center">
                    <div class="h4 fw-bold text-info mb-0">85%</div>
                    <div class="text-muted small">Attendance</div>
                  </div>
                </div>
              </div>
              
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Schedule</span>
                  <span class="small text-muted">Mon, Wed, Fri</span>
                </div>
                <div class="small text-muted">8:00 AM - 9:00 AM</div>
              </div>
              
              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-sm" onclick="viewClassStudents(1)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-students"></use>
                  </svg>
                  View Students
                </button>
                <button class="btn btn-outline-secondary btn-sm" onclick="manageClassGrades(1)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  Manage Grades
                </button>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="class-card surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h5 class="fw-bold text-success mb-1">Grade 10-B</h5>
                  <p class="text-muted small mb-0">Mathematics</p>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="editClass(2)">Edit Class</a></li>
                    <li><a class="dropdown-item" href="#" onclick="viewClassDetails(2)">View Details</a></li>
                    <li><a class="dropdown-item" href="#" onclick="archiveClass(2)">Archive Class</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="row g-3 mb-3">
                <div class="col-6">
                  <div class="text-center">
                    <div class="h4 fw-bold text-success mb-0">38</div>
                    <div class="text-muted small">Students</div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="text-center">
                    <div class="h4 fw-bold text-info mb-0">92%</div>
                    <div class="text-muted small">Attendance</div>
                  </div>
                </div>
              </div>
              
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Schedule</span>
                  <span class="small text-muted">Tue, Thu</span>
                </div>
                <div class="small text-muted">9:00 AM - 10:00 AM</div>
              </div>
              
              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-sm" onclick="viewClassStudents(2)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-students"></use>
                  </svg>
                  View Students
                </button>
                <button class="btn btn-outline-secondary btn-sm" onclick="manageClassGrades(2)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  Manage Grades
                </button>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="class-card surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h5 class="fw-bold text-warning mb-1">Grade 9-A</h5>
                  <p class="text-muted small mb-0">Science</p>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="editClass(3)">Edit Class</a></li>
                    <li><a class="dropdown-item" href="#" onclick="viewClassDetails(3)">View Details</a></li>
                    <li><a class="dropdown-item" href="#" onclick="archiveClass(3)">Archive Class</a></li>
                  </ul>
                </div>
              </div>
              
              <div class="row g-3 mb-3">
                <div class="col-6">
                  <div class="text-center">
                    <div class="h4 fw-bold text-success mb-0">45</div>
                    <div class="text-muted small">Students</div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="text-center">
                    <div class="h4 fw-bold text-info mb-0">88%</div>
                    <div class="text-muted small">Attendance</div>
                  </div>
                </div>
              </div>
              
              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-semibold">Schedule</span>
                  <span class="small text-muted">Mon, Wed</span>
                </div>
                <div class="small text-muted">10:00 AM - 11:00 AM</div>
              </div>
              
              <div class="d-grid gap-2">
                <button class="btn btn-primary btn-sm" onclick="viewClassStudents(3)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-students"></use>
                  </svg>
                  View Students
                </button>
                <button class="btn btn-outline-secondary btn-sm" onclick="manageClassGrades(3)">
                  <svg class="icon me-1" width="16" height="16" fill="currentColor">
                    <use href="#icon-chart"></use>
                  </svg>
                  Manage Grades
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- All Students Tab -->
    <div class="tab-pane fade" id="students" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="d-flex gap-3">
            <div class="input-group" style="width: 300px;">
              <span class="input-group-text">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-search"></use>
                </svg>
              </span>
              <input type="text" class="form-control" placeholder="Search students..." id="studentSearch">
            </div>
            <select class="form-select" style="width: 200px;" id="classFilter">
              <option value="">All Classes</option>
              <option value="grade-10-a">Grade 10-A</option>
              <option value="grade-10-b">Grade 10-B</option>
              <option value="grade-9-a">Grade 9-A</option>
            </select>
          </div>
          <button class="btn btn-outline-primary" onclick="exportStudents()">
            <svg class="icon me-1" width="16" height="16" fill="currentColor">
              <use href="#icon-download"></use>
            </svg>
            Export
          </button>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover" id="studentsTable">
            <thead class="table-light">
              <tr>
                <th>
                  <input type="checkbox" class="form-check-input" id="selectAllStudents">
                </th>
                <th>Student</th>
                <th>Class</th>
                <th>LRN</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="checkbox" class="form-check-input" value="1">
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">John Doe</div>
                      <div class="text-muted small">john.doe@email.com</div>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-primary">Grade 10-A</span></td>
                <td>123456789012</td>
                <td>+63 912 345 6789</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                      <svg class="icon" width="16" height="16" fill="currentColor">
                        <use href="#icon-more"></use>
                      </svg>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#" onclick="viewStudentProfile(1)">View Profile</a></li>
                      <li><a class="dropdown-item" href="#" onclick="viewStudentGrades(1)">View Grades</a></li>
                      <li><a class="dropdown-item" href="#" onclick="contactStudent(1)">Contact</a></li>
                      <li><a class="dropdown-item" href="#" onclick="removeFromClass(1)">Remove from Class</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <input type="checkbox" class="form-check-input" value="2">
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-success" width="16" height="16" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Jane Smith</div>
                      <div class="text-muted small">jane.smith@email.com</div>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-primary">Grade 10-A</span></td>
                <td>123456789013</td>
                <td>+63 912 345 6790</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                      <svg class="icon" width="16" height="16" fill="currentColor">
                        <use href="#icon-more"></use>
                      </svg>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#" onclick="viewStudentProfile(2)">View Profile</a></li>
                      <li><a class="dropdown-item" href="#" onclick="viewStudentGrades(2)">View Grades</a></li>
                      <li><a class="dropdown-item" href="#" onclick="contactStudent(2)">Contact</a></li>
                      <li><a class="dropdown-item" href="#" onclick="removeFromClass(2)">Remove from Class</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Schedule Tab -->
    <div class="tab-pane fade" id="schedule" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Class Schedule</h5>
          <div class="d-flex gap-2">
            <button class="btn btn-outline-primary btn-sm" onclick="addSchedule()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-plus"></use>
              </svg>
              Add Schedule
            </button>
            <button class="btn btn-outline-secondary btn-sm" onclick="exportSchedule()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-download"></use>
              </svg>
              Export
            </button>
          </div>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-8">
            <div class="surface p-4">
              <div id="scheduleCalendar" style="height: 400px;">
                <!-- Calendar will be rendered here -->
                <div class="text-center text-muted py-5">
                  <svg class="icon mb-3" width="48" height="48" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <p>Schedule calendar will be displayed here</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Upcoming Classes</h6>
              <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center p-3 border rounded">
                  <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                    <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                      <use href="#icon-clock"></use>
                    </svg>
                  </div>
                  <div class="flex-grow-1">
                    <div class="fw-semibold">Grade 10-A Mathematics</div>
                    <div class="text-muted small">Today, 8:00 AM</div>
                  </div>
                </div>
                
                <div class="d-flex align-items-center p-3 border rounded">
                  <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                    <svg class="icon text-success" width="16" height="16" fill="currentColor">
                      <use href="#icon-clock"></use>
                    </svg>
                  </div>
                  <div class="flex-grow-1">
                    <div class="fw-semibold">Grade 10-B Mathematics</div>
                    <div class="text-muted small">Tomorrow, 9:00 AM</div>
                  </div>
                </div>
                
                <div class="d-flex align-items-center p-3 border rounded">
                  <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                    <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                      <use href="#icon-clock"></use>
                    </svg>
                  </div>
                  <div class="flex-grow-1">
                    <div class="fw-semibold">Grade 9-A Science</div>
                    <div class="text-muted small">Wednesday, 10:00 AM</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Activities Tab -->
    <div class="tab-pane fade" id="activities" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Class Activities</h5>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createActivityModal">
            <svg class="icon me-1" width="16" height="16" fill="currentColor">
              <use href="#icon-plus"></use>
            </svg>
            Create Activity
          </button>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-8">
            <div class="surface p-4">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Recent Activities</h6>
                <div class="btn-group btn-group-sm" role="group">
                  <input type="radio" class="btn-check" name="activityFilter" id="allActivities" checked>
                  <label class="btn btn-outline-primary" for="allActivities">All</label>
                  <input type="radio" class="btn-check" name="activityFilter" id="myActivities">
                  <label class="btn btn-outline-primary" for="myActivities">My Classes</label>
                </div>
              </div>
              
              <div class="activity-timeline">
                <div class="activity-item d-flex gap-3 mb-4">
                  <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                    <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                      <use href="#icon-chart"></use>
                    </svg>
                  </div>
                  <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                      <div class="fw-semibold">Quiz #3 - Algebra</div>
                      <span class="badge bg-primary">Grade 10-A</span>
                    </div>
                    <div class="text-muted small mb-2">Mathematics • Due: Dec 15, 2024</div>
                    <div class="text-muted small">Created 2 days ago</div>
                  </div>
                </div>
                
                <div class="activity-item d-flex gap-3 mb-4">
                  <div class="bg-success bg-opacity-10 rounded-circle p-2">
                    <svg class="icon text-success" width="16" height="16" fill="currentColor">
                      <use href="#icon-plus"></use>
                    </svg>
                  </div>
                  <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                      <div class="fw-semibold">Lab Experiment - Photosynthesis</div>
                      <span class="badge bg-warning">Grade 9-A</span>
                    </div>
                    <div class="text-muted small mb-2">Science • Due: Dec 20, 2024</div>
                    <div class="text-muted small">Created 1 week ago</div>
                  </div>
                </div>
                
                <div class="activity-item d-flex gap-3 mb-4">
                  <div class="bg-info bg-opacity-10 rounded-circle p-2">
                    <svg class="icon text-info" width="16" height="16" fill="currentColor">
                      <use href="#icon-calendar"></use>
                    </svg>
                  </div>
                  <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                      <div class="fw-semibold">Class Field Trip</div>
                      <span class="badge bg-info">All Classes</span>
                    </div>
                    <div class="text-muted small mb-2">Educational Trip • Dec 25, 2024</div>
                    <div class="text-muted small">Created 2 weeks ago</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Activity Statistics</h6>
              <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                        <use href="#icon-chart"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Total Activities</div>
                      <div class="text-muted small">This month</div>
                    </div>
                  </div>
                  <div class="badge bg-primary">15</div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-success" width="16" height="16" fill="currentColor">
                        <use href="#icon-check"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Completed</div>
                      <div class="text-muted small">Activities</div>
                    </div>
                  </div>
                  <div class="badge bg-success">12</div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                        <use href="#icon-clock"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Pending</div>
                      <div class="text-muted small">Activities</div>
                    </div>
                  </div>
                  <div class="badge bg-warning">3</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Create Class Modal -->
<div class="modal fade" id="createClassModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create New Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="createClassForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Class Name</label>
              <input type="text" class="form-control" placeholder="e.g., Grade 10-A" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select class="form-select" required>
                <option value="">Select Subject</option>
                <option value="mathematics">Mathematics</option>
                <option value="science">Science</option>
                <option value="english">English</option>
                <option value="filipino">Filipino</option>
                <option value="social-studies">Social Studies</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Grade Level</label>
              <select class="form-select" required>
                <option value="">Select Grade</option>
                <option value="7">Grade 7</option>
                <option value="8">Grade 8</option>
                <option value="9">Grade 9</option>
                <option value="10">Grade 10</option>
                <option value="11">Grade 11</option>
                <option value="12">Grade 12</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Section</label>
              <input type="text" class="form-control" placeholder="e.g., A, B, C" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Room</label>
              <input type="text" class="form-control" placeholder="e.g., Room 101">
            </div>
            <div class="col-md-6">
              <label class="form-label">Max Students</label>
              <input type="number" class="form-control" placeholder="50" min="1" max="100">
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="3" placeholder="Class description..."></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="createClass()">Create Class</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Student to Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="addStudentForm">
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label">Select Class</label>
              <select class="form-select" required>
                <option value="">Select Class</option>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Student LRN</label>
              <input type="text" class="form-control" placeholder="Enter student LRN" required>
            </div>
            <div class="col-12">
              <label class="form-label">Student Name</label>
              <input type="text" class="form-control" placeholder="Enter student name" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="addStudent()">Add Student</button>
      </div>
    </div>
  </div>
</div>

<!-- Create Activity Modal -->
<div class="modal fade" id="createActivityModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Class Activity</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="createActivityForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Activity Title</label>
              <input type="text" class="form-control" placeholder="e.g., Quiz #3 - Algebra" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Activity Type</label>
              <select class="form-select" required>
                <option value="">Select Type</option>
                <option value="quiz">Quiz</option>
                <option value="assignment">Assignment</option>
                <option value="project">Project</option>
                <option value="exam">Exam</option>
                <option value="lab">Lab Activity</option>
                <option value="field-trip">Field Trip</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Due Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Max Points</label>
              <input type="number" class="form-control" placeholder="100" required>
            </div>
            <div class="col-12">
              <label class="form-label">Classes</label>
              <select class="form-select" multiple required>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="4" placeholder="Activity description and instructions..."></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="createActivity()">Create Activity</button>
      </div>
    </div>
  </div>
</div>

<script>
// Teacher Class Management
class TeacherClassManagement {
  constructor() {
    this.selectedStudents = [];
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadClassData();
  }

  bindEvents() {
    // Student search
    document.getElementById('studentSearch').addEventListener('input', (e) => {
      this.filterStudents(e.target.value);
    });

    // Class filter
    document.getElementById('classFilter').addEventListener('change', (e) => {
      this.filterStudentsByClass(e.target.value);
    });

    // Select all students
    document.getElementById('selectAllStudents').addEventListener('change', (e) => {
      this.toggleSelectAllStudents(e.target.checked);
    });

    // Individual student checkboxes
    document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
      checkbox.addEventListener('change', () => this.updateSelectedStudents());
    });

    // Activity filter
    document.querySelectorAll('input[name="activityFilter"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.filterActivities(e.target.value);
      });
    });
  }

  loadClassData() {
    console.log('Loading class data...');
    // Load class data from API
  }

  filterStudents(searchTerm) {
    const rows = document.querySelectorAll('#studentsTable tbody tr');
    rows.forEach(row => {
      const studentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
      const studentEmail = row.querySelector('td:nth-child(2) .text-muted').textContent.toLowerCase();
      
      if (studentName.includes(searchTerm.toLowerCase()) || studentEmail.includes(searchTerm.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  filterStudentsByClass(className) {
    const rows = document.querySelectorAll('#studentsTable tbody tr');
    rows.forEach(row => {
      const studentClass = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
      
      if (!className || studentClass.includes(className.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  toggleSelectAllStudents(checked) {
    document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
      checkbox.checked = checked;
    });
    this.updateSelectedStudents();
  }

  updateSelectedStudents() {
    this.selectedStudents = Array.from(document.querySelectorAll('input[type="checkbox"][value]:checked'))
      .map(checkbox => checkbox.value);
    console.log('Selected students:', this.selectedStudents);
  }

  filterActivities(filter) {
    console.log(`Filtering activities: ${filter}`);
    // Filter activities based on selected option
  }
}

// Global functions
function editClass(classId) {
  showNotification(`Editing class ${classId}...`, { type: 'info' });
}

function viewClassDetails(classId) {
  showNotification(`Viewing class details ${classId}...`, { type: 'info' });
}

function archiveClass(classId) {
  if (confirm('Are you sure you want to archive this class?')) {
    showNotification(`Class ${classId} archived successfully!`, { type: 'success' });
  }
}

function viewClassStudents(classId) {
  showNotification(`Viewing students for class ${classId}...`, { type: 'info' });
  // Switch to students tab and filter by class
  document.getElementById('students-tab').click();
  document.getElementById('classFilter').value = `grade-${classId}`;
  window.teacherClassManagementInstance.filterStudentsByClass(`grade-${classId}`);
}

function manageClassGrades(classId) {
  showNotification(`Managing grades for class ${classId}...`, { type: 'info' });
  // Redirect to grade management page
}

function viewStudentProfile(studentId) {
  showNotification(`Viewing student profile ${studentId}...`, { type: 'info' });
}

function viewStudentGrades(studentId) {
  showNotification(`Viewing student grades ${studentId}...`, { type: 'info' });
}

function contactStudent(studentId) {
  showNotification(`Opening contact form for student ${studentId}...`, { type: 'info' });
}

function removeFromClass(studentId) {
  if (confirm('Are you sure you want to remove this student from the class?')) {
    showNotification(`Student ${studentId} removed from class!`, { type: 'success' });
  }
}

function exportStudents() {
  showNotification('Exporting students...', { type: 'info' });
  setTimeout(() => {
    showNotification('Students exported successfully!', { type: 'success' });
  }, 2000);
}

function addSchedule() {
  showNotification('Opening schedule editor...', { type: 'info' });
}

function exportSchedule() {
  showNotification('Exporting schedule...', { type: 'info' });
  setTimeout(() => {
    showNotification('Schedule exported successfully!', { type: 'success' });
  }, 2000);
}

function createClass() {
  showNotification('Class created successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('createClassModal'));
  modal.hide();
}

function addStudent() {
  showNotification('Student added to class successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('addStudentModal'));
  modal.hide();
}

function createActivity() {
  showNotification('Activity created successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('createActivityModal'));
  modal.hide();
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.teacherClassManagementInstance = new TeacherClassManagement();
});
</script>

<style>
/* Teacher Class Management Specific Styles */
.class-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.class-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.activity-timeline .activity-item {
  border-left: 2px solid var(--bs-border-color);
  padding-left: 1rem;
  margin-left: 1rem;
}

.activity-timeline .activity-item:last-child {
  border-left: none;
}

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}

.table-hover tbody tr:hover {
  background-color: var(--bs-table-hover-bg);
}

.badge {
  font-size: 0.75em;
}

.nav-tabs .nav-link {
  border: none;
  border-bottom: 2px solid transparent;
}

.nav-tabs .nav-link.active {
  border-bottom-color: var(--bs-primary);
  background-color: transparent;
}

.nav-tabs .nav-link:hover {
  border-bottom-color: var(--bs-primary);
  background-color: transparent;
}
</style>
