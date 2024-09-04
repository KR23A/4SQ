<?php
// Database connection
include 'db_connect.php';
$conn = new mysqli("localhost", "4sqnew", "4sqdis", "4sqkush");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $businessName = $_POST['businessName'];
    $dba = $_POST['dba'];
    $licenses = $_POST['licenses'];
    $ein = $_POST['ein'];
    $profilePicture = $_FILES['profilePicture']['name'];
    
    // Save the profile picture
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
    move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file);
    
    // Insert user into the database with status 'pending'
    $sql = "INSERT INTO users (firstName, lastName, email, password, businessName, dba, licenses, ein, profilePicture, status) 
            VALUES ('$firstName', '$lastName', '$email', '$password', '$businessName', '$dba', '$licenses', '$ein', '$profilePicture', 'pending')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Your account is pending approval.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

