<?php
// Update product status
if (isset($_POST['primary_id'])) {
    include '../connection.php';
    $primary_id = $_POST['primary_id'];

    // Get the current product status
    $stmt = mysqli_prepare($conn, "SELECT status FROM tb_products WHERE product_id=?");
    mysqli_stmt_bind_param($stmt, "s", $primary_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $status);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Switch the product status
    if ($status == "Available") {
        $status = "Unavailable";
    } else {
        $status = "Available";
    }

    $stmt = mysqli_prepare($conn, "UPDATE tb_products SET status=? WHERE product_id=?");
    mysqli_stmt_bind_param($stmt, "ss", $status, $primary_id);
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "($status) Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_close($conn);
} else {
    echo "error";
}
