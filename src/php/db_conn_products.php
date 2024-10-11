<?php
$servername = "e-com-dev-mysql.mysql.database.azure.com";
$username = "AdminAustin";
$password = "Baseball00!";
$dbname = "products";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
