<?php
include 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $venue = $_POST['venue'];
    $guests = $_POST['guests'];
    $event_date = $_POST['event_date'];
    $event_type = $_POST['event_type'];

    $sql1 = "INSERT INTO customers (name, contact) VALUES ('$name', '$contact')";
    if (!$conn->query($sql1)) {
        die("Customer Error: " . $conn->error);
    }

    $customer_id = $conn->insert_id;

    $sql2 = "INSERT INTO bookings (customer_id, venue, guests, event_date, event_type)
             VALUES ('$customer_id', '$venue', '$guests', '$event_date', '$event_type')";

    if (!$conn->query($sql2)) {
        die("Booking Error: " . $conn->error);
    }

    header("Location: book.php?success=1");
exit();
}
?>