<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.html");
    exit();
}

$conn = new mysqli("hostname", "username", "password", "database");

$sql = "SELECT * FROM users WHERE status='pending'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard - Foursquare Distributors</title>
    <link rel="stylesheet" href="css/adminstyle.css">
</head>
<body>
    <div class="dashboard">
        <h1>Admin Dashboard</h1>
        <h2>Pending User Approvals</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Business Name</th>
                    <th>DBA</th>
                    <th>Licenses</th>
                    <th>EIN</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['businessName']; ?></td>
                    <td><?php echo $row['dba']; ?></td>
                    <td><?php echo $row['licenses']; ?></td>
                    <td><?php echo $row['ein']; ?></td>
                    <td>
                        <form method="POST" action="approve-user.php">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="approve">Approve</button>
                            <button type="submit" name="reject">Reject</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
