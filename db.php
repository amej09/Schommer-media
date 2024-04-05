<?php
$servername = "localhost:3006";
$username = "root";
$password = "";
$dbname = "db-projekt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
