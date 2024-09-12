<?php
session_start();
include('db.php');

// Redirect if not logged in as student
if ($_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

// Check if required POST data is set
if (!isset($_POST['destination']) || !isset($_POST['amount']) || !isset($_POST['start_date']) || !isset($_POST['end_date'])) {
    echo "Incomplete form submission.";
    exit();
}

// Get form data
$student_id = $_SESSION['user_id'];
$destination = $_POST['destination'];
$amount = $_POST['amount'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// Static account details for payment
$static_account = [
    'account_name' => 'College Transport Department',
    'account_number' => '1234567890',
    'ifsc_code' => 'COLLEGE001',
];

// Here, we'll simulate the payment process.
// In a real-world scenario, you'd integrate with a payment gateway.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Payment Confirmation</h1>
            <p>Please review your details and confirm the payment:</p>
            <table class="table is-fullwidth">
                <tr>
                    <th>Destination</th>
                    <td><?php echo htmlspecialchars($destination); ?></td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td><?php echo htmlspecialchars($amount); ?> INR</td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td><?php echo htmlspecialchars($start_date); ?></td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td><?php echo htmlspecialchars($end_date); ?></td>
                </tr>
            </table>

            <h2 class="subtitle">Static Account Details</h2>
            <p>Account Name: <?php echo htmlspecialchars($static_account['account_name']); ?></p>
            <p>Account Number: <?php echo htmlspecialchars($static_account['account_number']); ?></p>
            <p>IFSC Code: <?php echo htmlspecialchars($static_account['ifsc_code']); ?></p>

            <form method="POST" action="payment_success.php">
                <input type="hidden" name="destination" value="<?php echo htmlspecialchars($destination); ?>">
                <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
                <input type="hidden" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                <input type="hidden" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
                <button class="button is-link" type="submit">Confirm Payment</button>
            </form>
        </div>
    </section>
</body>
</html>
