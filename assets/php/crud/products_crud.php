<?php
// Displays the data table with enabled search functionality
if (isset($_POST['input'])) {
    include '../connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT product_id, product, details, price, image
    FROM tb_products
    WHERE product_id LIKE '{$input}%'
    OR product LIKE '{$input}%'
    OR details LIKE '{$input}%'
    OR price LIKE '{$input}%'
    ORDER BY product_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
        <tr>
            <td><?php echo $row["product_id"] ?></td>
            <td><?php echo $row["image"] ?></td>
            <td><?php echo $row["product"] ?></td>
            <td><?php echo $row["details"] ?></td>
            <td><?php echo $row["price"] ?></td>
            <td>
                <button data-id="<?php echo $row["product_id"] ?>" class="edit-data btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                <button data-id="<?php echo $row["product_id"] ?>" class="delete-data btn btn-danger"><i class="fas fa-trash"></i></button>
            </td>
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

// Inserts a new data
if (
    isset($_POST['product']) &&
    isset($_POST['details']) &&
    isset($_POST['price'])
) {
    include '../connection.php';
    // mysqli_real_escape_string() escapes the special characters that the users will input that will otherwise become an error
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $price = $_POST['price'];
    $sql = "INSERT INTO tb_products VALUES (null, '$product', '$details', $price, 'default.png')";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

// Updates an existing data
if (
    isset($_POST['primary_id']) &&
    isset($_POST['edit_product']) &&
    isset($_POST['edit_details']) &&
    isset($_POST['edit_price'])
) {
    include '../connection.php';
    $primary_id = $_POST['primary_id'];
    // mysqli_real_escape_string() escapes the special characters that the users will input that will otherwise become an error
    $edit_product = mysqli_real_escape_string($conn, $_POST['edit_product']);
    $edit_details = mysqli_real_escape_string($conn, $_POST['edit_details']);
    $edit_price = $_POST['edit_price'];
    $sql = "UPDATE tb_products SET product='$edit_product', details='$edit_details', price='$edit_price' WHERE product_id='$primary_id'";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

// Deletes an existing data
if (isset($_POST['delete_id'])) {
    include '../connection.php';
    $primary_id = $_POST['delete_id'];
    $sql = "DELETE FROM tb_products WHERE product_id = $primary_id";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>