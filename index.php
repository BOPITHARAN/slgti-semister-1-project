<?php
require_once 'includes/functions.php';

$errors = [];
$values = ['student_id' => '', 'full_name' => '', 'email' => '', 'telephone' => '', 'course' => ''];

// Add new student (prepared statement)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = clean_student($_POST);
    $errors = validate_student($values);
    if (!$errors) {
        try {
            $stmt = $conn->prepare('INSERT INTO students (student_id, full_name, email, telephone, course) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('sssss', $values['student_id'], $values['full_name'], $values['email'], $values['telephone'], $values['course']);
            $stmt->execute();
            flash('success', 'Student registered successfully!');
            header('Location: index.php');
            exit;
        } catch (mysqli_sql_exception $ex) {
            if ($ex->getCode() === 1062) $errors['student_id'] = 'This Student ID already exists.';
            else $errors['student_id'] = 'Database error. Please try again.';
        }
    }
}

$q = trim($_GET['q'] ?? '');
$course = trim($_GET['course'] ?? '');
$students = fetch_students($conn, $q, $course);

include 'includes/header.php';
?>
<section class="hero">
  <div>
    <h1>Student Registration System</h1>
    <p>Register new students and manage student records easily.</p>
  </div>
  <div class="hero-icon">🎓</div>
</section>

<div class="grid">
  <section class="card">
    <h2 class="card-title blue">👤 Register New Student</h2>
    <div class="card-body">
      <?php $mode = 'add'; $action = 'index.php'; include 'includes/student_form.php'; ?>
    </div>
  </section>

  <section class="card">
    <h2 class="card-title green">👥 Registered Students</h2>
    <div class="card-body">
      <?php $self = 'index.php'; include 'includes/students_table.php'; ?>
    </div>
  </section>
</div>

<section class="card" id="about" style="margin-top:24px">
  <h2 class="card-title blue">About</h2>
  <div class="card-body"><p>A simple CRUD web application built with HTML, CSS, JavaScript, PHP and MySQL for the Web Development practical examination.</p></div>
</section>
<?php include 'includes/footer.php'; ?>
