<?php
session_start();
include('db.php');

// Redirect if not logged in as student
if ($_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

// Get student ID from session
$student_id = $_SESSION['user_id'];

// Fetch the student's QR code path from the database
$query = "SELECT qr_code_path FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$qr_code_path = $student['qr_code_path'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bus Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Your Bus Pass</h1>
            <p>Below is your bus pass QR code. Please show this to the bus conductor:</p>
            <figure class="image is-128x128">
                <img src="<?php echo '/bus_pass_system/qrcodes/' . htmlspecialchars($qr_code_path); ?>" alt="QR Code">
            </figure>
        </div>
    </section>
</body>
</html>
