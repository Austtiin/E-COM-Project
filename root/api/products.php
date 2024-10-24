<?php
require '../php/db_conn_products.php';

header('Content-Type: application/json');

$sql = "SELECT `product`.`productID`,
    `product`.`productName`,
    `product`.`productPrice`,
    `product`.`productIMG`,
    `product`.`productDesc` AS `productDescription`,
    `product`.`productCategory`,
    `product`.`productStock`,
    `product`.`productFeature`
FROM `product`;";

$result = $conn->query($sql);

$products = array();

// Check if successful
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        $products = [];
    }
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to get products from the database.']);
    exit;
}

echo json_encode($products);

$conn->close();
