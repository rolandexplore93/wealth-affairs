<?php
// Connect to the database
 $conn = new mysqli('localhost', 'root', '', 'wealth_affairs');

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>