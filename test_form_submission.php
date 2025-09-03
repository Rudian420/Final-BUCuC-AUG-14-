<?php
/**
 * Test form submission to debug the "Invalid request method" error
 */

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check admin session
if (!isset($_SESSION["admin"])) {
    die("Error: No admin session. Please log in first.");
}

echo "<h2>Test Form Submission</h2>";
echo "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px;'>";

echo "<h3>Request Method: " . $_SERVER['REQUEST_METHOD'] . "</h3>";
echo "<h3>POST Data:</h3>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<h3>GET Data:</h3>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "<h3>Test Form:</h3>";
echo "<form method='POST' action='handle_application.php' style='margin: 20px 0;'>";
echo "<input type='hidden' name='action' value='accept'>";
echo "<input type='hidden' name='member_id' value='1'>";
echo "<button type='submit' style='background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px;'>Test Accept (Member ID: 1)</button>";
echo "</form>";

echo "<h3>Test Form (Direct to this page):</h3>";
echo "<form method='POST' action='test_form_submission.php' style='margin: 20px 0;'>";
echo "<input type='hidden' name='action' value='accept'>";
echo "<input type='hidden' name='member_id' value='1'>";
echo "<button type='submit' style='background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px;'>Test Form (Same Page)</button>";
echo "</form>";

echo "</div>";
?>
