<?php
require_once __DIR__ . '/../config/db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

const COURSES = ['ICT', 'Business', 'Engineering', 'Management'];

function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function flash($type, $msg) { $_SESSION['flash'] = ['type' => $type, 'msg' => $msg]; }

function get_flash() {
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}

function clean_student($src) {
    return [
        'student_id' => trim($src['student_id'] ?? ''),
        'full_name'  => trim($src['full_name'] ?? ''),
        'email'      => trim($src['email'] ?? ''),
        'telephone'  => trim($src['telephone'] ?? ''),
        'course'     => trim($src['course'] ?? ''),
    ];
}

// Server-side validation (mirrors the JavaScript validation)
function validate_student($d) {
    $err = [];
    if (!preg_match('/^[A-Za-z0-9]{3,20}$/', $d['student_id'])) $err['student_id'] = 'Student ID must be 3-20 letters/numbers.';
    if (strlen($d['full_name']) < 3 || !preg_match("/^[\p{L} .'-]+$/u", $d['full_name'])) $err['full_name'] = 'Enter a valid full name (letters only, min 3 characters).';
    if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) $err['email'] = 'Enter a valid email address.';
    if (!preg_match('/^\+?\d{9,15}$/', preg_replace('/[\s-]/', '', $d['telephone']))) $err['telephone'] = 'Enter a valid telephone number (9-15 digits).';
    if (!in_array($d['course'], COURSES, true)) $err['course'] = 'Please select a course.';
    return $err;
}

function fetch_students($conn, $q = '', $course = '') {
    $sql = 'SELECT * FROM students WHERE 1=1';
    $types = ''; $params = [];
    if ($q !== '') {
        $sql .= ' AND (full_name LIKE ? OR student_id LIKE ? OR course LIKE ?)';
        $like = '%' . $q . '%';
        $types .= 'sss'; array_push($params, $like, $like, $like);
    }
    if ($course !== '') {
        $sql .= ' AND course = ?';
        $types .= 's'; $params[] = $course;
    }
    $sql .= ' ORDER BY student_id ASC';
    $stmt = $conn->prepare($sql);
    if ($params) $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
