<?php
include "../connection.php";

$primary_id = $_POST['primary_id'];

// Retrieve order details from the database
$query = "SELECT order_details, order_date_time, price, deliveryfee FROM tb_orders WHERE order_id = $primary_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $order_details = json_decode($row['order_details'], true);
    $order_date_time = $row['order_date_time'];
    $price = $row['price'];
    $deliveryfee = $row['deliveryfee'];

    // Format the order date and time
    $date = date_create($order_date_time);
    $formatted_date = date_format($date, "M d, Y");
    $formatted_time = date_format($date, "h:i A");

    // Calculate the total price
    $total_price = $price + $deliveryfee;

    // Display the order details in the desired format
    echo '
        <div class="modal-body">
            <div class="history-info-con" id="order-history-info">
                <div class="history-date" id="history-date">
                    <span>Delivery Date:</span>
                    <span>' . $formatted_date . '</span>
                </div>
                <div class="history-item-con" id="history-item-con">';

    foreach ($order_details as $item) {
        echo '
            <div class="history-item border rounded p-2 mb-2">
                <div class="history-details">
                    <div class="history-item-details">
                        <span>' . $item['name'] . '</span>
                    </div>
                    <span>x' . $item['qty'] . '</span>
                </div>
                <div class="history-sub">
                    <span>Price:</span>
                    <span>₱' . $item['price'] . '</span>
                </div>
            </div>';
    }

    echo '</div>
        </div>
        <div class="modal-footer d-flex justify-content-between" id="order-history-details">
            <div>
                <h6>Sub Total:</h6>
                <h6>Delivery Fee:</h6>
                <h6>Total Price:</h6>
            </div>
            <div>
                <h6>₱' . $price . '</h6>
                <h6>₱' . $deliveryfee . '</h6>
                <h6>₱' . $total_price . '</h6>
            </div>
        </div>';
} else {
    echo "<div class='p-3'>Cannot fetch order.<div>";
}

mysqli_close($conn);
