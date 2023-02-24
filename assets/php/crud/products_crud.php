<?php
// Displays the data table with enabled search functionality
if (isset($_POST['input'])) {
    include '../connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT product_id, product, category, details, price, image
    FROM tb_products
    WHERE (product_id LIKE '{$input}%'
    OR product LIKE '{$input}%'
    OR details LIKE '{$input}%'
    OR category LIKE '{$input}%'
    OR price LIKE '{$input}%')
    ORDER BY product_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
        <tr>
            <td><?php echo $row["product_id"] ?></td>
            <td>
                <img src="../assets/images/products/<?php echo $row["image"] ?>" class="img img-fluid rounded shadow" alt="">
            </td>
            <td><?php echo $row["product"] ?></td>
            <td><?php echo $row["category"] ?></td>
            <td><?php echo $row["details"] ?></td>
            <td><?php echo "₱" . $row["price"] ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="modify">
                    <button data-id="<?php echo $row["product_id"] ?>" class="edit-data btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                    <button data-id="<?php echo $row["product_id"] ?>" class="delete-data btn btn-danger"><i class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
    <?php
    }
    if (($count) == 0) {
    ?>
        <tr>
            <td colspan='7'>There are no records.</td>
        </tr>
<?php
    }
    mysqli_close($conn);
}

// Inserts new data
if (
    isset($_POST['product']) &&
    isset($_POST['details']) &&
    isset($_POST['category']) &&
    isset($_POST['price'])
) {
    include '../connection.php';
    include '../image_upload.php';

    // Sanitize the user input to prevent SQL injection attacks
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = $_POST['price'];

    // Insert the data into the database
    $sql = "INSERT INTO tb_products VALUES (null, '$product', '$category', '$details', $price, '$file_name')";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}


// Updates an existing data
if (
    isset($_POST['primary_id']) &&
    isset($_POST['edit_product']) &&
    isset($_POST['edit_details']) &&
    isset($_POST['edit_category']) &&
    isset($_POST['edit_price'])
) {
    include '../connection.php';
    include '../image_edit.php';

    // Sanitize the user input to prevent SQL injection attacks
    $primary_id = $_POST['primary_id'];
    $edit_product = mysqli_real_escape_string($conn, $_POST['edit_product']);
    $edit_details = mysqli_real_escape_string($conn, $_POST['edit_details']);
    $edit_category = mysqli_real_escape_string($conn, $_POST['edit_category']);
    $edit_price = $_POST['edit_price'];

    if ($file_name == "default.jpg") {
        $sql = "UPDATE tb_products SET product='$edit_product', category='$edit_category', details='$edit_details', price='$edit_price' WHERE product_id='$primary_id'";
    } else {
        $sql = "UPDATE tb_products SET product='$edit_product', category='$edit_category', details='$edit_details', price='$edit_price', image='$file_name' WHERE product_id='$primary_id'";
    }
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