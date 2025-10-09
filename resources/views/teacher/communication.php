<?php
$title = 'Communication';
?>

<!-- Teacher Communication Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Communication Center</h1>
      <p class="text-muted mb-0">Communicate with students, parents, and colleagues</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bulkMessageModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Bulk Message
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#composeMessageModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        Compose Message
      </button>
    </div>
  </div>
</div>

<!-- Communication Statistics Cards -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-primary" width="24" height="24" fill="currentColor">
            <use href="#icon-message"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-primary mb-0" data-count-to="24">0</div>
          <div class="text-muted small">Messages Sent</div>
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
          <div class="h4 fw-bold text-success mb-0" data-count-to="18">0</div>
          <div class="text-muted small">Read Messages</div>
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
          <div class="h4 fw-bold text-warning mb-0" data-count-to="6">0</div>
          <div class="text-muted small">Unread Messages</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-3">
    <div class="surface stat-card">
      <div class="d-flex align-items-center">
        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
          <svg class="icon text-info" width="24" height="24" fill="currentColor">
            <use href="#icon-alerts"></use>
          </svg>
        </div>
        <div>
          <div class="h4 fw-bold text-info mb-0" data-count-to="3">0</div>
          <div class="text-muted small">Urgent Messages</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Communication Tabs -->
<div class="surface mb-4">
  <ul class="nav nav-tabs" id="communicationTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="inbox-tab" data-bs-toggle="tab" data-bs-target="#inbox" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-message"></use>
        </svg>
        Inbox
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="sent-tab" data-bs-toggle="tab" data-bs-target="#sent" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-send"></use>
        </svg>
        Sent
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="drafts-tab" data-bs-toggle="tab" data-bs-target="#drafts" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-edit"></use>
        </svg>
        Drafts
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="announcements-tab" data-bs-toggle="tab" data-bs-target="#announcements" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-alerts"></use>
        </svg>
        Announcements
      </button>
    </li>
  </ul>
  
  <div class="tab-content" id="communicationTabsContent">
    <!-- Inbox Tab -->
    <div class="tab-pane fade show active" id="inbox" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Inbox Messages</h5>
          <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm" onclick="markAllAsRead()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-check"></use>
              </svg>
              Mark All Read
            </button>
            <button class="btn btn-outline-primary btn-sm" onclick="refreshInbox()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-refresh"></use>
              </svg>
              Refresh
            </button>
          </div>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-8">
            <div class="message-list">
              <div class="message-item surface p-3 mb-3 border-start border-4 border-danger">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div class="d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-danger" width="16" height="16" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Parent - Mrs. Smith</div>
                      <div class="text-muted small">jane.smith@email.com</div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-danger">Urgent</span>
                    <span class="text-muted small">2 hours ago</span>
                  </div>
                </div>
                <h6 class="fw-bold text-danger mb-2">Concern about Jane's grades</h6>
                <p class="text-muted mb-2">I'm concerned about Jane's recent performance in mathematics. She seems to be struggling with the new concepts...</p>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-primary" onclick="replyMessage(1)">Reply</button>
                  <button class="btn btn-sm btn-outline-secondary" onclick="viewMessage(1)">View</button>
                  <button class="btn btn-sm btn-outline-danger" onclick="deleteMessage(1)">Delete</button>
                </div>
              </div>
              
              <div class="message-item surface p-3 mb-3 border-start border-4 border-primary">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Student - John Doe</div>
                      <div class="text-muted small">john.doe@email.com</div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary">New</span>
                    <span class="text-muted small">4 hours ago</span>
                  </div>
                </div>
                <h6 class="fw-bold mb-2">Question about assignment</h6>
                <p class="text-muted mb-2">Hi Mr. Teacher, I have a question about the algebra assignment due tomorrow...</p>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-primary" onclick="replyMessage(2)">Reply</button>
                  <button class="btn btn-sm btn-outline-secondary" onclick="viewMessage(2)">View</button>
                  <button class="btn btn-sm btn-outline-danger" onclick="deleteMessage(2)">Delete</button>
                </div>
              </div>
              
              <div class="message-item surface p-3 mb-3 border-start border-4 border-success">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-success" width="16" height="16" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Colleague - Ms. Johnson</div>
                      <div class="text-muted small">ms.johnson@school.edu</div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success">Read</span>
                    <span class="text-muted small">1 day ago</span>
                  </div>
                </div>
                <h6 class="fw-bold mb-2">Meeting reminder</h6>
                <p class="text-muted mb-2">Just a reminder about our department meeting tomorrow at 3 PM...</p>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-primary" onclick="replyMessage(3)">Reply</button>
                  <button class="btn btn-sm btn-outline-secondary" onclick="viewMessage(3)">View</button>
                  <button class="btn btn-sm btn-outline-danger" onclick="deleteMessage(3)">Delete</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Quick Actions</h6>
              <div class="d-grid gap-2">
                <button class="btn btn-primary" onclick="composeMessage()">
                  <svg class="icon me-2" width="16" height="16" fill="currentColor">
                    <use href="#icon-plus"></use>
                  </svg>
                  Compose Message
                </button>
                <button class="btn btn-outline-primary" onclick="sendAnnouncement()">
                  <svg class="icon me-2" width="16" height="16" fill="currentColor">
                    <use href="#icon-alerts"></use>
                  </svg>
                  Send Announcement
                </button>
                <button class="btn btn-outline-secondary" onclick="contactParents()">
                  <svg class="icon me-2" width="16" height="16" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                  Contact Parents
                </button>
                <button class="btn btn-outline-info" onclick="scheduleMeeting()">
                  <svg class="icon me-2" width="16" height="16" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                  Schedule Meeting
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Sent Tab -->
    <div class="tab-pane fade" id="sent" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Sent Messages</h5>
          <div class="d-flex gap-2">
            <button class="btn btn-outline-primary btn-sm" onclick="exportSentMessages()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-download"></use>
              </svg>
              Export
            </button>
            <button class="btn btn-outline-secondary btn-sm" onclick="refreshSent()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-refresh"></use>
              </svg>
              Refresh
            </button>
          </div>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light">
              <tr>
                <th>Recipient</th>
                <th>Subject</th>
                <th>Date Sent</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Parent - Mrs. Smith</div>
                      <div class="text-muted small">jane.smith@email.com</div>
                    </div>
                  </div>
                </td>
                <td>Re: Jane's progress update</td>
                <td>Dec 19, 2024</td>
                <td><span class="badge bg-success">Delivered</span></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                      <svg class="icon" width="16" height="16" fill="currentColor">
                        <use href="#icon-more"></use>
                      </svg>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#" onclick="viewMessage(4)">View</a></li>
                      <li><a class="dropdown-item" href="#" onclick="forwardMessage(4)">Forward</a></li>
                      <li><a class="dropdown-item" href="#" onclick="deleteMessage(4)">Delete</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-success" width="16" height="16" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Grade 10-A Class</div>
                      <div class="text-muted small">42 students</div>
                    </div>
                  </div>
                </td>
                <td>Assignment reminder</td>
                <td>Dec 18, 2024</td>
                <td><span class="badge bg-success">Delivered</span></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                      <svg class="icon" width="16" height="16" fill="currentColor">
                        <use href="#icon-more"></use>
                      </svg>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#" onclick="viewMessage(5)">View</a></li>
                      <li><a class="dropdown-item" href="#" onclick="forwardMessage(5)">Forward</a></li>
                      <li><a class="dropdown-item" href="#" onclick="deleteMessage(5)">Delete</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Drafts Tab -->
    <div class="tab-pane fade" id="drafts" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Draft Messages</h5>
          <div class="d-flex gap-2">
            <button class="btn btn-outline-primary btn-sm" onclick="composeMessage()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-plus"></use>
              </svg>
              New Draft
            </button>
            <button class="btn btn-outline-secondary btn-sm" onclick="refreshDrafts()">
              <svg class="icon me-1" width="16" height="16" fill="currentColor">
                <use href="#icon-refresh"></use>
              </svg>
              Refresh
            </button>
          </div>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h6 class="fw-bold">Parent Conference Reminder</h6>
                  <p class="text-muted small mb-0">To: Grade 10-A Parents</p>
                </div>
                <span class="text-muted small">Dec 15, 2024</span>
              </div>
              <p class="text-muted mb-3">This is a reminder about the upcoming parent conference scheduled for...</p>
              <div class="d-flex gap-2">
                <button class="btn btn-sm btn-primary" onclick="editDraft(1)">Edit</button>
                <button class="btn btn-sm btn-success" onclick="sendDraft(1)">Send</button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteDraft(1)">Delete</button>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6">
            <div class="surface p-4">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h6 class="fw-bold">Assignment Guidelines</h6>
                  <p class="text-muted small mb-0">To: Grade 9-A Students</p>
                </div>
                <span class="text-muted small">Dec 14, 2024</span>
              </div>
              <p class="text-muted mb-3">Please find attached the guidelines for the upcoming science project...</p>
              <div class="d-flex gap-2">
                <button class="btn btn-sm btn-primary" onclick="editDraft(2)">Edit</button>
                <button class="btn btn-sm btn-success" onclick="sendDraft(2)">Send</button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteDraft(2)">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Announcements Tab -->
    <div class="tab-pane fade" id="announcements" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Announcements</h5>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
            <svg class="icon me-1" width="16" height="16" fill="currentColor">
              <use href="#icon-plus"></use>
            </svg>
            Create Announcement
          </button>
        </div>
        
        <div class="row g-4">
          <div class="col-lg-8">
            <div class="announcement-list">
              <div class="surface p-4 mb-3 border-start border-4 border-primary">
                <div class="d-flex justify-content-between align-items-start mb-3">
                  <div>
                    <h6 class="fw-bold text-primary">Mathematics Quiz Schedule</h6>
                    <p class="text-muted small mb-0">Posted by: You • Dec 20, 2024</p>
                  </div>
                  <div class="d-flex gap-2">
                    <span class="badge bg-primary">Active</span>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                        <svg class="icon" width="16" height="16" fill="currentColor">
                          <use href="#icon-more"></use>
                        </svg>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="editAnnouncement(1)">Edit</a></li>
                        <li><a class="dropdown-item" href="#" onclick="viewAnnouncementStats(1)">View Stats</a></li>
                        <li><a class="dropdown-item" href="#" onclick="deleteAnnouncement(1)">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <p class="text-muted mb-3">The mathematics quiz for Grade 10-A and 10-B will be held on December 25, 2024. Please prepare accordingly.</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex gap-3">
                    <span class="text-muted small">
                      <svg class="icon me-1" width="14" height="14" fill="currentColor">
                        <use href="#icon-eye"></use>
                      </svg>
                      42 views
                    </span>
                    <span class="text-muted small">
                      <svg class="icon me-1" width="14" height="14" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                      2 classes
                    </span>
                  </div>
                  <button class="btn btn-sm btn-outline-primary" onclick="viewAnnouncement(1)">View Details</button>
                </div>
              </div>
              
              <div class="surface p-4 mb-3 border-start border-4 border-success">
                <div class="d-flex justify-content-between align-items-start mb-3">
                  <div>
                    <h6 class="fw-bold text-success">Science Fair Update</h6>
                    <p class="text-muted small mb-0">Posted by: You • Dec 18, 2024</p>
                  </div>
                  <div class="d-flex gap-2">
                    <span class="badge bg-success">Completed</span>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                        <svg class="icon" width="16" height="16" fill="currentColor">
                          <use href="#icon-more"></use>
                        </svg>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="editAnnouncement(2)">Edit</a></li>
                        <li><a class="dropdown-item" href="#" onclick="viewAnnouncementStats(2)">View Stats</a></li>
                        <li><a class="dropdown-item" href="#" onclick="deleteAnnouncement(2)">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <p class="text-muted mb-3">The science fair has been successfully completed. Thank you to all participants!</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex gap-3">
                    <span class="text-muted small">
                      <svg class="icon me-1" width="14" height="14" fill="currentColor">
                        <use href="#icon-eye"></use>
                      </svg>
                      38 views
                    </span>
                    <span class="text-muted small">
                      <svg class="icon me-1" width="14" height="14" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                      1 class
                    </span>
                  </div>
                  <button class="btn btn-sm btn-outline-primary" onclick="viewAnnouncement(2)">View Details</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="surface p-4">
              <h6 class="fw-bold mb-3">Announcement Statistics</h6>
              <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                        <use href="#icon-alerts"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Total Announcements</div>
                      <div class="text-muted small">This month</div>
                    </div>
                  </div>
                  <div class="badge bg-primary">8</div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-success" width="16" height="16" fill="currentColor">
                        <use href="#icon-eye"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Total Views</div>
                      <div class="text-muted small">This month</div>
                    </div>
                  </div>
                  <div class="badge bg-success">156</div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                      <svg class="icon text-info" width="16" height="16" fill="currentColor">
                        <use href="#icon-user"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fw-semibold">Active</div>
                      <div class="text-muted small">Announcements</div>
                    </div>
                  </div>
                  <div class="badge bg-info">3</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Compose Message Modal -->
<div class="modal fade" id="composeMessageModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Compose Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="composeMessageForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">To</label>
              <select class="form-select" multiple required>
                <option value="parent-mrs-smith">Parent - Mrs. Smith</option>
                <option value="student-john-doe">Student - John Doe</option>
                <option value="colleague-ms-johnson">Colleague - Ms. Johnson</option>
                <option value="grade-10-a">Grade 10-A Class</option>
                <option value="grade-10-b">Grade 10-B Class</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Priority</label>
              <select class="form-select">
                <option value="normal">Normal</option>
                <option value="high">High</option>
                <option value="urgent">Urgent</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Subject</label>
              <input type="text" class="form-control" placeholder="Enter message subject" required>
            </div>
            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea class="form-control" rows="6" placeholder="Type your message here..." required></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Attachments</label>
              <input type="file" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.png">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-primary" onclick="saveAsDraft()">Save as Draft</button>
        <button type="button" class="btn btn-primary" onclick="sendMessage()">Send Message</button>
      </div>
    </div>
  </div>
</div>

<!-- Bulk Message Modal -->
<div class="modal fade" id="bulkMessageModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Bulk Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="bulkMessageForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Recipient Group</label>
              <select class="form-select" required>
                <option value="">Select Group</option>
                <option value="all-students">All Students</option>
                <option value="all-parents">All Parents</option>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
                <option value="all-teachers">All Teachers</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Message Type</label>
              <select class="form-select" required>
                <option value="announcement">Announcement</option>
                <option value="reminder">Reminder</option>
                <option value="notification">Notification</option>
                <option value="alert">Alert</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Subject</label>
              <input type="text" class="form-control" placeholder="Enter message subject" required>
            </div>
            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea class="form-control" rows="6" placeholder="Type your message here..." required></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Schedule Send</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="scheduleSend">
                <label class="form-check-label" for="scheduleSend">
                  Schedule for later delivery
                </label>
              </div>
              <input type="datetime-local" class="form-control mt-2" id="scheduleDateTime" style="display: none;">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="sendBulkMessage()">Send Bulk Message</button>
      </div>
    </div>
  </div>
</div>

<!-- Create Announcement Modal -->
<div class="modal fade" id="createAnnouncementModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="createAnnouncementForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" placeholder="Enter announcement title" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Target Audience</label>
              <select class="form-select" multiple required>
                <option value="grade-10-a">Grade 10-A</option>
                <option value="grade-10-b">Grade 10-B</option>
                <option value="grade-9-a">Grade 9-A</option>
                <option value="all-students">All Students</option>
                <option value="all-parents">All Parents</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Content</label>
              <textarea class="form-control" rows="6" placeholder="Enter announcement content..." required></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Priority</label>
              <select class="form-select">
                <option value="normal">Normal</option>
                <option value="high">High</option>
                <option value="urgent">Urgent</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Expiry Date</label>
              <input type="date" class="form-control">
            </div>
            <div class="col-12">
              <label class="form-label">Attachments</label>
              <input type="file" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.png">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-primary" onclick="saveAnnouncementDraft()">Save as Draft</button>
        <button type="button" class="btn btn-primary" onclick="publishAnnouncement()">Publish Announcement</button>
      </div>
    </div>
  </div>
</div>

<script>
// Teacher Communication Management
class TeacherCommunicationManagement {
  constructor() {
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadCommunicationData();
  }

  bindEvents() {
    // Schedule send toggle
    document.getElementById('scheduleSend').addEventListener('change', (e) => {
      const scheduleDateTime = document.getElementById('scheduleDateTime');
      scheduleDateTime.style.display = e.target.checked ? 'block' : 'none';
    });
  }

  loadCommunicationData() {
    console.log('Loading communication data...');
    // Load communication data from API
  }
}

// Global functions
function replyMessage(messageId) {
  showNotification(`Opening reply for message ${messageId}...`, { type: 'info' });
}

function viewMessage(messageId) {
  showNotification(`Viewing message ${messageId}...`, { type: 'info' });
}

function deleteMessage(messageId) {
  if (confirm('Are you sure you want to delete this message?')) {
    showNotification(`Message ${messageId} deleted successfully!`, { type: 'success' });
  }
}

function forwardMessage(messageId) {
  showNotification(`Forwarding message ${messageId}...`, { type: 'info' });
}

function composeMessage() {
  showNotification('Opening message composer...', { type: 'info' });
}

function sendMessage() {
  showNotification('Message sent successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('composeMessageModal'));
  modal.hide();
}

function saveAsDraft() {
  showNotification('Message saved as draft!', { type: 'info' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('composeMessageModal'));
  modal.hide();
}

function sendBulkMessage() {
  showNotification('Bulk message sent successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('bulkMessageModal'));
  modal.hide();
}

function markAllAsRead() {
  showNotification('All messages marked as read!', { type: 'success' });
}

function refreshInbox() {
  showNotification('Inbox refreshed successfully!', { type: 'success' });
}

function exportSentMessages() {
  showNotification('Exporting sent messages...', { type: 'info' });
  setTimeout(() => {
    showNotification('Messages exported successfully!', { type: 'success' });
  }, 2000);
}

function refreshSent() {
  showNotification('Sent messages refreshed successfully!', { type: 'success' });
}

function editDraft(draftId) {
  showNotification(`Editing draft ${draftId}...`, { type: 'info' });
}

function sendDraft(draftId) {
  showNotification(`Draft ${draftId} sent successfully!`, { type: 'success' });
}

function deleteDraft(draftId) {
  if (confirm('Are you sure you want to delete this draft?')) {
    showNotification(`Draft ${draftId} deleted successfully!`, { type: 'success' });
  }
}

function refreshDrafts() {
  showNotification('Drafts refreshed successfully!', { type: 'success' });
}

function sendAnnouncement() {
  showNotification('Opening announcement composer...', { type: 'info' });
}

function contactParents() {
  showNotification('Opening parent contact form...', { type: 'info' });
}

function scheduleMeeting() {
  showNotification('Opening meeting scheduler...', { type: 'info' });
}

function editAnnouncement(announcementId) {
  showNotification(`Editing announcement ${announcementId}...`, { type: 'info' });
}

function viewAnnouncementStats(announcementId) {
  showNotification(`Viewing stats for announcement ${announcementId}...`, { type: 'info' });
}

function deleteAnnouncement(announcementId) {
  if (confirm('Are you sure you want to delete this announcement?')) {
    showNotification(`Announcement ${announcementId} deleted successfully!`, { type: 'success' });
  }
}

function viewAnnouncement(announcementId) {
  showNotification(`Viewing announcement ${announcementId}...`, { type: 'info' });
}

function publishAnnouncement() {
  showNotification('Announcement published successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('createAnnouncementModal'));
  modal.hide();
}

function saveAnnouncementDraft() {
  showNotification('Announcement saved as draft!', { type: 'info' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('createAnnouncementModal'));
  modal.hide();
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.teacherCommunicationManagementInstance = new TeacherCommunicationManagement();
});
</script>

<style>
/* Teacher Communication Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.message-item {
  transition: all 0.3s ease;
  cursor: pointer;
}

.message-item:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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

.border-start {
  border-left-width: 4px !important;
}
</style>
