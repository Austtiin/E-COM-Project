<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../php/db_conn_users.php';

header('Content-Type: application/json');

if (!isset($_SESSION['UserID'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$userID = $_SESSION['UserID'];

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'];
$newQuantity = $data['quantity'];

// Validate input
if (!isset($productId) || !isset($newQuantity) || $newQuantity < 1) {
    echo json_encode(['error' => 'Invalid input']);
    exit();
}

try {
    $sql = "UPDATE cart SET quantity = ? WHERE userID = ? AND productID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $newQuantity, $userID, $productId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error updating record']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Failed to update cart item', 'details' => $e->getMessage()]);
}

$stmt->close();
$conn->close();