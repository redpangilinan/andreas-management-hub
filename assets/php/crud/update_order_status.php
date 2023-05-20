<?php
include '../connection.php';

$primary_id = $_POST['primary_id'];
$status = $_POST['status'];

// Check the current status of the order
$checkStmt = mysqli_prepare($conn, "SELECT status FROM tb_orders WHERE order_id = ?");
mysqli_stmt_bind_param($checkStmt, 's', $primary_id);
mysqli_stmt_execute($checkStmt);
mysqli_stmt_bind_result($checkStmt, $currentStatus);

if (mysqli_stmt_fetch($checkStmt)) {
    if ($currentStatus !== "Complete") {
        // Update the status if it's not complete
        $updateStmt = mysqli_prepare($conn, "UPDATE tb_orders SET status = ? WHERE order_id = ?");
        mysqli_stmt_bind_param($updateStmt, "ss", $status, $primary_id);

        if (mysqli_stmt_execute($updateStmt)) {
            echo "success";
        } else {
            echo "Error: " . mysqli_stmt_error($updateStmt);
        }

        mysqli_stmt_close($updateStmt);
    } else {
        echo "order_complete_update";
    }
} else {
    echo "Error: Order not found";
}

mysqli_stmt_close($checkStmt);
mysqli_close($conn);
