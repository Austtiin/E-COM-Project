<?php


//Categorys.php 
//This file is used to get all the categories from the database and return them as JSON

require_once '../php/db_conn_products.php';

header('Content-Type: application/json');

$sql = "SELECT DISTINCT productCategory FROM `products`;";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['productCategory'];
    }
}

echo json_encode($categories);

$conn->close();
