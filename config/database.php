<?php
// Include constants file
require_once 'constants.php';

// Attempt to connect to MySQL database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can set the character set to UTF-8 (recommended)
$conn->set_charset('utf8');

// Now $conn can be used for your database queries
?>
