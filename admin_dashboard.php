<?php
include('header.php');

// Verify if user is logged in and is an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<section class="section">
    <div class="container">
        <h1 class="title">Admin Dashboard</h1>
        <!-- Add admin-specific content here -->
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        <p>From here, you can manage conductors and view student information.</p>
    </div>
</section>

</body>
</html>
