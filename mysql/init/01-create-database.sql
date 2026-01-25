-- Create DB
CREATE DATABASE IF NOT EXISTS dbmovies CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE dbmovies;

-- Create user for application
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'userpass';

-- Grant privileges
GRANT ALL PRIVILEGES ON dbmovies.* TO 'user'@'%';
FLUSH PRIVILEGES;

-- Table users (needed for replication)
-- Created first so replication works correctly
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100)
);

-- Insert initial record
INSERT INTO users (name, email) VALUES ('Master user', 'master@test');