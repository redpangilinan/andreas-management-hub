<?php
include "../connection.php";

$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
$contactNo = mysqli_real_escape_string($conn, $_POST['contactNo']);

$query = "SELECT order_id, order_details, order_date_time, price
        FROM tb_orders
        WHERE (firstname = '$firstName'
        AND lastname = '$lastName'
        AND contact_no = '$contactNo')
        AND status = 'Complete'
        ORDER BY order_date_time DESC";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orderId = $row['order_id'];
        $price = $row['price'];
        $orderDate = date('M j, Y', strtotime($row['order_date_time']));
        $orderDetails = json_decode($row['order_details'], true);
        $numItems = count($orderDetails);
        echo '<div class="history-order card" data-id="' . $orderId . '" data-bs-toggle="modal" data-bs-target="#orderHistory">';
        echo '<h5>#' . $orderId . ' - ' . $orderDate . '</h5>';
        echo '<div class="history-details">';
        echo '<span>₱' . $price . ' - ' . $numItems . ' item(s)</span>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<div class='text-center'>No orders found.</div>";
}

mysqli_close($conn);
