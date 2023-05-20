<?php
include '../connection.php';

$primary_id = $_POST['primary_id'];
$status = $_POST['status'];

// Retrieve the current status of the order_id
$stmt = mysqli_prepare($conn, "SELECT status FROM tb_orders WHERE order_id = ?");
mysqli_stmt_bind_param($stmt, "s", $primary_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $currentStatus);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Check if the order exists and its current status is not 'Complete'
if ($currentStatus && $currentStatus !== 'Complete') {
    // Check if the new status is not 'Approval'
    if ($status !== 'Approval') {
        // Update the status in the database
        $stmt = mysqli_prepare($conn, "UPDATE tb_orders SET status = ? WHERE order_id = ?");
        mysqli_stmt_bind_param($stmt, "ss", $status, $primary_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "order_approved";
    }
} else {
    echo "order_complete_update";
}

mysqli_close($conn);
