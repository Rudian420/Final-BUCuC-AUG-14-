-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `bucuc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the database
USE `bucuc`;

-- Create adminpanel table
CREATE TABLE IF NOT EXISTS `adminpanel` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('main_admin', 'admin') DEFAULT 'admin',
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert main admin account with hashed password (admin123)
INSERT INTO `adminpanel` (`username`, `email`, `password`, `role`) VALUES 
('RUDIAN AHMED', 'admin@bucuc.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'main_admin')
ON DUPLICATE KEY UPDATE 
`password` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
`role` = 'main_admin';

-- Show the admin account
SELECT * FROM `adminpanel`; 