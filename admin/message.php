<?php
    include '../component/connect.php';

    session_start();

    if (isset($_GET['read_message_id'])) {
        $messageId = $_GET['read_message_id'];
        $updateSql = "UPDATE contact_messages SET is_read = TRUE WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("i", $messageId);
        $stmt->execute();
        header("Location: message.php");
        exit();
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESSAGE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="message.css">
</head>
<body>

    <div class="sidenav" id="mySidenav">
    <div class="logo">
        <span>D'DANAU</span>
        CLOTHING ALTERATION APP
    </div>

        <a href="dashboard.php"><i class="fas fa-home"></i>Dashboard</a>
        <a href="staff.php"><i class="fa-solid fa-address-book"></i>Staff List</a>
        <a href="services.php"><i class="fas fa-edit"></i>Alteration Services Form</a>
        <a href="order.php"><i class="fas fa-file-alt"></i>Order Form</a>
        <a href="submit_order.php"><i class="fas fa-box"></i></i>Order Record</a>
        <a href="alteration_progress.php"><i class="fas fa-tasks"></i>Alteration Progress</a>
        <a href="#message"><i class="fas fa-envelope"></i>Message</a>
    </div>


    <div id="main">
        <div class="header">
            <span class="menu-icon" onclick="openNav()">&#9776; MESSAGE</span>
            <div class="profile">
                <i class="fas fa-user dropbtn"></i>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div id="message">
            <?php

            $sql = "SELECT id, name, email, phone_number, message, is_read, DATE_FORMAT(submitted_at, '%W, %M %e, %Y at %h:%i %p') as formatted_date FROM contact_messages ORDER BY submitted_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $messageClass = $row['is_read'] ? "message read" : "message";
                    echo "<div class='$messageClass'>";
                    echo "<h4>From: " . htmlspecialchars($row['name']) . " (" . htmlspecialchars($row['email']) . ")</h4>";
                    echo "<p>Message: " . nl2br(htmlspecialchars($row['message'])) . "</p>";
                    echo "<p><small>Received on: " . $row['formatted_date'] . "</small></p>";
                    echo $row['is_read'] ? "<span class='label read'>Read</span>" : "<span class='label unread'>Unread</span>";
                    if (!$row['is_read']) {
                        echo "<a href='?read_message_id=" . $row['id'] . "' class='mark-as-read'>Mark as Read</a>";
                    }
                    echo "</div>";
                }
            } else {
                echo "No messages received.";
            }
            $conn->close();
            ?>
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