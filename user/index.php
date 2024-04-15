<?php 

    include '../component/connect.php';

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>D'DANAU R ENTERPRISE</title>

	<!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="index.css" />
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
            <a href="#home">home</a>
            <a href="services.php">services</a>
            <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                <a href="tracking.php">tracking</a>
            <?php endif; ?>
            <a href="aboutUs.php">about us</a>
            <a href="contactUs.php">contact Us</a>
            <a href="FAQs.php">FAQs</a>
        </nav>

        <!-- Icon -->
        <div class="icons">
            <div class="fas fa-user" id="login-icon"></div>
            <!-- <div class="fas fa-search" id="search-btn"></div> -->
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
    <section class="home" id="home">
        <div class="content">
            <h3>
                <span class="text1">D'Danau</span> 
                <br /> 
                <span class="text2">Clothes Alteration</span>
            </h3>
            <p> Welcome to D'Danau Clothes Alteration App! 
                We're thrilled to have you here. 
                Whether you're looking to resize, repair, or customize your garments, we've got you covered. Happy altering!</p>
  
            <a href="services.php" class="btn">EXPLORE MORE</a>
        </div>
    </section>
    <!-- home section end -->

    <!-- service section start -->
    <section class="our-service" id="our-service">
        <h1 class="heading"> our <span>services</span></h1>

        <div class="swiper menu-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide" data-name="alt-1">
                    <img src="../pics/basic.png">
                    <h3>Basic Alteration</h3>
                </div>

                <div class="swiper-slide slide" data-name="alt-2">
                    <img src="../pics/primeum.png">
                    <h3>Premium Alteration</h3>
                </div>

                <div class="swiper-slide slide" data-name="alt-3">
                    <img src="../pics/school.png">
                    <h3>School Alteration</h3>
                </div>

                <div class="swiper-slide slide" data-name="alt-4">
                    <img src="../pics/curtain.png">
                    <h3>Curtain</h3>
                </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>
    

    <div class="button-service">
        <a href="services.php" class="btn">discover more</a>
    </div>
    </section>
    <!-- services section end -->

    <!-- About Us section start -->
    <section class="home-abt" id="home-abt">
        <h1 class="heading"> <span>about</span> us </h1>

        <div class="abt-row">
            <div class="image">
                <img src="../pics/banner.jpeg" alt=""/>
            </div>

            <div class="abt-content">
                <h3>D'Danau R Enterprise</h3>
                <p>Welcome to D'Danau Clothes Alteration App! 
                    We're here to make your clothes fit perfectly, easily, and quickly. 
                    Our app connects you with expert tailors who can alter your clothes just the way you want. 
                    Whether it's a small fix or a big change, we're all about helping you look your best. 
                    Thanks for choosing us for your alteration needs. 
                    We can't wait to get started on making your clothes just right for you.
                </p>

                <a href="aboutUs.php" class="abt-btn">Learn More</a>

            </div>
        </div>
    </section>
    <!-- About Us section end -->

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