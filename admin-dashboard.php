<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.html");
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
        
        <!-- Product Upload Section -->
        <h2>Upload New Product</h2>
        <form action="upload-product.php" method="POST" enctype="multipart/form-data">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required><br>

            <label for="productImage">Product Image:</label>
            <input type="file" id="productImage" name="productImage" required><br>

            <label for="productPrice">Product Price:</label>
            <input type="text" id="productPrice" name="productPrice" required><br>

            <label for="productDescription">Product Description:</label>
            <textarea id="productDescription" name="productDescription" required></textarea><br>

            <label for="productFlavors">Product Flavors (comma-separated):</label>
            <input type="text" id="productFlavors" name="productFlavors" required><br>

            <button type="submit">Upload Product</button>
        </form>

        <!-- Pending User Approvals Section -->
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
                    <td><?php echo htmlspecialchars($row['firstName'] . " " . $row['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['businessName']); ?></td>
                    <td><?php echo htmlspecialchars($row['dba']); ?></td>
                    <td><?php echo htmlspecialchars($row['licenses']); ?></td>
                    <td><?php echo htmlspecialchars($row['ein']); ?></td>
                    <td>
                        <form method="POST" action="approve-user.php">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['id']); ?>">
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
