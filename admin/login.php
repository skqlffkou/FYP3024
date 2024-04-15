<?php 

    include '../component/connect.php';

    session_start();

    if (isset($_POST['submit'])) {
        $admin_email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);

        $select = " SELECT * FROM admin_registration WHERE  admin_email = '$admin_email' && admin_password = '$pass'";

        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $admin_email;
            $_SESSION['name'] = $row['admin_name'];
            header('location:dashboard.php');
            exit;
        } else {
            $message[] = "<div class='alert error'>Incorrect email or password!</div>";
        }

    }

    

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN</title>

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

            <button type="submit" value = "login" name="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="registration.php">Register Now</a></p>
            </div>
        </form>
    </div>
</section>

</body>
</html>