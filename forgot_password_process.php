
<?php
session_start();

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "cyberthreat_portal"
);

if ($conn->connect_error) {
    die("Database connection failed. Please try again later.");
}

$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: forgot_password.php");
    exit();
}

$email = trim($_POST["email"] ?? "");

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
        alert('Please enter a valid email address.');
        window.location.href = 'forgot_password.php';
    </script>";
    exit();
}

$stmt = $conn->prepare(
    "SELECT id FROM users WHERE email = ? LIMIT 1"
);

if (!$stmt) {
    die("Database query could not be prepared.");
}

$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>
        alert('Your account was found. Password reset is not configured yet.');
        window.location.href = 'login.php';
    </script>";
} else {
    echo "<script>
        alert('If an account exists for that email, follow the available recovery instructions.');
        window.location.href = 'forgot_password.php';
    </script>";
}

$stmt->close();
$conn->close();
exit();
?>
