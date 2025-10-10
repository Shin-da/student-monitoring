<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">User Management</h1>
      <p class="text-muted mb-0">Manage user accounts, approvals, and permissions</p>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bulkActionsModal" id="bulkActionsBtn" disabled>
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-settings"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Bulk Actions</span>
        <span class="badge bg-primary ms-1" id="selectedCount">0</span>
      </button>
      <a href="<?= \Helpers\Url::to('/admin/create-user') ?>" class="btn btn-primary btn-sm">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Create User</span>
      </a>
    </div>
  </div>
</div>

<div class="surface p-4">
  <!-- Advanced Search and Filters -->
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-text">
          <svg width="16" height="16" fill="currentColor">
            <use href="#icon-search"></use>
          </svg>
        </span>
        <input type="text" class="form-control" id="searchInput" placeholder="Search users by name, email, or ID...">
      </div>
    </div>
    <div class="col-md-2">
      <select class="form-select" id="statusFilter">
        <option value="">All Status</option>
        <option value="pending">Pending</option>
        <option value="active">Active</option>
        <option value="suspended">Suspended</option>
      </select>
    </div>
    <div class="col-md-2">
      <select class="form-select" id="roleFilter">
        <option value="">All Roles</option>
        <option value="admin">Admin</option>
        <option value="teacher">Teacher</option>
        <option value="adviser">Adviser</option>
        <option value="student">Student</option>
        <option value="parent">Parent</option>
      </select>
    </div>
    <div class="col-md-2">
      <select class="form-select" id="sortBy">
        <option value="name">Sort by Name</option>
        <option value="email">Sort by Email</option>
        <option value="created_at">Sort by Date</option>
        <option value="role">Sort by Role</option>
      </select>
    </div>
    <div class="col-md-2">
      <div class="d-flex gap-1">
        <button class="btn btn-outline-secondary btn-sm" id="clearFilters">
          <svg width="14" height="14" fill="currentColor">
            <use href="#icon-x"></use>
          </svg>
        </button>
        <button class="btn btn-outline-primary btn-sm" id="exportBtn">
          <svg width="14" height="14" fill="currentColor">
            <use href="#icon-download"></use>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h5 class="fw-bold mb-0">All Users</h5>
      <small class="text-muted" id="userCount">Loading users...</small>
    </div>
    <div class="d-flex align-items-center gap-2">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="selectAll">
        <label class="form-check-label small" for="selectAll">
          Select All
        </label>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover" id="usersTable">
      <thead>
        <tr>
          <th width="40">
            <input type="checkbox" class="form-check-input" id="selectAllTable">
          </th>
          <th class="sortable" data-sort="name">
            Name
            <svg width="12" height="12" fill="currentColor" class="ms-1 sort-icon">
              <use href="#icon-arrow-up"></use>
            </svg>
          </th>
          <th class="sortable" data-sort="email">
            Email
            <svg width="12" height="12" fill="currentColor" class="ms-1 sort-icon">
              <use href="#icon-arrow-up"></use>
            </svg>
          </th>
          <th class="sortable" data-sort="role">
            Role
            <svg width="12" height="12" fill="currentColor" class="ms-1 sort-icon">
              <use href="#icon-arrow-up"></use>
            </svg>
          </th>
          <th class="sortable" data-sort="status">
            Status
            <svg width="12" height="12" fill="currentColor" class="ms-1 sort-icon">
              <use href="#icon-arrow-up"></use>
            </svg>
          </th>
          <th class="sortable" data-sort="created_at">
            Created
            <svg width="12" height="12" fill="currentColor" class="ms-1 sort-icon">
              <use href="#icon-arrow-up"></use>
            </svg>
          </th>
          <th>Approved By</th>
          <th width="120">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $userData): ?>
        <tr data-user-id="<?= $userData['id'] ?>" data-role="<?= $userData['role'] ?>" data-status="<?= $userData['status'] ?>">
          <td>
            <input type="checkbox" class="form-check-input user-checkbox" value="<?= $userData['id'] ?>">
          </td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center">
                <svg width="16" height="16" fill="currentColor">
                  <use href="#icon-user"></use>
                </svg>
              </div>
              <div>
                <div class="fw-semibold"><?= htmlspecialchars($userData['name']) ?></div>
                <div class="text-muted small">ID: <?= $userData['id'] ?></div>
              </div>
            </div>
          </td>
          <td><?= htmlspecialchars($userData['email']) ?></td>
          <td>
            <span class="badge bg-<?= match($userData['role']) {
              'admin' => 'danger',
              'teacher' => 'success', 
              'adviser' => 'info',
              'student' => 'primary',
              'parent' => 'warning',
              default => 'secondary'
            } ?>-subtle text-<?= match($userData['role']) {
              'admin' => 'danger',
              'teacher' => 'success',
              'adviser' => 'info', 
              'student' => 'primary',
              'parent' => 'warning',
              default => 'secondary'
            } ?>">
              <?= ucfirst($userData['role']) ?>
            </span>
          </td>
          <td>
            <span class="badge bg-<?= match($userData['status']) {
              'pending' => 'warning',
              'active' => 'success',
              'suspended' => 'danger',
              default => 'secondary'
            } ?>-subtle text-<?= match($userData['status']) {
              'pending' => 'warning',
              'active' => 'success', 
              'suspended' => 'danger',
              default => 'secondary'
            } ?>">
              <?= ucfirst($userData['status']) ?>
            </span>
          </td>
          <td>
            <div class="small">
              <?= date('M j, Y', strtotime($userData['created_at'])) ?>
            </div>
            <div class="text-muted small">
              <?= date('g:i A', strtotime($userData['created_at'])) ?>
            </div>
          </td>
          <td>
            <?php if ($userData['approved_by_name']): ?>
              <div class="small"><?= htmlspecialchars($userData['approved_by_name']) ?></div>
              <div class="text-muted small">
                <?= $userData['approved_at'] ? date('M j, Y', strtotime($userData['approved_at'])) : '' ?>
              </div>
            <?php else: ?>
              <span class="text-muted small">Not approved</span>
            <?php endif; ?>
          </td>
          <td>
            <div class="d-flex gap-1">
              <?php if ($userData['status'] === 'pending'): ?>
                <form method="post" action="<?= \Helpers\Url::to('/admin/approve-user') ?>" class="d-inline user-action-form" data-action="approve">
                  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                  <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                  <button type="submit" class="btn btn-success btn-sm" title="Approve">
                    <svg width="14" height="14" fill="currentColor">
                      <use href="#icon-check"></use>
                    </svg>
                  </button>
                </form>
                <form method="post" action="<?= \Helpers\Url::to('/admin/reject-user') ?>" class="d-inline user-action-form" data-action="reject">
                  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                  <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                  <button type="submit" class="btn btn-danger btn-sm" title="Reject" onclick="return confirm('Are you sure you want to reject this user? This action cannot be undone.')">
                    <svg width="14" height="14" fill="currentColor">
                      <use href="#icon-x"></use>
                    </svg>
                  </button>
                </form>
              <?php elseif ($userData['status'] === 'active' && $userData['id'] != $user['id']): ?>
                <form method="post" action="<?= \Helpers\Url::to('/admin/suspend-user') ?>" class="d-inline user-action-form" data-action="suspend">
                  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                  <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                  <button type="submit" class="btn btn-warning btn-sm" title="Suspend" onclick="return confirm('Are you sure you want to suspend this user?')">
                    <svg width="14" height="14" fill="currentColor">
                      <use href="#icon-pause"></use>
                    </svg>
                  </button>
                </form>
              <?php elseif ($userData['status'] === 'suspended'): ?>
                <form method="post" action="<?= \Helpers\Url::to('/admin/activate-user') ?>" class="d-inline user-action-form" data-action="activate">
                  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                  <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                  <button type="submit" class="btn btn-success btn-sm" title="Activate">
                    <svg width="14" height="14" fill="currentColor">
                      <use href="#icon-play"></use>
                    </svg>
                  </button>
                </form>
              <?php endif; ?>
              <form method="post" action="<?= \Helpers\Url::to('/admin/delete-user') ?>" class="d-inline user-action-form" data-action="delete">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete" onclick="return confirm('Delete this user? This cannot be undone.')">
                  <svg width="14" height="14" fill="currentColor">
                    <use href="#icon-delete"></use>
                  </svg>
                </button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php if (empty($users)): ?>
  <div class="text-center py-5">
    <svg width="48" height="48" fill="currentColor" class="text-muted mb-3">
      <use href="#icon-user"></use>
    </svg>
    <h6 class="text-muted">No users found</h6>
    <p class="text-muted small">Create your first user account to get started.</p>
    <a href="<?= \Helpers\Url::to('/admin/create-user') ?>" class="btn btn-primary btn-sm">Create User</a>
  </div>
  <?php endif; ?>
</div>

<!-- Bulk Actions Modal -->
<div class="modal fade" id="bulkActionsModal" tabindex="-1" aria-labelledby="bulkActionsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bulkActionsModalLabel">Bulk Actions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Perform actions on <span id="selectedUsersCount">0</span> selected users:</p>
        <div class="d-grid gap-2">
          <button class="btn btn-success" onclick="bulkApprove()">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-check"></use>
            </svg>
            Approve Selected
          </button>
          <button class="btn btn-warning" onclick="bulkSuspend()">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-pause"></use>
            </svg>
            Suspend Selected
          </button>
          <button class="btn btn-danger" onclick="bulkDelete()">
            <svg width="16" height="16" fill="currentColor" class="me-2">
              <use href="#icon-delete"></use>
            </svg>
            Delete Selected
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="userDetailsContent">
        <!-- User details will be loaded here -->
      </div>
    </div>
  </div>
</div>

<script>
// Advanced Users Management JavaScript
class UsersManager {
  constructor() {
    this.users = [];
    this.filteredUsers = [];
    this.selectedUsers = new Set();
    this.currentSort = { column: 'name', direction: 'asc' };
    this.init();
  }

  init() {
    this.loadUsers();
    this.bindEvents();
    this.updateUserCount();
  }

  loadUsers() {
    // Mock data - replace with actual API call
    this.users = [
      {
        id: 1,
        name: 'John Doe',
        email: 'john@example.com',
        role: 'admin',
        status: 'active',
        created_at: '2024-01-15',
        approved_by: 'System'
      },
      {
        id: 2,
        name: 'Jane Smith',
        email: 'jane@example.com',
        role: 'teacher',
        status: 'pending',
        created_at: '2024-01-16',
        approved_by: null
      },
      {
        id: 3,
        name: 'Mike Johnson',
        email: 'mike@example.com',
        role: 'student',
        status: 'active',
        created_at: '2024-01-17',
        approved_by: 'John Doe'
      }
    ];
    this.filteredUsers = [...this.users];
  }

  bindEvents() {
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', (e) => {
      this.filterUsers();
    });

    // Filter functionality
    document.getElementById('statusFilter').addEventListener('change', () => {
      this.filterUsers();
    });

    document.getElementById('roleFilter').addEventListener('change', () => {
      this.filterUsers();
    });

    // Sort functionality
    document.querySelectorAll('.sortable').forEach(header => {
      header.addEventListener('click', (e) => {
        const column = e.currentTarget.dataset.sort;
        this.sortUsers(column);
      });
    });

    // Select all functionality
    document.getElementById('selectAll').addEventListener('change', (e) => {
      this.toggleSelectAll(e.target.checked);
    });

    document.getElementById('selectAllTable').addEventListener('change', (e) => {
      this.toggleSelectAll(e.target.checked);
    });

    // Individual checkbox functionality
    document.addEventListener('change', (e) => {
      if (e.target.classList.contains('user-checkbox')) {
        this.updateSelectedUsers();
      }
    });

    // Clear filters
    document.getElementById('clearFilters').addEventListener('click', () => {
      this.clearFilters();
    });

    // Export functionality
    document.getElementById('exportBtn').addEventListener('click', () => {
      this.exportUsers();
    });

    // Intercept user action forms for AJAX
    document.addEventListener('submit', async (e) => {
      const form = e.target;
      if (form.classList && form.classList.contains('user-action-form')) {
        e.preventDefault();
        const actionType = form.dataset.action;
        const formData = new FormData(form);
        const userId = formData.get('user_id');
        try {
          const res = await fetch(form.action, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
            body: formData
          });
          const json = await res.json();
          if (!json.success) throw new Error(json.error || 'Action failed');
          this.applyRowUpdate(parseInt(userId), actionType, json);
        } catch (err) {
          showNotification(err.message || 'Action failed', 'error');
        }
      }
    });
  }

  filterUsers() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const roleFilter = document.getElementById('roleFilter').value;

    this.filteredUsers = this.users.filter(user => {
      const matchesSearch = !searchTerm || 
        user.name.toLowerCase().includes(searchTerm) ||
        user.email.toLowerCase().includes(searchTerm) ||
        user.id.toString().includes(searchTerm);

      const matchesStatus = !statusFilter || user.status === statusFilter;
      const matchesRole = !roleFilter || user.role === roleFilter;

      return matchesSearch && matchesStatus && matchesRole;
    });

    this.renderUsers();
    this.updateUserCount();
  }

  sortUsers(column) {
    if (this.currentSort.column === column) {
      this.currentSort.direction = this.currentSort.direction === 'asc' ? 'desc' : 'asc';
    } else {
      this.currentSort.column = column;
      this.currentSort.direction = 'asc';
    }

    this.filteredUsers.sort((a, b) => {
      let aVal = a[column];
      let bVal = b[column];

      if (column === 'created_at') {
        aVal = new Date(aVal);
        bVal = new Date(bVal);
      }

      if (this.currentSort.direction === 'asc') {
        return aVal > bVal ? 1 : -1;
      } else {
        return aVal < bVal ? 1 : -1;
      }
    });

    this.renderUsers();
    this.updateSortIcons();
  }

  updateSortIcons() {
    document.querySelectorAll('.sort-icon').forEach(icon => {
      icon.style.display = 'none';
    });

    const currentHeader = document.querySelector(`[data-sort="${this.currentSort.column}"] .sort-icon`);
    if (currentHeader) {
      currentHeader.style.display = 'inline';
      currentHeader.innerHTML = this.currentSort.direction === 'asc' ? 
        '<use href="#icon-arrow-up"></use>' : 
        '<use href="#icon-arrow-down"></use>';
    }
  }

  toggleSelectAll(checked) {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => {
      checkbox.checked = checked;
      if (checked) {
        this.selectedUsers.add(parseInt(checkbox.value));
      } else {
        this.selectedUsers.delete(parseInt(checkbox.value));
      }
    });
    this.updateSelectedUsers();
  }

  updateSelectedUsers() {
    this.selectedUsers.clear();
    document.querySelectorAll('.user-checkbox:checked').forEach(checkbox => {
      this.selectedUsers.add(parseInt(checkbox.value));
    });

    const count = this.selectedUsers.size;
    document.getElementById('selectedCount').textContent = count;
    document.getElementById('selectedUsersCount').textContent = count;
    document.getElementById('bulkActionsBtn').disabled = count === 0;
    document.getElementById('selectAll').checked = count > 0 && count === this.filteredUsers.length;
    document.getElementById('selectAllTable').checked = count > 0 && count === this.filteredUsers.length;
  }

  clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('roleFilter').value = '';
    this.filterUsers();
  }

  exportUsers() {
    const csvContent = this.generateCSV();
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'users_export.csv';
    a.click();
    window.URL.revokeObjectURL(url);
  }

  generateCSV() {
    const headers = ['ID', 'Name', 'Email', 'Role', 'Status', 'Created At', 'Approved By'];
    const rows = this.filteredUsers.map(user => [
      user.id,
      user.name,
      user.email,
      user.role,
      user.status,
      user.created_at,
      user.approved_by || 'Not approved'
    ]);

    return [headers, ...rows].map(row => 
      row.map(field => `"${field}"`).join(',')
    ).join('\n');
  }

  renderUsers() {
    // This would typically update the table with filtered/sorted data
    // For now, we'll just update the count
    this.updateUserCount();
  }

  updateUserCount() {
    const count = this.filteredUsers.length;
    document.getElementById('userCount').textContent = `${count} user${count !== 1 ? 's' : ''} found`;
  }

  applyRowUpdate(userId, actionType, payload) {
    const row = document.querySelector(`tr[data-user-id="${userId}"]`);
    if (!row) return;
    if (actionType === 'delete' && payload.deleted) {
      row.remove();
      this.updateUserCount();
      showNotification('User deleted', 'success');
      return;
    }
    if (payload.status) {
      row.dataset.status = payload.status;
      const badgeCell = row.querySelector('td:nth-child(5) span');
      if (badgeCell) {
        const color = getStatusColor(payload.status);
        badgeCell.className = `badge bg-${color}-subtle text-${color}`;
        badgeCell.textContent = payload.status.charAt(0).toUpperCase() + payload.status.slice(1);
      }
    }
    showNotification('User updated', 'success');
  }
}

// Bulk Actions
function bulkApprove() {
  const selectedIds = Array.from(usersManager.selectedUsers);
  if (selectedIds.length === 0) return;

  if (confirm(`Are you sure you want to approve ${selectedIds.length} user(s)?`)) {
    // Here you would make an API call to approve users
    console.log('Approving users:', selectedIds);
    showNotification('Users approved successfully!', 'success');
    usersManager.selectedUsers.clear();
    usersManager.updateSelectedUsers();
  }
}

function bulkSuspend() {
  const selectedIds = Array.from(usersManager.selectedUsers);
  if (selectedIds.length === 0) return;

  if (confirm(`Are you sure you want to suspend ${selectedIds.length} user(s)?`)) {
    // Here you would make an API call to suspend users
    console.log('Suspending users:', selectedIds);
    showNotification('Users suspended successfully!', 'warning');
    usersManager.selectedUsers.clear();
    usersManager.updateSelectedUsers();
  }
}

function bulkDelete() {
  const selectedIds = Array.from(usersManager.selectedUsers);
  if (selectedIds.length === 0) return;

  if (confirm(`Are you sure you want to delete ${selectedIds.length} user(s)? This action cannot be undone.`)) {
    // Here you would make an API call to delete users
    console.log('Deleting users:', selectedIds);
    showNotification('Users deleted successfully!', 'error');
    usersManager.selectedUsers.clear();
    usersManager.updateSelectedUsers();
  }
}

// User Details
function viewUserDetails(userId) {
  const user = usersManager.users.find(u => u.id === userId);
  if (!user) return;

  const content = `
    <div class="row g-3">
      <div class="col-md-6">
        <div class="border rounded-3 p-3">
          <h6 class="fw-semibold mb-3">Basic Information</h6>
          <div class="mb-2">
            <strong>Name:</strong> ${user.name}
          </div>
          <div class="mb-2">
            <strong>Email:</strong> ${user.email}
          </div>
          <div class="mb-2">
            <strong>Role:</strong> 
            <span class="badge bg-${getRoleColor(user.role)}-subtle text-${getRoleColor(user.role)}">
              ${user.role.charAt(0).toUpperCase() + user.role.slice(1)}
            </span>
          </div>
          <div class="mb-2">
            <strong>Status:</strong> 
            <span class="badge bg-${getStatusColor(user.status)}-subtle text-${getStatusColor(user.status)}">
              ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="border rounded-3 p-3">
          <h6 class="fw-semibold mb-3">Account Details</h6>
          <div class="mb-2">
            <strong>Created:</strong> ${new Date(user.created_at).toLocaleDateString()}
          </div>
          <div class="mb-2">
            <strong>Approved By:</strong> ${user.approved_by || 'Not approved'}
          </div>
          <div class="mb-2">
            <strong>Last Login:</strong> Never
          </div>
          <div class="mb-2">
            <strong>Account ID:</strong> ${user.id}
          </div>
        </div>
      </div>
    </div>
  `;

  document.getElementById('userDetailsContent').innerHTML = content;
  new bootstrap.Modal(document.getElementById('userDetailsModal')).show();
}

function editUser(userId) {
  // Redirect to edit user page or open edit modal
  window.location.href = `/admin/edit-user/${userId}`;
}

function getRoleColor(role) {
  const colors = {
    'admin': 'danger',
    'teacher': 'success',
    'adviser': 'info',
    'student': 'primary',
    'parent': 'warning'
  };
  return colors[role] || 'secondary';
}

function getStatusColor(status) {
  const colors = {
    'pending': 'warning',
    'active': 'success',
    'suspended': 'danger'
  };
  return colors[status] || 'secondary';
}

function showNotification(message, type) {
  // Use the notification system we created earlier
  if (typeof Notification !== 'undefined') {
    new Notification(message, { type });
  } else {
    alert(message);
  }
}

// Initialize the users manager
const usersManager = new UsersManager();
</script>
