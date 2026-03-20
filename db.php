<?php
$conn = new mysqli("localhost", "root", "", "catering_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
}
?>