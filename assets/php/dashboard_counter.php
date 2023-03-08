<?php
//Shows the total count of accounts
function userCount()
{
    include 'connection.php';
    $sql = "SELECT * FROM tb_accounts";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Shows the total count of products
function productCount()
{
    include 'connection.php';
    $sql = "SELECT * FROM tb_products";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

//Shows the total count of orders
function orderCount()
{
    include 'connection.php';
    $sql = "SELECT * FROM tb_orders";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}
