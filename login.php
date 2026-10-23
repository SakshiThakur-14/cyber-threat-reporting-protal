<?php
$pageTitle = "Login - Cyber Threat Reporting Portal";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $pageTitle; ?></title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#0b1320;
    color:white;
}

.navbar{
    background:#081221;
    padding:15px 8%;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    font-size:28px;
    font-weight:bold;
    color:#00d9ff;
}

.navbar ul{
    display:flex;
    list-style:none;
}

.navbar ul li{
    margin-left:20px;
}

.navbar ul li a{
    color:white;
    text-decoration:none;
}

.navbar ul li a:hover{
    color:#00d9ff;
}

.login-section{
    min-height:85vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.login-box{
    width:100%;
    max-width:450px;
    background:#112240;
    padding:35px;
    border-radius:12px;
    box-shadow:0px 0px 20px rgba(0,217,255,0.2);
}

.login-box h2{
    text-align:center;
    color:#00d9ff;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:6px;
}

.form-group input{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
}

.btn{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    background:#00d9ff;
    color:black;
    font-weight:bold;
    cursor:pointer;
}

.btn:hover{
    background:white;
}

.extra-links{
    text-align:center;
    margin-top:15px;
}

.extra-links a{
    color:#00d9ff;
    text-decoration:none;
}

.error{
    color:#ff6b6b;
    text-align:center;
    margin-top:10px;
    display:none;
}

footer{
    background:#081221;
    text-align:center;
    padding:20px;
}

@media(max-width:768px){

.navbar{
    flex-direction:column;
}

.navbar ul{
    margin-top:10px;
}

}

</style>
</head>

<body>

<nav class="navbar">

<div class="logo">CyberSecure</div>

<ul>
<li><a href="index.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="report.php">Report Threat</a></li>
<li><a href="register.php">Register</a></li>
<li><a href="login.php">Login</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>

</nav>

<section class="login-section">

<div class="login-box">

<h2>User Login</h2>

<form id="loginForm" action="login_process.php" method="POST">

<div class="form-group">
<label>Email Address</label>
<input type="email" name="email" id="email" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" id="password" required>
</div>

<button type="submit" class="btn">Login</button>

<div class="error" id="errorMsg">
Please enter valid login details.
</div>

</form>

<div class="extra-links">
<p>Don't have an account? <a href="register.php">Register Here</a></p>
<p><a href="forgot_password.php">Forgot Password?</a></p>
</div>

</div>

</section>

<footer>
<p>
© <?php echo date("Y"); ?>
Cyber Threat Reporting Portal | MCA Internship Project
</p>
</footer>

<script>

document.getElementById("loginForm")
.addEventListener("submit", function(e){

let email = document.getElementById("email").value;
let password = document.getElementById("password").value;

if(email.trim() === "" || password.trim() === ""){

e.preventDefault();

document.getElementById("errorMsg").style.display="block";

return;
}

});

</script>

</body>
</html>