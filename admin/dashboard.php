<?php
    include '../component/connect.php';

    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }

    // SQL to count total users
    $userSql = "SELECT COUNT(*) AS total_users FROM user_registration";
    $userResult = $conn->query($userSql);
    $userRow = $userResult->fetch_assoc();
    $totalUsers = $userRow['total_users'];

    // SQL to count total staff
    $staffSql = "SELECT COUNT(*) AS total_staff FROM staff";
    $staffResult = $conn->query($staffSql);
    $staffRow = $staffResult->fetch_assoc();
    $totalStaff = $staffRow['total_staff'];

    // SQL to count total orders
    $orderSql = "SELECT COUNT(*) AS total_order FROM orders";
    $orderResult = $conn->query($orderSql);
    $orderRow = $orderResult->fetch_assoc();
    $totalOrder = $orderRow['total_order'];

    // Query to count all unread messages
    $messageSql = "SELECT COUNT(*) as unread_count FROM contact_messages WHERE is_read = 0";
    $messageResult = $conn->query($messageSql);

    // Initialize a variable to hold the count of unread messages
    $unreadCount = 0;

    if ($messageResult) {
        $messageRow = $messageResult->fetch_assoc();
        $unreadCount = $messageRow['unread_count'];
    } else {
        echo "Error fetching unread messages count: " . $conn->error;
    }

    // Close the database connection at the end
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'DANAU R ENTERPRISE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <div class="sidenav" id="mySidenav">
    <div class="logo">
        <span>D'DANAU</span>
        CLOTHING ALTERATION APP
    </div>

        <a href="#Dashboard"><i class="fas fa-home"></i>Dashboard</a>
        <a href="staff.php"><i class="fa-solid fa-address-book"></i>Staff List</a>
        <a href="services.php"><i class="fas fa-edit"></i>Alteration Services Form</a>
        <a href="order.php"><i class="fas fa-file-alt"></i>Order Form</a>
        <a href="submit_order.php"><i class="fas fa-box"></i></i>Order Record</a>
        <a href="alteration_progress.php"><i class="fas fa-tasks"></i>Alteration Progress</a>
        <a href="message.php"><i class="fas fa-envelope"></i>Message</a>
    </div>


    <div id="main">
        <div class="header">
            <span class="menu-icon" onclick="openNav()">&#9776; DASHBOARD</span>
            <div class="profile">
                <i class="fas fa-user dropbtn"></i>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class="welcome">
            <img src="../pics/logo.jpeg" alt="D'Danau Logo">
            <h1>Welcome back, <?php echo $_SESSION['name']; ?>!</h1>
        </div>

        <div class="link">
            <!-- Box -->
            <div class="box">
                <i class="fas fa-users fa-2x"></i>
                <h3>User</h3>
                <p>Total of user: <?php echo $totalUsers; ?></p>
            </div>

            <div class="box">
                <i class="fas fa-file-alt fa-2x"></i>
                <h3>Staff</h3>
                <p>Total of staff: <?php echo $totalStaff; ?></p>
            </div>

            <div class="box">
                <i class="fas fa-shopping-cart fa-2x"></i>
                <h3>Customer Orders</h3>
                <p>Total of orders: <?php echo $totalOrder?></p>
            </div>

            <div class="box">
                <i class="fas fa-envelope fa-2x"></i>
                <h3>Message</h3>
                <p>Total of unread messages: <?php echo $unreadCount; ?></p>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <p>Copyright &copy; 2024 D'Danau R Enterprise | All rights reserved.</p>
    </footer>


    <script>
        function openNav() {
            var sidenav = document.getElementById("mySidenav");
            var main = document.getElementById("main");

            if (sidenav.style.width === "300px") {
                sidenav.style.width = "0px";
                main.style.marginLeft = "0px";
            } else {
                sidenav.style.width = "300px";
                main.style.marginLeft = "300px";
            }
        }
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the dropdown button and dropdown content
        var dropdown = document.querySelector(".dropbtn");
        var dropdownContent = document.getElementById("myDropdown");

        // Toggle the dropdown display on click
        dropdown.onclick = function() {
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        };

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                }
            }
        };
    });
    </script>

</body>
</html>