<?php
include 'db_connect.php';
session_start();
include 'config.php'; // This file should include your database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['ajay_ranpura@hotmail.com'];
    $password = $_POST['Yellow@22'];
    
    // Query to check if the user is an admin
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        if ($row['role'] == 'admin') {
            $_SESSION['user_type'] = 'admin';
            header('Location: admin_dashboard.php'); // Redirect to admin dashboard
            exit();
        } else {
            $_SESSION['user_type'] = 'user';
            header('Location: index.html'); // Redirect to user dashboard
            exit();
        }
    } else {
        echo "<script>alert('Invalid login credentials');</script>";
    }
}

