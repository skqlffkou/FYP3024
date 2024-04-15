<?php 

    include '../component/connect.php';
    session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FAQs</title>

	<!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="FAQs.css" />
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
            <a href="contactUs.php">contact Us</a>
            <a href="#FAQs">FAQs</a>
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
    <section class="home-faq" id="home-faq">
        <div class="content-faq">
            <h1 class="heading"> <span>Frequently</span> Ask Question </h1>
        </div>
    </section>
    <!-- home section end -->

    <!-- FAQs section start -->

    <section class="faq-section">
        <div class="container">
            <!-- <h2 class="faq-heading">Frequently Asked Questions</h2> -->
            <h1 class="heading"> <span>Asked</span> Questions </h1>

            <div class="faq-search-box">
                <input type="text" id="faqSearchInput" placeholder="Search FAQs..." onkeyup="searchFAQs()">
            </div>
            <!-- Category 1: General Question -->
            <div class="faq-category">
                <h3>General Question</h3>
                <div class="faq-item">
                    <button class="faq-question">What is D'Danau Alterations App?</button>
                    <div class="faq-answer">
                        <p>D'Danau Alterations Apps is an online clothing alteration service that allows customers to view their order records in the form of digital receipts and track their order progress. Our aim is to provide a convenient alteration service for all your clothing needs.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">How can I create an account?</button>
                    <div class="faq-answer">
                        <p>Creating an account is easy and free. Just click on the user Icon in the upper right corner of the main page and press the 'REGISTER' button. Then, fill in your details and follow the registration process.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Do you offer a delivery service for completed alterations?</button>
                    <div class="faq-answer">
                        <p>Currently, all completed garments must be picked up in-store. We ensure that your altered items are securely stored until you can collect them.</p>
                    </div>
                </div>
            </div>
            
            <!-- Category 1: Order Placement and Tracking -->
            <div class="faq-category">
                <h3>Order Placement and Tracking</h3>
                <div class="faq-item">
                    <button class="faq-question">How do I place an order for clothing alteration?</button>
                    <div class="faq-answer">
                        <p>Orders for clothing alterations can only be placed in-store to ensure accurate measurements. Please visit us during our working hours.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">How can I view my tracking order?</button>
                    <div class="faq-answer">
                        <p>Once your order has been placed by our manager, you can view and track its progress online through our website. Just log in to your D'Danau account and navigate to the "Tracking" page, where you can see all current orders.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">What does the order status mean?</button>
                    <div class="faq-answer">
                        <p>Each order status reflects a specific stage in the alteration process:
                            <li>Not In Progress: Your order has been logged and is awaiting alteration.</li>
                            <li>In Progress: Your alteration is currently underway.</li>
                            <li>Ready to Pickup: Your alteration is complete and ready to be picked up.</li>
                            <li>Picked Up: Your order has been taken by you once you are satisfied with all the condition of your item.</li>
                            <li>Completed: Your alteration is done and admin will confirm it.</li>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Category 2: Alteration Process -->
            <div class="faq-category">
                <h3>Alteration Process</h3>
                <div class="faq-item">
                    <button class="faq-question">How long does an alteration take?</button>
                    <div class="faq-answer">
                        <p> The turnaround time depends on the complexity of the alteration and our current workload. Generally, alterations take between 4 to 6 days. We strive to complete your order as quickly as possible without compromising on quality.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">What should I bring for the alteration appointment?</button>
                    <div class="faq-answer">
                        <p>Please bring the clothing item you wish to alter and any specific accessories (like special buttons) you want us to use.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">Can I specify custom alteration requests?</button>
                    <div class="faq-answer">
                        <p>Yes, we accommodate custom alteration requests. Please discuss your specific needs with our staff in-store during the order placement process.</p>
                    </div>
                </div>
            </div>
            
            <!-- Category 3: Payment and Pricing -->
            <div class="faq-category">
                <h3>Payment and Pricing</h3>
                <div class="faq-item">
                    <button class="faq-question">How is the cost of an alteration determined?</button>
                    <div class="faq-answer">
                        <p>The cost depends on the type of modification required. You can go to the services page on the website. The price list for each type of alteration is there.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">What payment methods do you accept?</button>
                    <div class="faq-answer">
                        <p>We accept cash and mobile payments. Payment is due upon order pickup.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQs section end -->




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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Select all FAQ question elements
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            // Toggle the "active" class on the question
            question.classList.toggle('active');
            
            // Select the next sibling (faq-answer) and toggle visibility
            const answer = question.nextElementSibling;
            if (answer.style.display === "block") {
                answer.style.display = "none";
            } else {
                answer.style.display = "block";
            }
        });
    });
});
</script>

<script>
function searchFAQs() {
    let input = document.getElementById('faqSearchInput');
    let filter = input.value.toUpperCase();
    let faqSection = document.querySelector('.faq-section'); // Adjust selector if needed
    let questions = faqSection.getElementsByClassName('faq-question');

    for (i = 0; i < questions.length; i++) {
        let question = questions[i];
        let txtValue = question.textContent || question.innerText;
        let answer = question.nextElementSibling; // Assuming the answer follows the question
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            question.style.display = "";
            answer.style.display = ""; // Optionally show answers matching search
        } else {
            question.style.display = "none";
            answer.style.display = "none"; // Hide non-matching answers
        }
    }
}
</script>



</body>
</html>