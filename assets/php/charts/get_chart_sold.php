<?php
// Retrieve database information
include "../connection.php";
$option = $_GET['option'];

// Set the SQL query based on the selected option
switch ($option) {
    case 'weekly':
        $sql = "SELECT DATE(order_date_time)
		AS order_date, COUNT(*)
		AS num_orders
		FROM tb_orders
		WHERE YEARWEEK(order_date_time, 1) = YEARWEEK(NOW(), 1)
		GROUP BY DATE(order_date_time)";
        break;
    case 'monthly':
        $sql = "SELECT DATE(order_date_time)
		AS order_date, COUNT(*)
		AS num_orders
		FROM tb_orders
		WHERE MONTH(order_date_time) = MONTH(NOW())
		AND YEAR(order_date_time) = YEAR(NOW())
		GROUP BY DATE(order_date_time)";
        break;
    case 'yearly':
        $sql = "SELECT DATE(order_date_time)
		AS order_date, COUNT(*)
		AS num_orders
		FROM tb_orders
		WHERE YEAR(order_date_time) = YEAR(NOW())
		GROUP BY DATE(order_date_time)";
        break;
    case 'all_time':
        $sql = "SELECT DATE(order_date_time)
        AS order_date, COUNT(*)
        AS num_orders
        FROM tb_orders
        GROUP BY DATE(order_date_time)";
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
