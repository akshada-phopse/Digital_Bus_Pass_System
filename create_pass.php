<?php
session_start();
include('db.php');

// Redirect if not logged in as student
if ($_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

// Check if user_id is set
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set. Please log in again.";
    exit();
}

// Fetch student information from the database
$student_id = $_SESSION['user_id']; // Assuming student_id is stored in session
$query = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Define destination amounts
$destination_amounts = [
    'Shrirampur' => 1200,
    'Shirdi' => 1500,
    'Nashik' => 1800
    // Add more destinations and amounts as needed
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <style>
        .form-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <section class="section">
        <div class="container">
            <div class="form-container">
                <h1 class="title">Create Bus Pass</h1>
                <form method="POST" action="payment_final.php">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control">
                            <input class="input" type="text" value="<?php echo htmlspecialchars($student['name']); ?>" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Roll No</label>
                        <div class="control">
                            <input class="input" type="text" value="<?php echo htmlspecialchars($student['roll_no']); ?>" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Department</label>
                        <div class="control">
                            <input class="input" type="text" value="<?php echo htmlspecialchars($student['department']); ?>" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Class</label>
                        <div class="control">
                            <input class="input" type="text" value="<?php echo htmlspecialchars($student['class']); ?>" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Start Date</label>
                        <div class="control">
                            <input class="input" type="date" name="start_date" id="start_date" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">End Date</label>
                        <div class="control">
                            <input class="input" type="text" name="end_date" id="end_date" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Destination</label>
                        <div class="control">
                            <div class="select">
                                <select name="destination" id="destination" required>
                                    <?php foreach ($destination_amounts as $destination => $amount): ?>
                                        <option value="<?php echo htmlspecialchars($destination); ?>">
                                            <?php echo htmlspecialchars($destination); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Amount</label>
                        <div class="control">
                            <input class="input" type="text" name="amount" id="amount" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button class="button is-link" type="submit">Proceed to Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Calculate end date and set amount
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = new Date(this.value);
            const endDate = new Date(startDate.setDate(startDate.getDate() + 30));
            document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
        });

        document.getElementById('destination').addEventListener('change', function() {
            const amounts = <?php echo json_encode($destination_amounts); ?>;
            const destination = this.value;
            const amount = amounts[destination] || 0;
            document.getElementById('amount').value = amount;
        });
    </script>
</body>
</html>
