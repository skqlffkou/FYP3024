<?php 

    include '../component/connect.php';
    session_start();

    

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>USER LOGIN</title>

    <!-- bootstrap cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="login.css" />
</head>
<body>

<!-- Login section -->
<section class="login-home" id="login-home">
    <div class="login-wrapper">
        <form action="" method="post">
            <h1>Login</h1>

            <?php 

            if(isset($_POST["submit"])){
                $user_email = $_POST["email"];
                $user_password = $_POST["password"];

                require_once "../component/connect.php";

                $sql = "SELECT * FROM user_registration WHERE user_email = '$user_email'";
                $result = mysqli_query($conn, $sql);
                $user_registration = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user_registration) {
                    if (password_verify($user_password, $user_registration["user_password"])) {
                        $_SESSION['user_logged_in'] = true;
                        $_SESSION['user_name'] = $user_registration["user_name"];
                        $_SESSION['user_id'] = $user_registration['id']; // Setting the user ID in session
                        header('location:index.php');
                        die();
                    }
                } else {
                    $message[] = "<div class = 'alert alert-danger'>Incorrect email or password!</div>";
                }
            }
            ?>
                        <?php 
                

                if (!empty($message)) {
                    foreach ($message as $msg) {
                        echo $msg;
                    }
                }
                
            
            ?>

            <div class="linput-box">
                <input type="email" name="email" placeholder="Email" required />
                <i class="fa fa-envelope"></i>
            </div>

            <div class="linput-box">
                <input type="password" name="password" placeholder="Password" required />
                <i class="fa fa-lock"></i>
            </div>

            <button type="submit" name="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="registration.php">Register Now</a></p>
            </div>
        </form>
    </div>
</section>



<!-- JS link -->
<script src="scripts.js">
</script>

</body>
</html>