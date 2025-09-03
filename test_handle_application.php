<?php
/**
 * Test the handle_application.php file directly
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    die("Error: No admin session. Please log in first.");
}

echo "<h2>Test handle_application.php</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px;'>";

try {
    echo "<h3>Step 1: Check File Existence</h3>";
    if (file_exists('handle_application.php')) {
        echo "✅ handle_application.php exists<br>";
    } else {
        echo "❌ handle_application.php not found<br>";
        exit;
    }
    
    echo "<h3>Step 2: Check File Permissions</h3>";
    if (is_readable('handle_application.php')) {
        echo "✅ handle_application.php is readable<br>";
    } else {
        echo "❌ handle_application.php is not readable<br>";
        exit;
    }
    
    echo "<h3>Step 3: Check File Size</h3>";
    $fileSize = filesize('handle_application.php');
    echo "File size: " . $fileSize . " bytes<br>";
    
    echo "<h3>Step 4: Check File Content</h3>";
    $content = file_get_contents('handle_application.php');
    if ($content) {
        echo "✅ File content can be read<br>";
        echo "Content length: " . strlen($content) . " characters<br>";
        
        // Check for common issues
        if (strpos($content, '<?php') === 0) {
            echo "✅ File starts with PHP tag<br>";
        } else {
            echo "❌ File doesn't start with PHP tag<br>";
        }
        
        if (strpos($content, 'function sendCongratulationsEmail') !== false) {
            echo "✅ Email function found<br>";
        } else {
            echo "❌ Email function not found<br>";
        }
        
        if (strpos($content, 'function sendToGoogleSheets') !== false) {
            echo "✅ Google Sheets function found<br>";
        } else {
            echo "⚠️ Google Sheets function not found (optional)<br>";
        }
        
    } else {
        echo "❌ Cannot read file content<br>";
        exit;
    }
    
    echo "<h3>Step 5: Test PHP Syntax</h3>";
    $syntaxCheck = shell_exec('php -l handle_application.php 2>&1');
    if (strpos($syntaxCheck, 'No syntax errors') !== false) {
        echo "✅ PHP syntax is correct<br>";
    } else {
        echo "❌ PHP syntax error:<br>";
        echo "<pre>" . htmlspecialchars($syntaxCheck) . "</pre>";
    }
    
    echo "<h3>Step 6: Test Include</h3>";
    try {
        ob_start();
        include 'handle_application.php';
        ob_end_clean();
        echo "✅ File can be included successfully<br>";
    } catch (Exception $e) {
        echo "❌ Error including file: " . $e->getMessage() . "<br>";
    }
    
    echo "<h3>Step 7: Test Functions</h3>";
    if (function_exists('sendCongratulationsEmail')) {
        echo "✅ sendCongratulationsEmail function exists<br>";
    } else {
        echo "❌ sendCongratulationsEmail function not found<br>";
    }
    
    if (function_exists('sendToGoogleSheets')) {
        echo "✅ sendToGoogleSheets function exists<br>";
    } else {
        echo "⚠️ sendToGoogleSheets function not found (optional)<br>";
    }
    
    echo "<h3>🎯 Test Summary</h3>";
    echo "<p>All tests completed. If any test shows ❌, that's likely the cause of your 500 error.</p>";
    
} catch (Exception $e) {
    echo "<h3>❌ Error Found:</h3>";
    echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>This is likely the cause of your 500 error.</p>";
}

echo "</div>";
?>
