<?php
include '../component/connect.php'; 

// Check if the 'id' GET variable is set and is not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare the DELETE statement
    $query = "DELETE FROM alteration_services WHERE id = $id";

    // Attempt to execute the query
    if (mysqli_query($conn, $query)) {
        header('Location: services.php?status=deleted');
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header('Location: services.php?status=error');
    exit;
}

?>
