<?php
include('header.php');

// Redirect if not logged in as student
if ($_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
</head>
<body>

<section class="section">
    <div class="container">
        <h1 class="title">Welcome, <?php echo $_SESSION['username']; ?></h1>
        <!-- Add student dashboard content -->
    </div>
</section>

</body>
</html>
