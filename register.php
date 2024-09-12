<?php
include('header.php');
include('db.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $class = $_POST['class'];
    $roll_no = $_POST['roll_no'];
    $prn_number = $_POST['prn_number'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Ensure password is hashed

    $query = "INSERT INTO students (name, department, class, roll_no, prn_number, phone, email, address, username, password) VALUES ('$name', '$department', '$class', '$roll_no', '$prn_number', '$phone', '$email', '$address', '$username', '$password')";
    if (mysqli_query($conn, $query)) {
        echo '<p class="has-text-success">Registration successful!</p>';
    } else {
        echo '<p class="has-text-danger">Error: ' . mysqli_error($conn) . '</p>';
    }
}
?>

    <section class="section">
        <div class="container">
            <h1 class="title">Register</h1>
            <form method="POST">
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input" type="text" name="name" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Department</label>
                    <div class="control">
                        <input class="input" type="text" name="department" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Class</label>
                    <div class="control">
                        <input class="input" type="text" name="class" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Roll Number</label>
                    <div class="control">
                        <input class="input" type="text" name="roll_no" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">PRN Number</label>
                    <div class="control">
                        <input class="input" type="text" name="prn_number" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Phone</label>
                    <div class="control">
                        <input class="input" type="text" name="phone" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Address</label>
                    <div class="control">
                        <textarea class="textarea" name="address" required></textarea>
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
                        <button class="button is-link" type="submit" name="register">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
