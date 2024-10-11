<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Dummy credentials for testing
    $validEmail = 'admin';
    $validPassword = '1';

    if ($email === $validEmail && $password === $validPassword) {
        $_SESSION['loggedin'] = true;
        echo '<script>sessionStorage.setItem("loggedin", "true"); window.location.href = "index.html";</script>';
    } else {
        echo 'Invalid credentials';
    }
}
?>