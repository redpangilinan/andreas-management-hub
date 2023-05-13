<?php
// Displays the data table with enabled search functionality
if (isset($_POST['input']) && isset($_POST['filter_status'])) {
    include '../connection.php';
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $filter_status = mysqli_real_escape_string($conn, $_POST['filter_status']);
    $sql =
        "SELECT order_id, firstname, lastname, address, contact_no, order_details, order_date_time, order_type, mode_of_payment, price, profit, deliveryfee, status
    FROM tb_orders
    WHERE status = '$filter_status'
    AND (order_id LIKE '{$input}%'
    OR firstname LIKE '{$input}%'
    OR lastname LIKE '{$input}%'
    OR address LIKE '{$input}%'
    OR contact_no LIKE '{$input}%'
    OR order_details LIKE '{$input}%'
    OR order_date_time LIKE '{$input}%'
    OR order_type LIKE '{$input}%'
    OR mode_of_payment LIKE '{$input}%'
    OR price LIKE '{$input}%'
    OR profit LIKE '{$input}%'
    OR status LIKE '{$input}%')
    ORDER BY order_date_time DESC";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data = json_decode($row["order_details"], true);
?>
        <tr>
            <td><?php echo $row["order_id"] ?></td>
            <td>
                <div class="card">
                    <ul class="list-group list-group-flush text-nowrap">
                        <li class="list-group-item"><?php echo $row["firstname"] . " " . $row["lastname"] ?></li>
                        <li class="list-group-item"><?php echo $row["contact_no"] ?></li>
                        <li class="list-group-item"><?php echo $row["address"] ?></li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="card">
                    <ul class="list-group list-group-flush text-nowrap">
                        <?php
                        foreach ($data as $item) {
                            $name = $item['name'];
                            $qty = $item['qty'];
                            $price = $item['price'];

                            echo '<li class="list-group-item">' . $name . ' (' . $qty . ') - ₱' . $price . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </td>
            <td><?php echo date("Y-m-d h:i A", strtotime($row["order_date_time"])); ?></td>
            <td><?php echo $row["order_type"] ?></td>
            <td><?php echo $row["mode_of_payment"] ?></td>
            <td><?php echo "₱" . $row["price"] . " <span class='text-success'>(" . "₱" . $row["profit"] . ")</span>
                            <br><span class='text-secondary'>₱" . $row["deliveryfee"] . "</span>";
                ?>
            </td>
            <td>
                <select data-id="<?php echo $row["order_id"] ?>" class="status-select form-select form-select-sm" style="min-width: 7rem;">
                    <option value="Pending" <?php if ($row["status"] == "Pending") echo "selected" ?>>Pending</option>
                    <option value="Complete" <?php if ($row["status"] == "Complete") echo "selected" ?>>Complete</option>
                    <option value="Canceled" <?php if ($row["status"] == "Canceled") echo "selected" ?>>Canceled</option>
                </select>
            </td>
            <td>
                <div class="btn-group" role="group" aria-label="modify">
                    <!-- <button data-id="<?php // echo $row["order_id"] 
                                            ?>" class="view-data btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fas fa-eye"></i></button> -->
                    <button data-id="<?php echo $row["order_id"] ?>" class="edit-data btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                    <button data-id="<?php echo $row["order_id"] ?>" class="delete-data btn btn-danger"><i class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
    <?php
    }
    if (($count) == 0) {
    ?>
        <tr>
            <td colspan='10'>There are no records.</td>
        </tr>
<?php
    }
    mysqli_close($conn);
}

// Inserts new data
if (
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['address']) &&
    isset($_POST['contact_no']) &&
    isset($_POST['order_details']) &&
    isset($_POST['order_date_time']) &&
    isset($_POST['order_type']) &&
    isset($_POST['mode_of_payment']) &&
    isset($_POST['price']) &&
    isset($_POST['profit']) &&
    isset($_POST['deliveryfee'])
) {
    include '../connection.php';

    // Store input values into variables
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $order_details = $_POST['order_details'];
    $order_date_time = date('Y-m-d H:i:s', strtotime($_POST['order_date_time']));
    $order_type = $_POST['order_type'];
    $mode_of_payment = $_POST['mode_of_payment'];
    $price = $_POST['price'];
    $profit = $_POST['profit'];
    $deliveryfee = $_POST['deliveryfee'];

    // Sanitize the input and insert the data into the database
    if ($order_details == "[]" || $order_details == "") {
        echo "empty_cart";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO tb_orders VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
        mysqli_stmt_bind_param($stmt, "ssssssssddd", $firstname, $lastname, $address, $contact_no, $order_details, $order_date_time, $order_type, $mode_of_payment, $price, $profit, $deliveryfee);
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


// Updates an existing data
if (
    isset($_POST['primary_id']) &&
    isset($_POST['edit_firstname']) &&
    isset($_POST['edit_lastname']) &&
    isset($_POST['edit_address']) &&
    isset($_POST['edit_contact_no']) &&
    isset($_POST['edit_order_details']) &&
    isset($_POST['edit_order_date_time']) &&
    isset($_POST['edit_order_type']) &&
    isset($_POST['edit_mode_of_payment']) &&
    isset($_POST['edit_price']) &&
    isset($_POST['edit_profit']) &&
    isset($_POST['edit_status'])
) {
    include '../connection.php';

    // Store input values into variables
    $primary_id = $_POST['primary_id'];
    $edit_firstname = $_POST['edit_firstname'];
    $edit_lastname = $_POST['edit_lastname'];
    $edit_address = $_POST['edit_address'];
    $edit_contact_no = $_POST['edit_contact_no'];
    $edit_order_details = $_POST['edit_order_details'];
    $edit_order_date_time = date('Y-m-d H:i:s', strtotime($_POST['edit_order_date_time']));
    $edit_order_type = $_POST['edit_order_type'];
    $edit_mode_of_payment = $_POST['edit_mode_of_payment'];
    $edit_price = $_POST['edit_price'];
    $edit_profit = $_POST['edit_profit'];
    $edit_status = $_POST['edit_status'];

    // Sanitize the input and insert the data into the database
    if ($edit_order_details == "[]" || $edit_order_details == "") {
        echo "empty_cart";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE tb_orders SET firstname=?, lastname=?, address=?, contact_no=?, order_details=?, order_date_time=?, order_type=?, mode_of_payment=?, price=?, profit=?, status=? WHERE order_id=?");
        mysqli_stmt_bind_param($stmt, "ssssssssddss", $edit_firstname, $edit_lastname, $edit_address, $edit_contact_no, $edit_order_details, $edit_order_date_time, $edit_order_type, $edit_mode_of_payment, $edit_price, $edit_profit, $edit_status, $primary_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

// Deletes an existing data
if (isset($_POST['delete_id'])) {
    include '../connection.php';
    $primary_id = $_POST['delete_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM tb_orders WHERE order_id = ?");
    mysqli_stmt_bind_param($stmt, 's', $primary_id);
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>