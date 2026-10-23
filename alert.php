<?php
$conn = new mysqli("localhost", "root", "", "cyberthreat_portal");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM security_alerts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cyber Threat Alerts</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0b1320;
            color: white;
        }

        .header {
            background: #081221;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: #00d9ff;
            font-size: 28px;
            font-weight: bold;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
        }

        .nav a:hover {
            color: #00d9ff;
        }

        .container {
            width: 85%;
            margin: 40px auto;
        }

        h1 {
            color: #00d9ff;
            text-align: center;
            margin-bottom: 30px;
        }

        .alert-card {
            background: #111d2e;
            border-left: 5px solid #00d9ff;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .alert-card h2 {
            color: #00d9ff;
            margin-top: 0;
        }

        .alert-type {
            color: #ffcc00;
            font-weight: bold;
        }

        .date {
            color: #aaa;
            font-size: 14px;
        }

        .no-alert {
            text-align: center;
            background: #111d2e;
            padding: 30px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="header">

    <div class="logo">
        Cyber Threat Portal
    </div>

    <div class="nav">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="report.php">Report Threat</a>
        <a href="alerts.php">Threat Alerts</a>
        <a href="contact.php">Contact</a>
    </div>

</div>

<div class="container">

    <h1>Cyber Threat Alerts</h1>

    <?php

    if ($result && $result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            ?>

            <div class="alert-card">

                <h2>
                    <?php echo htmlspecialchars($row['title']); ?>
                </h2>

                <p class="alert-type">
                    Alert Type:
                    <?php echo htmlspecialchars($row['alert_type']); ?>
                </p>

                <p>
                    <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                </p>

                <p class="date">
                    Published:
                    <?php echo htmlspecialchars($row['created_at']); ?>
                </p>

            </div>

            <?php
        }

    } else {

        echo '<div class="no-alert">
                No security alerts available.
              </div>';
    }

    $conn->close();

    ?>

</div>

</body>
</html>