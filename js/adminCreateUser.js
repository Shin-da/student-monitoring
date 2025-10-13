(function(){
  // MODIFIED BY CURSOR on 2025-10-13: Route student creation to /admin/create_student.php with JSON payload
  'use strict';

  document.addEventListener('DOMContentLoaded', function(){
    var form = document.getElementById('createUserForm');
    if (!form) return;

    var submitBtn = document.getElementById('submitBtn');

    function showAlert(message, type) {
      // type: 'success' | 'danger' | 'warning'
      var alert = document.createElement('div');
      alert.className = 'alert alert-' + (type || 'success');
      alert.setAttribute('role', 'alert');
      alert.textContent = message;

      form.parentNode.insertBefore(alert, form);
      setTimeout(function(){
        if (alert && alert.parentNode) alert.parentNode.removeChild(alert);
      }, 4000);
    }

    function getValue(id) {
      var el = document.getElementById(id);
      return el ? el.value : '';
    }

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      if (submitBtn) {
        submitBtn.disabled = true;
      }

      var role = getValue('role');
      var payload = {
        name: getValue('name').trim(),
        email: getValue('email').trim(),
        password: getValue('password'),
        role: role
      };

      // Optional fields
      var expiry = getValue('expiryDate');
      var notes = getValue('notes');
      if (expiry) payload.expiry_date = expiry;
      if (notes) payload.notes = notes;

      // Role-specific optional fields mapping to API
      // Students
      var studentIdAsLRN = getValue('student_id');
      var gradeLevel = getValue('grade_level');
      var sectionName = getValue('section_name') || getValue('section');
      if (role === 'student') {
        if (studentIdAsLRN) payload.lrn = studentIdAsLRN;
        if (gradeLevel) payload.grade_level = parseInt(gradeLevel, 10) || null;
        if (sectionName) payload.section_name = sectionName;
      }
      // Teachers/advisers
      var isAdviser = getValue('is_adviser');
      if (role === 'teacher' || role === 'adviser') {
        if (isAdviser !== '') payload.is_adviser = !!(isAdviser === '1' || isAdviser === 'true' || isAdviser === true);
      }

      var base = (window.__BASE_PATH__ || '').replace(/\/$/, '');
      var endpoint = base + '/api/create_user.php';
      // If creating a student, use dedicated transactional endpoint
      if (role === 'student') {
        endpoint = base + '/admin/create_student.php';
        // Map available role-specific fields if present in DOM
        var sectionIdEl = document.getElementById('section_id');
        var schoolYearEl = document.getElementById('school_year');
        var adviserIdEl = document.getElementById('adviser_id');
        var contactNameEl = document.getElementById('contact_name');
        var emergencyEl = document.getElementById('emergency_contact');
        var relationshipEl = document.getElementById('relationship');
        var addressEl = document.getElementById('address');

        if (studentIdAsLRN) payload.lrn = studentIdAsLRN;
        if (gradeLevel) payload.grade_level = parseInt(gradeLevel, 10) || null;
        // Optional extended fields (send only if present)
        if (sectionIdEl && sectionIdEl.value) payload.section_id = parseInt(sectionIdEl.value, 10) || null;
        if (schoolYearEl && schoolYearEl.value) payload.school_year = schoolYearEl.value.trim();
        if (adviserIdEl && adviserIdEl.value) payload.adviser_id = parseInt(adviserIdEl.value, 10) || null;
        if (contactNameEl && contactNameEl.value) payload.contact_name = contactNameEl.value.trim();
        if (emergencyEl && emergencyEl.value) payload.emergency_contact = emergencyEl.value.trim();
        if (relationshipEl && relationshipEl.value) payload.relationship = relationshipEl.value.trim();
        if (addressEl && addressEl.value) payload.address = addressEl.value.trim();
      }
      fetch(endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
        credentials: 'same-origin'
      })
      .then(function(res){ return res.json().catch(function(){ return {success:false, message:'Invalid server response'}; }); })
      .then(function(json){
        if (json && json.success) {
          showAlert('User created successfully.', 'success');
          form.reset();
          // If role-specific fields section exists, hide it after reset
          var rs = document.getElementById('roleSpecificFields');
          if (rs) rs.style.display = 'none';
        } else {
          showAlert((json && json.message) || 'Failed to create user.', 'danger');
        }
      })
      .catch(function(){
        showAlert('Network error. Please try again.', 'danger');
      })
      .finally(function(){
        if (submitBtn) {
          submitBtn.disabled = false;
        }
      });
    });
  });
})();


