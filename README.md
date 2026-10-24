# Student Registration System

Web Development Practical Examination – HTML, CSS, JavaScript, PHP, MySQL, Git.

## Features
- Add student with client-side (JS) and server-side validation
- Display all students in a table
- Search by name, ID or course; filter by course
- Edit student details
- Delete student (with confirmation)
- Responsive layout (desktop and mobile)
- Prepared statements for every database query

## Requirements
- PHP 7.4+ (with `mysqli`)
- MySQL / MariaDB
- XAMPP, WAMP, Laragon or similar

## Setup
1. Copy the `student-registration` folder into your web root (e.g. `C:\xampp\htdocs\`).
2. Start **Apache** and **MySQL**.
3. Open phpMyAdmin → **Import** → choose `database.sql` → Go.
   (Or run: `mysql -u root < database.sql`)
4. Edit `config/db.php` if your MySQL user/password differ from `root` / empty.
5. Visit `http://localhost/student-registration/`.

## Folder Structure
```
student-registration/
├── assets/ (css/style.css, js/script.js, images/)
├── config/db.php
├── includes/ (header, footer, form + table partials, helpers)
├── index.php      registration form + student list
├── students.php   full student list
├── edit.php       edit student
├── delete.php     delete student
├── database.sql
└── README.md
```

## Git workflow (Task 4)
```
git init
git add .
git commit -m "Initial commit: project structure and database script"
git checkout -b feature/student-crud
git add .
git commit -m "Add student CRUD, validation and search"
git checkout main
git merge feature/student-crud
git log --oneline --graph
git branch
git status
```
Take screenshots of `git log`, `git branch` and `git status` for submission.

## Test checklist (Task 5)
- [ ] Add valid student → appears in table
- [ ] Empty fields / bad email / bad phone → error messages
- [ ] Duplicate Student ID → rejected
- [ ] Search and course filter work
- [ ] Edit saves changes
- [ ] Delete asks for confirmation then removes record
- [ ] Layout works on mobile width
