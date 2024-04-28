-- Delete dummy data from users table
DELETE FROM users;

-- Drop users table
DROP TABLE IF EXISTS users;

-- Delete user and revoke privileges
DROP USER 'php'@'localhost';

-- Drop lab11 database
DROP DATABASE IF EXISTS lab11;
