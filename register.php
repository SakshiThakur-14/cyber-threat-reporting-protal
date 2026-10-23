<?php
$pageTitle = "Register - Cyber Threat Reporting Portal";
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
    color:#00d9ff;
    font-size:28px;
    font-weight:bold;
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

.register-section{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:85vh;
    padding:30px;
}

.register-box{
    width:100%;
    max-width:600px;
    background:#112240;
    padding:35px;
    border-radius:12px;
}

.register-box h2{
    text-align:center;
    color:#00d9ff;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:15px;
}

label{
    display:block;
    margin-bottom:5px;
}

input, select{
    width:100%;
    padding:12px;
    border:none;
    border-radius:5px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:5px;
    background:#00d9ff;
    color:black;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:white;
}

.success{
    display:none;
    text-align:center;
    margin-top:15px;
    color:#00ff99;
    font-weight:bold;
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
<li><a href="contact.php">Contact</a></li>
</ul>

</nav>

<section class="register-section">

<div class="register-box">

<h2>Create Account</h2>

<form id="registerForm" action="register_process.php" method="POST">

<div class="form-group">
<label>Full Name</label>
<input type="text" name="full_name" required>
</div>

<div class="form-group">
<label>Email Address</label>
<input type="email" name="email" required>
</div>

<div class="form-group">
<label>Phone Number</label>
<input type="text" name="phone" required>
</div>

<div class="form-group">
<label>User Role</label>
<select name="role" required>
<option value="">Select Role</option>
<option value="Citizen">Citizen</option>
<option value="Organization">Organization</option>
<option value="Security Analyst">Security Analyst</option>
</select>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" id="password" name="password" required>
</div>

<div class="form-group">
<label>Confirm Password</label>
<input type="password" id="confirmPassword" required>
</div>

<button type="submit">Register</button>

<div class="success" id="successMsg">
Registration Successful!
</div>

</form>

</div>

</section>

<footer>
<p>
© <?php echo date("Y"); ?>
Cyber Threat Reporting Portal | MCA Internship Project
</p>
</footer>

<script>

document.getElementById("registerForm")
.addEventListener("submit", function(e){

let password =
document.getElementById("password").value;

let confirmPassword =
document.getElementById("confirmPassword").value;

if(password !== confirmPassword){

e.preventDefault();
alert("Passwords do not match!");
return;
}

if(password.length < 6){

e.preventDefault();
alert("Password must be at least 6 characters.");
return;
}

document.getElementById("successMsg").style.display="block";

});

</script>

</body>
</html>