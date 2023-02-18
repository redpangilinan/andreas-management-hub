<?php
include '../connection.php';
$primary_id = $_POST["primary_id"];
$sql =
    "SELECT product, details, price, image
    FROM tb_products
    WHERE product_id = $primary_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
    <input type="hidden" id="primary_id" value="<?php echo $primary_id ?>">
    <div class="mb-3 d-flex">
        <div class="w-100">
            <label for="edit_product" class="form-label">Product</label>
            <input type="text" class="form-control" id="edit_product" placeholder="Product" value="<?php echo $row['product'] ?>" required>
        </div>
        <div class="w-100 ms-2">
            <label for="edit_product" class="form-label">Price</label>
            <input type="number" class="form-control" id="edit_product" placeholder="Product" value="<?php echo $row['product'] ?>" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_details">Details</label>
        <textarea class="form-control" id="edit_details" rows="3" placeholder="Details" required><?php echo $row['details'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="edit_product_image" class="form-label">Product Image</label>
        <input class="form-control" type="file" id="edit_product_image">
    </div>
<?php
}
?>