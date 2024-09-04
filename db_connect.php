<?php
// Database connection parameters
$servername = "localhost";  // Usually "localhost" if hosted locally or the server name provided by your host
$username = "4sq";
$password = "4sqdis";
$dbname = "4sqkush";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

