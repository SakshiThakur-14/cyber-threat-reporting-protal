<?php
/* =========================================================
   REGISTERED USERS PAGE
   Cyber Threat Reporting Portal
   Database: cyberthreat_portal
   ========================================================= */

error_reporting(E_ALL);
ini_set('display_errors', 1);


/* ===============================
   DATABASE CONNECTION
================================ */

$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "cyberthreat_portal";

$conn = new mysqli(
    $host,
    $user,
    $password,
    $database
);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");


/* ===============================
   GET REGISTERED USERS
================================ */

$users = $conn->query("
    SELECT
        id,
        full_name,
        email,
        phone,
        role,
        registration_date
    FROM users
    ORDER BY id DESC
");

if (!$users) {
    die("Users Query Error: " . $conn->error);
}


/* ===============================
   TOTAL USERS
================================ */

$total_users = $users->num_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Registered Users | Cyber Threat Portal</title>


<style>

/* ===============================
   RESET
================================ */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


/* ===============================
   BODY
================================ */

body {
    font-family: Arial, Helvetica, sans-serif;

    background: #eef2f7;

    color: #1e293b;
}


/* ===============================
   SIDEBAR
================================ */

.sidebar {

    position: fixed;

    left: 0;
    top: 0;

    width: 250px;

    height: 100vh;

    background: #07111f;

    color: white;

    padding: 25px 15px;
}


.logo {

    text-align: center;

    font-size: 25px;

    font-weight: bold;

    color: #00d9ff;

    margin-bottom: 35px;
}


.logo span {
    color: white;
}


.sidebar a {

    display: block;

    text-decoration: none;

    color: #cbd5e1;

    padding: 14px 18px;

    margin-bottom: 8px;

    border-radius: 8px;

    transition: 0.3s;

    font-size: 15px;
}


.sidebar a:hover,
.sidebar a.active {

    background: #00bcd4;

    color: white;
}


.sidebar a span {

    margin-right: 10px;
}


/* ===============================
   MAIN
================================ */

.main {

    margin-left: 250px;

    min-height: 100vh;

    padding: 25px;
}


/* ===============================
   TOP BAR
================================ */

.topbar {

    background: white;

    padding: 20px 25px;

    border-radius: 12px;

    margin-bottom: 25px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    box-shadow:
        0 3px 15px rgba(0,0,0,0.08);
}


.topbar h1 {

    font-size: 27px;

    color: #07111f;
}


.topbar p {

    color: #64748b;

    margin-top: 5px;
}


.admin-badge {

    background: #07111f;

    color: white;

    padding: 10px 18px;

    border-radius: 25px;

    font-weight: bold;
}


/* ===============================
   USER COUNT
================================ */

.user-card {

    background: white;

    border-radius: 12px;

    padding: 25px;

    margin-bottom: 25px;

    box-shadow:
        0 3px 15px rgba(0,0,0,0.08);

    display: flex;

    align-items: center;

    gap: 20px;
}


.user-icon {

    width: 60px;

    height: 60px;

    border-radius: 50%;

    background: #e0f7fa;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 30px;
}


.user-card h3 {

    color: #64748b;

    font-size: 14px;

    margin-bottom: 5px;
}


.user-count {

    font-size: 30px;

    font-weight: bold;

    color: #07111f;
}


/* ===============================
   SECTION
================================ */

.section {

    background: white;

    border-radius: 12px;

    padding: 25px;

    box-shadow:
        0 3px 15px rgba(0,0,0,0.08);

    overflow-x: auto;
}


.section-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 20px;
}


.section-header h2 {

    font-size: 21px;

    color: #07111f;
}


/* ===============================
   TABLE
================================ */

table {

    width: 100%;

    border-collapse: collapse;

    min-width: 800px;
}


th {

    background: #07111f;

    color: white;

    padding: 14px;

    text-align: left;

    font-size: 13px;
}


td {

    padding: 13px;

    border-bottom:
        1px solid #e2e8f0;

    font-size: 13px;
}


tr:hover {

    background: #f8fafc;
}


/* ===============================
   ROLE
================================ */

.role {

    display: inline-block;

    padding: 5px 10px;

    border-radius: 15px;

    background: #e0f2fe;

    color: #0369a1;

    font-weight: bold;

    font-size: 12px;
}


/* ===============================
   EMPTY
================================ */

.empty {

    text-align: center;

    padding: 25px;

    color: #64748b;
}


/* ===============================
   FOOTER
================================ */

.footer {

    text-align: center;

    padding: 25px;

    color: #64748b;

    font-size: 13px;
}


/* ===============================
   RESPONSIVE
================================ */

@media (max-width: 700px) {

    .sidebar {

        position: relative;

        width: 100%;

        height: auto;
    }


    .main {

        margin-left: 0;
    }


    .topbar {

        flex-direction: column;

        align-items: flex-start;

        gap: 15px;
    }

}

</style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">

    <div class="logo">
        CYBER<span>THREAT</span>
    </div>


    <a href="dashboard.php">

        <span>📊</span>
        Dashboard

    </a>


    <a href="dashboard.php#reports">

        <span>🚨</span>
        Reports

    </a>


    <a href="registered_users.php"
       class="active">

        <span>👥</span>
        Registered Users

    </a>


    <a href="dashboard.php#threat-reports">

        <span>🛡️</span>
        Threat Reports

    </a>


    <a href="dashboard.php#alerts">

        <span>⚠️</span>
        Security Alerts

    </a>


    <a href="dashboard.php#messages">

        <span>✉️</span>
        Contact Messages

    </a>


    <a href="dashboard.php#logins">

        <span>🔐</span>
        Login Logs

    </a>


    <a href="index.php">

        <span>🏠</span>
        Frontend

    </a>

</div>



<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="main">


    <!-- TOP BAR -->

    <div class="topbar">

        <div>

            <h1>
                Registered Users
            </h1>

            <p>
                View all users registered on the Cyber Threat Reporting Portal.
            </p>

        </div>


        <div class="admin-badge">
            👤 Administrator
        </div>

    </div>



    <!-- USER COUNT -->

    <div class="user-card">

        <div class="user-icon">
            👥
        </div>


        <div>

            <h3>
                TOTAL REGISTERED USERS
            </h3>

            <div class="user-count">

                <?php
                echo $total_users;
                ?>

            </div>

        </div>

    </div>



    <!-- REGISTERED USERS TABLE -->

    <div class="section">

        <div class="section-header">

            <h2>
                👥 Registered Users
            </h2>

        </div>


        <table>

            <thead>

                <tr>

                    <th>
                        ID
                    </th>

                    <th>
                        Full Name
                    </th>

                    <th>
                        Email
                    </th>

                    <th>
                        Phone
                    </th>

                    <th>
                        Role
                    </th>

                    <th>
                        Registration Date
                    </th>

                </tr>

            </thead>


            <tbody>


                <?php if ($users->num_rows > 0): ?>


                    <?php while ($user_row = $users->fetch_assoc()): ?>


                    <tr>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user_row['id']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user_row['full_name']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user_row['email']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user_row['phone']
                            );
                            ?>

                        </td>


                        <td>

                            <span class="role">

                                <?php
                                echo htmlspecialchars(
                                    $user_row['role']
                                );
                                ?>

                            </span>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user_row['registration_date']
                            );
                            ?>

                        </td>


                    </tr>


                    <?php endwhile; ?>


                <?php else: ?>


                    <tr>

                        <td
                            colspan="6"
                            class="empty">

                            No registered users found.

                        </td>

                    </tr>


                <?php endif; ?>


            </tbody>

        </table>

    </div>



    <!-- FOOTER -->

    <div class="footer">

        © <?php echo date("Y"); ?>
        Cyber Threat Reporting Portal |
        Registered Users

    </div>


</div>


</body>

</html>


<?php

$conn->close();

?>