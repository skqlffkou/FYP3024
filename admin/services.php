<?php
include '../component/connect.php';

$message = []; // Initialize an empty array to hold error or success messages

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize it
    $serviceCategory = mysqli_real_escape_string($conn, $_POST['serviceCategory']);
    $subCategory = mysqli_real_escape_string($conn, $_POST['subCategory']);
    $serviceName = mysqli_real_escape_string($conn, $_POST['serviceName']);
    $servicePrice = mysqli_real_escape_string($conn, $_POST['servicePrice']);
    $serviceImage = $_FILES['serviceImage']['name'];
    $service_image_tmp_name = $_FILES['serviceImage']['tmp_name'];
    $service_image_folder = '../uploaded_files/' . $serviceImage; // Adjust the path as necessary

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTERATION SERVICES</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <a href="#manage_services"><i class="fas fa-edit"></i>Alteration Services Form</a>
        <a href="order.php"><i class="fas fa-file-alt"></i>Order Form</a>
        <a href="submit_order.php"><i class="fas fa-box"></i></i>Order Record</a>
        <a href="alteration_progress.php"><i class="fas fa-tasks"></i>Alteration Progress</a>
        <a href="message.php"><i class="fas fa-envelope"></i>Message</a>
    </div>


    <div id="main">
        <div class="header">
            <span class="menu-icon" onclick="openNav()">&#9776; ALTERATION SERVICES</span>
            <div class="profile">
                <i class="fas fa-user dropbtn"></i>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>



        <!-- Add New Alteration Service Form -->
        <div class="form-container">
            <h2>Add New Alteration Service</h2>

            <?php 
            // Validate input
            if (empty($serviceCategory) || empty($subCategory) || empty($serviceName) || empty($servicePrice) || empty($serviceImage)) {
                // $message[] = 'Please fill out all fields';
                // $message[] = "<div class='alert error'>Please fill out all fields!</div>";
            } else {
                // Attempt to move the uploaded file to your desired directory
                if (move_uploaded_file($service_image_tmp_name, $service_image_folder)) {
                    // Use prepared statement to insert data into the database
                    $insert = $conn->prepare("INSERT INTO alteration_services (category, subcategory, name, price, image_path) VALUES (?, ?, ?, ?, ?)");
                    $insert->bind_param("sssss", $serviceCategory, $subCategory, $serviceName, $servicePrice, $service_image_folder);

                    if ($insert->execute()) {
                        $message = "<div class='alert alert-success'>New service added successfully!</div>";
                    } else {
                        // $message[] = 'Could not add the service: ' . $conn->error;
                        $message = "<div class='alert alert-error'>Could not add the service! </div>";
                    }

                    $insert->close();
                } else {
                    // $message[] = 'Failed to upload image.';
                    $message = "<div class='alert alert-error'>Failed to upload image.</div>";
                }

                echo $message;
            }
        ?>

            <form id="addServiceForm" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="serviceCategory">Service Category</label>
                    <select id="serviceCategory" name="serviceCategory" onchange="updateSubcategories()" required>
                        <option value="">Select a Category</option>
                        <option value="Basic Alteration">Basic Alteration</option>
                        <option value="Premium Alteration">Premium Alteration</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subCategory">Category</label>
                    <select id="subCategory" name="subCategory" required>
                        <!-- Subcategories will be added here based on the JavaScript function -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="serviceName">Name of the Alteration</label>
                    <input type="text" id="serviceName" name="serviceName" required>
                </div>
                <div class="form-group">
                    <label for="servicePrice">Price</label>
                    <input type="number" id="servicePrice" name="servicePrice" required>
                </div>
                <div class="form-group">
                    <label for="serviceImage">Image</label>
                    <input type="file" id="serviceImage" name="serviceImage" accept="image/*">
                </div>
                <div class="form-group">
                    <button type="submit" name = "submit">Add Service</button>
                </div>
            </form>
        </div>

        <div class="services-table-container">
            <h2>Existing Alteration Services</h2>
            <table id="servicesTable">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Service Name</th>
                        <th>Price (RM)</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
            $query = "SELECT * FROM alteration_services"; 
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['category']) . "</td>
                            <td>" . htmlspecialchars($row['subcategory']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['price']) . "</td>
                            <td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Service Image' style='width: 50px; height: auto;'></td>
                            <td>
                                <button onclick=\"location.href='services_update.php?id=" . $row['id'] . "'\" class='edit-btn'>Update</button>
                                <button onclick=\"if(confirm('Are you sure you want to delete this service?')) location.href='services_delete.php?id=" . $row['id'] . "'\"class='delete-btn'>Delete</button>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No services found</td></tr>";
            }
            ?>
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
        function updateSubcategories() {
        var category = document.getElementById("serviceCategory").value;
        var subCategory = document.getElementById("subCategory");
        subCategory.options.length = 0; // Clear all existing options first

        if(category === "Basic Alteration") {
            var options = ["Pants Alteration", "T-Shirt Alteration"];
        } else if(category === "Premium Alteration") {
            var options = ["Zip Alteration", "Dress Alteration", "School Alteration"];
        } else if(category === "Others") {
            var options = ["Curtain Alteration", "General Alteration"];
        } else {
            var options = [];
        }

        // Now add these options to subcategory dropdown
        options.forEach(function(option) {
            var opt = new Option(option, option);
            subCategory.appendChild(opt);
        });
    }

    document.addEventListener("DOMContentLoaded", updateSubcategories); // Populate on load

    </script>

</body>
</html>