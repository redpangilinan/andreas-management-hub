<?php
include "../assets/php/connection.php";

// Show all the products from the database
$product_sql = "SELECT product FROM tb_products ORDER BY product_id";
$product_result = mysqli_query($conn, $product_sql);
while ($product_row = mysqli_fetch_array($product_result, MYSQLI_ASSOC)) {
    $product = $product_row["product"];
?>
    <option value="<?php echo $product ?>"><?php echo $product ?></option>
<?php
}

mysqli_close($conn);
?>