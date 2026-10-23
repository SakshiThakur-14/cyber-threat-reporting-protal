
<?php
session_start();

$conn = new mysqli("localhost", "root", "", "cyberthreat_portal");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $conn->close();
    header("Location: login.php");
    exit();
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    $conn->close();

    echo "<script>
        alert('Please enter email and password.');
        window.location.href='login.php';
    </script>";
    exit();
}

// Find user by email
$stmt = $conn->prepare(
    "SELECT id, full_name, email, phone, role, password
     FROM users
     WHERE email = ?"
);

if (!$stmt) {
    die("Login query error: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    $stmt->close();
    $conn->close();

    echo "<script>
        alert('No account found with this email. Please register first.');
        window.location.href='register.php';
    </script>";
    exit();
}

$user = $result->fetch_assoc();

// Verify password
if (!password_verify($password, $user['password'])) {
    $stmt->close();
    $conn->close();

    echo "<script>
        alert('Incorrect password!');
        window.location.href='login.php';
    </script>";
    exit();
}

// Successful login: create session
session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['email'] = $user['email'];
$_SESSION['role'] = $user['role'];

// Save login activity
$userId = (int) $user['id'];
$userEmail = $user['email'];
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';

$logStmt = $conn->prepare(
    "INSERT INTO login_logs
     (user_id, email, login_time, ip_address)
     VALUES (?, ?, NOW(), ?)"
);

if (!$logStmt) {
    die("Login log prepare failed: " . $conn->error);
}

$logStmt->bind_param(
    "iss",
    $userId,
    $userEmail,
    $ipAddress
);

if (!$logStmt->execute()) {
    die("Login log insert failed: " . $logStmt->error);
}

$logStmt->close();
$stmt->close();
$conn->close();

// Redirect after successful login
header("Location: index.php");
exit();
?>
