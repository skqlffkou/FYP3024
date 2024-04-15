<?php
    include '../component/connect.php';

    session_start();

    $message = ""; // Initialize an empty array to hold error or success messages


// Fetch categories and their services
    $categories = [];
    $query = "SELECT c.id AS category_id, c.name AS category_name, s.id AS service_id, s.name AS service_name
            FROM categories c
            LEFT JOIN services s ON c.id = s.category_id
            ORDER BY c.name, s.name";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[$row['category_name']][] = [
                'id' => $row['service_id'],
                'name' => $row['service_name']
            ];
        }
    }

    // Fetch customers
    $customers = [];
    $customerQuery = "SELECT id, user_name FROM user_registration ORDER BY user_name";
    $customerResult = mysqli_query($conn, $customerQuery);
    if ($customerResult) {
        while ($customerRow = mysqli_fetch_assoc($customerResult)) {
            $customers[] = $customerRow;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CUSTOMER ORDER FORM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" href="services.css">
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
        <a href="#order"><i class="fas fa-file-alt"></i>Order Form</a>
        <a href="submit_order.php"><i class="fas fa-box"></i></i>Order Record</a>
        <a href="alteration_progress.php"><i class="fas fa-tasks"></i>Alteration Progress</a>
        <a href="message.php"><i class="fas fa-envelope"></i>Message</a>
    </div>


    <div id="main">
        <div class="header">
            <span class="menu-icon" onclick="openNav()">&#9776; CUSTOMER ORDER FORM</span>
            <div class="profile">
                <i class="fas fa-user dropbtn"></i>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <!-- Form for add customer ordering -->
        <form action="" method="post" id="addOrderForm">
            <h2>Add Customer Order</h2>

            <?php 
                if (isset($_POST['submitOrder'])) {
                    $customer_id = mysqli_real_escape_string($conn, $_POST['customerId']);
                    $orderDate = $_POST['orderDate'];
                    $dueDate = $_POST['dueDate'];
                    $paymentMethod = mysqli_real_escape_string($conn, $_POST['paymentMethod']);
                
                    $sql = "INSERT INTO orders (customer_id, order_date, due_date, payment_method) VALUES ('$customer_id', '$orderDate', '$dueDate', '$paymentMethod')";
                
                    if (mysqli_query($conn, $sql)) {
                        $last_order_id = mysqli_insert_id($conn);
                        
                       
                        if(isset($_POST['services']) && is_array($_POST['services'])) {
                            foreach ($_POST['services'] as $service_id) {
                                $quantity = isset($_POST['quantity'][$service_id]) ? (int)$_POST['quantity'][$service_id] : 1;
                                $service_id = (int)$service_id;
                                
                                $detailSql = "INSERT INTO order_details (order_id, service_id, quantity) VALUES ('$last_order_id', '$service_id', '$quantity')";
                                mysqli_query($conn, $detailSql);
                            }
                        }

                        $message = "<div class='alert alert-success'>Order successfully added!</div>";
                    } else {

                        $message = "<div class='alert alert-error'>Failed to added new order.</div>";
                    }
                } 

                echo $message;
            ?>

            <div class="form-group">
                <label for="customerId">Select Customer:</label>
                <select name="customerId" required>
                    <option value="">Please select a customer</option>
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo htmlspecialchars($customer['id']); ?>">
                            <?php echo htmlspecialchars($customer['user_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="services-section">
                <?php foreach ($categories as $category => $services): ?>
                <fieldset>
                    <legend><?php echo $category; ?></legend>
                    <?php foreach ($services as $service): ?>
                    <div class="service-option">
                        <label>
                            <input type="checkbox" name="services[]" value="<?php echo $service['id']; ?>">
                            <?php echo $service['name']; ?>
                        </label>
                        Quantity: <input type="number" name="quantity[<?php echo $service['id']; ?>]" min="0" value="0">
                    </div>
                    <?php endforeach; ?>
                </fieldset>
                <?php endforeach; ?>
            </div>
            
            <div class="form-group">
                <label for="orderDate">Order Date:</label>
                <input type="date" id="orderDate" name="orderDate" required>
            </div>
            
            <div class="form-group">
                <label for="dueDate">Due Date:</label>
                <input type="date" id="dueDate" name="dueDate" required>
            </div>
            
            <div class="form-group">
                <label>Payment Method:</label>
                <select name="paymentMethod" required>
                    <option value="Cash">Cash</option>
                    <option value="QR">QR Payment</option>
                </select>
            </div>

            
            
            <button type="submit" name="submitOrder">Add Order</button>
        </form>
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