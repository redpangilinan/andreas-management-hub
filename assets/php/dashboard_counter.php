<?php
//Shows the total count of accounts with "User" as their account type
function userCount()
{
    include 'connection.php';
    $sql = "SELECT * FROM tb_accounts";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

function productCount()
{
    include 'connection.php';
    $sql = "SELECT * FROM tb_products";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}
