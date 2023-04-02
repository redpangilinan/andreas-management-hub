<?php
// Shows the total count of accounts
function userCount()
{
    include 'connection.php';
    $sql = "SELECT * FROM tb_accounts";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

// Shows the total count of products
function productCount()
{
    include 'connection.php';
    $sql = "SELECT * FROM tb_products";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

// Shows the total count of orders
function orderCount()
{
    include 'connection.php';
    $sql = "SELECT * FROM tb_orders";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    echo "$count";
    mysqli_close($conn);
}

// Shows the total income today
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

// Shows the total income last 7 days
function incomeLast7Days()
{
    include 'connection.php';
    $sql = "SELECT SUM(price) as income_data
    FROM tb_orders
    WHERE order_date_time >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)
    AND status = 'Complete';";
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

// Shows the total income last 30 days
function incomeLast30Days()
{
    include 'connection.php';
    $sql = "SELECT SUM(price) as income_data
    FROM tb_orders
    WHERE order_date_time >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)
    AND status = 'Complete';";
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

// Shows the total income last 60 days
function incomeLast60Days()
{
    include 'connection.php';
    $sql = "SELECT SUM(price) as income_data
    FROM tb_orders
    WHERE order_date_time >= DATE_SUB(CURRENT_DATE, INTERVAL 60 DAY)
    AND status = 'Complete';";
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

// Shows the total income this year
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
