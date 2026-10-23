<?php
$pageTitle = "Report Threat - Cyber Threat Reporting Portal";
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

.hero{
    text-align:center;
    padding:60px 20px;
}

.hero h1{
    color:#00d9ff;
    margin-bottom:15px;
    font-size:42px;
}

.container{
    width:90%;
    max-width:1000px;
    margin:20px auto 50px;
}

.form-box{
    background:#112240;
    padding:35px;
    border-radius:12px;
}

.form-box h2{
    color:#00d9ff;
    margin-bottom:25px;
}

.row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

input,
select,
textarea{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    margin-bottom:15px;
    font-size:15px;
}

textarea{
    resize:none;
    height:120px;
}

button{
    background:#00d9ff;
    color:black;
    border:none;
    padding:12px 25px;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
}

button:hover{
    background:white;
}

.success{
    display:none;
    color:#00ff99;
    margin-top:15px;
    font-weight:bold;
}

footer{
    background:#081221;
    text-align:center;
    padding:20px;
}

@media(max-width:768px){

.row{
    grid-template-columns:1fr;
}

.hero h1{
    font-size:32px;
}

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
<li><a href="contact.php">Contact</a></li>
</ul>

</nav>

<section class="hero">
<h1>Report a Cyber Threat</h1>
<p>Submit cyber incidents securely for investigation and tracking.</p>
</section>

<div class="container">

<div class="form-box">

<h2>Threat Report Form</h2>

<form id="reportForm" action="submit_report.php" method="POST" enctype="multipart/form-data">

<div class="row">

<div>
<label>Full Name</label>
<input type="text" name="full_name" required>
</div>

<div>
<label>Email Address</label>
<input type="email" name="email" required>
</div>

</div>

<div class="row">

<div>
<label>Phone Number</label>
<input type="text" name="phone" required>
</div>

<div>
<label>Threat Type</label>
<select name="threat_type" required>
<option value="">Select Threat</option>
<option>Phishing</option>
<option>Malware</option>
<option>Ransomware</option>
<option>Identity Theft</option>
<option>Data Breach</option>
<option>Online Fraud</option>
<option>Other</option>
</select>
</div>

</div>

<label>Incident Date</label>
<input type="date" name="incident_date" required>

<label>Threat Description</label>
<textarea name="description" placeholder="Describe the cyber incident..." required></textarea>

<label>Upload Evidence</label>
<input type="file" name="evidence">

<button type="submit">Submit Report</button>

<div class="success" id="successMsg">
Threat Report Submitted Successfully!
</div>

</form>

</div>

</div>

<footer>
<p>
© <?php echo date("Y"); ?>
Cyber Threat Reporting Portal | MCA Internship Project
</p>
</footer>

<script>

document.getElementById("reportForm")
.addEventListener("submit", function(e){

let email =
document.querySelector('input[name="email"]').value;

if(email.indexOf("@") === -1){

e.preventDefault();
alert("Please enter a valid email address.");

return;
}

document.getElementById("successMsg").style.display="block";

});

</script>

</body>
</html>