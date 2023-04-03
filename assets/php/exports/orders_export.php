<?php
include "../connection.php";
$table_name = 'tb_orders';

// Select data from a table
$query = "SELECT order_id, firstname, lastname, address, contact_no, order_details, order_date_time, order_type, mode_of_payment, price, status FROM $table_name ORDER BY order_date_time DESC";
$result = mysqli_query($conn, $query);

// Create a file pointer for the CSV file
$output = fopen('php://output', 'w');

// Set headers for the CSV file
header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=$table_name.csv");

// Write data to the CSV file
fputcsv($output, array('ID', 'First Name', 'Last Name', 'Address', 'Contact No.', 'Order Details', 'Date to Deliver', 'Order Type', 'Mode of Payment', 'Price', 'Status'));
while ($row = mysqli_fetch_assoc($result)) {
    $order_details = json_decode($row['order_details'], true);
    $item_names = array();
    foreach ($order_details as $item) {
        $item_names[] = $item['name'] . ' (' . $item['qty'] . ')';
    }
    $row['order_details'] = implode(', ', $item_names);
    $row['contact_no'] = "\t" . $row['contact_no'];
    fputcsv($output, $row);
}

// Close the file pointer and database connection
fclose($output);
mysqli_close($conn);
