<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../php/db_conn_users.php';

header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$userID = $_SESSION['UserID'];

try {
    $sql = "SELECT cart.id, cart.userID, cart.productID, cart.quantity, products.productName, products.productPrice
            FROM cart
            JOIN products ON cart.productID = products.productID
            WHERE cart.userID = ?;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    $cartItems = [];
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }

    echo json_encode($cartItems);
} catch (Exception $e) {
    echo json_encode(['error' => 'Failed to retrieve cart items', 'details' => $e->getMessage()]);
}

$stmt->close();
$conn->close();
