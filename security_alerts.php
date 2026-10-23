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

    <title>Security Alerts | Cyber Threat Portal</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0b1320;
            color: white;
        }

        header {
            background: #111c2e;
            padding: 25px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #00d9ff;
            font-size: 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-weight: bold;
        }

        nav a:hover {
            color: #00d9ff;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .heading h2 {
            color: #00d9ff;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .heading p {
            color: #b8c4d6;
        }

        .alerts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .alert-card {
            background: #162235;
            border-radius: 12px;
            padding: 25px;
            border-left: 5px solid #00d9ff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            transition: 0.3s;
        }

        .alert-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,217,255,0.2);
        }

        .alert-card h3 {
            color: #00d9ff;
            margin-bottom: 15px;
        }

        .alert-type {
            display: inline-block;
            background: #263852;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .alert-card p {
            color: #d5dce7;
            line-height: 1.6;
        }

        .date {
            margin-top: 15px;
            color: #8fa2bb;
            font-size: 13px;
        }

        .no-alerts {
            text-align: center;
            background: #162235;
            padding: 40px;
            border-radius: 12px;
            color: #b8c4d6;
        }

        footer {
            margin-top: 60px;
            padding: 20px;
            text-align: center;
            background: #111c2e;
            color: #8fa2bb;
        }
    </style>
</head>

<body>

<header>

    <h1>Cyber Threat Portal</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="report.php">Report Threat</a>
        <a href="alerts.php">Alerts</a>
        <a href="contact.php">Contact</a>
    </nav>

</header>


<div class="container">

    <div class="heading">

        <h2>Security Alerts</h2>

        <p>
            Stay informed about the latest cyber threats and security warnings.
        </p>

    </div>


    <div class="alerts">

        <?php

        if ($result && $result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

        ?>

            <div class="alert-card">

                <span class="alert-type">
                    <?php echo htmlspecialchars($row['alert_type']); ?>
                </span>

                <h3>
                    <?php echo htmlspecialchars($row['title']); ?>
                </h3>

                <p>
                    <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                </p>

                <div class="date">
                    <?php echo htmlspecialchars($row['created_at']); ?>
                </div>

            </div>

        <?php

            }

        } else {

        ?>

            <div class="no-alerts">

                <h3>No Security Alerts Available</h3>

                <p>
                    There are currently no security alerts to display.
                </p>

            </div>

        <?php

        }

        ?>

    </div>

</div>


<footer>
    © 2026 Cyber Threat Reporting Portal
</footer>

</body>
</html>

<?php
$conn->close();
?>