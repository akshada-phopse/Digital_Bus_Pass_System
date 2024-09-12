<?php
include('header.php');
include('db.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it is not already started
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Plain text password for admin check
    $user_type = $_POST['user_type'];

    if ($user_type == 'admin') {
        // Hardcoded admin credentials
        $admin_username = 'sanjivani_admin';
        $admin_password = 'admin@123';

        if ($username == $admin_username && $password == $admin_password) {
            $_SESSION['user_type'] = 'admin';
            $_SESSION['username'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo '<p class="has-text-danger">Invalid Admin credentials</p>';
        }
    } else {
        // Logic for Student and Conductor login
        $password_hashed = md5($password); // Ensure the password is hashed
        if ($user_type == 'student') {
            $query = "SELECT * FROM students WHERE username='$username' AND password='$password_hashed'";
        } elseif ($user_type == 'conductor') {
            $query = "SELECT * FROM conductors WHERE username='$username' AND password='$password_hashed'";
        }

        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['user_type'] = $user_type;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id']; // Set the user ID in session

            if ($user_type == 'student') {
                header("Location: student_dashboard.php");
            } elseif ($user_type == 'conductor') {
                header("Location: conductor_dashboard.php");
            }
            exit();
        } else {
            echo '<p class="has-text-danger">Invalid credentials or user type</p>';
        }
    }
}
?>

<section class="section">
    <div class="container">
        <h1 class="title">Login</h1>
        <form method="POST">
            <div class="field">
                <label class="label">Username</label>
                <div class="control">
                    <input class="input" type="text" name="username" required autocomplete="off">
                </div>
            </div>
            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input" type="password" name="password" required autocomplete="off">
                </div>
            </div>
            <div class="field">
                <label class="label">User Type</label>
                <div class="control">
                    <div class="select">
                        <select name="user_type" required>
                            <option value="student">Student</option>
                            <option value="conductor">Conductor</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-link" type="submit" name="login">Login</button>
                </div>
            </div>
        </form>
    </div>
</section>

</body>
</html>
