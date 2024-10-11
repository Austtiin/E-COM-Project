<?php
$servername = "e-com-dev-mysql.mysql.database.azure.com";
$username = "AdminAustin";
$password = "Baseball00!";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM `users`.`users` WHERE Username = '$username' AND PasswordHash='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Invalid email or password.";
}

$conn->close();
