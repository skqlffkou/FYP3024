<?php 

    include '../component/connect.php';
    session_start();

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
    <link rel="stylesheet" href="aboutUs.css" />
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
            <a href="#aboutUs">about us</a>
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
    <section class="home-abt" id="home-abt">
        <div class="content-abt">
            <h1 class="heading"> <span>about</span> us </h1>
        </div>
    </section>
    <!-- home section end -->

    <!-- about section start -->
    <section class="about" id="about">
        <h1 class="heading"> our <span>Story</span></h1>

        <div class="box-container">
            <div class="box" data-name="b-1">
            <img src="../pics/logo.jpeg" alt="" width="130" height="122" />
            <h1>D'Danau R Enterprise Logo</h1>
            <p>The logo is the official symbol of D'Danau R Enterprise. 
                It combines a thread and needle to create the letter "D", representing "D'Danau". 
                The store's name is positioned below the logo. 
                The background of the logo is black, with gold used for contrast.</p>
        </div>
  
        <div class="box" data-name="b-2">
            <img src="../pics/theme.jpeg" alt="" width="130" height="122" />
            <h1>"D'Danau R Enterprise"</h1>
            <p>The name of our store symbolizes the water in the lake that flows endlessly, just like the sustenance that Allah SWT has bestowed upon us. 
            "D'Danau" translates to "In the Lake" or "At the Lake," while "R" stands for "Rezeki," meaning "Provision" or "Sustenance." 
            This name reflects our hope for endless growth and prosperity, mirroring the constant flow of water and sustenance in nature.</p>
        </div>

    </section>
    <!-- about section end -->

        <!-- team section start -->
        <section class="team" id="team">
        <h1 class="heading"> our <span>team</span></h1>
    
        <div class="team-box">
            <div class="profile">
                <img src="../pics/founder.png" width="240" height="241" />
                <div class="info">
                <h2 class="name">Founder</h2>
                <p class="bio">Othman Bin Zulbaidi<br />othman@gmail.com</p>
                
            
            </div>
        </div>
        
        <div class="profile">
            <img src="../pics/manager.png" width="240" height="241" />
            <div class="info">
              <h2 class="name">Manager</h2>
                <p class="bio">Siti Ayu Binti Othman<br />ayu21@gmail.com</p>
                
                
            </div>
        </div>
    </section>
    <!-- team section end -->



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