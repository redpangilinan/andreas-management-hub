<?php
// Retrieve database information
include "../connection.php";
$option = $_GET['option'];

// Set the SQL query based on the selected option
switch ($option) {
    case 'weekly':
        $sql = "SELECT DAYNAME(calendar.date) AS order_date, COUNT(tb_orders.order_id) AS num_orders
        FROM (
          SELECT DATE(NOW() - INTERVAL weekday(NOW()) DAY + INTERVAL seq DAY) AS date
          FROM seq_0_to_6
        ) calendar
        LEFT JOIN tb_orders ON DATE(tb_orders.order_date_time) = calendar.date
          AND YEARWEEK(tb_orders.order_date_time, 1) = YEARWEEK(NOW(), 1)
          AND tb_orders.status = 'Complete'
        GROUP BY calendar.date";
        break;
    case 'monthly':
        $sql = "SELECT calendar.date AS order_date, COUNT(tb_orders.order_id) AS num_orders
        FROM (
          SELECT LAST_DAY(NOW() - INTERVAL 1 MONTH) + INTERVAL 1 DAY + INTERVAL seq DAY AS date
          FROM seq_0_to_30
          WHERE LAST_DAY(NOW() - INTERVAL 1 MONTH) + INTERVAL 1 DAY + INTERVAL seq DAY <= NOW()
        ) calendar
        LEFT JOIN tb_orders ON DATE(tb_orders.order_date_time) = calendar.date
          AND MONTH(tb_orders.order_date_time) = MONTH(NOW())
          AND YEAR(tb_orders.order_date_time) = YEAR(NOW())
          AND tb_orders.status = 'Complete'
        GROUP BY calendar.date";
        break;
    case 'yearly':
        $sql = "SELECT 'January' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 1 AND status = 'Complete'
        UNION
        SELECT 'February' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 2 AND status = 'Complete'
        UNION
        SELECT 'March' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 3 AND status = 'Complete'
        UNION
        SELECT 'April' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 4 AND status = 'Complete'
        UNION
        SELECT 'May' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 5 AND status = 'Complete'
        UNION
        SELECT 'June' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 6 AND status = 'Complete'
        UNION
        SELECT 'July' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 7 AND status = 'Complete'
        UNION
        SELECT 'August' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 8 AND status = 'Complete'
        UNION
        SELECT 'September' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 9 AND status = 'Complete'
        UNION
        SELECT 'October' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 10 AND status = 'Complete'
        UNION
        SELECT 'November' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 11 AND status = 'Complete'
        UNION
        SELECT 'December' AS order_date, COUNT(*) AS num_orders
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW()) AND MONTH(order_date_time) = 12 AND status = 'Complete'";
        break;
    case 'all_time':
        $sql = "SELECT 
        YEAR(order_date_time) AS order_date, 
        COUNT(*) AS num_orders
        FROM tb_orders
        WHERE status = 'Complete'
        GROUP BY YEAR(order_date_time)
        HAVING COUNT(*) >= 1
        ORDER BY order_date;";
        break;
    default:
        // Return an empty response if the option value is invalid
        echo json_encode(['orderDates' => [], 'numOrders' => []]);
        exit;
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Create an array to hold the data
$data = array('orderDates' => array(), 'numOrders' => array());

// Loop through the results and add them to the data array
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data['orderDates'], $row['order_date']);
    array_push($data['numOrders'], $row['num_orders']);
}

// Convert the data array to JSON then close the database
echo json_encode($data);
mysqli_close($conn);
