CREATE DATABASE DCE_student;

USE DCE_student;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    mname VARCHAR(50),
    lname VARCHAR(50),
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    password_hash VARCHAR(30)
);