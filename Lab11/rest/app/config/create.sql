-- Create database
CREATE DATABASE IF NOT EXISTS lab11;

-- Create user with privileges for lab11 database
CREATE IF NOT EXISTS USER 'php'@'localhost' IDENTIFIED BY 'php';
GRANT ALL PRIVILEGES ON lab11.* TO 'php'@'localhost';
FLUSH PRIVILEGES;

-- Switch to lab11 database
USE lab11;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    age INT NOT NULL
);

-- Insert dummy data into users table
INSERT INTO users (name, email, age) VALUES
('John Doe', 'john@example.com',33),
('Jane Smith', 'jane@example.com',51),
('Michael Johnson', 'michael@example.com', 41),
('Emily Brown', 'emily@example.com', 27),
('David Wilson', 'david@example.com',22);
