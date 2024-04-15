<?php
include '../component/connect.php';

// Check if the 'id' GET variable is set
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the staff member's current data
    $sql = "SELECT * FROM staff WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $staff = mysqli_fetch_assoc($result);
    } else {
        die("Failed to retrieve staff details: " . mysqli_error($conn));
    }
} else {
    header("Location: staff.php");
    exit;
}

$message = ""; // Initialize message variable

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAFF EDIT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="services.css"> -->
    <link rel="stylesheet" href="staff_edit.css">
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
            <span class="menu-icon" onclick="openNav()">&#9776; MANAGE STAFF</span>
            <div class="profile">
                <i class="fas fa-user dropbtn"></i>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <?php 
        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
            $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);

            // Update the staff member's data
            $updateSql = "UPDATE staff SET full_name = '$full_name', phone_number = '$phone_number', email = '$email', gender = '$gender' WHERE id = '$id'";
            
            if (mysqli_query($conn, $updateSql)) {
                // header("Location: staff.php");
                // exit;
                $message .= "<div class='alert success'>Staff updated successfully.</div>";
                header('refresh:6; url=staff.php'); // Redirect after 6 seconds to services.php
            } else {
                // echo "Error updating record: " . mysqli_error($conn);
                $message .= "<div class='alert error'>Error updating record.</div>";
            }
        }
        ?>

        <!-- Form Container -->
        <div class="form-container">
            <h2>Edit Staff</h2>
            <?php echo $message; ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($staff['full_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?= htmlspecialchars($staff['phone_number']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($staff['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <input type="radio" id="male" name="gender" value="Male" <?php echo ($staff['gender'] == 'Male') ? 'checked' : ''; ?>>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="Female" <?php echo ($staff['gender'] == 'Female') ? 'checked' : ''; ?>>
                        <label for="female">Female</label>
                    </div>
                </div>
                <div class="button-group">
                        <button type="submit" name="submit">Update Staff</button>
                        <a href="staff.php" class="back-button">Back</a>
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
