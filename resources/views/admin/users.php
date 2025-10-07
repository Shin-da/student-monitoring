<div class="dashboard-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="h3 fw-bold mb-1">User Management</h1>
      <p class="text-muted mb-0">Manage user accounts, approvals, and permissions</p>
    </div>
    <div class="d-flex gap-2">
      <a href="/admin/create-user" class="btn btn-primary btn-sm">
        <svg width="16" height="16" fill="currentColor">
          <use href="#icon-plus"></use>
        </svg>
        <span class="d-none d-md-inline ms-1">Create User</span>
      </a>
    </div>
  </div>
</div>

<div class="surface p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">All Users</h5>
    <div class="d-flex gap-2">
      <select class="form-select form-select-sm" style="width: auto;">
        <option value="">All Status</option>
        <option value="pending">Pending</option>
        <option value="active">Active</option>
        <option value="suspended">Suspended</option>
      </select>
      <select class="form-select form-select-sm" style="width: auto;">
        <option value="">All Roles</option>
        <option value="admin">Admin</option>
        <option value="teacher">Teacher</option>
        <option value="adviser">Adviser</option>
        <option value="student">Student</option>
        <option value="parent">Parent</option>
      </select>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Created</th>
          <th>Approved By</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $userData): ?>
        <tr>
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
                <form method="post" action="/admin/approve-user" class="d-inline">
                  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                  <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                  <button type="submit" class="btn btn-success btn-sm" title="Approve">
                    <svg width="14" height="14" fill="currentColor">
                      <use href="#icon-check"></use>
                    </svg>
                  </button>
                </form>
                <form method="post" action="/admin/reject-user" class="d-inline">
                  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                  <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                  <button type="submit" class="btn btn-danger btn-sm" title="Reject" 
                          onclick="return confirm('Are you sure you want to reject this user? This action cannot be undone.')">
                    <svg width="14" height="14" fill="currentColor">
                      <use href="#icon-x"></use>
                    </svg>
                  </button>
                </form>
              <?php elseif ($userData['status'] === 'active' && $userData['id'] != $user['id']): ?>
                <form method="post" action="/admin/suspend-user" class="d-inline">
                  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                  <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                  <button type="submit" class="btn btn-warning btn-sm" title="Suspend"
                          onclick="return confirm('Are you sure you want to suspend this user?')">
                    <svg width="14" height="14" fill="currentColor">
                      <use href="#icon-pause"></use>
                    </svg>
                  </button>
                </form>
              <?php elseif ($userData['status'] === 'suspended'): ?>
                <form method="post" action="/admin/activate-user" class="d-inline">
                  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                  <input type="hidden" name="user_id" value="<?= $userData['id'] ?>">
                  <button type="submit" class="btn btn-success btn-sm" title="Activate">
                    <svg width="14" height="14" fill="currentColor">
                      <use href="#icon-play"></use>
                    </svg>
                  </button>
                </form>
              <?php endif; ?>
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
    <a href="/admin/create-user" class="btn btn-primary btn-sm">Create User</a>
  </div>
  <?php endif; ?>
</div>
