<?php
include '../component/connect.php';
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Define variables and initialize with empty values
$user_name = $user_email = $user_phone = "";
$user_id = $_SESSION['user_id']; 

// Fetching the user's existing data
$sql = "SELECT user_name, user_email, user_phone FROM user_registration WHERE id = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = $user_id;

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $user_name, $user_email, $user_phone);
            mysqli_stmt_fetch($stmt);
        } else {
            // Handle error - User not found
            echo "An error occurred. Please try again.";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
mysqli_stmt_close($stmt);

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and assign new values
    $user_name = trim($_POST["user_name"]);
    $user_email = trim($_POST["user_email"]);
    $user_phone = trim($_POST["user_phone"]);

    // Prepare an update statement
    $sql = "UPDATE user_registration SET user_name=?, user_email=?, user_phone=? WHERE id=?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_email, $param_phone, $param_id);

        // Set parameters
        $param_name = $user_name;
        $param_email = $user_email;
        $param_phone = $user_phone;
        $param_id = $user_id;

        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            header("location:profile.php"); // Redirect to profile page or confirmation page
            exit();
        } else {
            //echo "Oops! Something went wrong. Please try again later.";
            $message[] = "<div class = 'alert alert-danger'>Oops! Something went wrong. Please try again later.</div>";
        }
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="login.css"> <!-- Assuming profile.css contains the CSS you provided -->
</head>
<body class="login-home">
    <div class="login-wrapper">
        <h1>Update Profile</h1>

        <?php 

                if (!empty($message)) {
                    foreach ($message as $msg) {
                        echo $msg;
                    }
                }
                
            
            ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="linput-box">
                <input type="text" name="user_name" value="<?php echo $user_name; ?>" placeholder="Username">
            </div>    
            <div class="linput-box">
                <input type="email" name="user_email" value="<?php echo $user_email; ?>" placeholder="Email">
            </div>
            <div class="linput-box">
                <input type="text" name="user_phone" value="<?php echo $user_phone; ?>" placeholder="Phone">
            </div>
            <div>
                <button type="submit" class="btn">Update</button>
                <a href="profile.php" class="btn" style="display:inline-block; margin-top: 15px; line-height: 40px;">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
