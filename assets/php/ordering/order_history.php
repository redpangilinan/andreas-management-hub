<?php
include "../connection.php";

$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
$contactNo = mysqli_real_escape_string($conn, $_POST['contactNo']);

// Query for completed orders
$completedQuery = "SELECT order_id, order_details, order_date_time, price, deliveryfee
        FROM tb_orders
        WHERE (firstname = '$firstName'
        AND lastname = '$lastName'
        AND contact_no = '$contactNo')
        AND status = 'Complete'
        ORDER BY order_date_time DESC";

$completedResult = mysqli_query($conn, $completedQuery);

// Query for pending orders
$pendingQuery = "SELECT order_id, order_details, order_date_time, price, deliveryfee
        FROM tb_orders
        WHERE (firstname = '$firstName'
        AND lastname = '$lastName'
        AND contact_no = '$contactNo')
        AND status = 'Pending'
        ORDER BY order_date_time DESC";

$pendingResult = mysqli_query($conn, $pendingQuery);

// Output pending orders
if (mysqli_num_rows($pendingResult) > 0) {
    echo '<div class="history-category"><h5 style="color: #088178;">Pending Orders</h5></div>';
    while ($row = mysqli_fetch_assoc($pendingResult)) {
        $orderId = $row['order_id'];
        $price = $row['price'];
        $deliveryfee = $row['deliveryfee'];
        $orderDate = date('M j, Y', strtotime($row['order_date_time']));
        $orderDetails = json_decode($row['order_details'], true);
        $numItems = count($orderDetails);
        echo '<div class="history-order card" data-id="' . $orderId . '" data-bs-toggle="modal" data-bs-target="#orderHistory">';
        echo '<h5>#' . $orderId . ' - ' . $orderDate . '</h5>';
        echo '<div class="history-details">';
        echo '<span>₱' . ($price + $deliveryfee) . ' - ' . $numItems . ' item(s)</span>';
        echo '</div>';
        echo '</div>';
    }
}

// Output completed orders
if (mysqli_num_rows($completedResult) > 0) {
    echo '<div class="history-category"><h5 style="color: #088178;">Completed Orders</h5></div>';
    while ($row = mysqli_fetch_assoc($completedResult)) {
        $orderId = $row['order_id'];
        $price = $row['price'];
        $orderDate = date('M j, Y', strtotime($row['order_date_time']));
        $orderDetails = json_decode($row['order_details'], true);
        $numItems = count($orderDetails);
        echo '<div class="history-order card" data-id="' . $orderId . '" data-bs-toggle="modal" data-bs-target="#orderHistory">';
        echo '<h5>#' . $orderId . ' - ' . $orderDate . '</h5>';
        echo '<div class="history-details">';
        echo '<span>₱' . ($price + $deliveryfee) . ' - ' . $numItems . ' item(s)</span>';
        echo '</div>';
        echo '</div>';
    }
}

// Output if no orders found
if (mysqli_num_rows($completedResult) == 0 && mysqli_num_rows($pendingResult) == 0) {
    echo "<div class='text-center'>No orders found.</div>";
}

mysqli_close($conn);
