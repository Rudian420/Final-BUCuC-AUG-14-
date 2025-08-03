-- Create members table for Cultural Club members
USE `bucuc`;

CREATE TABLE IF NOT EXISTS `members` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `full_name` VARCHAR(100) NOT NULL,
    `university_id` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `gsuite_email` VARCHAR(100) NULL,
    `password` VARCHAR(255) NOT NULL,
    `department` VARCHAR(100) NOT NULL,
    `semester` VARCHAR(20) NOT NULL,
    `gender` ENUM('Male', 'Female', 'Other') NOT NULL,
    `date_of_birth` DATE NOT NULL,
    `facebook_url` VARCHAR(255) NULL,
    `membership_status` ENUM('New Member', 'Current Member', 'Previous Member') NOT NULL,
    `motivation` TEXT NOT NULL,
    `status` ENUM('active', 'inactive', 'pending') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert a sample member for testing (password: member123)
INSERT INTO `members` (
    `full_name`, 
    `university_id`, 
    `email`, 
    `password`, 
    `department`, 
    `semester`, 
    `gender`, 
    `date_of_birth`, 
    `membership_status`, 
    `motivation`
) VALUES (
    'John Doe',
    '2021-01-01-001',
    'john.doe@bracu.ac.bd',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'Computer Science and Engineering',
    '6th',
    'Male',
    '2000-01-01',
    'Current Member',
    'I want to join the Cultural Club to develop my creative skills and contribute to cultural activities.'
);

-- Show the members table structure
DESCRIBE `members`;

-- Show sample member
SELECT `id`, `full_name`, `email`, `department`, `membership_status`, `status` FROM `members`; 