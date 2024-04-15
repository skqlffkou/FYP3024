<?php

include '../component/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Begin transaction to ensure data integrity
    $conn->begin_transaction();

    try {
        // First, update the status in the orders table
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $status, $order_id);
        if (!$stmt->execute()) {
            throw new Exception("Error updating order status: " . $stmt->error);
        }
        $stmt->close();
        
        // Next, insert the tracking update
        $stmt = $conn->prepare("INSERT INTO order_tracking (order_id, status, update_time) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $order_id, $status);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting tracking record: " . $stmt->error);
        }
        $stmt->close();

        // If both operations are successful, commit the transaction
        $conn->commit();
        echo "Order status updated successfully.";
    } catch (Exception $e) {
        // An error occurred, roll back the transaction
        $conn->rollback();
        echo $e->getMessage();
    }
} else {
    echo "No POST data received.";
}

?>
