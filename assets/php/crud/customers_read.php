<?php
// Displays the data table with enabled search functionality
if (isset($_POST['input'])) {
    include '../connection.php';
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $sql =
        "SELECT 
            ROW_NUMBER() OVER (ORDER BY SUM(price) DESC) AS rank,
            CONCAT(firstname, ' ', lastname) AS customer_name,
            address,
            contact_no,
            COUNT(order_id) AS total_orders,
            SUM(price) AS total_spent
        FROM tb_orders
        WHERE status = 'Complete'
            AND (
                CONCAT(firstname, ' ', lastname) LIKE '{$input}%'
                OR address LIKE '{$input}%'
                OR contact_no LIKE '{$input}%'
            )
        GROUP BY firstname, lastname, contact_no
        ORDER BY SUM(price) DESC";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
        <tr>
            <td><?php echo $row["rank"] ?></td>
            <td><?php echo $row["customer_name"] ?></td>
            <td><?php echo $row["address"] ?></td>
            <td><?php echo $row["contact_no"] ?></td>
            <td><?php echo $row["total_orders"] ?></td>
            <td><?php echo "₱" . $row["total_spent"] ?></td>
        </tr>
    <?php
    }
    if (($count) == 0) {
    ?>
        <tr>
            <td colspan='6'>There are no records.</td>
        </tr>
<?php
    }
    mysqli_close($conn);
}
