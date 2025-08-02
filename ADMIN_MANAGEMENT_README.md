# Admin Management Feature

## Overview
This feature allows existing admins to manage other admin accounts in the BRAC University Cultural Club system.

## Features

### 1. Add New Admin
- **Access**: Click "Admin Management" in the sidebar, then "Add New Admin" button
- **Required Fields**:
  - Username (unique)
  - Email (unique, valid format)
  - Password (minimum 6 characters)
  - Role (Admin or Super Admin)
- **Validation**: 
  - All fields are required
  - Email must be valid format
  - Username and email must be unique
  - Password minimum 6 characters

### 2. View Admin List
- **Access**: Click "Admin Management" in the sidebar
- **Displayed Information**:
  - Admin ID
  - Username
  - Email
  - Role (with color-coded badges)
  - Status (Active/Inactive)
  - Created Date
  - Action buttons (Edit/Delete)

### 3. Delete Admin
- **Access**: Click the trash icon next to any admin in the list
- **Security Features**:
  - Cannot delete the primary admin (ID: 1)
  - Cannot delete your own account
  - Confirmation dialog before deletion
- **Process**: 
  1. Click delete button
  2. Confirm deletion in popup
  3. Admin is permanently removed

### 4. Edit Admin (Future Feature)
- Currently shows "Edit functionality will be implemented soon"
- Will allow updating admin details

## Security Features

### Session Management
- Admin ID and role stored in session
- Prevents self-deletion
- Protects primary admin account

### Input Validation
- Server-side validation for all inputs
- SQL injection prevention using prepared statements
- XSS prevention with proper escaping

### Access Control
- Only logged-in admins can access management features
- Unauthorized access returns 401 error

## Database Schema

The feature uses the existing `adminpanel` table:
```sql
CREATE TABLE `adminpanel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
);
```

## Files Modified/Created

### New Files:
- `admin_actions.php` - Handles all admin management operations

### Modified Files:
- `admin_dashboard.php` - Added admin management UI and JavaScript
- `admin-login.php` - Enhanced session management
- `AdminCss/Dashboard.css` - Added styling for admin management

## Usage Instructions

1. **Login as Admin**: Use existing admin credentials
2. **Navigate**: Click "Admin Management" in the sidebar
3. **Add Admin**: Click "Add New Admin" button and fill the form
4. **Delete Admin**: Click the trash icon and confirm
5. **View List**: Admin list loads automatically when you visit the section

## API Endpoints

### GET Requests:
- `admin_actions.php?action=get_admins` - Returns list of all admins

### POST Requests:
- `admin_actions.php` with `action=add_admin` - Adds new admin
- `admin_actions.php` with `action=delete_admin` - Deletes admin
- `admin_actions.php` with `action=edit_admin` - Edits admin (future)

## Error Handling

The system provides user-friendly error messages for:
- Invalid email format
- Duplicate username/email
- Short passwords
- Database errors
- Unauthorized access
- Self-deletion attempts
- Primary admin deletion attempts

## Future Enhancements

1. **Edit Admin Functionality**: Allow updating admin details
2. **Password Reset**: Allow admins to reset passwords
3. **Role-based Permissions**: Different access levels for different roles
4. **Audit Log**: Track admin management actions
5. **Bulk Operations**: Add/delete multiple admins at once 