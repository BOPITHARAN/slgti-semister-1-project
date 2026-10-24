<?php
// Expects: $students, $q, $course, $self (page to submit the filter to)
?>
<form class="filter-bar" method="get" action="<?= e($self) ?>">
  <input type="text" name="q" placeholder="Search by name, ID or course..." value="<?= e($q) ?>">
  <select name="course" onchange="this.form.submit()">
    <option value="">All Courses</option>
    <?php foreach (COURSES as $c): ?>
      <option value="<?= e($c) ?>" <?= $course === $c ? 'selected' : '' ?>><?= e($c) ?></option>
    <?php endforeach; ?>
  </select>
  <button class="btn btn-primary btn-sm" type="submit">Search</button>
</form>
<div class="table-wrap">
<table>
  <thead>
    <tr><th>#</th><th>Student ID</th><th>Full Name</th><th>Email</th><th>Telephone</th><th>Course</th><th>Action</th></tr>
  </thead>
  <tbody>
  <?php if (!$students): ?>
    <tr><td colspan="7" class="empty">No students found.</td></tr>
  <?php endif; ?>
  <?php foreach ($students as $i => $s): ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td><?= e($s['student_id']) ?></td>
      <td><?= e($s['full_name']) ?></td>
      <td><?= e($s['email']) ?></td>
      <td><?= e($s['telephone']) ?></td>
      <td><?= e($s['course']) ?></td>
      <td class="actions">
        <a class="icon-btn edit" href="edit.php?id=<?= (int)$s['id'] ?>" title="Edit">✎</a>
        <form method="post" action="delete.php" class="inline" data-confirm="Delete <?= e($s['full_name']) ?>? This cannot be undone.">
          <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">
          <button type="submit" class="icon-btn del" title="Delete">🗑</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
