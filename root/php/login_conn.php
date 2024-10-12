<?php
session_start();
require_once './db_conn_users.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a select statement
    $stmt = $conn->prepare("SELECT UserID, passwordHash FROM users.users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($UserID, $passwordHash);
        $stmt->fetch();

        $passwordHash = password_hash($passwordHash, PASSWORD_DEFAULT);
        //if the password is verified, the user will be logged in
        if (password_verify($password, $passwordHash)) {
            $_SESSION['username'] = $username;
            $_SESSION['UserID'] = $UserID;
            echo json_encode(['success' => true, 'message' => 'Login successful']);

        //else if the password is invalid, the user will be prompted to enter a valid password
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid password', 'retrieved_password' => $passwordHash]);
        }

        //else if the username is invalid, the user will be prompted to enter a valid username
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username', 'retrieved_username' => $username]);
    }


    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php");
    exit();
}
