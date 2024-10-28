<?php
$servername = "e-com-dev-server.mysql.database.azure.com";
$username = "hlsguvphvt";
$password = "Baseball00!";
$dbname = "nsw_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
