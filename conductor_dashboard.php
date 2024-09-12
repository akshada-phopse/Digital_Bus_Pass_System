<?php
include('header.php');

// Verify if user is logged in and is a conductor
if ($_SESSION['user_type'] != 'conductor') {
    header("Location: login.php");
    exit();
}

// Check if a session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<section class="section">
    <div class="container">
        <h1 class="title">Conductor Dashboard</h1>
        <!-- Add conductor-specific content here -->
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        <p>From here, you can scan student bus passes.</p>
    </div>
</section>

</body>
</html>
