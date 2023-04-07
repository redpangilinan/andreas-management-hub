<?php
include '../connection.php';
$primary_id = $_POST["primary_id"];
$sql =
    "SELECT product, price, image
    FROM tb_products
    WHERE product_id = $primary_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
    <input type="hidden" name="primary_id" id="primary_id" value="<?php echo $primary_id ?>">
    <div class="info-img">
        <div class="order-img">
            <img src="./assets/images/products/<?php echo $row["image"] ?>" alt="">
        </div>
        <div class="order-info">
            <h5><?php echo $row['product'] ?></h5>
            <span>Price:</span> <span><?php echo "₱" . $row['price'] ?></span>
        </div>
    </div>
    <hr>
    <div class="del-type">
        <h6>Delivery Type:</h6>
        <select class="form-select form-select-sm" id="delivery" name="delivery">
            <option value="Pick Up">Pick Up</option>
            <option value="Delivery">Delivery</option>
        </select>
    </div>
    <hr>
    <div class="ordr-quantity">
        <h6>Quantity:</h6>
        <div class="quantity">
            <span class="minus">-</span>
            <input role="textbox" type="number" class="count" name="quantity" value="1">
            <span class="plus">+</span>
        </div>
    </div>
<?php
}
?>