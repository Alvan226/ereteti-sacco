<?php
// Connect to the Ereteti SACCO database
$conn = mysqli_connect('localhost', 'root', '', 'ereteti_web');

// Check database connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
?>