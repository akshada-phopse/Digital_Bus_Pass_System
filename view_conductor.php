<?php
session_start();
include('db.php');
include('header.php');

if ($_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

$query = "SELECT * FROM conductors WHERE name LIKE '%$search%' OR username LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Conductors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <style>
        .header-1 {
            font-weight: bold;
            font-size: 1.5em;
            background-color: #f5f5f5;
        }
        .table-c {
            overflow-x: auto;
        }
        .is-pulled-right {
            margin-left: auto;
        }
    </style>
</head>
<body>

<section class="section">
    <div class="container">
        <div class="columns is-vcentered">
            <div class="column is-three-quarters">
                <h1 class="title">View Conductors</h1>
            </div>
            <div class="column is-one-quarter">
                <!-- Search Bar -->
                <form method="POST" class="field has-addons is-pulled-right">
                    <div class="control">
                        <input class="input" type="text" name="search" placeholder="Search by name or username" value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <div class="control">
                        <button class="button is-link" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-c">
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Bus No</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['bus_no']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>******</td>"; // Hide hashed password from view
                        echo "<td><a class='button is-danger' href='remove_conductor.php?id=" . htmlspecialchars($row['id']) . "'>Remove</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a class="button is-link" href="add_conductor.php">Add New Conductor</a>
    </div>
</section>

</body>
</html>
