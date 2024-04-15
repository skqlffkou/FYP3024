<?php
include '../component/connect.php';

session_start();

$message = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone_number = $conn->real_escape_string(trim($_POST['number']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    // SQL query to insert data into the contact_messages table
    $sql = "INSERT INTO contact_messages (name, email, phone_number, message, submitted_at) VALUES (?, ?, ?, ?, NOW())";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $phone_number, $message);

    // Execute the prepared statement
    if($stmt->execute()){
        $message = "<div class='alert alert-success'>Your message has been sent successfully!</div>";
        header('location:contactUs.php');
    } else {
        // Handle error, inform the user
        $message = "<div class='alert alert-error'>There was a problem sending your message. Please try again later.</div>";
    }

    // Close statement
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ABOUT US</title>

	<!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="contactUs.css" />
</head>
<body>
    <!-- header section start -->
    <header class="header">
        <!-- Logo -->
        <a href="index.php" class="logo">
            <img src="../pics/logo.jpeg" width = "100" alt="" />
        </a>

        <!-- Navigation bar -->
        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="services.php">services</a>
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                <a href="tracking.php">tracking</a>
            <?php endif; ?>
            <a href="aboutUs.php">about us</a>
            <a href="#contactUs">contact Us</a>
            <a href="FAQs.php">FAQs</a>
        </nav>

        <!-- Icon -->
        <div class="icons">
            <div class="fas fa-user" id="login-icon"></div>
            <div class="fas fa-bars" id="menu-button"></div>
        </div>

        <!-- User box for login -->
        <div class="user-box">
            <div class="dropdown">

                <?php 
                
                if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                        <!-- Displayed when user is logged in -->
                        <p>Welcome, <?=$_SESSION['user_name'];?>!</p>
                        <a href="profile.php"><button class="btn">Profile</button></a>
                        <form method="post" action="logout.php">
                            <button type="submit" name="logout" class="btn">Logout</button>
                        </form>

                <?php else: ?>
                        <!-- Displayed when user is not logged in -->
                        <p>Welcome!</p>
                        <a href="login.php"><button class="btn">Login</button></a>
                        <a href="registration.php" ><button class="btn">Register</button></a>
                <?php endif; ?>
            </div>
        </div>


    </header>
    <!-- Header section end -->

    <!-- home section start -->
    <section class="home-cont" id="home-cont">
        <div class="content-cont">
            <h1 class="heading"> <span>Contact</span> us </h1>
        </div>
    </section>
    <!-- home section end -->

    <!-- contact section start -->

    <section class="contact" id="contact">
        <h1 class="heading"> <span>leave a</span> message </h1>
        <?php 
               
                if (!empty($message)) {
                    echo $message;
                }
                
                
            
            ?>
            
        
        <div class="row">
            <div class="image">
                <img src="../pics/message.jpg" alt="" width="508" height="456" />
            
            </div>
        

            <form method="POST" action="">
            <h3>get in touch</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" name="name" placeholder="Name" required />
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" name="number" placeholder="Phone Number" />
                </div>
                <div class="inputBox">
                    <span class="fa fa-paper-plane"></span>
                    <textarea name="message" placeholder="Write a Message" required></textarea>
                </div>
                <input type="submit" value="contact now" class="btn"/>
            </form>

        </div>
    </section>
    <!-- contact section end -->

    <!-- contact information start -->
    <section class="contact-info" id="contact-info">
        <h1 class="heading"> <span>contact</span> information </h1>

        <div class="map-container">
            <div class="mapBg"></div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31870.01699519255!2d101.53798371083985!3d3.1599072000000166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4f06f12bf2c3%3A0x344114d8b7defde4!2sRepeir%20Jeans!5e0!3m2!1sen!2smy!4v1708653986939!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="contactMethod">
            <div class="method">
                <article class ="text">
                    <i class="fa-solid fa-location-dot contactIcon"></i>
                    <h1 class="sub-heading">Location</h1>
                    <p class="para">D Danau R Enterprise, Lot KB-7, Jalan Cecawi 6/19a, Seksyen 6 Kota Damansara</p>
                </article>
            </div>

            <div class="method">
                <article class ="text">
                    <i class="fa-solid fa-envelope contactIcon"></i>
                    <h1 class="sub-heading">Email</h1>
                    <p class="para">ddanaurenterprise@gmail.com</p>
                </article>
            </div>
        </div>
    </section>
    <!-- contact information end -->


    <!-- Footer -->
    <footer>
        <div class = "footer-content">
            <h3>Opening Hour</h3>
            <p>10.00 am to 10.00 pm (Everyday)</p>
            <ul class = "socials">
                <li><a href="https://www.facebook.com/sitiayu21?mibextid=LQQJ4d" class="fa-brands fa-facebook"></a></li>
                <li><a href="https://www.facebook.com/sitiayu21?mibextid=LQQJ4d" class="fa-brands fa-instagram"></a></li>
            </ul>
        </div>

        <div class = "footer-bottom">
            <p>copyright &copy;2024 D'Danau R Enterprise | All rights reserved.</p>
        </div>
    </footer>
    <!-- Footer section start -->


<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- JS link -->
<script src="scripts.js"></script>

</body>
</html>