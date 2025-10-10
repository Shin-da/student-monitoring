// backendIntegration.js - Connect existing UI to backend API endpoints without altering UI structure
(() => {
  function getBasePath() {
    try {
      if (typeof window.__BASE_PATH__ === 'string') return window.__BASE_PATH__;
    } catch (_) {}
    // Fallback: attempt to infer base path from current URL up to '/public'
    try {
      const loc = window.location.pathname;
      const idx = loc.indexOf('/public');
      return idx > 0 ? loc.substring(0, idx) : '';
    } catch (_) { return ''; }
  }

  const BASE = getBasePath();

  async function apiFetch(url, options = {}) {
    const resp = await fetch(url, {
      headers: { 'Content-Type': 'application/json', ...(options.headers || {}) },
      credentials: 'same-origin',
      ...options,
    });
    let data;
    try { data = await resp.json(); } catch (_) { data = null; }
    if (!resp.ok) {
      const message = (data && (data.message || data.error)) || `Request failed (${resp.status})`;
      throw new Error(message);
    }
    return data || {};
  }

  function notify(message, type = 'info') {
    try {
      if (typeof Notification !== 'undefined') {
        new Notification(message, { type });
        return;
      }
    } catch (_) {}
    // Fallback
    console[type === 'error' ? 'error' : 'log'](message);
    alert(message);
  }

  function getFormJSON(form) {
    const formData = new FormData(form);
    const obj = {};
    for (const [key, value] of formData.entries()) {
      if (obj[key] !== undefined) {
        if (!Array.isArray(obj[key])) obj[key] = [obj[key]];
        obj[key].push(value);
      } else {
        obj[key] = value;
      }
    }
    return obj;
  }

  function disableButton(btn, isLoading, loadingSelector = '.btn-loading', textSelector = '.btn-text') {
    if (!btn) return;
    btn.disabled = !!isLoading;
    const loading = btn.querySelector(loadingSelector);
    const text = btn.querySelector(textSelector);
    if (loading) loading.style.display = isLoading ? 'inline-flex' : 'none';
    if (text) text.style.display = isLoading ? 'none' : 'inline-flex';
  }

  document.addEventListener('DOMContentLoaded', () => {
    // 1) Admin: Create User -> /api/create_user.php (POST JSON)
    const createUserForm = document.getElementById('createUserForm');
    if (createUserForm) {
      createUserForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const submitBtn = document.getElementById('submitBtn');
        disableButton(submitBtn, true);
        try {
          // Gather core fields and any role-specific inputs present
          const payload = getFormJSON(createUserForm);
          // Remove csrf_token from API payload if present
          if ('csrf_token' in payload) delete payload.csrf_token;

          const res = await apiFetch(`${BASE}/api/create_user.php`, {
            method: 'POST',
            body: JSON.stringify(payload),
          });

          if (res && res.success) {
            notify(res.message || 'User created successfully!', 'success');
            // Optional redirect back to users list if provided by API
            if (res.redirect) {
              window.location.href = res.redirect;
            } else {
              createUserForm.reset();
            }
          } else {
            notify((res && (res.message || res.error)) || 'Failed to create user.', 'error');
          }
        } catch (err) {
          notify(err.message || 'Error creating user.', 'error');
        } finally {
          disableButton(submitBtn, false);
        }
      });
    }

    // 2) Teacher: Add student by LRN -> GET get_student_by_lrn then POST add_student_to_section
    const addStudentForm = document.getElementById('addStudentForm');
    if (addStudentForm) {
      addStudentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const primaryBtn = addStudentForm.closest('.modal-content')?.querySelector('.modal-footer .btn.btn-primary');
        disableButton(primaryBtn, true);
        try {
          const fields = addStudentForm.querySelectorAll('input, select, textarea');
          // Expecting: class select, LRN input, name input
          const classSelect = addStudentForm.querySelector('select');
          const lrnInput = addStudentForm.querySelector('input[type="text"][placeholder*="LRN"]') || addStudentForm.querySelector('input[name="lrn"], input#lrn');
          if (!classSelect || !lrnInput) throw new Error('Missing class or LRN field');

          const lrn = (lrnInput.value || '').trim();
          if (!lrn) throw new Error('Please enter a valid LRN');

          const lookup = await apiFetch(`${BASE}/api/get_student_by_lrn.php?lrn=${encodeURIComponent(lrn)}`, { method: 'GET' });
          if (!lookup || !lookup.success || !lookup.student || !lookup.student.id) {
            throw new Error((lookup && (lookup.message || lookup.error)) || 'Student not found');
          }

          const body = {
            student_id: lookup.student.id,
            section: classSelect.value,
          };

          const addRes = await apiFetch(`${BASE}/api/add_student_to_section.php`, {
            method: 'POST',
            body: JSON.stringify(body),
          });

          if (addRes && addRes.success) {
            notify(addRes.message || 'Student added to section successfully!', 'success');
            // close modal if bootstrap available
            try {
              const modalEl = document.getElementById('addStudentModal');
              if (modalEl && window.bootstrap?.Modal) {
                const instance = window.bootstrap.Modal.getInstance(modalEl) || new window.bootstrap.Modal(modalEl);
                instance.hide();
              }
            } catch (_) {}
            addStudentForm.reset();
          } else {
            throw new Error((addRes && (addRes.message || addRes.error)) || 'Failed to add student to section');
          }
        } catch (err) {
          notify(err.message || 'Error adding student.', 'error');
        } finally {
          disableButton(primaryBtn, false);
        }
      });
    }

    // 3) Teacher: Submit grades -> /api/submit_grade.php (POST)
    // Hook a conventional form if present
    const submitGradeForm = document.getElementById('submitGradeForm');
    if (submitGradeForm) {
      submitGradeForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const payload = getFormJSON(submitGradeForm);
        try {
          const res = await apiFetch(`${BASE}/api/submit_grade.php`, {
            method: 'POST',
            body: JSON.stringify(payload),
          });
          if (res && res.success) {
            notify(res.message || 'Grade submitted successfully!', 'success');
            submitGradeForm.reset();
          } else {
            notify((res && (res.message || res.error)) || 'Failed to submit grade.', 'error');
          }
        } catch (err) {
          notify(err.message || 'Error submitting grade.', 'error');
        }
      });
    }

    // Provide a programmatic API for grade submission if UI triggers are custom
    if (!window.submitGrade) {
      window.submitGrade = async function submitGrade(payload) {
        try {
          const res = await apiFetch(`${BASE}/api/submit_grade.php`, {
            method: 'POST',
            body: JSON.stringify(payload),
          });
          if (res && res.success) {
            notify(res.message || 'Grade submitted successfully!', 'success');
            return res;
          }
          throw new Error((res && (res.message || res.error)) || 'Failed to submit grade.');
        } catch (err) {
          notify(err.message || 'Error submitting grade.', 'error');
          throw err;
        }
      };
    }
  });
})();




