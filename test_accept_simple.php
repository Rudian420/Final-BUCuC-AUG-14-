<?php
/**
 * Simple test to identify the 500 error on Hostinger
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Testing Accept Functionality</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px;'>";

// Test 1: Basic PHP
echo "<h3>1. Basic PHP Test</h3>";
echo "✅ PHP is working<br>";
echo "PHP Version: " . phpversion() . "<br>";

// Test 2: Session
echo "<h3>2. Session Test</h3>";
session_start();
if (isset($_SESSION["admin"])) {
    echo "✅ Admin session exists<br>";
} else {
    echo "❌ No admin session - this might be the issue!<br>";
    echo "Please log in as admin first.<br>";
}

// Test 3: Check if files exist
echo "<h3>3. File Existence Test</h3>";
$files = [
    'Database/db.php',
    'config/email_config.php', 
    'vendor/autoload.php',
    'handle_application.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "✅ $file exists<br>";
    } else {
        echo "❌ $file missing<br>";
    }
}

// Test 4: Database connection
echo "<h3>4. Database Connection Test</h3>";
try {
    if (file_exists('Database/db.php')) {
        require_once 'Database/db.php';
        $database = new Database();
        $pdo = $database->createConnection();
        echo "✅ Database connection successful<br>";
    } else {
        echo "❌ Database file missing<br>";
    }
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

// Test 5: Email configuration
echo "<h3>5. Email Configuration Test</h3>";
try {
    if (file_exists('config/email_config.php')) {
        require_once 'config/email_config.php';
        echo "✅ Email config loaded<br>";
        
        if (defined('SMTP_HOST') && defined('SMTP_USERNAME') && defined('SMTP_PASSWORD')) {
            echo "✅ Email constants defined<br>";
        } else {
            echo "❌ Email constants missing<br>";
        }
    } else {
        echo "❌ Email config file missing<br>";
    }
} catch (Exception $e) {
    echo "❌ Email config error: " . $e->getMessage() . "<br>";
}

// Test 6: PHPMailer
echo "<h3>6. PHPMailer Test</h3>";
try {
    if (file_exists('vendor/autoload.php')) {
        require_once 'vendor/autoload.php';
        echo "✅ Vendor autoload loaded<br>";
        
        if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            echo "✅ PHPMailer class exists<br>";
        } else {
            echo "❌ PHPMailer class missing<br>";
        }
    } else {
        echo "❌ Vendor autoload missing<br>";
    }
} catch (Exception $e) {
    echo "❌ PHPMailer error: " . $e->getMessage() . "<br>";
}

// Test 7: Simulate POST request
echo "<h3>7. POST Request Simulation</h3>";
if (isset($_SESSION["admin"])) {
    echo "✅ Ready to test POST request<br>";
    echo "<form method='POST' action='handle_application.php' style='margin: 20px 0;'>";
    echo "<input type='hidden' name='action' value='accept'>";
    echo "<input type='hidden' name='member_id' value='1'>";
    echo "<button type='submit' style='background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px;'>Test Accept (Member ID: 1)</button>";
    echo "</form>";
} else {
    echo "❌ Cannot test POST - no admin session<br>";
}

echo "<h3>Summary</h3>";
echo "<p>If any test shows ❌, that's likely the cause of your 500 error.</p>";
echo "<p>Most common causes on Hostinger:</p>";
echo "<ul>";
echo "<li>Missing admin session (need to log in first)</li>";
echo "<li>Database connection issues</li>";
echo "<li>Missing email configuration</li>";
echo "<li>PHPMailer not properly installed</li>";
echo "<li>File permissions issues</li>";
echo "</ul>";

echo "</div>";
?>
