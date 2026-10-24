// Task 2 - Form validation
document.addEventListener('DOMContentLoaded', function () {
  var form = document.querySelector('.student-form');

  var rules = {
    student_id: function (v) { return /^[A-Za-z0-9]{3,20}$/.test(v) ? '' : 'Student ID must be 3-20 letters/numbers.'; },
    full_name:  function (v) { return v.length >= 3 && /^[A-Za-z .'-]+$/.test(v) ? '' : 'Enter a valid full name (letters only, min 3 characters).'; },
    email:      function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) ? '' : 'Enter a valid email address.'; },
    telephone:  function (v) { return /^\+?\d{9,15}$/.test(v.replace(/[\s-]/g, '')) ? '' : 'Enter a valid telephone number (9-15 digits).'; },
    course:     function (v) { return v !== '' ? '' : 'Please select a course.'; }
  };

  function check(name) {
    var input = form.elements[name];
    var msg = rules[name](input.value.trim());
    document.getElementById('err-' + name).textContent = msg;
    input.closest('.input-wrap').classList.toggle('invalid', msg !== '');
    return msg === '';
  }

  if (form) {
    Object.keys(rules).forEach(function (n) {
      form.elements[n].addEventListener('blur', function () { check(n); });
    });

    form.addEventListener('submit', function (e) {
      var ok = true;
      Object.keys(rules).forEach(function (n) { if (!check(n)) ok = false; });
      if (!ok) { e.preventDefault(); showMsg('Please fix the errors in the form.', 'error'); }
    });

    var reset = form.querySelector('[data-reset]');
    if (reset) reset.addEventListener('click', function () {
      setTimeout(function () {
        form.querySelectorAll('.error').forEach(function (s) { s.textContent = ''; });
        form.querySelectorAll('.invalid').forEach(function (s) { s.classList.remove('invalid'); });
      }, 0);
    });
  }

  // Delete confirmation
  document.querySelectorAll('form[data-confirm]').forEach(function (f) {
    f.addEventListener('submit', function (e) {
      if (!confirm(f.getAttribute('data-confirm'))) e.preventDefault();
    });
  });

  // Auto-hide alerts
  document.querySelectorAll('.alert').forEach(function (a) {
    setTimeout(function () { a.style.opacity = '0'; setTimeout(function () { a.remove(); }, 400); }, 4000);
  });

  function showMsg(text, type) {
    var d = document.createElement('div');
    d.className = 'alert alert-' + type;
    d.textContent = text;
    document.querySelector('.container').prepend(d);
    setTimeout(function () { d.remove(); }, 4000);
  }
});
