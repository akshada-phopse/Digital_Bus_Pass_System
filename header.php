<?php
// Check if a session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Digital Bus Pass System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <style>
        .header-title {
            font-weight: bold;
            font-size: 1.8em;
            text-align: center;
            width: 100%;
           /* background-color: #3273dc; /* Adjust background color */
            color: black;
            padding: 10px 0;
        }
        .navbar {
            background-color:beige !important; /* Adjust navbar background color */
            padding: 5px 0; /* Reduce the height */
        }
        .navbar-menu {
            justify-content: center;
        }
        .header-container {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
        }
        .content {
            margin-top: 120px; /* Adjust to make space for the fixed header and navbar */
        }
        /* Ensure navbar items are aligned correctly on small screens */
        .navbar-item {
            padding: 0.75rem 1.5rem;
        }
    </style>
</head>
<body>
    <div class="header-container">
        

        <nav class="navbar is-spaced" role="navigation" aria-label="main navigation">
            <div class="container">
                <div class="navbar-brand">
                    <!-- Brand name and burger menu -->
                    <a class="header-title" href="index.php">
                        Sanjivani Digital Bus Pass 🚍
                    </a>

                    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasic">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>

                <div id="navbarBasic" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item" href="index.php">Home</a>

                        <?php
                        if (isset($_SESSION['user_type'])) {
                            switch ($_SESSION['user_type']) {
                                case 'student':
                                    echo '
                                    <a class="navbar-item" href="create_pass.php">Create Pass</a>
                                    <a class="navbar-item" href="view_pass.php">View Pass</a>
                                    <a class="navbar-item" href="renew_pass.php">Renew old Pass</a>
                                    ';
                                    break;

                                case 'conductor':
                                    echo '
                                    <a class="navbar-item" href="scan_pass.php">Scan Student Pass</a>
                                    ';
                                    break;

                                case 'admin':
                                    echo '
                                    <a class="navbar-item" href="view_conductor.php">View Conductor</a>
                                    <a class="navbar-item" href="view_students.php">View Students</a>
                                    ';
                                    break;
                            }
                            echo '<a class="navbar-item" href="logout.php">Logout</a>';
                        } else {
                            echo '
                            <a class="navbar-item" href="login.php">Login</a>
                            <a class="navbar-item" href="register.php">Register</a>
                            ';
                        }
                        ?>
                        <a class="navbar-item" href="about.php">About Us</a>
                        <a class="navbar-item" href="contact.php">Contact for help</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="content">
        <!-- Your page content starts here -->
    </div>

    <script>
        // Burger menu toggle
        document.addEventListener('DOMContentLoaded', () => {
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            if ($navbarBurgers.length > 0) {
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }
        });
    </script>
</body>
</html>
