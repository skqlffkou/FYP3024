<?php
include '../component/connect.php';

// Check if the 'id' GET variable is set
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the service details from the database
    $query = "SELECT * FROM alteration_services WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $service = mysqli_fetch_assoc($result);
    } else {
        // Redirect or error handling
        die('Service not found.');
    }
} else {
    // Redirect or error handling
    die('ID not provided.');
}

$messages = ""; // Initialize message variable



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE ALTERATION SERVICES</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="services.css"> -->
    <link rel="stylesheet" href="services_update.css">
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

        <?php 
        if(isset($_POST['submit'])){

            $serviceCategory = mysqli_real_escape_string($conn, $_POST['serviceCategory']);
            $subCategory = mysqli_real_escape_string($conn, $_POST['subCategory']);
            $serviceName = mysqli_real_escape_string($conn, $_POST['serviceName']);
            $servicePrice = mysqli_real_escape_string($conn, $_POST['servicePrice']);
            $serviceImage = isset($_FILES['serviceImage']['name']) && $_FILES['serviceImage']['name'] != '' ? $_FILES['serviceImage']['name'] : $service['image_path'];
            $service_image_tmp_name = $_FILES['serviceImage']['tmp_name'];
            $service_image_folder = '../uploaded_files/' . $serviceImage;
        
            if(empty($serviceCategory) || empty($subCategory) || empty($serviceName) || empty($servicePrice)){
                $messages .= "<div class='alert error'>Please fill out all fields.</div>";
            } else {
                $update = "UPDATE alteration_services SET category = '$serviceCategory', subcategory = '$subCategory', name = '$serviceName', price = '$servicePrice', image_path = '$serviceImage' WHERE id = '$id'";
                $upload = mysqli_query($conn, $update);
                if($upload){
                    if($_FILES['serviceImage']['name'] != ''){
                        move_uploaded_file($service_image_tmp_name, $service_image_folder);
                    }
                    $messages = "<div class='alert alert-success'>Service updated successfully.</div>";
                    header('refresh:4; url=services.php'); // Redirect after 4 seconds to services.php
                } else {
                    $messages = "<div class='alert alert-error'>Failed to update service.</div>";
                }
            }
        }
        ?>

    <!-- Form Container -->
    <div class="form-container">
        <h2>Update Alteration Service</h2>
        <?php echo $messages; ?>
        <form id="updateServiceForm" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="serviceCategory">Service Category</label>
                <select id="serviceCategory" name="serviceCategory" required>
                    <option value="">Select a Category</option>
                    <option value="Basic Alteration" <?php if ($service['category'] == 'Basic Alteration') echo 'selected'; ?>>Basic Alteration</option>
                    <option value="Premium Alteration" <?php if ($service['category'] == 'Premium Alteration') echo 'selected'; ?>>Premium Alteration</option>
                    <option value="Others" <?php if ($service['category'] == 'Others') echo 'selected'; ?>>Others</option>
                </select>
            </div>
            <div class="form-group">
                <label for="subCategory">Subcategory</label>
                <input type="text" id="subCategory" name="subCategory" value="<?php echo htmlspecialchars($service['subcategory']); ?>" required>
            </div>
            <div class="form-group">
                <label for="serviceName">Name of the Alteration</label>
                <input type="text" id="serviceName" name="serviceName" value="<?php echo htmlspecialchars($service['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="servicePrice">Price</label>
                <input type="number" id="servicePrice" name="servicePrice" value="<?php echo htmlspecialchars($service['price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="serviceImage">Image (leave blank to keep current image)</label>
                <input type="file" id="serviceImage" name="serviceImage" accept="image/*">
                Current Image: <img src="<?php echo htmlspecialchars($service['image_path']); ?>" alt="Service Image" style="width: 100px; height: auto;">
            </div>
            <div class="button-group">
                    <button type="submit" name="submit">Update Service</button>
                    <a href="services.php" class="back-button">Back</a>
            </div>
        </form>
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
