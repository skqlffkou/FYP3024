<?php
include '../component/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];


    $conn->begin_transaction();

    try {

        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $status, $order_id);
        if (!$stmt->execute()) {
            throw new Exception("Error updating order status: " . $stmt->error);
        }
        $stmt->close();
        
        $stmt = $conn->prepare("INSERT INTO order_tracking (order_id, status, update_time) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $order_id, $status);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting tracking record: " . $stmt->error);
        }
        $stmt->close();


        $conn->commit();
    } catch (Exception $e) {

        $conn->rollback();
        echo $e->getMessage();
    }
}


$sql = "SELECT o.order_id, u.user_name, latestStatus.last_update, latestStatus.status FROM orders o JOIN user_registration u ON o.customer_id = u.id LEFT JOIN ( SELECT t.order_id, t.status, t.update_time as last_update FROM order_tracking t INNER JOIN ( SELECT order_id, MAX(update_time) as MaxUpdateTime FROM order_tracking GROUP BY order_id ) tm ON t.order_id = tm.order_id AND t.update_time = tm.MaxUpdateTime ) latestStatus ON o.order_id = latestStatus.order_id ORDER BY latestStatus.last_update DESC";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTERATION PROGRESS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="alteration_progress.css">
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
        <a href="#alteration_progress"><i class="fas fa-tasks"></i>Alteration Progress</a>
        <a href="message.php"><i class="fas fa-envelope"></i>Message</a>

    </div>

    <div id="main">
        <div class="header">
            <span class="menu-icon" onclick="openNav()">&#9776; ALTERATION PROGRESS </span>
            <div class="profile">
                <i class="fas fa-user dropbtn"></i>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        
<!-- Table structure to display orders -->
<?php 
    if ($result->num_rows > 0) {
        // Start of table
        echo '<table class="orders-table">';
        // Table header
        echo '<tr>
                <th>User Name</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Last Update</th>
                <th>Actions</th>
              </tr>';
        
        while($row = $result->fetch_assoc()) {
            // Each order row
            echo "<tr>";
            echo "<td>{$row['user_name']}</td>";
            echo "<td>{$row['order_id']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['last_update']}</td>";

            // Start of form within a table cell
            echo '<td>';
            echo '<form action="" method="post">';

            // Dropdown for status update
            echo '<select name="status" class="status-dropdown">
                    <option value="Not in Progress">Not in Progress</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Ready to Pickup">Ready to Pickup</option>
                    <option value="Picked Up">Picked Up</option>
                    <option value="Completed">Completed</option>
                  </select>';
            
            // Hidden input for the order_id
            echo "<input type='hidden' name='order_id' value='{$row['order_id']}' />";

            // Submit button for this order's form
            echo '<input type="submit" value="Update Status" class="status-update-btn">';

            // End of form
            echo '</form>';
            echo '</td>';

            echo "</tr>";
        }
        
        // End of table
        echo '</table>';
    } else {
        echo "No orders found.";
    }
    ?>
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