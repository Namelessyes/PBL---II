<?php
$host = "localhost";
$user = "root";  // Change this if necessary
$password = "";  // Change this if necessary
$database = "partimer_db";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
