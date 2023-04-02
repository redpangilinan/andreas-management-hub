<?php
// Retrieve database information
include "../connection.php";
$option = $_GET['option'];

// Set the SQL query based on the selected option
switch ($option) {
    case 'today':
        $sql = "SELECT order_details
        FROM tb_orders
        WHERE DATE(order_date_time) = CURDATE()
        AND status = 'Complete'";
        break;
    case 'last7':
        $sql = "SELECT order_details
        FROM tb_orders
        WHERE order_date_time >= CURDATE() - INTERVAL 7 DAY
        AND status = 'Complete'";
        break;
    case 'last30':
        $sql = "SELECT order_details
        FROM tb_orders
        WHERE order_date_time >= CURDATE() - INTERVAL 30 DAY
        AND status = 'Complete'";
        break;
    case 'last60':
        $sql = "SELECT order_details
        FROM tb_orders
        WHERE order_date_time >= CURDATE() - INTERVAL 60 DAY
        AND status = 'Complete'";
        break;
    case 'this_year':
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
