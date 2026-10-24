<?php
require_once 'includes/functions.php';
$q = trim($_GET['q'] ?? '');
$course = trim($_GET['course'] ?? '');
$students = fetch_students($conn, $q, $course);
include 'includes/header.php';
?>
<section class="card">
  <h2 class="card-title green">👥 All Registered Students (<?= count($students) ?>)</h2>
  <div class="card-body">
    <?php $self = 'students.php'; include 'includes/students_table.php'; ?>
  </div>
</section>
<?php include 'includes/footer.php'; ?>
