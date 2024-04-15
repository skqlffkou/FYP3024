<?php
// Include database connection
include '../component/connect.php';

session_start();

// Fetch all categories
$categoriesQuery = "SELECT DISTINCT category FROM alteration_services";
$categoriesResult = mysqli_query($conn, $categoriesQuery);
$categories = mysqli_fetch_all($categoriesResult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OUR SERVICES</title>

	<!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="services.css" />
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
            <a href="#services">services</a>
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
    <section class="home-services" id="home-services">
        <div class="content-services">
            <h1 class="heading"> <span>Our</span> services </h1>
        </div>
    </section>
    <!-- home section end -->

    <!-- Alteration service start -->
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
    <!-- Alteration service end -->

    <?php
    // Fetch Basic Alteration - Pants Alteration Services
    $pantsAlterationSql = "SELECT * FROM alteration_services WHERE category = 'BASIC ALTERATION' AND subcategory = 'PANTS ALTERATION'";
    $pantsAlterationResult = mysqli_query($conn, $pantsAlterationSql);
    $pantsAlterations = mysqli_fetch_all($pantsAlterationResult, MYSQLI_ASSOC);

    // Fetch Basic Alteration - T-Shirt & Shirt Alteration Services
    $shirtAlterationSql = "SELECT * FROM alteration_services WHERE category = 'BASIC ALTERATION' AND subcategory = 'T-SHIRT ALTERATION'";
    $shirtAlterationResult = mysqli_query($conn, $shirtAlterationSql);
    $shirtAlterations = mysqli_fetch_all($shirtAlterationResult, MYSQLI_ASSOC);

    // Fetch Premium Alteration - Zip Alteration Services
    $zipAlterationSql = "SELECT * FROM alteration_services WHERE category = 'PREMIUM ALTERATION' AND subcategory = 'ZIP ALTERATION'";
    $zipAlterationResult = mysqli_query($conn, $zipAlterationSql);
    $zipAlterations = mysqli_fetch_all($zipAlterationResult, MYSQLI_ASSOC);

    // Fetch Premium Alteration - Dress or Cloak Alteration Services
    $dressAlterationSql = "SELECT * FROM alteration_services WHERE category = 'PREMIUM ALTERATION' AND subcategory = 'DRESS ALTERATION'";
    $dressAlterationResult = mysqli_query($conn, $dressAlterationSql);
    $dressAlterations = mysqli_fetch_all($dressAlterationResult, MYSQLI_ASSOC);

    // Fetch Premium Alteration - School Alteration Services
    $schoolAlterationSql = "SELECT * FROM alteration_services WHERE category = 'PREMIUM ALTERATION' AND subcategory = 'SCHOOL ALTERATION'";
    $schoolAlterationResult = mysqli_query($conn, $schoolAlterationSql);
    $schoolAlterations = mysqli_fetch_all($schoolAlterationResult, MYSQLI_ASSOC);

    // Fetch Others Alteration - Curtain Alteration Services
    $othersAlterationSql = "SELECT * FROM alteration_services WHERE category = 'OTHERS' AND subcategory = 'CURTAIN ALTERATION'";
    $othersAlterationResult = mysqli_query($conn, $othersAlterationSql);
    $othersAlterations = mysqli_fetch_all($othersAlterationResult, MYSQLI_ASSOC);

    // Fetch Others Alteration - General Alteration Services
    $generalAlterationSql = "SELECT * FROM alteration_services WHERE category = 'OTHERS' AND subcategory = 'GENERAL ALTERATION'";
    $generalAlterationResult = mysqli_query($conn, $generalAlterationSql);
    $generalAlterations = mysqli_fetch_all($generalAlterationResult, MYSQLI_ASSOC);
    ?>

    <!-- Basic Alteration Section -->
    <section class="basic-alt">
        <h1 class="heading"> Basic<span> Alteration</span></h1>
        <div class="basic-cont">
            <!-- Pants Alteration Subcategory -->
            <div class="category">
                <h2><span>✩</span> PANTS ALTERATION <span>✩</span></h2>
            </div>
            <div class="box-basic">
                <?php foreach ($pantsAlterations as $service): ?>
                    <div class="boxs">
                        <img src="<?php echo $service['image_path']; ?>" alt=""/>
                        <h3><?php echo $service['name']; ?></h3>
                        <div class="price">RM <?php echo $service['price']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- T-Shirt & Shirt Alteration Subcategory -->
            <div class="category">
                <h2><span>✩</span> T-SHIRT & SHIRT ALTERATION <span>✩</span></h2>
            </div>
            <div class="box-basic">
                <?php foreach ($shirtAlterations as $service): ?>
                    <div class="boxs">
                        <img src="<?php echo $service['image_path']; ?>" alt=""/>
                        <h3><?php echo $service['name']; ?></h3>
                        <div class="price">RM <?php echo $service['price']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- premium alteration  -->
    <section class="premium-alt">
        <h1 class="heading"> Premium<span> Alteration</span></h1>
        <div class="premium-cont">
            <!-- zip Alteration Subcategory -->
            <div class="category">
                <h2><span>✩</span> ZIP ALTERATION <span>✩</span></h2>
            </div>
            <div class="box-premium">
                <?php foreach ($zipAlterations as $service): ?>
                    <div class="boxs">
                        <img src="<?php echo $service['image_path']; ?>" alt=""/>
                        <h3><?php echo $service['name']; ?></h3>
                        <div class="price">RM <?php echo $service['price']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- dreass or cloak Alteration Subcategory -->
            <div class="category">
                <h2><span>✩</span> DRESS OR CLOAK ALTERATION <span>✩</span></h2>
            </div>
            <div class="box-premium">
                <?php foreach ($dressAlterations as $service): ?>
                    <div class="boxs">
                        <img src="<?php echo $service['image_path']; ?>" alt=""/>
                        <h3><?php echo $service['name']; ?></h3>
                        <div class="price">RM <?php echo $service['price']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- School Alteration Subcategory -->
            <div class="category">
                <h2><span>✩</span> SCHOOL ALTERATION <span>✩</span></h2>
            </div>
            <div class="box-premium">
                <?php foreach ($schoolAlterations as $service): ?>
                    <div class="boxs">
                        <img src="<?php echo $service['image_path']; ?>" alt=""/>
                        <h3><?php echo $service['name']; ?></h3>
                        <div class="price">RM <?php echo $service['price']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- others alteration  -->
    <section class="others-alt">
        <h1 class="heading"> Others<span> Alteration</span></h1>
        <div class="others-cont">

            <!-- curtain Alteration Subcategory -->
            <div class="category">
                <h2><span>✩</span> CURTAIN ALTERATION <span>✩</span></h2>
            </div>
            <div class="box-others">
                <?php foreach ($othersAlterations as $service): ?>
                    <div class="boxs">
                        <img src="<?php echo $service['image_path']; ?>" alt=""/>
                        <h3><?php echo $service['name']; ?></h3>
                        <div class="price">RM <?php echo $service['price']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- general Alteration Subcategory -->
            <div class="category">
                <h2><span>✩</span> GENERAL CLOTHING REPAIR ALTERATION <span>✩</span></h2>
            </div>
            <div class="box-others">
                <?php foreach ($generalAlterations as $service): ?>
                    <div class="boxs">
                        <img src="<?php echo $service['image_path']; ?>" alt=""/>
                        <h3><?php echo $service['name']; ?></h3>
                        <div class="price">RM <?php echo $service['price']; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

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