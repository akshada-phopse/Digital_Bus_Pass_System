<?php
session_start();
include('db.php');

// Redirect if not logged in as conductor
if ($_SESSION['user_type'] != 'conductor') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Student Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Scan Student Pass</h1>
            <div id="qr-reader" style="width: 500px;"></div>
            <div id="qr-reader-results"></div> <!-- Corrected from 'fid' to 'id' -->
        </div>
    </section>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle the scanned result here
            fetch('validate_pass.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'qr_code_data=' + encodeURIComponent(decodedText)
            })
            .then(response => response.json())
            .then(data => {
                const resultElement = document.getElementById('qr-reader-results');
                if (data.valid) {
                    resultElement.innerHTML = `<p class="has-text-success">Valid Pass</p>`;
                } else {
                    resultElement.innerHTML = `<p class="has-text-danger">Expired Pass</p>`;
                }
            })
            .catch(error => console.error('Error:', error));
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
