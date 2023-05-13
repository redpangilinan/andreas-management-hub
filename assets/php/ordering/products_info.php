<?php
include '../connection.php';
$primary_id = mysqli_real_escape_string($conn, $_POST["primary_id"]);
$sql =
    "SELECT product, details, expense, price, image
    FROM tb_products
    WHERE product_id = $primary_id";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
    <div class="modal-body">
        <input type="hidden" name="primary_id" id="primary_id" value="<?php echo $primary_id ?>">
        <input type="hidden" name="expense" id="expense" value="<?php echo $row['expense'] ?>">
        <div class="info-img">
            <div class="order-img">
                <img src="./assets/images/products/<?php echo $row["image"] ?>" alt="">
            </div>
            <div class="order-info">
                <h5><?php echo $row['product'] . " - ₱" . $row['price'] ?></h5>
                <div class="text-secondary"><?php echo $row['details'] ?></div>
            </div>
        </div>
        <hr>
        <div class="ordr-quantity">
            <h6>Quantity:</h6>
            <div class="quantity">
                <span class="minus">-</span>
                <input role="textbox" type="number" class="count" name="quantity" id="quantity" value="1">
                <span class="plus">+</span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="ordr-butn" data-bs-dismiss="modal">Buy Now</button>
        <button type="button" class="ordr-butn" data-bs-dismiss="modal" onclick="addToCart('<?php echo $row['product'] ?>', parseInt(document.querySelector('#quantity').value), <?php echo $row['price'] ?> * parseInt(document.querySelector('#quantity').value), <?php echo $row['expense'] ?> * parseInt(document.querySelector('#quantity').value), '<?php echo $row['image'] ?>', 'add')">Add to Cart</button>
    </div>
<?php
}
?>