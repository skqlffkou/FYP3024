<?php 

    include '../component/connect.php';

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
            if (isset($_POST["submit"])) {
                $user_name = $_POST["name"]; 
                $user_email = $_POST["email"]; 
                $user_phone = $_POST["phone"]; 
                $user_password = $_POST["password"]; 
                $confirm_password = $_POST["cpassword"]; 
                
                $passwordHash = password_hash($user_password, PASSWORD_DEFAULT);

                $errors = array();

                if (empty($user_name) || empty($user_email) || empty($user_phone) || empty($user_password) || empty($confirm_password)) {
                    array_push($errors, "All fields are required!"); 
                }

                if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) { 
                    array_push($errors, "Email is not valid!");
                }

                if (strlen($user_password) < 8) {
                    array_push($errors, "Password must be at least 8 characters long.");
                }

                if ($user_password !== $confirm_password) {
                    array_push($errors, "Password does not match!");
                }

                require_once "../component/connect.php";
                $sql = "SELECT * FROM user_registration WHERE user_email = '$user_email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);

                if ($rowCount > 0) {
                    array_push($errors, "Email already exist!");
                }
                
                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>"; 
                    }
                } else {
                    // insert the data into database
                    $sql = "INSERT INTO user_registration (user_name, user_email, user_phone, user_password	
                    ) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $user_name, $user_email, $user_phone, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Registered Successfully!</div>";
                    } else {
                        die("Something went wrong.");
                    }
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
                <input type="phone" name="phone" placeholder="Phone Number" required />
                <i class="fa-solid fa-phone"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required />
                <i class="fa fa-lock"></i>
            </div>

            <div class="input-box">
                <input type="password" name="cpassword" placeholder="Confirm Password" required />
                <i class="fa fa-lock"></i>
            </div>

            <button type="submit" name="submit" class="btn">Register</button>

            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</section>

<!-- JS link -->
<script src="scripts.js">
</script>

</body>
</html>