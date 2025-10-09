<?php
$title = 'Teaching Materials';
?>

<!-- Teacher Materials Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Teaching Materials</h1>
      <p class="text-muted mb-0">Manage and organize your teaching resources</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bulkUploadModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-upload"></use>
        </svg>
        Bulk Upload
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadMaterialModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Upload Material
      </button>
    </div>
  </div>
</div>

<!-- Materials Statistics Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-download"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="156">0</div>
          <div class="text-muted small">Total Materials</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-success" width="24" height="24" fill="currentColor">
            <use href="#icon-check"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-success mb-0" data-count-to="142">0</div>
          <div class="text-muted small">Published</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-warning" width="24" height="24" fill="currentColor">
            <use href="#icon-clock"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-warning mb-0" data-count-to="14">0</div>
          <div class="text-muted small">Drafts</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-star"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0" data-count-to="2.8" data-count-decimals="1">0</div>
          <div class="text-muted small">GB Storage Used</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Materials Filters -->
<div class="surface mb-4">
  <div class="row g-3 align-items-center">
    <div class="col-md-3">
      <label class="form-label">Subject</label>
      <select class="form-select" id="subjectFilter">
        <option value="">All Subjects</option>
        <option value="mathematics">Mathematics</option>
        <option value="science">Science</option>
        <option value="english">English</option>
        <option value="filipino">Filipino</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Grade Level</label>
      <select class="form-select" id="gradeFilter">
        <option value="">All Grades</option>
        <option value="grade-7">Grade 7</option>
        <option value="grade-8">Grade 8</option>
        <option value="grade-9">Grade 9</option>
        <option value="grade-10">Grade 10</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Material Type</label>
      <select class="form-select" id="typeFilter">
        <option value="">All Types</option>
        <option value="lesson-plan">Lesson Plan</option>
        <option value="worksheet">Worksheet</option>
        <option value="presentation">Presentation</option>
        <option value="video">Video</option>
        <option value="document">Document</option>
        <option value="image">Image</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Search</label>
      <div class="input-group">
        <span class="input-group-text">
          <svg class="icon" width="16" height="16" fill="currentColor">
            <use href="#icon-search"></use>
          </svg>
        </span>
        <input type="text" class="form-control" placeholder="Search materials..." id="materialSearch">
      </div>
    </div>
  </div>
</div>

<!-- Materials Management Tabs -->
<div class="surface mb-4">
  <ul class="nav nav-tabs" id="materialsTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="all-materials-tab" data-bs-toggle="tab" data-bs-target="#all-materials" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-list"></use>
        </svg>
        All Materials
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="recent-tab" data-bs-toggle="tab" data-bs-target="#recent" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-clock"></use>
        </svg>
        Recent
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="favorites-tab" data-bs-toggle="tab" data-bs-target="#favorites" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-star"></use>
        </svg>
        Favorites
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="shared-tab" data-bs-toggle="tab" data-bs-target="#shared" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-share"></use>
        </svg>
        Shared
      </button>
    </li>
  </ul>
  
  <div class="tab-content" id="materialsTabsContent">
    <!-- All Materials Tab -->
    <div class="tab-pane fade show active" id="all-materials" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">All Materials</h5>
          <div class="d-flex gap-2">
            <div class="btn-group" role="group">
              <input type="radio" class="btn-check" name="viewMode" id="gridView" checked>
              <label class="btn btn-outline-primary" for="gridView">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-grid"></use>
                </svg>
              </label>
              <input type="radio" class="btn-check" name="viewMode" id="listView">
              <label class="btn btn-outline-primary" for="listView">
                <svg class="icon" width="16" height="16" fill="currentColor">
                  <use href="#icon-list"></use>
                </svg>
              </label>
            </div>
            <button class="btn btn-outline-secondary btn-sm" onclick="exportMaterials()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-download"></use>
              </svg>
              Export
            </button>
            <button class="btn btn-outline-primary btn-sm" onclick="refreshMaterials()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-refresh"></use>
              </svg>
              Refresh
            </button>
          </div>
        </div>
        
        <div class="row g-4" id="materialsGrid">
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="material-card surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-primary" width="20" height="20" fill="currentColor">
                    <use href="#icon-document"></use>
                  </svg>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewMaterial(1)">View</a></li>
                    <li><a class="dropdown-item" href="#" onclick="editMaterial(1)">Edit</a></li>
                    <li><a class="dropdown-item" href="#" onclick="shareMaterial(1)">Share</a></li>
                    <li><a class="dropdown-item" href="#" onclick="downloadMaterial(1)">Download</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteMaterial(1)">Delete</a></li>
                  </ul>
                </div>
              </div>
              
              <h6 class="fw-bold mb-2">Algebra Basics Lesson Plan</h6>
              <p class="text-muted small mb-3">Mathematics • Grade 10</p>
              
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge bg-primary">Lesson Plan</span>
                <span class="text-muted small">2.5 MB</span>
              </div>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <span class="text-muted small">Dec 15, 2024</span>
                </div>
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-eye"></use>
                  </svg>
                  <span class="text-muted small">24 views</span>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="material-card surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-success bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-success" width="20" height="20" fill="currentColor">
                    <use href="#icon-presentation"></use>
                  </svg>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewMaterial(2)">View</a></li>
                    <li><a class="dropdown-item" href="#" onclick="editMaterial(2)">Edit</a></li>
                    <li><a class="dropdown-item" href="#" onclick="shareMaterial(2)">Share</a></li>
                    <li><a class="dropdown-item" href="#" onclick="downloadMaterial(2)">Download</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteMaterial(2)">Delete</a></li>
                  </ul>
                </div>
              </div>
              
              <h6 class="fw-bold mb-2">Photosynthesis Presentation</h6>
              <p class="text-muted small mb-3">Science • Grade 9</p>
              
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge bg-success">Presentation</span>
                <span class="text-muted small">8.2 MB</span>
              </div>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <span class="text-muted small">Dec 12, 2024</span>
                </div>
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-eye"></use>
                  </svg>
                  <span class="text-muted small">18 views</span>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="material-card surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-warning" width="20" height="20" fill="currentColor">
                    <use href="#icon-worksheet"></use>
                  </svg>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewMaterial(3)">View</a></li>
                    <li><a class="dropdown-item" href="#" onclick="editMaterial(3)">Edit</a></li>
                    <li><a class="dropdown-item" href="#" onclick="shareMaterial(3)">Share</a></li>
                    <li><a class="dropdown-item" href="#" onclick="downloadMaterial(3)">Download</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteMaterial(3)">Delete</a></li>
                  </ul>
                </div>
              </div>
              
              <h6 class="fw-bold mb-2">Math Problem Set #3</h6>
              <p class="text-muted small mb-3">Mathematics • Grade 10</p>
              
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge bg-warning">Worksheet</span>
                <span class="text-muted small">1.8 MB</span>
              </div>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <span class="text-muted small">Dec 10, 2024</span>
                </div>
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-eye"></use>
                  </svg>
                  <span class="text-muted small">32 views</span>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="material-card surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-info bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-info" width="20" height="20" fill="currentColor">
                    <use href="#icon-video"></use>
                  </svg>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewMaterial(4)">View</a></li>
                    <li><a class="dropdown-item" href="#" onclick="editMaterial(4)">Edit</a></li>
                    <li><a class="dropdown-item" href="#" onclick="shareMaterial(4)">Share</a></li>
                    <li><a class="dropdown-item" href="#" onclick="downloadMaterial(4)">Download</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteMaterial(4)">Delete</a></li>
                  </ul>
                </div>
              </div>
              
              <h6 class="fw-bold mb-2">Chemistry Lab Demo</h6>
              <p class="text-muted small mb-3">Science • Grade 9</p>
              
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge bg-info">Video</span>
                <span class="text-muted small">45.2 MB</span>
              </div>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  <span class="text-muted small">Dec 8, 2024</span>
                </div>
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-eye"></use>
                  </svg>
                  <span class="text-muted small">56 views</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Recent Tab -->
    <div class="tab-pane fade" id="recent" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Recent Materials</h5>
          <span class="badge bg-primary">12 materials</span>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Material</th>
                <th>Type</th>
                <th>Subject</th>
                <th>Size</th>
                <th>Last Modified</th>
                <th>Views</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                        <use href="#icon-document"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Algebra Basics Lesson Plan</div>
                      <div class="text-muted small">Mathematics • Grade 10</div>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-primary">Lesson Plan</span></td>
                <td>Mathematics</td>
                <td>2.5 MB</td>
                <td>Dec 15, 2024</td>
                <td>24</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                      <svg class="icon" width="16" height="16" fill="currentColor">
                        <use href="#icon-more"></use>
                      </svg>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#" onclick="viewMaterial(1)">View</a></li>
                      <li><a class="dropdown-item" href="#" onclick="editMaterial(1)">Edit</a></li>
                      <li><a class="dropdown-item" href="#" onclick="shareMaterial(1)">Share</a></li>
                      <li><a class="dropdown-item" href="#" onclick="downloadMaterial(1)">Download</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Favorites Tab -->
    <div class="tab-pane fade" id="favorites" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Favorite Materials</h5>
          <span class="badge bg-warning">8 materials</span>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-4">
            <div class="surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-warning" width="20" height="20" fill="currentColor">
                    <use href="#icon-star"></use>
                  </svg>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewMaterial(5)">View</a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeFromFavorites(5)">Remove from Favorites</a></li>
                    <li><a class="dropdown-item" href="#" onclick="shareMaterial(5)">Share</a></li>
                  </ul>
                </div>
              </div>
              
              <h6 class="fw-bold mb-2">Advanced Calculus Notes</h6>
              <p class="text-muted small mb-3">Mathematics • Grade 10</p>
              
              <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-warning">Document</span>
                <span class="text-muted small">5.2 MB</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Shared Tab -->
    <div class="tab-pane fade" id="shared" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Shared Materials</h5>
          <span class="badge bg-info">5 materials</span>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-4">
            <div class="surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-info bg-opacity-10 rounded-circle p-2">
                  <svg class="icon text-info" width="20" height="20" fill="currentColor">
                    <use href="#icon-share"></use>
                  </svg>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                    <svg class="icon" width="16" height="16" fill="currentColor">
                      <use href="#icon-more"></use>
                    </svg>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="viewMaterial(6)">View</a></li>
                    <li><a class="dropdown-item" href="#" onclick="viewShareSettings(6)">Share Settings</a></li>
                    <li><a class="dropdown-item" href="#" onclick="stopSharing(6)">Stop Sharing</a></li>
                  </ul>
                </div>
              </div>
              
              <h6 class="fw-bold mb-2">Science Lab Manual</h6>
              <p class="text-muted small mb-3">Science • Grade 9</p>
              
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge bg-info">Shared</span>
                <span class="text-muted small">3.8 MB</span>
              </div>
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                  <span class="text-muted small">3 collaborators</span>
                </div>
                <div class="d-flex align-items-center">
                  <svg class="icon text-muted me-1" width="14" height="14" fill="currentColor">
                    <use href="#icon-eye"></use>
                  </svg>
                  <span class="text-muted small">12 views</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Upload Material Modal -->
<div class="modal fade" id="uploadMaterialModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Teaching Material</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="uploadMaterialForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Material Title</label>
              <input type="text" class="form-control" placeholder="Enter material title" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Material Type</label>
              <select class="form-select" required>
                <option value="">Select Type</option>
                <option value="lesson-plan">Lesson Plan</option>
                <option value="worksheet">Worksheet</option>
                <option value="presentation">Presentation</option>
                <option value="video">Video</option>
                <option value="document">Document</option>
                <option value="image">Image</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select class="form-select" required>
                <option value="">Select Subject</option>
                <option value="mathematics">Mathematics</option>
                <option value="science">Science</option>
                <option value="english">English</option>
                <option value="filipino">Filipino</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Grade Level</label>
              <select class="form-select" required>
                <option value="">Select Grade</option>
                <option value="grade-7">Grade 7</option>
                <option value="grade-8">Grade 8</option>
                <option value="grade-9">Grade 9</option>
                <option value="grade-10">Grade 10</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" rows="3" placeholder="Describe the material..."></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Upload Files</label>
              <input type="file" class="form-control" multiple accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.png,.mp4,.avi" required>
              <div class="form-text">Supported formats: PDF, DOC, DOCX, PPT, PPTX, JPG, PNG, MP4, AVI</div>
            </div>
            <div class="col-12">
              <label class="form-label">Tags</label>
              <input type="text" class="form-control" placeholder="Enter tags separated by commas">
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="makePublic">
                <label class="form-check-label" for="makePublic">
                  Make this material public for other teachers
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-primary" onclick="saveAsDraft()">Save as Draft</button>
        <button type="button" class="btn btn-primary" onclick="uploadMaterial()">Upload Material</button>
      </div>
    </div>
  </div>
</div>

<!-- Bulk Upload Modal -->
<div class="modal fade" id="bulkUploadModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bulk Upload Materials</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="bulkUploadForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select class="form-select" required>
                <option value="">Select Subject</option>
                <option value="mathematics">Mathematics</option>
                <option value="science">Science</option>
                <option value="english">English</option>
                <option value="filipino">Filipino</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Grade Level</label>
              <select class="form-select" required>
                <option value="">Select Grade</option>
                <option value="grade-7">Grade 7</option>
                <option value="grade-8">Grade 8</option>
                <option value="grade-9">Grade 9</option>
                <option value="grade-10">Grade 10</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Upload Files</label>
              <input type="file" class="form-control" multiple required>
              <div class="form-text">Select multiple files to upload at once</div>
            </div>
            <div class="col-12">
              <label class="form-label">Default Tags</label>
              <input type="text" class="form-control" placeholder="Enter default tags for all materials">
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="bulkMakePublic">
                <label class="form-check-label" for="bulkMakePublic">
                  Make all materials public
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="processBulkUpload()">Process Upload</button>
      </div>
    </div>
  </div>
</div>

<script>
// Teacher Materials Management
class TeacherMaterialsManagement {
  constructor() {
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadMaterialsData();
  }

  bindEvents() {
    // Filter changes
    document.getElementById('subjectFilter').addEventListener('change', () => this.filterMaterials());
    document.getElementById('gradeFilter').addEventListener('change', () => this.filterMaterials());
    document.getElementById('typeFilter').addEventListener('change', () => this.filterMaterials());

    // Search
    document.getElementById('materialSearch').addEventListener('input', (e) => {
      this.searchMaterials(e.target.value);
    });

    // View mode change
    document.querySelectorAll('input[name="viewMode"]').forEach(radio => {
      radio.addEventListener('change', (e) => {
        this.changeViewMode(e.target.value);
      });
    });
  }

  loadMaterialsData() {
    console.log('Loading materials data...');
    // Load materials data from API
  }

  filterMaterials() {
    const subject = document.getElementById('subjectFilter').value;
    const grade = document.getElementById('gradeFilter').value;
    const type = document.getElementById('typeFilter').value;

    console.log(`Filtering by: Subject=${subject}, Grade=${grade}, Type=${type}`);
    // Implement filtering logic
  }

  searchMaterials(searchTerm) {
    const cards = document.querySelectorAll('.material-card');
    cards.forEach(card => {
      const title = card.querySelector('h6').textContent.toLowerCase();
      const description = card.querySelector('p').textContent.toLowerCase();
      
      if (title.includes(searchTerm.toLowerCase()) || description.includes(searchTerm.toLowerCase())) {
        card.closest('.col-lg-3, .col-md-4, .col-sm-6').style.display = '';
      } else {
        card.closest('.col-lg-3, .col-md-4, .col-sm-6').style.display = 'none';
      }
    });
  }

  changeViewMode(mode) {
    const grid = document.getElementById('materialsGrid');
    if (mode === 'listView') {
      grid.className = 'table-responsive';
      grid.innerHTML = '<table class="table table-hover"><thead class="table-light"><tr><th>Material</th><th>Type</th><th>Subject</th><th>Size</th><th>Date</th><th>Views</th><th>Actions</th></tr></thead><tbody><tr><td colspan="7" class="text-center text-muted">List view will be implemented here</td></tr></tbody></table>';
    } else {
      grid.className = 'row g-4';
      // Restore grid view
      this.loadMaterialsData();
    }
  }
}

// Global functions
function viewMaterial(materialId) {
  showNotification(`Viewing material ${materialId}...`, { type: 'info' });
}

function editMaterial(materialId) {
  showNotification(`Editing material ${materialId}...`, { type: 'info' });
}

function shareMaterial(materialId) {
  showNotification(`Sharing material ${materialId}...`, { type: 'info' });
}

function downloadMaterial(materialId) {
  showNotification(`Downloading material ${materialId}...`, { type: 'info' });
}

function deleteMaterial(materialId) {
  if (confirm('Are you sure you want to delete this material?')) {
    showNotification(`Material ${materialId} deleted successfully!`, { type: 'success' });
  }
}

function removeFromFavorites(materialId) {
  showNotification(`Material ${materialId} removed from favorites!`, { type: 'success' });
}

function viewShareSettings(materialId) {
  showNotification(`Viewing share settings for material ${materialId}...`, { type: 'info' });
}

function stopSharing(materialId) {
  if (confirm('Are you sure you want to stop sharing this material?')) {
    showNotification(`Material ${materialId} is no longer shared!`, { type: 'success' });
  }
}

function uploadMaterial() {
  showNotification('Material uploaded successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('uploadMaterialModal'));
  modal.hide();
}

function saveAsDraft() {
  showNotification('Material saved as draft!', { type: 'info' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('uploadMaterialModal'));
  modal.hide();
}

function processBulkUpload() {
  showNotification('Processing bulk upload...', { type: 'info' });
  setTimeout(() => {
    showNotification('Bulk upload completed successfully!', { type: 'success' });
  }, 3000);
  const modal = bootstrap.Modal.getInstance(document.getElementById('bulkUploadModal'));
  modal.hide();
}

function exportMaterials() {
  showNotification('Exporting materials...', { type: 'info' });
  setTimeout(() => {
    showNotification('Materials exported successfully!', { type: 'success' });
  }, 2000);
}

function refreshMaterials() {
  if (window.teacherMaterialsManagementInstance) {
    window.teacherMaterialsManagementInstance.loadMaterialsData();
    showNotification('Materials refreshed successfully!', { type: 'success' });
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.teacherMaterialsManagementInstance = new TeacherMaterialsManagement();
});
</script>

<style>
/* Teacher Materials Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.material-card {
  transition: all 0.3s ease;
  cursor: pointer;
  height: 100%;
}

.material-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
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

.btn-check:checked + .btn {
  background-color: var(--bs-primary);
  border-color: var(--bs-primary);
  color: white;
}
</style>
