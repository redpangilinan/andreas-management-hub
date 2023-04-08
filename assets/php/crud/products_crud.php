<?php
// Displays the data table with enabled search functionality
if (isset($_POST['input'])) {
    include '../connection.php';
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $sql =
        "SELECT product_id, product, category, details, expense, price, image
    FROM tb_products
    WHERE (product_id LIKE '{$input}%'
    OR product LIKE '{$input}%'
    OR details LIKE '{$input}%'
    OR category LIKE '{$input}%'
    OR expense LIKE '{$input}%'
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
            <td><?php echo "₱" . $row["expense"] ?></td>
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
            <td colspan='8'>There are no records.</td>
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

    // Store input values into variables
    $product = $_POST['product'];
    $details = $_POST['details'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Sanitize the input and insert the data into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO tb_products VALUES (null, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssds", $product, $category, $details, $price, $file_name);
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
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
    $edit_product = $_POST['edit_product'];
    $edit_details = $_POST['edit_details'];
    $edit_category = $_POST['edit_category'];
    $edit_price = $_POST['edit_price'];

    if ($file_name == "default.jpg") {
        $stmt = mysqli_prepare($conn, "UPDATE tb_products SET product=?, category=?, details=?, price=? WHERE product_id=?");
        mysqli_stmt_bind_param($stmt, "sssds", $edit_product, $edit_category, $edit_details, $edit_price, $primary_id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE tb_products SET product=?, category=?, details=?, price=?, image=? WHERE product_id=?");
        mysqli_stmt_bind_param($stmt, "sssdss", $edit_product, $edit_category, $edit_details, $edit_price, $file_name, $primary_id);
    }
    if (mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

// Deletes an existing data
if (isset($_POST['delete_id'])) {
    include '../connection.php';
    $primary_id = $_POST['delete_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM tb_products WHERE product_id = ?");
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