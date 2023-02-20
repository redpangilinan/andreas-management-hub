<?php
include "../connection.php";
$table_name = 'tb_products';

// Select data from a table
$query = "SELECT product_id, product, details, price FROM $table_name";
$result = mysqli_query($conn, $query);

// Create a file pointer for the CSV file
$output = fopen('php://output', 'w');

// Set headers for the CSV file
header('Content-Type: text/csv');
header("Content-Disposition: attachment; filename=$table_name.csv");

// Write data to the CSV file
fputcsv($output, array('ID', 'Product', 'Details', 'Price'));
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Close the file pointer and database connection
fclose($output);
mysqli_close($conn);
