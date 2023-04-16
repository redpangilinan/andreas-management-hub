<?php
// Update account authority type
if (isset($_POST['primary_id'])) {
    include '../connection.php';
    $primary_id = $_POST['primary_id'];

    // Get the current account type
    $stmt = mysqli_prepare($conn, "SELECT account_type FROM tb_accounts WHERE account_id=?");
    mysqli_stmt_bind_param($stmt, "s", $primary_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $account_type);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Switch the account type
    if ($account_type == "Admin") {
        $account_type = "Co-owner";
    } else if ($account_type == "Owner") {
        $account_type = "Owner";
    } else {
        $account_type = "Admin";
    }

    // Update the account type if it's not the owner
    if ($account_type !== "Owner") {
        $stmt = mysqli_prepare($conn, "UPDATE tb_accounts SET account_type=? WHERE account_id=?");
        mysqli_stmt_bind_param($stmt, "ss", $account_type, $primary_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "($account_type) Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_close($conn);
    } else {
        echo "owner_account";
    }
} else {
    echo "error";
}
