<?php
/**
 * Minimal test for accept functionality
 * This bypasses all complex dependencies to isolate the issue
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Testing Accept Button - Minimal Version</h2>";

// Test 1: Basic PHP
echo "✅ PHP is working<br>";

// Test 2: Check if we can access the file
echo "✅ File is accessible<br>";

// Test 3: Check if we can include database file
try {
    if (file_exists('Database/db.php')) {
        echo "✅ Database file exists<br>";
        require_once 'Database/db.php';
        echo "✅ Database file loaded<br>";
        
        $database = new Database();
        echo "✅ Database class instantiated<br>";
        
        $pdo = $database->createConnection();
        echo "✅ Database connection successful<br>";
        
        // Test a simple query
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM members");
        $result = $stmt->fetch();
        echo "✅ Database query successful. Total members: " . $result['count'] . "<br>";
        
    } else {
        echo "❌ Database file missing<br>";
    }
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

// Test 4: Check email config
try {
    if (file_exists('config/email_config.php')) {
        echo "✅ Email config file exists<br>";
        require_once 'config/email_config.php';
        echo "✅ Email config loaded<br>";
        
        if (defined('SMTP_HOST')) {
            echo "✅ SMTP_HOST defined: " . SMTP_HOST . "<br>";
        } else {
            echo "❌ SMTP_HOST not defined<br>";
        }
        
        if (defined('SMTP_USERNAME')) {
            echo "✅ SMTP_USERNAME defined: " . SMTP_USERNAME . "<br>";
        } else {
            echo "❌ SMTP_USERNAME not defined<br>";
        }
        
    } else {
        echo "❌ Email config file missing<br>";
    }
} catch (Exception $e) {
    echo "❌ Email config error: " . $e->getMessage() . "<br>";
}

// Test 5: Check PHPMailer
try {
    if (file_exists('vendor/autoload.php')) {
        echo "✅ Vendor autoload exists<br>";
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

// Test 6: Check Google Sheets integration
try {
    if (file_exists('Action/google_sheets_integration.php')) {
        echo "✅ Google Sheets file exists<br>";
        require_once 'Action/google_sheets_integration.php';
        echo "✅ Google Sheets file loaded<br>";
        
        if (function_exists('sendToGoogleSheets')) {
            echo "✅ sendToGoogleSheets function exists<br>";
        } else {
            echo "❌ sendToGoogleSheets function missing<br>";
        }
        
    } else {
        echo "⚠️ Google Sheets file missing (optional)<br>";
    }
} catch (Exception $e) {
    echo "❌ Google Sheets error: " . $e->getMessage() . "<br>";
}

echo "<h3>Summary</h3>";
echo "<p>If all tests pass, the issue might be in the form submission or session handling.</p>";
echo "<p>If any test fails, that's likely the cause of your 500 error.</p>";
?>
