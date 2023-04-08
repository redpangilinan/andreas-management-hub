<?php
include "../assets/php/connection.php";

// Show all the products from the database
$product_sql = "SELECT product, expense, price FROM tb_products ORDER BY product_id";
$product_result = mysqli_query($conn, $product_sql);
$count = 0; // initialize a count variable to keep track of the current row
while ($product_row = mysqli_fetch_array($product_result, MYSQLI_ASSOC)) {
    $product = $product_row["product"];
    $expense = $product_row["expense"];
    $price = $product_row["price"];
?>
    <option value="<?php echo $product . ",,," . $price . ",,," . $expense ?>" <?php isSelected($count) ?>><?php echo $product . " - ₱" . $price ?></option>
<?php
    $count++; // increment the count variable after each iteration
}
mysqli_close($conn);

function isSelected($count)
{
    if ($count == 0) {
        echo "selected";
    }
}
?>