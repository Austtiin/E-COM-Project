<?php
session_start();
require './db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        echo '<script>sessionStorage.setItem("loggedin", "true"); window.location.href = "products.html";</script>';
    } else {
        echo 'Invalid credentials';
    }

    $stmt->close();
    $conn->close();
}