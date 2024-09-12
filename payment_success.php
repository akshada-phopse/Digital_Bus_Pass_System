<?php
session_start();
include('db.php');

// Redirect if not logged in as student
if ($_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

// Get POST data
$student_id = $_SESSION['user_id'];
$destination = $_POST['destination'];
$amount = $_POST['amount'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Simulate storing payment in the database
$query = "INSERT INTO payments (student_id, destination, amount, start_date, end_date, payment_date) 
          VALUES (?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($query);
$stmt->bind_param("issss", $student_id, $destination, $amount, $start_date, $end_date);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Call Python script to generate the QR code
    $command = escapeshellcmd("python C:/xampp/htdocs/bus_pass_system/scripts/generate_qr.py $student_id $destination $start_date $end_date");
    $output = shell_exec($command . " 2>&1");
    
    if (strpos($output, 'Error') === false) {
        header("Location: view_pass.php");
        exit();
    } else {
        echo "Payment was successful, but there was an error generating the QR code.";
        echo "<pre>$output</pre>"; // Debug: Output any errors or messages from Python script
    }
} else {
    echo "Payment failed. Please try again.";
}

$stmt->close();
$conn->close();
?>
