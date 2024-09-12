<?php
session_start();
include('db.php');

// Verify if user is logged in and is an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the delete query
    $query = "DELETE FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to view_students.php if deletion is successful
        header("Location: view_students.php");
        exit();
    } else {
        echo '<p class="has-text-danger">Error removing student: ' . mysqli_error($conn) . '</p>';
    }

    mysqli_stmt_close($stmt);
} else {
    echo '<p class="has-text-danger">No student ID specified.</p>';
}

mysqli_close($conn);
?>
