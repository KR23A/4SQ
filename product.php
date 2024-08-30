<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if (!$product) {
        echo "Product not found!";
        exit();
    }
} else {
    echo "No product ID specified!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="product-page">
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p>Price: <a href="login.html" class="login-to-view-price-btn">Login to view price</a></p>
        <label for="productFlavors">Choose a flavor:</label>
        <select id="productFlavors">
            <?php 
                $flavors = explode(',', $product['flavors']);
                foreach ($flavors as $flavor) {
                    echo "<option value='" . htmlspecialchars($flavor) . "'>" . htmlspecialchars($flavor) . "</option>";
                }
            ?>
        </select>
    </div>
</body>
</html>
