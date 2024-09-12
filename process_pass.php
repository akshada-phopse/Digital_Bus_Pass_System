<?php
session_start();
include('db.php');

// Redirect if not logged in as student
if ($_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

// Check if user_id is set
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set. Please log in again.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['user_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $destination = $_POST['destination'];
    $amount = $_POST['amount'];

    // Insert the bus pass details into the database
    $query = "INSERT INTO bus_passes (student_id, start_date, end_date, destination, amount) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssi", $student_id, $start_date, $end_date, $destination, $amount);

    if ($stmt->execute()) {
        // After inserting the pass, redirect to the payment page
        $_SESSION['pass_id'] = $stmt->insert_id; // Store the inserted pass ID in session
        $_SESSION['amount'] = $amount; // Store the amount in session for payment
        header("Location: payment_gateway.php"); // Redirect to the payment gateway page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Pass</title>
</head>
<body>
    <p>Processing your pass... Please wait.</p>
</body>
</html>
