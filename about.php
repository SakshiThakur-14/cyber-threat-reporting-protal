<?php
$pageTitle = "About Us - Cyber Threat Reporting Portal";
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
    line-height:1.6;
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
    list-style:none;
    display:flex;
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
    padding:80px 20px;
    background:linear-gradient(rgba(0,0,0,.7),rgba(0,0,0,.7));
}

.hero h1{
    font-size:48px;
    color:#00d9ff;
    margin-bottom:15px;
}

.hero p{
    max-width:800px;
    margin:auto;
    font-size:18px;
}

.container{
    width:90%;
    max-width:1200px;
    margin:40px auto;
}

.card{
    background:#112240;
    padding:30px;
    border-radius:10px;
    margin-bottom:25px;
}

.card h2{
    color:#00d9ff;
    margin-bottom:15px;
}

.features{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.feature-box{
    background:#112240;
    padding:25px;
    border-radius:10px;
    text-align:center;
    transition:0.3s;
}

.feature-box:hover{
    transform:translateY(-8px);
}

.feature-box h3{
    color:#00d9ff;
    margin-bottom:10px;
}

.counter-section{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:20px;
    margin-top:30px;
}

.counter-box{
    background:#112240;
    padding:25px;
    width:250px;
    text-align:center;
    border-radius:10px;
}

.counter-box h2{
    color:#00d9ff;
    font-size:35px;
}

footer{
    background:#081221;
    text-align:center;
    padding:20px;
    margin-top:40px;
}

@media(max-width:768px){
.hero h1{
    font-size:35px;
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
        <li><a href="report.php">Report</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</nav>

<section class="hero">
    <h1>About Cyber Threat Reporting Portal</h1>
    <p>
        A modern platform designed to help citizens, organizations,
        and security teams report, monitor, and manage cyber threats
        efficiently and securely.
    </p>
</section>

<div class="container">

    <div class="card">
        <h2>Our Mission</h2>
        <p>
            Our mission is to provide a secure and user-friendly platform
            where cyber incidents can be reported quickly. We aim to
            increase cybersecurity awareness and help reduce cybercrime
            through effective reporting and monitoring.
        </p>
    </div>

    <div class="card">
        <h2>Project Objectives</h2>
        <p>
            The Cyber Threat Reporting Portal helps users report phishing,
            malware attacks, identity theft, online fraud, ransomware,
            and other cyber threats while maintaining a centralized
            database for analysis and tracking.
        </p>
    </div>

    <h2 style="text-align:center;color:#00d9ff;margin-bottom:20px;">
        Key Features
    </h2>

    <div class="features">

        <div class="feature-box">
            <h3>Threat Reporting</h3>
            <p>Report cyber incidents securely and efficiently.</p>
        </div>

        <div class="feature-box">
            <h3>Case Tracking</h3>
            <p>Track the progress of submitted complaints.</p>
        </div>

        <div class="feature-box">
            <h3>Threat Alerts</h3>
            <p>Receive updates on recent cyber threats.</p>
        </div>

        <div class="feature-box">
            <h3>Analytics Dashboard</h3>
            <p>View threat statistics and security insights.</p>
        </div>

    </div>

    <div class="counter-section">

        <div class="counter-box">
            <h2 id="reports">0</h2>
            <p>Threat Reports</p>
        </div>

        <div class="counter-box">
            <h2 id="users">0</h2>
            <p>Users Protected</p>
        </div>

        <div class="counter-box">
            <h2 id="cases">0</h2>
            <p>Cases Resolved</p>
        </div>

    </div>

</div>

<footer>
    <p>
        © <?php echo date("Y"); ?>
        Cyber Threat Reporting Portal | MCA Internship Project
    </p>
</footer>

<script>

function animateCounter(id, start, end, duration){

let obj = document.getElementById(id);
let current = start;
let range = end - start;

let increment = end > start ? 1 : -1;
let stepTime = Math.abs(Math.floor(duration / range));

let timer = setInterval(function(){

current += increment;
obj.textContent = current;

if(current == end){
clearInterval(timer);
}

}, stepTime);
}

animateCounter("reports",0,1500,2000);
animateCounter("users",0,1200,2000);
animateCounter("cases",0,980,2000);

</script>

</body>
</html>