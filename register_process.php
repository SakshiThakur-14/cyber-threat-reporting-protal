<?php

$conn = new mysqli("localhost", "root", "", "cyberthreat_portal");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $role      = trim($_POST['role']);
    $password  = $_POST['password'];

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {

        echo "<script>
                alert('This email is already registered!');
                window.location.href='register.php';
              </script>";
        exit();

    }

    $check->close();

    // Password encryption
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare(
        "INSERT INTO users 
        (full_name, email, phone, role, password, registration_date)
        VALUES (?, ?, ?, ?, ?, NOW())"
    );

    $stmt->bind_param(
        "sssss",
        $full_name,
        $email,
        $phone,
        $role,
        $hashed_password
    );

    if ($stmt->execute()) {

        echo "<script>
                alert('Registration Successful!');
                window.location.href='login.php';
              </script>";

    } else {

        echo "Registration Failed: " . $stmt->error;

    }

    $stmt->close();
}

$conn->close();

?>
