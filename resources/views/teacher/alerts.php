<?php /** @var array $alerts */ ?>
<div class="d-flex justify-content-between align-items-center mb-2">
  <div>
    <h3 class="mb-1">Alerts</h3>
    <div class="text-muted">Review and manage system-generated alerts.</div>
  </div>
</div>

<div class="table-surface p-3">
  <div class="row g-2 align-items-center filters mb-2">
    <div class="col">
      <input class="form-control" placeholder="Search by student or remarks...">
    </div>
    <div class="col-auto">
      <select class="form-select">
        <option>All Subjects</option>
        <option>Math</option>
        <option>History</option>
      </select>
    </div>
    <div class="col-auto">
      <select class="form-select">
        <option>All Types</option>
        <option selected>Warning</option>
        <option>Info</option>
      </select>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Student Name</th>
          <th scope="col">Subject</th>
          <th scope="col">Alert Type</th>
          <th scope="col">Remarks</th>
          <th scope="col" class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2025-10-03</td>
          <td>Angela Reyes</td>
          <td>Math</td>
          <td><span class="badge-soft">Warning</span></td>
          <td>Missed quiz last week</td>
          <td class="text-end"><button class="btn btn-sm btn-outline-secondary">Mark as Resolved</button></td>
        </tr>
        <tr>
          <td>2025-10-05</td>
          <td>Ramon Uy</td>
          <td>History</td>
          <td><span class="badge-soft">Warning</span></td>
          <td>Incomplete assignment</td>
          <td class="text-end"><button class="btn btn-sm btn-outline-secondary">Mark as Resolved</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


