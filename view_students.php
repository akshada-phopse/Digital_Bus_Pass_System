<?php
session_start();
include('db.php');
include('header.php');

if ($_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle search functionality
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
}

$query = "SELECT * FROM students WHERE name LIKE '%$search_query%' OR department LIKE '%$search_query%' OR class LIKE '%$search_query%' OR roll_no LIKE '%$search_query%' OR prn_number LIKE '%$search_query%' OR phone LIKE '%$search_query%' OR email LIKE '%$search_query%' OR address LIKE '%$search_query%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <style>
        .table-c {
            overflow-x: auto;
        }
    </style>
    <script>
        function confirmDeletion(id) {
            if (confirm("Are you sure you want to delete this student?")) {
                window.location.href = "remove_student.php?id=" + id;
            }
        }
    </script>
</head>
<body>

<section class="section">
    <div class="container">
        <div class="level">
            <h1 class="title level-left">View Students</h1>
            <div class="level-right">
                <form method="POST" class="field has-addons">
                    <div class="control">
                        <input class="input" type="text" name="search_query" placeholder="Search students" value="<?php echo htmlspecialchars($search_query); ?>">
                    </div>
                    <div class="control">
                        <button class="button is-link" type="submit" name="search">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-c">
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Class</th>
                        <th>Roll No</th>
                        <th>PRN Number</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['class']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['roll_no']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['prn_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                        echo "<td>
                                <a class='button is-primary' href='status_student.php?id=" . htmlspecialchars($row['id']) . "'>Status</a>
                                <a class='button is-danger' href='javascript:void(0);' onclick='confirmDeletion(" . htmlspecialchars($row['id']) . ")'>Remove</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

</body>
</html>
