<?php
session_start();
include('db.php');

// Make sure it's a POST request
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode(['valid' => false]);
    exit();
}

// Get the QR code data from the POST request
$qr_code_data = $_POST['qr_code_data'];

// Fetch the student details from the database based on the QR code data
$query = "SELECT start_date, end_date FROM students WHERE qr_code_data = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $qr_code_data);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if ($student) {
    $current_date = date('Y-m-d');
    if ($current_date >= $student['start_date'] && $current_date <= $student['end_date']) {
        echo json_encode(['valid' => true]); // Pass is valid
    } else {
        echo json_encode(['valid' => false]); // Pass is expired
    }
} else {
    echo json_encode(['valid' => false]); // QR code not found in the database
}

$stmt->close();
$conn->close();
?>
