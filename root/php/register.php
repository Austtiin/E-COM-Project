<?php
session_start();
require './db_conn_users.php'; // Include the existing database connection file


$username = $_POST['username'];
$password = $_POST['password'];


$passwordHash = password_hash($password, PASSWORD_BCRYPT);


$stmt = $conn->prepare("INSERT INTO users (Username, PasswordHash) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $passwordHash);


if ($stmt->execute() === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
