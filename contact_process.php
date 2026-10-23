<?php

$conn = new mysqli("localhost", "root", "", "cyberthreat_portal");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $stmt = $conn->prepare(
        "INSERT INTO contact_messages
        (name, email, subject, message, submitted_at)
        VALUES (?, ?, ?, ?, NOW())"
    );

    $stmt->bind_param(
        "ssss",
        $name,
        $email,
        $subject,
        $message
    );

    if ($stmt->execute()) {

        echo "<script>
                alert('Message Submitted Successfully!');
                window.location.href='contact.php';
              </script>";

    } else {

        echo "Message could not be submitted: " . $stmt->error;

    }

    $stmt->close();
}

$conn->close();

?>