<?php
session_start();
require_once './db_conn_users.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare a select statement
        $stmt = $conn->prepare("SELECT UserID, passwordHash FROM users WHERE Username = ?");
        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Database statement prep failed: ' . $conn->error]);
            exit();
        }

        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            echo json_encode(['success' => false, 'message' => 'Execution failed: ' . $stmt->error]);
            exit();
        }

        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($UserID, $passwordHash);
            $stmt->fetch();

            // For testing, compare directly
            if ($password == $passwordHash) {
                session_regenerate_id(true);
                $_SESSION['username'] = $username;
                $_SESSION['UserID'] = $UserID;
                echo json_encode(['success' => true, 'message' => 'Login successful']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid password']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username']);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Username or password not provided']);
    }
} else {
    header("Location: login.php");
    exit();
}
