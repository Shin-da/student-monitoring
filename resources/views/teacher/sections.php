<?php /** @var array $user */ ?>
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h1 class="h4 fw-bold mb-1">My Sections</h1>
    <p class="text-muted mb-0">Create and manage your sections</p>
  </div>
  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createSectionModal">
    <svg width="16" height="16" fill="currentColor"><use href="#icon-plus"></use></svg>
    <span class="d-none d-md-inline ms-1">Create Section</span>
  </button>
  </div>

<div class="surface p-3">
  <div id="sectionsContainer" class="row g-3">
    <!-- Sections will be loaded here -->
  </div>
</div>

<!-- Create Section Modal -->
<div class="modal fade" id="createSectionModal" tabindex="-1" aria-labelledby="createSectionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createSectionModalLabel">Create Section</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="createSectionForm">
        <div class="modal-body">
          <input type="hidden" id="teacherUserId" value="<?= (int)($user['id'] ?? 0) ?>">
          <div class="mb-3">
            <label for="section_name" class="form-label">Section Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="section_name" required>
          </div>
          <div class="mb-3">
            <label for="grade_level" class="form-label">Grade Level <span class="text-danger">*</span></label>
            <select class="form-select" id="grade_level" required>
              <option value="">Select grade</option>
              <?php for($i=1; $i<=12; $i++): ?>
                <option value="<?= $i ?>">Grade <?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Optional"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Section</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Add Student by LRN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="activeSectionId">
        <div class="mb-3">
          <label for="lrnInput" class="form-label">Learner Reference Number</label>
          <input type="text" class="form-control" id="lrnInput" placeholder="Type LRN...">
        </div>
        <div id="lrnResult" class="border rounded p-2 d-none"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="confirmAddBtn" class="btn btn-primary" disabled>Add to Section</button>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';

  const teacherUserId = parseInt(document.getElementById('teacherUserId').value, 10) || 0;
  const sectionsContainer = document.getElementById('sectionsContainer');
  const createSectionForm = document.getElementById('createSectionForm');
  const addStudentModal = document.getElementById('addStudentModal');
  const lrnInput = document.getElementById('lrnInput');
  const lrnResult = document.getElementById('lrnResult');
  const confirmAddBtn = document.getElementById('confirmAddBtn');
  let selectedStudent = null;
  let activeSectionId = null;

  function api(path, options){
    const base = (window.__BASE_PATH__ || '').replace(/\/$/, '');
    return fetch(base + path, options || {});
  }

  function sectionCard(section){
    return `
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="card-title mb-0">${section.section_name}</h5>
              <span class="badge bg-primary-subtle text-primary">Grade ${section.grade_level}</span>
            </div>
            <p class="card-text flex-grow-1">${section.description || ''}</p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">Created ${new Date(section.created_at).toLocaleDateString()}</small>
              <button class="btn btn-outline-primary btn-sm" data-section-id="${section.id}" data-action="add-student">Add Student</button>
            </div>
          </div>
        </div>
      </div>
    `;
  }

  function loadSections(){
    api('/api/teacher/list_sections.php')
      .then(r => r.json())
      .then(json => {
        if (!json.success) throw new Error(json.message || 'Failed to load sections');
        sectionsContainer.innerHTML = (json.data || []).map(sectionCard).join('');
      })
      .catch(() => { sectionsContainer.innerHTML = '<div class="text-muted">No sections yet</div>'; });
  }

  createSectionForm.addEventListener('submit', function(e){
    e.preventDefault();
    const payload = {
      teacher_user_id: teacherUserId,
      section_name: document.getElementById('section_name').value.trim(),
      grade_level: parseInt(document.getElementById('grade_level').value, 10),
      description: document.getElementById('description').value.trim() || null
    };
    api('/api/teacher/create_section.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify(payload),
      credentials: 'same-origin'
    })
    .then(r => r.json())
    .then(json => {
      if (!json.success) throw new Error(json.message || 'Failed');
      bootstrap.Modal.getInstance(document.getElementById('createSectionModal')).hide();
      createSectionForm.reset();
      loadSections();
      if (window.Notification) new Notification('Section created', { type: 'success' });
    })
    .catch(err => { alert(err.message || 'Error creating section'); });
  });

  sectionsContainer.addEventListener('click', function(e){
    const btn = e.target.closest('button[data-action="add-student"]');
    if (!btn) return;
    activeSectionId = parseInt(btn.getAttribute('data-section-id'), 10);
    document.getElementById('activeSectionId').value = activeSectionId;
    selectedStudent = null;
    lrnInput.value = '';
    lrnResult.classList.add('d-none');
    confirmAddBtn.disabled = true;
    new bootstrap.Modal(addStudentModal).show();
  });

  let debounce;
  lrnInput.addEventListener('input', function(){
    const q = this.value.trim();
    selectedStudent = null;
    confirmAddBtn.disabled = true;
    if (debounce) clearTimeout(debounce);
    if (!q) { lrnResult.classList.add('d-none'); return; }
    debounce = setTimeout(() => {
      api('/api/teacher/search_student_by_lrn.php?q=' + encodeURIComponent(q))
        .then(r => r.json())
        .then(json => {
          if (!json.success || !json.data) { lrnResult.classList.remove('d-none'); lrnResult.innerHTML = '<div class="text-muted">No match</div>'; return; }
          const s = json.data;
          selectedStudent = s;
          lrnResult.classList.remove('d-none');
          lrnResult.innerHTML = `
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="fw-semibold">${s.name} (${s.lrn || 'N/A'})</div>
                <div class="text-muted small">Grade ${s.grade_level || 'N/A'}</div>
              </div>
              <span class="badge bg-primary-subtle text-primary">Student</span>
            </div>`;
          confirmAddBtn.disabled = false;
        })
        .catch(() => { lrnResult.classList.remove('d-none'); lrnResult.innerHTML = '<div class="text-muted">No match</div>'; });
    }, 250);
  });

  confirmAddBtn.addEventListener('click', function(){
    if (!selectedStudent || !activeSectionId) return;
    const payload = {
      section_id: activeSectionId,
      student_user_id: selectedStudent.user_id,
      added_by_user_id: teacherUserId
    };
    api('/api/teacher/add_student_to_section.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify(payload),
      credentials: 'same-origin'
    })
    .then(r => r.json())
    .then(json => {
      if (!json.success) throw new Error(json.message || 'Failed to add');
      bootstrap.Modal.getInstance(addStudentModal).hide();
      if (window.Notification) new Notification('Student added to section', { type: 'success' });
    })
    .catch(err => alert(err.message || 'Error'));
  });

  loadSections();
})();
</script>


