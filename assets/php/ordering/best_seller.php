<?php
include "./assets/php/connection.php";

// Query the database for all products
$sql = "SELECT order_details
FROM tb_orders
WHERE status = 'Complete'";
$result = mysqli_query($conn, $sql);
$data = array('orderDetails' => array());

// Loop through the results and add them to the data array
while ($row = mysqli_fetch_assoc($result)) {
    array_push($data['orderDetails'], json_decode($row['order_details'], true));
}

// Convert the data array to JSON then close the database
$encoded_data = json_encode($data);

function soldProducts($encoded_data)
{
    $productNames = array();
    $productSold = array();
    $orderDetails = $encoded_data['orderDetails'];

    foreach ($orderDetails as $order) {
        foreach ($order as $item) {
            $name = $item['name'];
            $qty = $item['qty'];
            $index = array_search($name, $productNames);
            if ($index === false) {
                array_push($productNames, $name);
                array_push($productSold, $qty);
            } else {
                $productSold[$index] += $qty;
            }
        }
    }

    return array($productNames, $productSold);
}

list($productNames, $productSold) = soldProducts($data);

// Sort the arrays by the total sold in descending order
array_multisort($productSold, SORT_DESC, $productNames);

// Print the top N highest selling products in the specified format
$num_products = 3; // Change this value to display a different number of products
for ($i = 0; $i < $num_products; $i++) {
    echo "<div class='best-seller'>
        <img src='./assets/images/andreas background.jpg' alt='' class='best-img'>
        <h6>{$productNames[$i]}</h6>
        <p>Best seller</p>
    </div>";
}


mysqli_close($conn);
