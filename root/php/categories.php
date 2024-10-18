<?php
require '../php/db_conn_products.php';

header('Content-Type: application/json');

$sql = "SELECT `productCategory` FROM `products`.`product` GROUP BY `productCategory`;";


$result = $conn->query($sql);

$productCategorys = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productCategorys[] = $row;
    }
}
print_r($productCategorys);
echo json_encode($productCategorys);

$conn->close();
