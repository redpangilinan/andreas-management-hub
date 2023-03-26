<?php
// Retrieve database information
include "../connection.php";
$option = $_GET['option'];

// Set the SQL query based on the selected option
switch ($option) {
    case 'weekly':
        $sql = "SELECT order_details
        FROM tb_orders
        WHERE YEARWEEK(order_date_time, 1) = YEARWEEK(NOW(), 1)
        AND status = 'Complete'";
        break;
    case 'monthly':
        $sql = "SELECT order_details
        FROM tb_orders
        WHERE MONTH(order_date_time) = MONTH(NOW())
        AND YEAR(order_date_time) = YEAR(NOW())
        AND status = 'Complete'";
        break;
    case 'yearly':
        $sql = "SELECT order_details
        FROM tb_orders
        WHERE YEAR(order_date_time) = YEAR(NOW())
        AND status = 'Complete'";
        break;
    case 'all_time':
        $sql = "SELECT order_details
        FROM tb_orders
        WHERE status = 'Complete'";
        break;
    default:
        // Return an empty response if the option value is invalid
        echo json_encode(['orderDetails' => []]);
        exit;
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Create an array to hold the data
$data = array('orderDetails' => array());

// Loop through the results and add them to the data array
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data['orderDetails'], json_decode($row['order_details'], true));
}

// Convert the data array to JSON then close the database
echo json_encode($data);
mysqli_close($conn);
