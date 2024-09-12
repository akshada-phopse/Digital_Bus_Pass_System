<?php
session_start();
include('db.php');
include('header.php');

// Verify if user is logged in and is an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $bus_no = $_POST['bus_no'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash the password

    $query = "INSERT INTO conductors (name, bus_no, phone, address, email, username, password) VALUES ('$name', '$bus_no', '$phone', '$address', '$email', '$username', '$password')";
    if (mysqli_query($conn, $query)) {
        header("Location: view_conductor.php");
        exit();
    } else {
        echo '<p class="has-text-danger">Error adding conductor: ' . mysqli_error($conn) . '</p>';
    }
}
?>

<section class="section">
    <div class="container">
        <h1 class="title">Add New Conductor</h1>
        <form method="POST">
            <div class="field">
                <label class="label">Name</label>
                <div class="control">
                    <input class="input" type="text" name="name" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Bus No</label>
                <div class="control">
                    <input class="input" type="text" name="bus_no" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Phone</label>
                <div class="control">
                    <input class="input" type="text" name="phone" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Address</label>
                <div class="control">
                    <input class="input" type="text" name="address" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Username</label>
                <div class="control">
                    <input class="input" type="text" name="username" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input" type="password" name="password" required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-link" type="submit" name="submit">Add Conductor</button>
                </div>
            </div>
        </form>
    </div>
</section>

</body>
</html>
