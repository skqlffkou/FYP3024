<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
include '../component/connect.php';

$admin_email = $_SESSION['email']; 
$error = [];

// Fetch current user details
$select = "SELECT * FROM admin_registration WHERE admin_email = '$admin_email'";
$result = mysqli_query($conn, $select);
$currentAdmin = mysqli_fetch_assoc($result);

if (!$currentAdmin) {
    echo "Admin not found!";
    exit;
}

// Update profile
if (isset($_POST['update'])) {
    $admin_name = mysqli_real_escape_string($conn, $_POST['name']);
    $admin_email_new = mysqli_real_escape_string($conn, $_POST['email']);

    // Update the database
    $update = "UPDATE admin_registration SET admin_name='$admin_name', admin_email='$admin_email_new' WHERE admin_email='$admin_email'";
    if (mysqli_query($conn, $update)) {
        $_SESSION['email'] = $admin_email_new; // Update the session email
        header('Location: profile.php'); // Redirect back to the profile page
    } else {
        $error[] = "Failed to update profile.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" href="profile.css" />
</head>
<body>

<div class="update-home">
    <div class="update-wrapper">
        <form action="" method="post">
            <h1>Update Profile</h1>

            <?php 
            if (!empty($error)) {
                foreach ($error as $message) {
                    echo "<div class='alert alert-danger'>$message</div>";
                }
            }
            ?>

            <div class="input-box">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($currentAdmin['admin_name']); ?>" required>
            </div>

            <div class="input-box">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($currentAdmin['admin_email']); ?>" required>
            </div>

            

            <div>
            <button type="submit" name="update" class="btn-style">Update</button>
            <a href="profile.php" class="btn-style">Cancel</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
