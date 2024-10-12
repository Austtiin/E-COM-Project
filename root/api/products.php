<?php
require '../php/db_conn_products.php'; // Ensure this path is correct for your setup

header('Content-Type: application/json');

// Correct the SQL query by removing the extra comma
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

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);

$conn->close();