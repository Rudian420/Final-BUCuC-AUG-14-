-- Create settings table to store application system toggle
CREATE TABLE IF NOT EXISTS application_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_name VARCHAR(50) UNIQUE NOT NULL,
    setting_value VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default setting for application system (enabled by default)
INSERT INTO application_settings (setting_name, setting_value) 
VALUES ('application_system_enabled', 'true')
ON DUPLICATE KEY UPDATE setting_value = setting_value;

-- Add application status to members table if not exists
ALTER TABLE members 
ADD COLUMN IF NOT EXISTS application_status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
ADD COLUMN IF NOT EXISTS admin_action_at TIMESTAMP NULL,
ADD COLUMN IF NOT EXISTS admin_action_by INT NULL,
ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Add foreign key constraint for admin_action_by
-- ALTER TABLE members ADD FOREIGN KEY (admin_action_by) REFERENCES adminpanel(id) ON DELETE SET NULL;
