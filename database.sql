CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    course VARCHAR(100) NOT NULL
);

INSERT INTO students (student_id, full_name, email, telephone, course) VALUES
('S001','John Silva','john@example.com','0771234567','ICT'),
('S002','Maria Perera','maria@example.com','0712345678','Business'),
('S003','Kasun Fernando','kasun@example.com','0723456789','Engineering'),
('S004','Nimal Jayasuriya','nimal@example.com','0756789123','ICT'),
('S005','Sanduni Weerasinghe','sanduni@example.com','0765432198','Management');
