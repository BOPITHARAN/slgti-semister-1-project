<?php
require_once 'includes/functions.php';

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM students WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
if (!$student) { flash('error', 'Student not found.'); header('Location: index.php'); exit; }

$values = $student;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = clean_student($_POST);
    $errors = validate_student($values);
    if (!$errors) {
        try {
            $stmt = $conn->prepare('UPDATE students SET student_id=?, full_name=?, email=?, telephone=?, course=? WHERE id=?');
            $stmt->bind_param('sssssi', $values['student_id'], $values['full_name'], $values['email'], $values['telephone'], $values['course'], $id);
            $stmt->execute();
            flash('success', 'Student updated successfully!');
            header('Location: index.php');
            exit;
        } catch (mysqli_sql_exception $ex) {
            $errors['student_id'] = $ex->getCode() === 1062 ? 'This Student ID already exists.' : 'Database error. Please try again.';
        }
    }
}
include 'includes/header.php';
?>
<section class="card narrow">
  <h2 class="card-title blue">✎ Edit Student</h2>
  <div class="card-body">
    <?php $mode = 'edit'; $action = 'edit.php?id=' . $id; include 'includes/student_form.php'; ?>
  </div>
</section>
<?php include 'includes/footer.php'; ?>
