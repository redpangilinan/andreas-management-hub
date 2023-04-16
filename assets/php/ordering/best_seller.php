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

mysqli_close($conn);

// Convert the data array to JSON then close the database
$encoded_data = json_encode($data);

function soldProducts($encoded_data)
{
    $productNames = array();
    $productSold = array();
    $productImages = array();
    $orderDetails = $encoded_data['orderDetails'];

    // Count the number of sold products
    foreach ($orderDetails as $order) {
        foreach ($order as $item) {
            $name = $item['name'];
            $qty = $item['qty'];
            $index = array_search($name, $productNames);
            if ($index === false) {
                array_push($productNames, $name);
                array_push($productSold, $qty);
                // Set default image if product name not found in database
                $productImages[$name] = "default.jpg";
            } else {
                $productSold[$index] += $qty;
            }
        }
    }

    // Fetch the product images
    include "./assets/php/connection.php";
    $sql = "SELECT product, image FROM tb_products";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productImages[$row['product']] = $row['image'];
        }
    }
    mysqli_close($conn);

    return array($productNames, $productSold, $productImages);
}

list($productNames, $productSold, $productImages) = soldProducts($data);

// Sort the arrays by the total sold in descending order
array_multisort($productSold, SORT_DESC, $productNames);

// Print the top 3 highest selling products
function bestSeller($productNames, $productImages)
{
    $num_products = 3;
    for ($i = 0; $i < $num_products; $i++) {
        if ($i == 0) {
            $best_class = "best-left";
        } else if ($i == 1) {
            $best_class = "best-mid";
        } else {
            $best_class = "best-right";
        }
        $productImage = $productImages[$productNames[$i]];
        echo "
        <div class='$best_class'>
            <div class='best-img'><img src='./assets/images/products/{$productImage}' alt=''>
                <h4>{$productNames[$i]}</h4>
            </div>
        </div>";
    }
}

// Print the top 3 highest selling products for mobile
function bestSellerM($productNames, $productImages)
{
    $num_products = 3;
    for ($i = 0; $i < $num_products; $i++) {
        if ($i == 0) {
            $best_class = "carousel-item active";
        } else {
            $best_class = "carousel-item";
        }
        $productImage = $productImages[$productNames[$i]];
        echo "
        <div class='$best_class'>
            <div class='best-mob'>
                <div class='best-mob-img'><img src='./assets/images/products/{$productImage}' alt=''>
                    <div class='carousel-caption d-block'>
                        <h5>{$productNames[$i]}</h5>
                    </div>
                </div>
            </div>
        </div>";
    }
}
