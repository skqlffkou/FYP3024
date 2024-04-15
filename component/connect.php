

<?php 
    $hostname = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "alteration_db";

    $conn = mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);

    if (!$conn) {
        die("Not Connected");
    }

    
?>