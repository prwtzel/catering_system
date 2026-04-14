<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // SAFE LOGIN QUERY
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // SESSION
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // GO TO DASHBOARD
        header("Location: dashboard.php");
        exit();

    } else {
        $error = "Invalid login!";
    }
}
?>