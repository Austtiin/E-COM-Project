<?php
require '../php/db_conn_products.php';

header('Content-Type: application/json');

$sql = "SELECT `product`.`productID`,
    `product`.`productName`,
    `product`.`productPrice`,
    `product`.`productIMG`,
    `product`.`productDesc`,
    `product`.`productCategory`,
    `product`.`productStock`
FROM `products`.`product`;";

$result = $conn->query($sql);

$products = array();

// Check if the query was successful
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        // If no rows were returned, send an empty array
        $products = [];
    }
} else {
    // If the query failed, log the error and return a 500 response
    http_response_code(500);
    echo json_encode(['error' => 'Failed to get products from database.']);
    exit;
}

echo json_encode($products);

$conn->close();

