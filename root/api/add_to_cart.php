<?php

//add to cart
//Add to cart API that allows users to add products to their cart
session_start();
require_once '../php/db_conn_users.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$productID = $data['productID'];
$quantity = $data['quantity'];

// Assuming you have a cart table and a user is logged in
$userID = $_SESSION['UserID'];

$sql = "INSERT INTO cart (userID, productID, quantity) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $userID, $productID, $quantity);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
