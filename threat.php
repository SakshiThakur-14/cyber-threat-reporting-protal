<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Report Cyber Threat</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #0b1320;
    color: white;
}

.navbar {
    background: #081221;
    padding: 15px 8%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    color: #00d9ff;
    font-size: 28px;
    font-weight: bold;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

.navbar a:hover {
    color: #00d9ff;
}

.container {
    width: 90%;
    max-width: 800px;
    margin: 40px auto;
    background: #111f33;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,.4);
}

h1 {
    text-align: center;
    color: #00d9ff;
    margin-bottom: 30px;
}

label {
    display: block;
    margin-top: 18px;
    margin-bottom: 7px;
    font-weight: bold;
}

input,
select,
textarea {
    width: 100%;
    padding: 13px;
    border: 1px solid #34495e;
    border-radius: 7px;
    background: #081626;
    color: white;
    font-size: 15px;
}

textarea {
    min-height: 140px;
    resize: vertical;
}

button {
    width: 100%;
    margin-top: 25px;
    padding: 14px;
    border: none;
    border-radius: 7px;
    background: #00d9ff;
    color: #081221;
    font-size: 17px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #00b8d9;
}

.required {
    color: #ff6b6b;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">
        Cyber Threat Portal
    </div>

    <div>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="threat.php">Report Threat</a>
        <a href="contact.php">Contact</a>
    </div>

</div>


<!-- REPORT FORM -->

<div class="container">

    <h1>Report a Cyber Threat</h1>

    <form action="submit_report.php" method="POST">

        <label>
            Full Name <span class="required">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            placeholder="Enter your full name"
            required
        >


        <label>
            Email <span class="required">*</span>
        </label>

        <input
            type="email"
            name="email"
            placeholder="Enter your email"
            required
        >


        <label>
            Phone
        </label>

        <input
            type="text"
            name="phone"
            placeholder="Enter your phone number"
        >


        <label>
            Threat Type <span class="required">*</span>
        </label>

        <select name="threat_type" required>

            <option value="">Select Threat Type</option>

            <option value="Phishing">Phishing</option>

            <option value="Online Fraud">Online Fraud</option>

            <option value="Hacking">Hacking</option>

            <option value="Identity Theft">Identity Theft</option>

            <option value="Malware">Malware</option>

            <option value="Ransomware">Ransomware</option>

            <option value="Unauthorized Access">
                Unauthorized Access
            </option>

            <option value="Other">Other</option>

        </select>


        <label>
            Incident Date <span class="required">*</span>
        </label>

        <input
            type="date"
            name="incident_date"
            required
        >


        <label>
            Threat Description <span class="required">*</span>
        </label>

        <textarea
            name="description"
            placeholder="Describe the cyber threat or incident in detail"
            required
        ></textarea>


        <label>
            Evidence
        </label>

        <input
            type="text"
            name="evidence"
            placeholder="Enter evidence details or file name"
        >


        <button type="submit">
            Submit Threat Report
        </button>

    </form>

</div>

</body>
</html>