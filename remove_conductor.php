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
    
    // JavaScript for confirmation
    echo '<script>
        if (confirm("Are you sure you want to delete this conductor?")) {
            window.location.href = "remove_conductor.php?confirm=1&id=' . $id . '";
        } else {
            window.location.href = "view_conductor.php";
        }
    </script>';
}

// Check if 'confirm' parameter is set in the URL and equals 1
if (isset($_GET['confirm']) && $_GET['confirm'] == '1') {
    $id = $_GET['id'];

    // Prepare and execute the delete query
    $query = "DELETE FROM conductors WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to view_conductor.php if deletion is successful
        header("Location: view_conductor.php");
        exit();
    } else {
        echo '<p class="has-text-danger">Error removing conductor: ' . mysqli_error($conn) . '</p>';
    }
} else {
    echo '<p class="has-text-danger">No conductor ID specified.</p>';
}

mysqli_close($conn);
?>
