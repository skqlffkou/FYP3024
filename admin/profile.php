<?php
session_start(); // Start the session

// Check if the admin is not logged in, then redirect to login page
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

include '../component/connect.php'; // Include your database connection

$adminEmail = $_SESSION['email'];

// Fetch admin details using the email from the session
$sql = "SELECT id, admin_name, admin_email FROM admin_registration WHERE admin_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $adminEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adminId = $row['id'];
    $adminName = $row['admin_name'];
    $adminEmail = $row['admin_email'];
} else {
    echo "No user found.";
    exit; // or redirect to an error page or login page
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Profile</title>
    <!-- Stylesheets and scripts here -->
    <link rel="stylesheet" href="profile.css" />
</head>
<body>

<div class="profile-info">
    <h1>Profile Information</h1>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($adminName); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($adminEmail); ?></p>
    <a href="update.php" class="btn-style">Edit Profile</a>
    <a href="dashboard.php" class="btn-style">Back</a>
</div>

</body>
</html>
