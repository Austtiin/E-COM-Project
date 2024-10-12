<?php
$servername = "e-com-dev-server.mysql.database.azure.com";
$username = "hlsguvphvt";
$password = "Baseball00!";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
