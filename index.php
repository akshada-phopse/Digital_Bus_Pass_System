<?php
include('header.php');

// Check if a user is logged in
if (!isset($_SESSION['username'])) {
?>

<section class="section">
    <div class="container">
        <h1 class="title">Welcome to Sanjivani Digital Bus Pass System</h1>
        <p>This is a digital bus pass management system designed for students, conductors, and administrators.</p>

        <!-- About Us Section -->
        <section class="section">
            <h2 class="title">About Us</h2>
            <p>
                Welcome to the Sanjivani Digital Bus Pass System. Our system is designed to streamline the process of issuing and managing bus passes for students, conductors, and administrators.
            </p>
            <p>
                We aim to provide an easy-to-use, efficient, and secure platform for all users, ensuring that students have convenient access to bus passes, conductors can verify passes quickly, and administrators can manage the system with ease.
            </p>
            <p>
                Thank you for visiting our platform. We are committed to improving public transportation experiences for everyone involved.
            </p>
        </section>

        <!-- Contact Us Section -->
        <section class="section">
            <h2 class="title">Contact Us</h2>
            <p>If you have any questions, issues, or require assistance with the Sanjivani Digital Bus Pass System, feel free to reach out to us:</p>
            <ul>
                <li>Email: <a href="mailto:support@sanjivani-buspass.com">support@sanjivani-buspass.com</a></li>
                <li>Phone: +91-1234567890</li>
                <li>Address: Sanjivani College, Bus Pass Department, Pune, India</li>
            </ul>
            <p>We are here to help and ensure that your experience with our system is as smooth as possible.</p>
        </section>
    </div>
</section>

<?php
} else {
    // Redirect to the appropriate dashboard if the user is logged in
    if ($_SESSION['user_type'] == 'student') {
        header("Location: student_dashboard.php");
    } elseif ($_SESSION['user_type'] == 'conductor') {
        header("Location: conductor_dashboard.php");
    } elseif ($_SESSION['user_type'] == 'admin') {
        header("Location: admin_dashboard.php");
    }
    exit();
}
?>

</body>
</html>
