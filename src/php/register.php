<?php
session_start();
require './db_conn_users.php'; // Include the existing database connection file

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (Username, PasswordHash) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $passwordHash);

// Execute the statement
if ($stmt->execute() === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();