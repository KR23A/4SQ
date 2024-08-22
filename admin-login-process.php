<?php
include 'db_connect.php';
session_start();
$conn = new mysqli("hostname", "username", "password", "database");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Check if the user is an admin
    $sql = "SELECT * FROM admins WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin-dashboard.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No admin found with that email.";
    }
}
?>
