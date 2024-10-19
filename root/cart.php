<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productID = intval($_POST['productID']);
    $quantity = intval($_POST['quantity']);
    $deliveryMethod = $_POST['deliveryMethod'];


    $_SESSION['cart'][] = [
        'productID' => $productID,
        'quantity' => $quantity,
        'deliveryMethod' => $deliveryMethod
    ];


    header('Location: cart_view.php');
    exit;
}
