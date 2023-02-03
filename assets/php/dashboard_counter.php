<?php
//Shows the total count of accounts with "User" as their account type
function userCount() {
    include 'connection.php';
    $sql = "SELECT * FROM tb_accounts WHERE account_type = 'User'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

function recordCount() {
    include 'connection.php';
    $sql = "SELECT * FROM tb_records";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}
?>