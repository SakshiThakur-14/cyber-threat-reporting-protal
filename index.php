<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cyber Threat Reporting Portal</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    background:#0a192f;
    color:white;
}

/* Navbar */
nav{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 8%;
    background:#081221;
    position:sticky;
    top:0;
    z-index:1000;
}

.logo{
    font-size:28px;
    font-weight:bold;
    color:#00d9ff;
}

nav ul{
    display:flex;
    list-style:none;
}

nav ul li{
    margin-left:20px;
}

nav ul li a{
    color:white;
    text-decoration:none;
    transition:0.3s;
}

nav ul li a:hover{
    color:#00d9ff;
}

/* Hero Section */
.hero{
    height:90vh;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
    url('https://images.unsplash.com/photo-1550751827-4bd374c3f58b');
    background-size:cover;
    background-position:center;
}

.hero-content h1{
    font-size:55px;
    margin-bottom:20px;
}

.hero-content p{
    font-size:20px;
    margin-bottom:25px;
}

.btn{
    padding:12px 25px;
    background:#00d9ff;
    color:black;
    text-decoration:none;
    border-radius:5px;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover{
    background:white;
}

/* Stats Section */
.stats{
    padding:60px 8%;
    text-align:center;
}

.stats h2{
    margin-bottom:40px;
}

.stat-container{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:25px;
}

.stat-box{
    background:#112240;
    padding:30px;
    width:250px;
    border-radius:10px;
}

.stat-box h3{
    font-size:35px;
    color:#00d9ff;
}

/* Features */
.features{
    padding:60px 8%;
    background:#081221;
}

.features h2{
    text-align:center;
    margin-bottom:40px;
}

.feature-container{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:25px;
}

.feature-box{
    width:300px;
    background:#112240;
    padding:25px;
    border-radius:10px;
    transition:0.3s;
}

.feature-box:hover{
    transform:translateY(-10px);
}

.feature-box h3{
    color:#00d9ff;
    margin-bottom:10px;
}

/* Alerts */
.alerts{
    padding:60px 8%;
    text-align:center;
}

.alert-box{
    background:#112240;
    margin:15px auto;
    max-width:800px;
    padding:20px;
    border-left:5px solid red;
    text-align:left;
}

/* Footer */
footer{
    background:#081221;
    text-align:center;
    padding:20px;
}

@media(max-width:768px){

.hero-content h1{
    font-size:35px;
}

nav{
    flex-direction:column;
}

nav ul{
    margin-top:10px;
}
}
</style>

</head>
<body>

<nav>
    <div class="logo">CyberSecure</div>

    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="report.php">Report Threat</a></li>
        <li><a href="alert.php">Threat Alerts</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="threat.php">Threat Reports</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</nav>

<section class="hero">
    <div class="hero-content">
        <h1>Cyber Threat Reporting Portal</h1>
        <p>Report Cyber Crimes, Phishing Attacks, Malware Incidents and Security Breaches Quickly.</p>

        <a href="report.php" class="btn">Report a Threat</a>
    </div>
</section>

<section class="stats">

<h2>Cyber Security Statistics</h2>

<div class="stat-container">

<div class="stat-box">
<h3 id="cases">0</h3>
<p>Threat Reports</p>
</div>

<div class="stat-box">
<h3 id="users">0</h3>
<p>Registered Users</p>
</div>

<div class="stat-box">
<h3 id="resolved">0</h3>
<p>Resolved Cases</p>
</div>

</div>

</section>

<section class="features">

<h2>Portal Features</h2>

<div class="feature-container">

<div class="feature-box">
<h3>Threat Reporting</h3>
<p>Submit cyber incidents securely with detailed information.</p>
</div>

<div class="feature-box">
<h3>Real-Time Alerts</h3>
<p>Receive latest cyber attack warnings and notifications.</p>
</div>

<div class="feature-box">
<h3>Case Tracking</h3>
<p>Track the status of submitted reports in real time.</p>
</div>

<div class="feature-box">
<h3>Analytics Dashboard</h3>
<p>Monitor threat trends through interactive charts.</p>
</div>

<div class="feature-box">
<h3>Evidence Upload</h3>
<p>Upload screenshots, files and supporting evidence.</p>
</div>

<div class="feature-box">
<h3>Secure Data Storage</h3>
<p>All reports are protected using advanced security measures.</p>
</div>

</div>

</section>

<section class="alerts">

<h2>Latest Threat Alerts</h2>

<div class="alert-box">
<h3>⚠️ Phishing Campaign Alert</h3>
<p>Users are advised not to click suspicious email links claiming to be from banks.</p>
</div>

<div class="alert-box">
<h3>⚠️ Ransomware Warning</h3>
<p>Multiple organizations reported ransomware attacks this week.</p>
</div>

<div class="alert-box">
<h3>⚠️ Fake Job Scam</h3>
<p>Cyber criminals are targeting job seekers through fake recruitment emails.</p>
</div>

</section>

<footer>
<p>© <?php echo date("Y"); ?> Cyber Threat Reporting Portal | MCA Internship Project</p>
</footer>

<script>

// Animated Counter

function animateValue(id,start,end,duration){

let obj=document.getElementById(id);
let range=end-start;
let current=start;
let increment=end>start ? 1 : -1;
let stepTime=Math.abs(Math.floor(duration/range));

let timer=setInterval(function(){

current+=increment;
obj.innerHTML=current;

if(current==end){
clearInterval(timer);
}

},stepTime);

}

animateValue("cases",0,1250,2000);
animateValue("users",0,850,2000);
animateValue("resolved",0,980,2000);

</script>

</body>
</html>