<?php
include '../connection.php';
$primary_id = $_POST["primary_id"];
$sql =
    "SELECT product, category, details, expense, price, image
    FROM tb_products
    WHERE product_id = $primary_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
    <input type="hidden" name="primary_id" id="primary_id" value="<?php echo $primary_id ?>">
    <div class="mb-3 d-flex">
        <div class="w-100">
            <label for="edit_product" class="form-label">Product</label>
            <input type="text" class="form-control" name="edit_product" id="edit_product" placeholder="Product" value="<?php echo $row['product'] ?>" required>
        </div>
        <div class="w-100 ms-2">
            <label for="edit_category" class="form-label">Category</label>
            <input type="text" class="form-control" name="edit_category" id="edit_category" placeholder="Category" value="<?php echo $row['category'] ?>" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_details">Details</label>
        <textarea class="form-control" name="edit_details" id="edit_details" rows="3" placeholder="Details" required><?php echo $row['details'] ?></textarea>
    </div>
    <div class="mb-3 d-flex">
        <div class="w-100">
            <label for="edit_expense" class="form-label">Expense</label>
            <input type="number" class="form-control" name="edit_expense" id="edit_expense" placeholder="Expense" value="<?php echo $row['expense'] ?>" required>
        </div>
        <div class="w-100 ms-2">
            <label for="edit_price" class="form-label">Price</label>
            <input type="number" class="form-control" name="edit_price" id="edit_price" placeholder="Price" value="<?php echo $row['price'] ?>" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_image" class="form-label">Product Image</label>
        <input class="form-control" type="file" name="edit_image" id="edit_image">
    </div>
<?php
}
?>