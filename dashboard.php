<?php

/* =========================================================
   CYBER THREAT REPORTING PORTAL
   ADMIN DASHBOARD
   Database: cyberthreat_portal
   ========================================================= */

/* ---------- SHOW PHP ERRORS ---------- */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ---------- DATABASE CONNECTION ---------- */
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "cyberthreat_portal";

$conn = new mysqli($host, $user, $password, $database);

/* Check connection */
if ($conn->connect_error) {
    die("
        <div style='
            background:#ffe5e5;
            color:#b00020;
            padding:30px;
            margin:30px;
            border:2px solid #b00020;
            border-radius:10px;
            font-family:Arial;
        '>
            <h2>DATABASE CONNECTION ERROR</h2>
            <p>" . htmlspecialchars($conn->connect_error) . "</p>
            <p>
                Make sure MySQL is running in XAMPP and that the database
                <b>cyberthreat_portal</b> exists.
            </p>
        </div>
    ");
}

$conn->set_charset("utf8mb4");


/* =========================================================
   DELETE REPORT
   ========================================================= */

if (isset($_GET['delete_report'])) {

    $report_id = intval($_GET['delete_report']);

    if ($report_id > 0) {

        $stmt = $conn->prepare("DELETE FROM reports WHERE id = ?");
        $stmt->bind_param("i", $report_id);
        $stmt->execute();
        $stmt->close();

        header("Location: dashboard.php?message=Report deleted successfully");
        exit;
    }
}


/* =========================================================
   UPDATE REPORT STATUS
   ========================================================= */

if ($_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST['update_report'])) {

    $report_id = intval($_POST['report_id']);
    $status = $_POST['status'];

    $allowed_status = [
        "Pending",
        "Under Investigation",
        "Resolved",
        "Rejected"
    ];

    if (in_array($status, $allowed_status, true)) {

        $stmt = $conn->prepare(
            "UPDATE reports SET status = ? WHERE id = ?"
        );

        $stmt->bind_param("si", $status, $report_id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: dashboard.php?message=Report status updated");
    exit;
}


/* =========================================================
   DASHBOARD COUNTS
   ========================================================= */

/* Users */
$result = $conn->query("SELECT COUNT(*) AS total FROM users");
$row = $result->fetch_assoc();
$total_users = $row['total'];


/* Reports */
$result = $conn->query("SELECT COUNT(*) AS total FROM reports");
$row = $result->fetch_assoc();
$total_reports = $row['total'];


/* Pending reports */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM reports
     WHERE status = 'Pending'"
);

$row = $result->fetch_assoc();
$pending_reports = $row['total'];


/* Resolved reports */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM reports
     WHERE status = 'Resolved'"
);

$row = $result->fetch_assoc();
$resolved_reports = $row['total'];


/* Contact messages */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM contact_messages"
);

$row = $result->fetch_assoc();
$total_messages = $row['total'];


/* Security alerts */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM security_alerts"
);

$row = $result->fetch_assoc();
$total_alerts = $row['total'];


/* Threat reports */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM reports"
);

$row = $result->fetch_assoc();
$total_threat_reports = $row['total'];



/* Login logs */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM login_logs"
);

$row = $result->fetch_assoc();
$total_logins = $row['total'];


/* Admins */
$result = $conn->query(
    "SELECT COUNT(*) AS total
     FROM admin"
);

$row = $result->fetch_assoc();
$total_admins = $row['total'];


/* =========================================================
   RECENT REPORTS
   ========================================================= */

$reports = $conn->query(
    "SELECT
        id,
        full_name,
        email,
        phone,
        threat_type,
        incident_date,
        description,
        evidence,
        status,
        priority,
        admin_remark,
        reported_at,
        updated_at
     FROM reports
     ORDER BY id DESC
     LIMIT 10"
);


/* =========================================================
   RECENT USERS
   ========================================================= */

$users = $conn->query(
    "SELECT
        id,
        full_name,
        email,
        phone,
        role,
        registration_date
     FROM users
     ORDER BY id DESC
     LIMIT 10"
);


/* =========================================================
   RECENT LOGIN LOGS
   ========================================================= */

$login_logs = $conn->query(
    "SELECT
        id,
        user_id,
        email,
        login_time,
        ip_address
     FROM login_logs
     ORDER BY id DESC
     LIMIT 10"
);


/* =========================================================
   CONTACT MESSAGES
   ========================================================= */

$messages = $conn->query(
    "SELECT
        id,
        name,
        email,
        subject,
        message,
        submitted_at
     FROM contact_messages
     ORDER BY id DESC
     LIMIT 10"
);


/* =========================================================
   SECURITY ALERTS
   ========================================================= */

$alerts = $conn->query(
    "SELECT
        id,
        title,
        alert_type,
        description,
        created_at
     FROM security_alerts
     ORDER BY id DESC
     LIMIT 10"
);



/* =========================================================
   THREAT REPORTS
   ========================================================= */


$threat_reports = $conn->query("
    SELECT
        report_id,
        full_name,
        email,
        threat_type,
        incident_date,
        status,
        created_at
    FROM threat_reports
    ORDER BY report_id DESC
");

if (!$threat_reports) {
    die("Threat Reports Query Error: " . $conn->error);
}


if (!$threat_reports) {
    die("Threat Reports Query Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Cyber Threat Portal - Admin Dashboard</title>


<style>

/* =========================================================
   RESET
   ========================================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #eef2f7;
    color: #1e293b;
}


/* =========================================================
   SIDEBAR
   ========================================================= */

.sidebar {
    position: fixed;
    left: 0;
    top: 0;

    width: 250px;
    height: 100vh;

    background: #07111f;
    color: white;

    padding: 25px 15px;

    overflow-y: auto;
}

.logo {
    text-align: center;

    font-size: 25px;
    font-weight: bold;

    color: #00d9ff;

    margin-bottom: 35px;
}

.logo span {
    color: #ffffff;
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


/* =========================================================
   MAIN
   ========================================================= */

.main {
    margin-left: 250px;

    min-height: 100vh;

    padding: 25px;
}


/* =========================================================
   TOP BAR
   ========================================================= */

.topbar {
    background: white;

    padding: 20px 25px;

    border-radius: 12px;

    margin-bottom: 25px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    box-shadow: 0 3px 15px rgba(0,0,0,0.08);
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


/* =========================================================
   MESSAGE
   ========================================================= */

.message {
    background: #dcfce7;

    color: #166534;

    padding: 15px 20px;

    border-radius: 8px;

    margin-bottom: 20px;

    border-left: 5px solid #22c55e;
}


/* =========================================================
   STAT CARDS
   ========================================================= */

.stats {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 20px;

    margin-bottom: 30px;
}

.card {
    background: white;

    padding: 22px;

    border-radius: 12px;

    box-shadow: 0 3px 15px rgba(0,0,0,0.08);

    transition: 0.3s;
}

.card:hover {
    transform: translateY(-4px);
}

.card-title {
    color: #64748b;

    font-size: 14px;

    margin-bottom: 10px;
}

.card-number {
    font-size: 32px;

    font-weight: bold;

    color: #07111f;
}

.card-icon {
    font-size: 28px;

    margin-bottom: 8px;
}


/* =========================================================
   SECTION
   ========================================================= */

.section {
    background: white;

    border-radius: 12px;

    padding: 25px;

    margin-bottom: 30px;

    box-shadow: 0 3px 15px rgba(0,0,0,0.08);

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


/* =========================================================
   TABLE
   ========================================================= */

table {
    width: 100%;

    border-collapse: collapse;

    min-width: 850px;
}

th {
    background: #07111f;

    color: white;

    padding: 13px;

    text-align: left;

    font-size: 13px;
}

td {
    padding: 12px;

    border-bottom: 1px solid #e2e8f0;

    font-size: 13px;

    vertical-align: top;
}

tr:hover {
    background: #f8fafc;
}


/* =========================================================
   STATUS
   ========================================================= */

.status {
    display: inline-block;

    padding: 5px 10px;

    border-radius: 15px;

    font-size: 12px;

    font-weight: bold;
}

.pending {
    background: #fef3c7;
    color: #92400e;
}

.resolved {
    background: #dcfce7;
    color: #166534;
}

.investigation {
    background: #dbeafe;
    color: #1d4ed8;
}

.rejected {
    background: #fee2e2;
    color: #991b1b;
}


/* =========================================================
   PRIORITY
   ========================================================= */

.priority {
    font-weight: bold;
}

.priority.High {
    color: #dc2626;
}

.priority.Medium {
    color: #d97706;
}

.priority.Low {
    color: #16a34a;
}


/* =========================================================
   BUTTONS
   ========================================================= */

.btn {
    border: none;

    padding: 7px 12px;

    border-radius: 6px;

    cursor: pointer;

    font-size: 12px;

    text-decoration: none;

    display: inline-block;

    margin: 2px;
}

.btn-update {
    background: #0284c7;
    color: white;
}

.btn-delete {
    background: #dc2626;
    color: white;
}

.btn-update:hover {
    background: #0369a1;
}

.btn-delete:hover {
    background: #b91c1c;
}


/* =========================================================
   SELECT
   ========================================================= */

select {
    padding: 7px;

    border: 1px solid #cbd5e1;

    border-radius: 5px;

    background: white;
}


/* =========================================================
   ALERT BOX
   ========================================================= */

.alert-box {
    padding: 15px;

    border-left: 5px solid #ef4444;

    background: #fff7f7;

    margin-bottom: 12px;

    border-radius: 5px;
}

.alert-box h3 {
    color: #991b1b;

    margin-bottom: 5px;
}

.alert-type {
    font-size: 12px;

    font-weight: bold;

    color: #64748b;
}


/* =========================================================
   FOOTER
   ========================================================= */

.footer {
    text-align: center;

    padding: 25px;

    color: #64748b;

    font-size: 13px;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 1100px) {

    .stats {
        grid-template-columns:
            repeat(2, 1fr);
    }

}

@media (max-width: 700px) {

    .sidebar {
        position: relative;

        width: 100%;

        height: auto;
    }

    .main {
        margin-left: 0;
    }

    .stats {
        grid-template-columns: 1fr;
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

    <a href="#dashboard" class="active">
        <span>📊</span> Dashboard
    </a>

    <a href="#reports">
        <span>🚨</span> Reports
    </a>

    <a href="#users">
        <span>👥</span> Users
    </a>

    <a href="#threat-reports">
        <span>🛡️</span> Threat Reports
    </a>

    <a href="#alerts">
        <span>⚠️</span> Security Alerts
    </a>

    <a href="#messages">
        <span>✉️</span> Contact Messages
    </a>

    <a href="#logins">
        <span>🔐</span> Login Logs
    </a>

    <a href="index.php">
        <span>🏠</span> Frontend
    </a>

</div>


<!-- =====================================================
     MAIN CONTENT
     ===================================================== -->

<div class="main">


<!-- TOP BAR -->

<div class="topbar" id="dashboard">

    <div>

        <h1>Admin Dashboard</h1>

        <p>
            Cyber Threat Reporting Portal Management System
        </p>

    </div>

    <div class="admin-badge">
        👤 Administrator
    </div>

</div>


<?php if (isset($_GET['message'])): ?>

<div class="message">

    <?php
        echo htmlspecialchars($_GET['message']);
    ?>

</div>

<?php endif; ?>


<!-- =====================================================
     STATISTICS
     ===================================================== -->

<div class="stats">


    <div class="card">

        <div class="card-icon">👥</div>

        <div class="card-title">
            REGISTERED USERS
        </div>

        <div class="card-number">
            <?php echo $total_users; ?>
        </div>

    </div>


    <div class="card">

        <div class="card-icon">🚨</div>

        <div class="card-title">
            TOTAL REPORTS
        </div>

        <div class="card-number">
            <?php echo $total_reports; ?>
        </div>

    </div>


    <div class="card">

        <div class="card-icon">⏳</div>

        <div class="card-title">
            PENDING REPORTS
        </div>

        <div class="card-number">
            <?php echo $pending_reports; ?>
        </div>

    </div>


    <div class="card">

        <div class="card-icon">✅</div>

        <div class="card-title">
            RESOLVED REPORTS
        </div>

        <div class="card-number">
            <?php echo $resolved_reports; ?>
        </div>

    </div>


    <div class="card">

        <div class="card-icon">✉️</div>

        <div class="card-title">
            CONTACT MESSAGES
        </div>

        <div class="card-number">
            <?php echo $total_messages; ?>
        </div>

    </div>


    <div class="card">

        <div class="card-icon">⚠️</div>

        <div class="card-title">
            SECURITY ALERTS
        </div>

        <div class="card-number">
            <?php echo $total_alerts; ?>
        </div>

    </div>


    <div class="card">

        <div class="card-icon">🛡️</div>

        <div class="card-title">
            THREAT REPORTS
        </div>

        <div class="card-number">
            <?php echo $total_threat_reports; ?>
        </div>

    </div>


    <div class="card">

        <div class="card-icon">🔐</div>

        <div class="card-title">
            LOGIN RECORDS
        </div>

        <div class="card-number">
            <?php echo $total_logins; ?>
        </div>

    </div>

</div>


<!-- =====================================================
     REPORT MANAGEMENT
     ===================================================== -->

<div class="section" id="reports">

    <div class="section-header">

        <h2>🚨 Report Management</h2>

    </div>


    <table>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Threat Type</th>
            <th>Incident Date</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Action</th>

        </tr>


        <?php if ($reports && $reports->num_rows > 0): ?>

            <?php while ($report = $reports->fetch_assoc()): ?>

            <tr>

                <td>
                    <?php echo $report['id']; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($report['full_name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($report['email']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($report['threat_type']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($report['incident_date']); ?>
                </td>

                <td>

                    <span class="priority
                        <?php echo htmlspecialchars($report['priority']); ?>">

                        <?php echo htmlspecialchars($report['priority']); ?>

                    </span>

                </td>

                <td>

                    <?php

                    $status_class = "pending";

                    if ($report['status'] === "Resolved") {
                        $status_class = "resolved";
                    }
                    elseif ($report['status'] === "Under Investigation") {
                        $status_class = "investigation";
                    }
                    elseif ($report['status'] === "Rejected") {
                        $status_class = "rejected";
                    }

                    ?>

                    <span class="status <?php echo $status_class; ?>">

                        <?php echo htmlspecialchars($report['status']); ?>

                    </span>

                </td>


                <td>

                    <form method="POST"
                          style="display:inline-block;">

                        <input type="hidden"
                               name="report_id"
                               value="<?php echo $report['id']; ?>">

                        <select name="status">

                            <option value="Pending"
                                <?php
                                if ($report['status'] === "Pending")
                                    echo "selected";
                                ?>>
                                Pending
                            </option>

                            <option value="Under Investigation"
                                <?php
                                if ($report['status'] === "Under Investigation")
                                    echo "selected";
                                ?>>
                                Under Investigation
                            </option>

                            <option value="Resolved"
                                <?php
                                if ($report['status'] === "Resolved")
                                    echo "selected";
                                ?>>
                                Resolved
                            </option>

                            <option value="Rejected"
                                <?php
                                if ($report['status'] === "Rejected")
                                    echo "selected";
                                ?>>
                                Rejected
                            </option>

                        </select>

                        <button
                            type="submit"
                            name="update_report"
                            class="btn btn-update">

                            Update

                        </button>

                    </form>


                    <a
                        href="dashboard.php?delete_report=<?php echo $report['id']; ?>"
                        class="btn btn-delete"
                        onclick="return confirm('Are you sure you want to delete this report?');">

                        Delete

                    </a>

                </td>

            </tr>

            <?php endwhile; ?>

        <?php else: ?>

            <tr>

                <td colspan="8"
                    style="text-align:center;">

                    No reports found.

                </td>

            </tr>

        <?php endif; ?>

    </table>

</div>


<!-- =====================================================
     USERS
     ===================================================== -->

<div class="section" id="users">

    <div class="section-header">

        <h2>👥 Registered Users</h2>

    </div>


    <table>

        <tr>

            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Registration Date</th>

        </tr>


        <?php if ($users && $users->num_rows > 0): ?>

            <?php while ($user_row = $users->fetch_assoc()): ?>

            <tr>

                <td>
                    <?php echo $user_row['id']; ?>
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
                    <?php
                    echo htmlspecialchars(
                        $user_row['role']
                    );
                    ?>
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

                <td colspan="6"
                    style="text-align:center;">

                    No registered users found.

                </td>

            </tr>

        <?php endif; ?>

    </table>

</div>


<!-- =====================================================
     THREAT REPORTS
     ===================================================== -->

<div class="section" id="threat-reports">

    <div class="section-header">

        <h2>🛡️ Threat Reports</h2>

    </div>


    <table>

        <tr>

            <th>Report ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Threat Type</th>
            <th>Incident Date</th>
            <th>Status</th>
            <th>Created</th>

        </tr>


        <?php if ($threat_reports &&
                  $threat_reports->num_rows > 0): ?>

            <?php while (
                $threat = $threat_reports->fetch_assoc()
            ): ?>

            <tr>

                <td>
                    <?php echo $threat['report_id']; ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $threat['full_name']
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $threat['email']
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $threat['threat_type']
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $threat['incident_date']
                    );
                    ?>
                </td>

                <td>

                    <span class="status pending">

                        <?php
                        echo htmlspecialchars(
                            $threat['status']
                        );
                        ?>

                    </span>

                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $threat['created_at']
                    );
                    ?>
                </td>

            </tr>

            <?php endwhile; ?>

        <?php else: ?>

            <tr>

                <td colspan="7"
                    style="text-align:center;">

                    No threat reports found.

                </td>

            </tr>

        <?php endif; ?>

    </table>

</div>


<!-- =====================================================
     SECURITY ALERTS
     ===================================================== -->

<div class="section" id="alerts">

    <div class="section-header">

        <h2>⚠️ Security Alerts</h2>

    </div>


    <?php if ($alerts && $alerts->num_rows > 0): ?>

        <?php while ($alert = $alerts->fetch_assoc()): ?>

        <div class="alert-box">

            <h3>
                <?php
                echo htmlspecialchars(
                    $alert['title']
                );
                ?>
            </h3>

            <div class="alert-type">

                Type:
                <?php
                echo htmlspecialchars(
                    $alert['alert_type']
                );
                ?>

                &nbsp; | &nbsp;

                Date:
                <?php
                echo htmlspecialchars(
                    $alert['created_at']
                );
                ?>

            </div>

            <p style="margin-top:8px;">

                <?php
                echo nl2br(
                    htmlspecialchars(
                        $alert['description']
                    )
                );
                ?>

            </p>

        </div>

        <?php endwhile; ?>

    <?php else: ?>

        <p>No security alerts found.</p>

    <?php endif; ?>

</div>


<!-- =====================================================
     CONTACT MESSAGES
     ===================================================== -->

<div class="section" id="messages">

    <div class="section-header">

        <h2>✉️ Contact Messages</h2>

    </div>


    <table>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date</th>

        </tr>


        <?php if ($messages &&
                  $messages->num_rows > 0): ?>

            <?php while (
                $msg = $messages->fetch_assoc()
            ): ?>

            <tr>

                <td>
                    <?php echo $msg['id']; ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $msg['name']
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $msg['email']
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $msg['subject'] ?? ''
                    );
                    ?>
                </td>

                <td style="max-width:300px;">

                    <?php
                    echo nl2br(
                        htmlspecialchars(
                            $msg['message']
                        )
                    );
                    ?>

                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $msg['submitted_at']
                    );
                    ?>
                </td>

            </tr>

            <?php endwhile; ?>

        <?php else: ?>

            <tr>

                <td colspan="6"
                    style="text-align:center;">

                    No contact messages found.

                </td>

            </tr>

        <?php endif; ?>

    </table>

</div>


<!-- =====================================================
     LOGIN LOGS
     ===================================================== -->

<div class="section" id="logins">

    <div class="section-header">

        <h2>🔐 Login Activity</h2>

    </div>


    <table>

        <tr>

            <th>ID</th>
            <th>User ID</th>
            <th>Email</th>
            <th>Login Time</th>
            <th>IP Address</th>

        </tr>


        <?php if ($login_logs &&
                  $login_logs->num_rows > 0): ?>

            <?php while (
                $login = $login_logs->fetch_assoc()
            ): ?>

            <tr>

                <td>
                    <?php echo $login['id']; ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $login['user_id'] ?? ''
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $login['email'] ?? ''
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $login['login_time']
                    );
                    ?>
                </td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $login['ip_address'] ?? ''
                    );
                    ?>
                </td>

            </tr>

            <?php endwhile; ?>

        <?php else: ?>

            <tr>

                <td colspan="5"
                    style="text-align:center;">

                    No login records found.

                </td>

            </tr>

        <?php endif; ?>

    </table>

</div>


<!-- =====================================================
     FOOTER
     ===================================================== -->

<div class="footer">

    © <?php echo date("Y"); ?>
    Cyber Threat Reporting Portal |
    Admin Dashboard

</div>


</div>


</body>

</html>

<?php

/* Close database connection */
$conn->close();

?>