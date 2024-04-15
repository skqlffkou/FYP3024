<?php 

include '../component/connect.php';
session_start(); // Start the session to access session variables

$userId = $_SESSION['user_id']; // Get the logged-in user's ID from session

// Updated SQL query to include user_registration for customer name and phone
$query = "SELECT 
    o.order_id, 
    o.order_date, 
    o.due_date, 
    o.payment_method, 


    o.status,


    s.name AS service_name, 
    od.quantity, 
    c.name AS category_name,
    (od.quantity * s.price) AS service_payment,
    ur.user_name AS customer_name, 
    ur.user_phone AS customer_phone
FROM orders o
JOIN order_details od ON o.order_id = od.order_id
JOIN services s ON od.service_id = s.id
JOIN categories c ON s.category_id = c.id
JOIN user_registration ur ON o.customer_id = ur.id
WHERE o.customer_id = ?
ORDER BY o.order_date DESC, o.order_id, s.id";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $orders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[$row['order_id']]['details'][] = $row;
        $orders[$row['order_id']]['order_date'] = $row['order_date'];
        $orders[$row['order_id']]['due_date'] = $row['due_date'];
        $orders[$row['order_id']]['payment_method'] = $row['payment_method'];
        $orders[$row['order_id']]['customer_name'] = $row['customer_name']; // Add customer name
        $orders[$row['order_id']]['customer_phone'] = $row['customer_phone']; // Add customer phone


        $orders[$row['order_id']]['status'] = $row['status'];


        // Aggregate total payment per order
        $orders[$row['order_id']]['total_payment'] = ($orders[$row['order_id']]['total_payment'] ?? 0) + $row['service_payment'];
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing the query.";
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TRACKING</title>

	<!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="tracking.css" />
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
    <section class="home-track" id="home-track">
        <div class="content-track">
            <h1 class="heading"> <span>your</span> tracking </h1>
        </div>
    </section>
    <!-- home section end -->

    <section class="tracking-dtl" id="tracking-dtl">
        <h1 class="heading"> Order <span>Details</span></h1>

        <!-- Order Details Receipt -->
        <?php if(!empty($orders)): ?>
            <div class="order-details">
                <h2>YOUR ORDERS</h2>
                <?php foreach($orders as $order_id => $order): ?>
                    <h3>ORDER #<?= htmlspecialchars($order_id) ?></h3>
                    <p>--------------------------------------------------------------------------------------------</p>
                    <p>Name: <?= htmlspecialchars($order['customer_name']) ?></p>
                    <p>Phone: <?= htmlspecialchars($order['customer_phone']) ?></p>
                    <p>******************************************</p>
                    <p>Order Date: <?= htmlspecialchars($order['order_date']) ?></p>
                    <p>Due Date: <?= htmlspecialchars($order['due_date']) ?></p>
                    <p>Payment Method: <?= htmlspecialchars($order['payment_method']) ?></p>
                    <p>--------------------------------------------------------------------------------------------</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Category</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($order['details'] as $detail): ?>
                                <tr>
                                    <td><?= htmlspecialchars($detail['service_name']) ?></td>
                                    <td><?= htmlspecialchars($detail['quantity']) ?></td>
                                    <td><?= htmlspecialchars(number_format($detail['service_payment'] / $detail['quantity'], 2)) ?></td>
                                    <td><?= htmlspecialchars($detail['category_name']) ?></td>
                                    <td><?= htmlspecialchars(number_format($detail['service_payment'], 2)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total Payment:</strong></td>
                                <td><?= htmlspecialchars(number_format($order['total_payment'], 2)) ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Sorry, currently you have no orders.</p>
        <?php endif; ?>
    </section>

    <section class="tracking-prog" id="tracking-prog">
    <h1 class="heading">Tracking <span>Progress</span></h1>

    <?php foreach($orders as $order_id => $order): ?>
    <div class="order-status">
        <h3>Order ID #<?= htmlspecialchars($order_id) ?></h3>
        <div class="progress-bar-container">
            <?php
            // Define the sequence of statuses.
            $statuses = ['Not in Progress', 'In Progress', 'Ready to Pickup', 'Picked Up', 'Completed'];
            $statusIcons = [
                'Not in Progress' => 'far fa-hourglass',
                'In Progress' => 'fas fa-sync-alt',
                'Ready to Pickup' => 'fas fa-box-open',
                'Picked Up' => 'fas fa-truck',
                'Completed' => 'fas fa-check-circle'
            ];

            // Get the index of the current status.
            $currentStatus = $order['status'];
            $currentIndex = array_search($currentStatus, $statuses);
            ?>

            <div class="progress-bar">
                <?php foreach($statuses as $index => $status): ?>
                    <div class="progress-step <?= $index <= $currentIndex ? 'active' : '' ?>">
                        <i class="<?= $statusIcons[$status] ?>"></i>
                        <p><?= htmlspecialchars($status) ?></p>
                    </div>
                    <?php if($index < count($statuses) - 1): ?>
                        <!-- Show the line as filled if it's before or at the current status -->
                        <div class="progress-bar-line <?= $index < $currentIndex ? 'filled' : '' ?>"></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>


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