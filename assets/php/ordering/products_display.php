<?php
if (isset($_POST['category'])) {
    include "../connection.php";
    $category = mysqli_real_escape_string($conn, $_POST["category"]);

    // Query the database for all products
    if ($category == "All") {
        $query = "SELECT product_id, product, price, image FROM tb_products WHERE status = 'Available' ORDER BY product_id";
    } else {
        $query = "SELECT product_id, product, price, image FROM tb_products WHERE category = '$category' AND status = 'Available' ORDER BY product_id";
    }
    $result = mysqli_query($conn, $query);

    // Loop through the results and print the products
    while ($row = mysqli_fetch_assoc($result)) {
        $primary_id = $row['product_id'];
        $product = $row['product'];
        $price = $row['price'];
        $image = $row['image'];

?>
        <div class="product" data-id="<?php echo $primary_id ?>">
            <img src="./assets/images/products/<?php echo $image ?>" alt="">
            <div class="product-text">
                <span>Andrea's Fresh and Greens</span>
                <h5><?php echo $product ?></h5>
                <hr>
                <h4><?php echo "₱" . $price ?></h4>
                <button type="button">Order</button>
            </div>
        </div>
<?php
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Error retrieving data.";
}
?>