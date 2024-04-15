<?php
include '../component/connect.php';

$search = $_GET['search'] ?? ''; // Using PHP 7 null coalesce operator

// Check if a search was performed
if (!empty($search)) {
    // Escape special characters in the search term
    $search = mysqli_real_escape_string($conn, $search);
    // Adjust the SQL query to filter results based on the search term
    $sql = "SELECT id, full_name, phone_number, email FROM staff WHERE full_name LIKE '%$search%'";
} else {
    // If no search was performed, select all staff
    $sql = "SELECT id, full_name, phone_number, email FROM staff";
}

$result = mysqli_query($conn, $sql);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAFF LIST</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="staff.css">
</head>
<body>

    <div class="sidenav" id="mySidenav">
        <div class="logo">
            <span>D'DANAU</span>
            CLOTHING ALTERATION APP
        </div>

        <a href="dashboard.php"><i class="fas fa-home"></i>Dashboard</a>
        <a href="#staff"><i class="fa-solid fa-address-book"></i>Staff List</a>
        <a href="services.php"><i class="fas fa-edit"></i>Alteration Services Form</a>
        <a href="order.php"><i class="fas fa-file-alt"></i>Order Form</a>
        <a href="submit_order.php"><i class="fas fa-box"></i></i>Order Record</a>
        <a href="alteration_progress.php"><i class="fas fa-tasks"></i>Alteration Progress</a>
        <a href="message.php"><i class="fas fa-envelope"></i>Message</a>
    </div>

    <div id="main">
        <div class="header">
            <span class="menu-icon" onclick="openNav()">&#9776; STAFF LIST</span>
            <div class="profile">
                <i class="fas fa-user dropbtn"></i>
                <div class="dropdown-content" id="myDropdown">
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class="staff-container">
            <div class="staff-header">
                <!-- <h2>Staff List</h2> -->
                <form action="staff.php" method="get" class="search-form">
                    <input type="text" name="search" placeholder="Search staff..." required>
                    <button class="search-btn" type="submit">Search</button>
                    <a href="staff.php" class="clear-search-btn">Show All</a>
                </form>
            </div>

            <table class="staff-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row["id"]) . "</td>
                                        <td>" . htmlspecialchars($row["full_name"]) . "</td>
                                        <td>" . htmlspecialchars($row["phone_number"]) . "</td>
                                        <td>" . htmlspecialchars($row["email"]) . "</td>
                                        <td>
                                        <a href='staff_edit.php?id=" . htmlspecialchars($row["id"]) . "' class='edit-link'>Edit</a>  
                                        <a href='staff_delete.php?id=" . htmlspecialchars($row["id"]) . "' class='delete-link' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No staff found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <div class="add-staff-btn-container">
            <a href="add_staff.php" class="btn add-staff-btn">Add New Staff</a>
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
    var searchForm = document.querySelector(".search-form");
    searchForm.addEventListener("submit", function(event) {
        var searchInput = document.querySelector("input[name='search']");
        if (!searchInput.value.trim()) {
            // Prevent the form from submitting
            event.preventDefault();
            // Navigate to the page without the search parameter
            window.location.href = "staff.php";
        }
    });
});
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