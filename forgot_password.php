```php
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Cyber Threat Reporting Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0b1320;
            font-family: Arial, sans-serif;
            color: white;
        }

        .forgot-box {
            width: 90%;
            max-width: 420px;
            padding: 30px;
            background: #111e30;
            border: 1px solid #263b50;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 217, 255, 0.08);
        }

        h2 {
            text-align: center;
            color: #00d9ff;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            color: #c3ceda;
            line-height: 1.5;
        }

        label {
            display: block;
            margin: 20px 0 8px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #354b60;
            border-radius: 6px;
            background: #0b1320;
            color: white;
            outline: none;
        }

        input:focus {
            border-color: #00d9ff;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #00d9ff;
            color: #081221;
            font-weight: bold;
            cursor: pointer;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #00d9ff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="forgot-box">
        <h2>Forgot Password?</h2>
        <p>Enter your registered email address to recover your account.</p>

        <form action="forgot_password_process.php" method="POST">
            <label for="email">Registered Email</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your registered email"
                required
            >

            <button type="submit">Continue</button>
        </form>

        <a class="back" href="login.php">← Back to Login</a>
    </div>
</body>
</html>
```