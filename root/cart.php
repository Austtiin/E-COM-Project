<?php
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assume you have a session variable for the cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productID = intval($_POST['productID']);
    $quantity = intval($_POST['quantity']);
    $deliveryMethod = $_POST['deliveryMethod'];

    // Add the product to the cart
    $_SESSION['cart'][] = [
        'productID' => $productID,
        'quantity' => $quantity,
        'deliveryMethod' => $deliveryMethod
    ];

    // Redirect to a confirmation or cart view page
    header('Location: cart_view.php'); // Create this page to show cart details
    exit;
}
