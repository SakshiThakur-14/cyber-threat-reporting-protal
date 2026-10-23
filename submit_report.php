<?php
/* =========================================================
   CYBER THREAT REPORTING PORTAL
   SUBMIT REPORT
   ========================================================= */

$host = "localhost";
$username = "root";
$password = "";
$database = "cyberthreat_portal";

/* CONNECT TO DATABASE */
$conn = new mysqli($host, $username, $password, $database);

/* CHECK CONNECTION */
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}


/* =========================================================
   CHECK FORM SUBMISSION
   ========================================================= */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* GET FORM DATA */

    $full_name = trim($_POST["full_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $threat_type = trim($_POST["threat_type"] ?? "");
    $incident_date = trim($_POST["incident_date"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $evidence = trim($_POST["evidence"] ?? "");


    /* VALIDATION */

    if (
        empty($full_name) ||
        empty($email) ||
        empty($threat_type) ||
        empty($incident_date) ||
        empty($description)
    ) {
        die("Please fill all required fields.");
    }


    /* =====================================================
       INSERT REPORT INTO DATABASE
       ===================================================== */

    $sql = "INSERT INTO reports
            (
                full_name,
                email,
                phone,
                threat_type,
                incident_date,
                description,
                evidence,
                status,
                priority
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', 'Medium')";


    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }


    $stmt->bind_param(
        "sssssss",
        $full_name,
        $email,
        $phone,
        $threat_type,
        $incident_date,
        $description,
        $evidence
    );


    /* =====================================================
       EXECUTE
       ===================================================== */

    if ($stmt->execute()) {

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Report Submitted</title>

            <style>

                body {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, sans-serif;
                    background: #0b1320;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 100vh;
                }

                .success-box {
                    width: 500px;
                    background: white;
                    padding: 45px;
                    border-radius: 15px;
                    text-align: center;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
                }

                .success-icon {
                    font-size: 60px;
                    color: #20c997;
                }

                h1 {
                    color: #0b1320;
                    margin-bottom: 15px;
                }

                p {
                    color: #555;
                    font-size: 17px;
                    line-height: 1.6;
                }

                .btn {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 12px 25px;
                    background: #00bcd4;
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    font-weight: bold;
                }

                .btn:hover {
                    background: #0097a7;
                }

            </style>

        </head>

        <body>

            <div class='success-box'>

                <div class='success-icon'>✓</div>

                <h1>Report Submitted Successfully!</h1>

                <p>
                    Your cyber threat report has been submitted successfully.
                    Our administrator will review your report.
                </p>

                <a href='report.php' class='btn'>
                    Submit Another Report
                </a>

                <br>

                <a href='index.php' class='btn'>
                    Back to Home
                </a>

            </div>

        </body>
        </html>
        ";

    } else {

        echo "Error submitting report: " . $stmt->error;

    }


    $stmt->close();

}

$conn->close();

?>