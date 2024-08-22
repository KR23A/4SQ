<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.html");
    exit();
}

$conn = new mysqli("hostname", "username", "password", "database");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    if (isset($_POST['approve'])) {
        $sql = "UPDATE users SET status='approved' WHERE id='$user_id'";
    } else if (isset($_POST['reject'])) {
        $sql = "DELETE FROM users WHERE id='$user_id'";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: admin-dashboard.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
