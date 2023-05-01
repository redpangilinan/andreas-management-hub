<?php
include '../connection.php';

$primary_id = $_POST['primary_id'];
$status = $_POST['status'];

// Sanitize the input and insert the data into the database
$stmt = mysqli_prepare($conn, "UPDATE tb_orders SET status=? WHERE order_id=?");
mysqli_stmt_bind_param($stmt, "ss", $status, $primary_id);
if (mysqli_stmt_execute($stmt)) {
    echo "success";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
