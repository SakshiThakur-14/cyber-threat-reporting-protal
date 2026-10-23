
<?php
$pageTitle = "Contact Us - Cyber Threat Reporting Portal";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $pageTitle; ?></title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0b1320;
            color: white;
            min-height: 100vh;
        }

        /* Navigation */
        nav {
            background: #081221;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            color: #00d9ff;
            font-size: 25px;
            font-weight: bold;
        }

        nav ul {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 20px;
            flex-wrap: wrap;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        nav ul li a:hover {
            color: #00d9ff;
        }

        /* Main Contact Section */
        .contact-section {
            max-width: 1150px;
            width: 90%;
            margin: 55px auto;
        }

        .page-heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .page-heading h1 {
            color: #00d9ff;
            font-size: 36px;
            margin-bottom: 12px;
        }

        .page-heading p {
            color: #bdc9d8;
            line-height: 1.7;
        }

        .contact-layout {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 30px;
            align-items: stretch;
        }

        /* Left Contact Information */
        .contact-info {
            background: #111e30;
            padding: 35px 30px;
            border: 1px solid #20344c;
            border-radius: 12px;
        }

        .contact-info h2 {
            color: #00d9ff;
            font-size: 25px;
            margin-bottom: 15px;
        }

        .info-intro {
            color: #c4cfdd;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .info-item {
            display: flex;
            gap: 15px;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .info-icon {
            min-width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0b2b3a;
            border: 1px solid #164b60;
            border-radius: 8px;
            font-size: 21px;
        }

        .info-item h3 {
            color: white;
            font-size: 16px;
            margin-bottom: 7px;
        }

        .info-item p {
            color: #bdc9d8;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .info-note {
            background: #0b2634;
            border-left: 3px solid #00d9ff;
            padding: 15px;
            margin-top: 10px;
            color: #d4e4ef;
            line-height: 1.7;
            border-radius: 4px;
        }

        /* Right Contact Form */
        .contact-form {
            background: #111e30;
            padding: 35px 30px;
            border: 1px solid #20344c;
            border-radius: 12px;
        }

        .contact-form h2 {
            color: #00d9ff;
            font-size: 25px;
            margin-bottom: 12px;
        }

        .form-description {
            color: #bdc9d8;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 13px;
            background: #0b1320;
            border: 1px solid #34465d;
            border-radius: 6px;
            color: white;
            font-size: 15px;
            font-family: Arial, sans-serif;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #00d9ff;
            box-shadow: 0 0 5px rgba(0, 217, 255, 0.15);
        }

        .form-group textarea {
            min-height: 140px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 6px;
            background: #00d9ff;
            color: #081221;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background: #00b8d9;
            transform: translateY(-1px);
        }

        /* Footer */
        footer {
            background: #081221;
            color: #aab7c8;
            text-align: center;
            padding: 22px;
            margin-top: 50px;
        }

        /* Mobile Responsive */
        @media (max-width: 800px) {
            nav {
                justify-content: center;
            }

            nav ul {
                justify-content: center;
            }

            .contact-layout {
                grid-template-columns: 1fr;
            }

            .page-heading h1 {
                font-size: 30px;
            }

            .contact-info,
            .contact-form {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">CyberSecure</div>

        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="threat.php">Threat Reports</a></li>
            <li><a href="alert.php">Threat Alerts</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>

    <!-- Contact Section -->
    <section class="contact-section">

        <div class="page-heading">
            <h1>Contact Us</h1>
            <p>
                Have a question or need assistance?
                We are here to help you.
            </p>
        </div>

        <div class="contact-layout">

            <!-- LEFT SIDE: CONTACT INFORMATION -->
            <div class="contact-info">

                <h2>Contact Information</h2>

                <p class="info-intro">
                    You can contact us for assistance with cyber
                    threat reporting, technical problems, or general
                    questions about our portal.
                </p>

                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div>
                        <h3>Our Portal</h3>
                        <p>Cyber Threat Reporting Portal</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div>
                        <h3>Email Address</h3>
                        <p>support@cyberthreatportal.com</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">📞</div>
                    <div>
                        <h3>Phone Number</h3>
                        <p>+91 98765 43210</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">🕒</div>
                    <div>
                        <h3>Working Hours</h3>
                        <p>
                            Monday - Friday<br>
                            9:00 AM - 5:00 PM
                        </p>
                    </div>
                </div>

                <div class="info-note">
                    🔒 Your online safety matters to us.
                    Contact our team if you need help using
                    the Cyber Threat Reporting Portal.
                </div>

            </div>

            <!-- RIGHT SIDE: CONTACT FORM -->
            <div class="contact-form">

                <h2>Send Us a Message</h2>

                <p class="form-description">
                    Fill in the details below and send your message.
                </p>

                <form
                    id="contactForm"
                    action="contact_process.php"
                    method="POST"
                >

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Enter your full name"
                            minlength="3"
                            maxlength="100"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email address"
                            maxlength="100"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            placeholder="Enter message subject"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea
                            id="message"
                            name="message"
                            placeholder="Write your message here..."
                            required
                        ></textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        Send Message
                    </button>

                </form>

            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        &copy; 2026 Cyber Threat Reporting Portal.
        All Rights Reserved.
    </footer>

</body>
</html>
