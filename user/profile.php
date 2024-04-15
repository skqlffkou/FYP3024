<?php
include '../component/connect.php';
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id']; 

// Attempt to query database for user information
$sql = "SELECT user_name, user_email, user_phone FROM user_registration WHERE id = ?";
if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = $user_id;
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $user_name, $user_email, $user_phone);
            mysqli_stmt_fetch($stmt);
        } else {
            // Handle error - User not found
            echo "User not found";
            exit;
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css"> <!-- Update the path accordingly -->
</head>
<body class="profile">

    <div class="prof-wrapper" style="width: auto; margin-top: 5rem;"> <!-- Adjusted for profile page -->
        <h2>User Profile</h2>
        <div class="profile-details">
            <p><b>Name:</b> <?php echo htmlspecialchars($user_name); ?></p>
            <p><b>Email:</b> <?php echo htmlspecialchars($user_email); ?></p>
            <p><b>Phone:</b> <?php echo htmlspecialchars($user_phone); ?></p>
        </div>
        <a href="updateProfile.php" class="btn btn-update" >Edit Profile</a>
        <a href="index.php" class="btn btn-back" >Back</a>
    </div>

</body>
</html>
