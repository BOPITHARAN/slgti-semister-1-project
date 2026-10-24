<?php $page = basename($_SERVER['SCRIPT_NAME']); $flash = get_flash(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Registration System</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar">
  <a class="brand" href="index.php">🎓 Student Registration System</a>
  <button class="nav-toggle" aria-label="Menu" onclick="document.querySelector('.nav-links').classList.toggle('open')">☰</button>
  <div class="nav-links">
    <a href="index.php" class="<?= $page === 'index.php' ? 'active' : '' ?>">Home</a>
    <a href="students.php" class="<?= $page === 'students.php' ? 'active' : '' ?>">Students</a>
    <a href="index.php#about">About</a>
  </div>
</nav>
<main class="container">
<?php if ($flash): ?>
  <div class="alert alert-<?= e($flash['type']) ?>"><?= e($flash['msg']) ?></div>
<?php endif; ?>
