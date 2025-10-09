<?php
$title = 'Communication Center';
?>

<!-- Communication Center Header -->
<div class="dashboard-header">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 mb-1 text-primary">Communication Center</h1>
      <p class="text-muted mb-0">Communicate with students, parents, and colleagues</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bulkMessageModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-message"></use>
        </svg>
        Bulk Message
      </button>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newMessageModal">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        New Message
      </button>
    </div>
  </div>
</div>

<!-- Communication Statistics -->
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
          <div class="text-muted small">Replied</div>
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
          <div class="text-muted small">Pending</div>
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
          <div class="h4 fw-bold text-info mb-0" data-count-to="3">0</div>
          <div class="text-muted small">Meetings Scheduled</div>
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
          <use href="#icon-inbox"></use>
        </svg>
        Inbox
        <span class="badge bg-primary ms-2">6</span>
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
        <span class="badge bg-warning ms-2">2</span>
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="meetings-tab" data-bs-toggle="tab" data-bs-target="#meetings" type="button" role="tab">
        <svg class="icon me-2" width="16" height="16" fill="currentColor">
          <use href="#icon-calendar"></use>
        </svg>
        Meetings
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
              <svg class="icon me-1" width="14" height="14" fill="currentColor">
                <use href="#icon-check"></use>
              </svg>
              Mark All Read
            </button>
            <button class="btn btn-outline-primary btn-sm" onclick="refreshInbox()">
              <svg class="icon me-1" width="14" height="14" fill="currentColor">
                <use href="#icon-refresh"></use>
              </svg>
              Refresh
            </button>
          </div>
        </div>
        
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-start">
              <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                  <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">Mrs. Rodriguez (Parent)</div>
                  <div class="text-muted small">Re: Sarah's Mathematics Performance</div>
                  <div class="text-muted small">I would like to schedule a meeting to discuss Sarah's recent grades...</div>
                </div>
              </div>
              <div class="text-end">
                <div class="badge bg-primary mb-1">New</div>
                <div class="text-muted small">2 hours ago</div>
                <div class="mt-2">
                  <button class="btn btn-sm btn-outline-primary" onclick="replyMessage(1)">Reply</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-start">
              <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                  <svg class="icon text-success" width="16" height="16" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">Maria Santos (Student)</div>
                  <div class="text-muted small">Question about upcoming assignment</div>
                  <div class="text-muted small">Good morning, I have a question about the Mathematics assignment due next week...</div>
                </div>
              </div>
              <div class="text-end">
                <div class="badge bg-primary mb-1">New</div>
                <div class="text-muted small">4 hours ago</div>
                <div class="mt-2">
                  <button class="btn btn-sm btn-outline-primary" onclick="replyMessage(2)">Reply</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-start">
              <div class="d-flex align-items-center">
                <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                  <svg class="icon text-info" width="16" height="16" fill="currentColor">
                    <use href="#icon-user"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">Mr. Johnson (Teacher)</div>
                  <div class="text-muted small">Collaboration on student intervention</div>
                  <div class="text-muted small">Hi, I'd like to discuss Michael Torres' performance in my Science class...</div>
                </div>
              </div>
              <div class="text-end">
                <div class="text-muted small">1 day ago</div>
                <div class="mt-2">
                  <button class="btn btn-sm btn-outline-primary" onclick="replyMessage(3)">Reply</button>
                </div>
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
          <span class="text-muted small">24 messages</span>
        </div>
        
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-start">
              <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                  <svg class="icon text-success" width="16" height="16" fill="currentColor">
                    <use href="#icon-check"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">To: Mrs. Rodriguez (Parent)</div>
                  <div class="text-muted small">Re: Sarah's Mathematics Performance</div>
                  <div class="text-muted small">Thank you for reaching out. I'd be happy to schedule a meeting to discuss Sarah's progress...</div>
                </div>
              </div>
              <div class="text-end">
                <div class="badge bg-success mb-1">Delivered</div>
                <div class="text-muted small">1 hour ago</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Drafts Tab -->
    <div class="tab-pane fade" id="drafts" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Draft Messages</h5>
          <span class="text-muted small">2 drafts</span>
        </div>
        
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-start">
              <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                  <svg class="icon text-warning" width="16" height="16" fill="currentColor">
                    <use href="#icon-edit"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">To: All Parents</div>
                  <div class="text-muted small">Quarterly Progress Report</div>
                  <div class="text-muted small">Dear Parents, I would like to share the quarterly progress report for our advisory class...</div>
                </div>
              </div>
              <div class="text-end">
                <div class="text-muted small">2 days ago</div>
                <div class="mt-2">
                  <button class="btn btn-sm btn-outline-primary" onclick="editDraft(1)">Edit</button>
                  <button class="btn btn-sm btn-outline-success" onclick="sendDraft(1)">Send</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Meetings Tab -->
    <div class="tab-pane fade" id="meetings" role="tabpanel">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="mb-0">Scheduled Meetings</h5>
          <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#scheduleMeetingModal">
            <svg class="icon me-1" width="14" height="14" fill="currentColor">
              <use href="#icon-plus"></use>
            </svg>
            Schedule Meeting
          </button>
        </div>
        
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-start">
              <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                  <svg class="icon text-primary" width="16" height="16" fill="currentColor">
                    <use href="#icon-calendar"></use>
                  </svg>
                </div>
                <div>
                  <div class="fw-semibold">Parent Meeting - Mrs. Rodriguez</div>
                  <div class="text-muted small">Discussing Sarah's academic performance</div>
                  <div class="text-muted small">Date: December 20, 2024 at 2:00 PM</div>
                </div>
              </div>
              <div class="text-end">
                <div class="badge bg-primary mb-1">Upcoming</div>
                <div class="text-muted small">Tomorrow</div>
                <div class="mt-2">
                  <button class="btn btn-sm btn-outline-primary" onclick="viewMeeting(1)">View</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- New Message Modal -->
<div class="modal fade" id="newMessageModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Compose New Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="newMessageForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">To</label>
              <select class="form-select" required>
                <option value="">Select Recipient</option>
                <optgroup label="Students">
                  <option value="student-1">Maria Santos</option>
                  <option value="student-2">John Cruz</option>
                  <option value="student-3">Ana Garcia</option>
                </optgroup>
                <optgroup label="Parents">
                  <option value="parent-1">Mrs. Rodriguez</option>
                  <option value="parent-2">Mr. Santos</option>
                  <option value="parent-3">Mrs. Garcia</option>
                </optgroup>
                <optgroup label="Teachers">
                  <option value="teacher-1">Mr. Johnson</option>
                  <option value="teacher-2">Ms. Smith</option>
                </optgroup>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Message Type</label>
              <select class="form-select" required>
                <option value="">Select Type</option>
                <option value="academic">Academic Update</option>
                <option value="behavior">Behavior Concern</option>
                <option value="achievement">Achievement Recognition</option>
                <option value="meeting">Meeting Request</option>
                <option value="general">General Communication</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Subject</label>
              <input type="text" class="form-control" placeholder="Enter message subject" required>
            </div>
            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea class="form-control" rows="6" placeholder="Enter your message..." required></textarea>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="urgentMessage">
                <label class="form-check-label" for="urgentMessage">
                  Mark as urgent
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-primary" onclick="saveDraft()">Save Draft</button>
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
              <label class="form-label">Recipients</label>
              <select class="form-select" multiple size="5" required>
                <option value="all-students">All Students</option>
                <option value="all-parents">All Parents</option>
                <option value="excellent-performers">Excellent Performers</option>
                <option value="needs-attention">Needs Attention</option>
                <option value="attendance-issues">Attendance Issues</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Message Type</label>
              <select class="form-select" required>
                <option value="">Select Type</option>
                <option value="announcement">Announcement</option>
                <option value="reminder">Reminder</option>
                <option value="update">Progress Update</option>
                <option value="meeting">Meeting Notice</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Subject</label>
              <input type="text" class="form-control" placeholder="Enter message subject" required>
            </div>
            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea class="form-control" rows="6" placeholder="Enter your message..." required></textarea>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="scheduleBulk">
                <label class="form-check-label" for="scheduleBulk">
                  Schedule for later delivery
                </label>
              </div>
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

<!-- Schedule Meeting Modal -->
<div class="modal fade" id="scheduleMeetingModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Schedule Meeting</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="scheduleMeetingForm">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Meeting Type</label>
              <select class="form-select" required>
                <option value="">Select Type</option>
                <option value="parent-meeting">Parent Meeting</option>
                <option value="student-conference">Student Conference</option>
                <option value="team-meeting">Team Meeting</option>
                <option value="intervention">Intervention Meeting</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Participants</label>
              <select class="form-select" multiple size="4" required>
                <option value="parent-1">Mrs. Rodriguez</option>
                <option value="parent-2">Mr. Santos</option>
                <option value="student-1">Maria Santos</option>
                <option value="student-2">John Cruz</option>
                <option value="teacher-1">Mr. Johnson</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Time</label>
              <input type="time" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Duration</label>
              <select class="form-select" required>
                <option value="15">15 minutes</option>
                <option value="30">30 minutes</option>
                <option value="45">45 minutes</option>
                <option value="60">1 hour</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Location</label>
              <select class="form-select" required>
                <option value="">Select Location</option>
                <option value="office">Adviser Office</option>
                <option value="classroom">Classroom</option>
                <option value="library">Library</option>
                <option value="online">Online Meeting</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Agenda</label>
              <textarea class="form-control" rows="3" placeholder="Enter meeting agenda..."></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="scheduleMeeting()">Schedule Meeting</button>
      </div>
    </div>
  </div>
</div>

<script>
// Communication Center Management
class CommunicationCenter {
  constructor() {
    this.init();
  }

  init() {
    this.bindEvents();
    this.loadCommunicationData();
  }

  bindEvents() {
    // Tab switching
    document.querySelectorAll('#communicationTabs button[data-bs-toggle="tab"]').forEach(tab => {
      tab.addEventListener('shown.bs.tab', (e) => {
        this.handleTabChange(e.target.getAttribute('data-bs-target'));
      });
    });
  }

  loadCommunicationData() {
    console.log('Loading communication data...');
    // Load communication data from API
  }

  handleTabChange(target) {
    console.log(`Switching to tab: ${target}`);
    // Handle tab-specific functionality
  }
}

// Global functions
function replyMessage(messageId) {
  showNotification(`Opening reply for message ${messageId}...`, { type: 'info' });
}

function editDraft(draftId) {
  showNotification(`Editing draft ${draftId}...`, { type: 'info' });
}

function sendDraft(draftId) {
  showNotification(`Sending draft ${draftId}...`, { type: 'info' });
  setTimeout(() => {
    showNotification('Draft sent successfully!', { type: 'success' });
  }, 1000);
}

function viewMeeting(meetingId) {
  showNotification(`Viewing meeting ${meetingId}...`, { type: 'info' });
}

function sendMessage() {
  showNotification('Sending message...', { type: 'info' });
  setTimeout(() => {
    showNotification('Message sent successfully!', { type: 'success' });
  }, 1500);
  const modal = bootstrap.Modal.getInstance(document.getElementById('newMessageModal'));
  modal.hide();
}

function saveDraft() {
  showNotification('Draft saved successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('newMessageModal'));
  modal.hide();
}

function sendBulkMessage() {
  showNotification('Sending bulk message...', { type: 'info' });
  setTimeout(() => {
    showNotification('Bulk message sent successfully!', { type: 'success' });
  }, 2000);
  const modal = bootstrap.Modal.getInstance(document.getElementById('bulkMessageModal'));
  modal.hide();
}

function scheduleMeeting() {
  showNotification('Meeting scheduled successfully!', { type: 'success' });
  const modal = bootstrap.Modal.getInstance(document.getElementById('scheduleMeetingModal'));
  modal.hide();
}

function markAllAsRead() {
  showNotification('All messages marked as read!', { type: 'success' });
}

function refreshInbox() {
  showNotification('Inbox refreshed!', { type: 'success' });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  new CommunicationCenter();
});
</script>

<style>
/* Communication Center Specific Styles */
.stat-card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.list-group-item {
  border: none;
  border-bottom: 1px solid var(--bs-border-color);
}

.list-group-item:last-child {
  border-bottom: none;
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

.icon {
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
}

.badge {
  font-size: 0.75em;
}
</style>
