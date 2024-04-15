<?php
include '../component/connect.php';

$query = "SELECT 
    o.order_id, 
    o.order_date, 
    o.due_date, 
    o.payment_method, 
    ur.user_name, 
    s.name AS service_name, 
    od.quantity, 
    c.name AS category_name,
    (od.quantity * s.price) AS service_payment
FROM orders o
LEFT JOIN user_registration ur ON o.customer_id = ur.id
LEFT JOIN order_details od ON o.order_id = od.order_id
LEFT JOIN services s ON od.service_id = s.id
LEFT JOIN categories c ON s.category_id = c.id
ORDER BY o.order_date DESC, o.order_id, s.id";

$result = mysqli_query($conn, $query);

$orders = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Key by order_id for grouping
        $orderId = $row['order_id'];
        if (!isset($orders[$orderId])) {
            // Initialize group for new order_id
            $orders[$orderId] = [
                'order_id' => $row['order_id'],
                'order_date' => $row['order_date'],
                'due_date' => $row['due_date'],
                'payment_method' => $row['payment_method'],
                'user_name' => $row['user_name'],
                'services' => [],
                'quantities' => [],
                'category_names' => [],
                'service_payments' => [],
                'total_payment' => 0
            ];
        }

        // Append service details
        $orders[$orderId]['services'][] = $row['service_name'];
        $orders[$orderId]['quantities'][] = $row['quantity'];
        $orders[$orderId]['category_names'][] = $row['category_name'];
        $orders[$orderId]['service_payments'][] = number_format($row['service_payment'], 2);
        $orders[$orderId]['total_payment'] += $row['service_payment'];
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Convert arrays to comma-separated strings for display
foreach ($orders as $orderId => $order) {
    $orders[$orderId]['services'] = implode("<br>", $order['services']);
    $orders[$orderId]['quantities'] = implode("<br>", $order['quantities']);
    $orders[$orderId]['category_names'] = implode("<br>", $order['category_names']);
    $orders[$orderId]['service_payments'] = implode(", ", $order['service_payments']);
    $orders[$orderId]['total_payment'] = number_format($order['total_payment'], 2);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDER RECORD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="order.css">
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
        <a href="message.php"><i class="fas fa-envelope"></i>Message</a>
    </div>


    <div id="main">
        <div class="header">
            <span class="menu-icon" onclick="openNav()">&#9776; CUSTOMER ORDER RECORD LIST</span>
            <div class="profile">
                <i class="fas fa-user dropbtn"></i>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class="order-records">
                <h2>Customer Order Records</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Categories</th>
                            <th>Services</th>
                            <th>Quantities</th>
                            <th>Order Date</th>
                            <th>Due Date</th>
                            <th>Payment Method</th>
                            <th>Total Payment (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                            <td><?php echo $order['category_names']; ?></td>
                            <td><?php echo $order['services']; ?></td>
                            <td><?php echo $order['quantities']; ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($order['due_date']); ?></td>
                            <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_payment']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
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

<script>
function addOrder() {
    const ordersContainer = document.getElementById("ordersContainer");
    const newOrder = document.createElement("div");
    newOrder.classList.add("form-row", "order");
    newOrder.innerHTML = `
        <label>Order Type:</label>
        <select name="orderType[]">
            <option value="Pants Hemming">Pants Hemming</option>
            <option value="Dress Hemming">Dress Hemming</option>
            <!-- Add more options as needed -->
        </select>
        <label>Quantity:</label>
        <input type="number" name="quantity[]" min="1" value="1">
    `;
    ordersContainer.appendChild(newOrder);
}

</script>

</body>
</html>