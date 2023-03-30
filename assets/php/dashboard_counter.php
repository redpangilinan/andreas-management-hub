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

//Shows the total income today
function incomeToday()
{
    include 'connection.php';
    $sql = "SELECT SUM(price) as income_data
    FROM tb_orders
    WHERE DATE(order_date_time) = CURRENT_DATE
    AND status = 'Complete'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($row["income_data"] == NULL) {
            echo "₱0";
        } else {
            echo "₱" . $row["income_data"];
        }
    }
    mysqli_close($conn);
}

//Shows the total income this week
function incomeThisWeek()
{
    include 'connection.php';
    $sql = "SELECT SUM(price) as income_data
    FROM tb_orders
    WHERE YEARWEEK(order_date_time) = YEARWEEK(CURRENT_DATE)
    AND status = 'Complete'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($row["income_data"] == NULL) {
            echo "₱0";
        } else {
            echo "₱" . $row["income_data"];
        }
    }
    mysqli_close($conn);
}

//Shows the total income this month
function incomeThisMonth()
{
    include 'connection.php';
    $sql = "SELECT SUM(price) as income_data
    FROM tb_orders
    WHERE MONTH(order_date_time) = MONTH(CURRENT_DATE)
    AND YEAR(order_date_time) = YEAR(CURRENT_DATE)
    AND status = 'Complete'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($row["income_data"] == NULL) {
            echo "₱0";
        } else {
            echo "₱" . $row["income_data"];
        }
    }
    mysqli_close($conn);
}

//Shows the total income this year
function incomeThisYear()
{
    include 'connection.php';
    $sql = "SELECT SUM(price) as income_data
    FROM tb_orders
    WHERE YEAR(order_date_time) = YEAR(CURRENT_DATE)
    AND status = 'Complete'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($row["income_data"] == NULL) {
            echo "₱0";
        } else {
            echo "₱" . $row["income_data"];
        }
    }
    mysqli_close($conn);
}
