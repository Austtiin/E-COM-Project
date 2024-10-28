<?php
require './php/db_conn_products.php';

if (!isset($_GET['id'])) {
    // Redirect or handle the error
    header('Location: dashboard.php');
    exit;
}

$productID = intval($_GET['id']);
$sql = "SELECT `productID`, `productName`, `productPrice`, `productIMG`, `productDesc`, `productFeature`, `productStock` FROM `products` WHERE `productID` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $productID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Product not found
    echo "Product not found!";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo htmlspecialchars($product['productName']); ?> - NorthStar Wholesale</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style1.css">
</head>

<body>
    <div class="container py-5">
        <h2 class="text-center"><?php echo htmlspecialchars($product['productName']); ?></h2>
        <img src="<?php echo htmlspecialchars($product['productIMG']); ?>" alt="<?php echo htmlspecialchars($product['productName']); ?>" class="img-fluid" />
        <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['productPrice']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($product['productDesc']); ?></p>
        <p><strong>Stock:</strong> <?php echo htmlspecialchars($product['productStock']); ?></p>
        <p></p><strong>Feature:</strong> <?php echo htmlspecialchars($product['productFeature']); ?></p>

        <form id="addToCartForm" action="cart.php" method="POST">
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" max="<?php echo htmlspecialchars($product['productStock']); ?>" value="1" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="deliveryMethod" class="form-label">Delivery Method:</label>
                <select id="deliveryMethod" name="deliveryMethod" class="form-select" required>
                    <option value="will_call">Will Call</option>
                    <option value="truck">Truck</option>
                    <option value="shipping">Shipping</option>
                </select>
            </div>

            <input type="hidden" name="productID" value="<?php echo htmlspecialchars($product['productID']); ?>">
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
    </div>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>