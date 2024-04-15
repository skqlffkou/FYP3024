
<?php
include '../component/connect.php';

// Check if the 'id' GET variable is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id']; // Cast to integer for security

    // Prepare a DELETE statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM staff WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // If successful, redirect to the staff list with a success message
        header('Location: staff.php?status=success&message=Staff+deleted+successfully');
    } else {
        // If not successful, redirect to the staff list with an error message
        header('Location: staff.php?status=error&message=Error+deleting+staff');
    }

    // Close statement
    $stmt->close();
} else {
    // If the ID isn't set or not numeric, redirect back with an error message
    header('Location: staff.php?status=error&message=Invalid+request');
}
exit; // Ensure no further execution happens
?>
