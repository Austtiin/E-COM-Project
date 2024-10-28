<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/php/db_conn_users.php';
if (!isset($_SESSION['UserID'])) {
    echo "You need to log in to view your cart.";
    exit();
}
ob_start();
include 'api/get_cart.php';
$cartItemsJson = ob_get_clean();
$cartItems = json_decode($cartItemsJson, true);
if (isset($cartItems['error'])) {
    echo "Error: " . htmlspecialchars($cartItems['error']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - NorthStar Wholesale</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Your Cart</h2>
        <?php if (empty($cartItems)): ?>
            <p class="text-center">Your cart is empty.</p>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($cartItems as $item): ?>
                    <div class="list-group-item">
                        <h5 class="mb-1"><?php echo htmlspecialchars($item['productName']); ?></h5>
                        <p class="mb-1">Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                        <p class="mb-1">Price: $<?php echo htmlspecialchars($item['productPrice']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="text-center mt-4">
            <a class="btn btn-primary" href="dashboard.php">Back to Shopping</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
