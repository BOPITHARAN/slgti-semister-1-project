<?php
// Expects: $values (array), $errors (array), $mode ('add'|'edit'), $action (string)
$fields = [
  'student_id' => ['Student ID', 'Enter student ID', '🆔'],
  'full_name'  => ['Full Name', 'Enter full name', '👤'],
  'email'      => ['Email', 'Enter email address', '✉️'],
  'telephone'  => ['Telephone', 'Enter telephone number', '📞'],
];
?>
<form class="student-form" method="post" action="<?= e($action) ?>" novalidate>
  <?php foreach ($fields as $name => [$label, $ph, $icon]): ?>
    <div class="form-group">
      <label for="<?= $name ?>"><?= $label ?> <span class="req">*</span></label>
      <div class="input-wrap <?= isset($errors[$name]) ? 'invalid' : '' ?>">
        <span class="icon"><?= $icon ?></span>
        <input type="<?= $name === 'email' ? 'email' : 'text' ?>" id="<?= $name ?>" name="<?= $name ?>"
               placeholder="<?= $ph ?>" value="<?= e($values[$name] ?? '') ?>">
      </div>
      <small class="error" id="err-<?= $name ?>"><?= e($errors[$name] ?? '') ?></small>
    </div>
  <?php endforeach; ?>
  <div class="form-group">
    <label for="course">Course <span class="req">*</span></label>
    <div class="input-wrap <?= isset($errors['course']) ? 'invalid' : '' ?>">
      <span class="icon">🎓</span>
      <select id="course" name="course">
        <option value="">Select a course</option>
        <?php foreach (COURSES as $c): ?>
          <option value="<?= e($c) ?>" <?= ($values['course'] ?? '') === $c ? 'selected' : '' ?>><?= e($c) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <small class="error" id="err-course"><?= e($errors['course'] ?? '') ?></small>
  </div>
  <div class="btn-row">
    <button type="submit" class="btn btn-primary"><?= $mode === 'edit' ? '💾 Update' : '➤ Submit' ?></button>
    <?php if ($mode === 'edit'): ?>
      <a href="index.php" class="btn btn-grey">Cancel</a>
    <?php else: ?>
      <button type="reset" class="btn btn-grey" data-reset>⟲ Reset</button>
    <?php endif; ?>
  </div>
</form>
