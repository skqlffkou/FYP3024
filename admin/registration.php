<?php 

    include '../component/connect.php';

    session_start();

    if (isset($_POST['submit'])) {
        $admin_name = mysqli_real_escape_string($conn, $_POST['name']);
        $admin_email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);

        $select = " SELECT * FROM admin_registration WHERE  admin_name = '$admin_name' && admin_email = '$admin_email' && admin_password = '$pass'";

        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            $error[] = 'user already exist!';
        } else {
            if($pass != $cpass){
                $error[] = 'Password not matched!';
            } else {
                $insert = "INSERT INTO admin_registration(admin_name, admin_email, admin_password) VALUES ('$admin_name', '$admin_email', '$pass')";
                mysqli_query($conn, $insert);
                header('location:login.php');
            }
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>REGISTER</title>

    <!-- bootstrap cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="registration.css" />
</head>
<body>

<!-- Registration section -->
<section class="register-home" id="register-home">
    <div class="wrapper">
        <form action="" method="post">
            <h1>Registration</h1>

            <?php 
                if(isset($error)){
                    foreach($error as $error){
                        echo "<div class='alert alert-danger'>$error</div>";;
                    }
                }
            
            ?>

            <div class="input-box">
                <input type="text" name="name" placeholder="Your Name" required />
                <i class="fa fa-user"></i>
            </div>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required />
                <i class="fa fa-envelope"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required />
                <i class="fa fa-lock"></i>
            </div>

            <div class="input-box">
                <input type="password" name="cpassword" placeholder="Confirm Password" required />
                <i class="fa fa-lock"></i>
            </div>

            <button type="submit" value = "register" name="submit" class="btn">Register</button>

            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</section>

</body>
</html>