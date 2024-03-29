<?php
// Displays the data table with enabled search functionality
if (isset($_POST['input'])) {
    include '../connection.php';
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $sql =
        "SELECT product_id, product, category, details, expense, price, status, image
    FROM tb_products
    WHERE (product_id LIKE '{$input}%'
    OR product LIKE '{$input}%'
    OR details LIKE '{$input}%'
    OR category LIKE '{$input}%'
    OR expense LIKE '{$input}%'
    OR price LIKE '{$input}%')
    ORDER BY category DESC, product_id";
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
            <td>
                <?php
                echo "₱" . $row["price"] . "<span class='text-danger'> (" . "₱" . $row["expense"] . ")</span><br>";
                echo "<span class='text-success'>+₱" . ($row["price"] - $row["expense"]) . "</span>";
                ?>
            </td>
            <td>
                <button data-id="<?php echo $row["product_id"] ?>" class="availability btn btn-secondary" style="width: 7rem;"><?php echo $row["status"] ?></button>
            </td>
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
            <td colspan='9'>There are no records.</td>
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
    isset($_POST['expense']) &&
    isset($_POST['price'])
) {
    include '../connection.php';
    include '../image_upload.php';

    // Store input values into variables
    $product = $_POST['product'];
    $details = $_POST['details'];
    $category = $_POST['category'];
    $expense = $_POST['expense'];
    $price = $_POST['price'];

    // Sanitize the input and insert the data into the database
    if ($expense >= $price) {
        echo "expense_handler";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO tb_products VALUES (null, ?, ?, ?, ?, ?, 'Available', ?)");
        mysqli_stmt_bind_param($stmt, "sssdds", $product, $category, $details, $expense, $price, $file_name);
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
    isset($_POST['edit_product']) &&
    isset($_POST['edit_details']) &&
    isset($_POST['edit_category']) &&
    isset($_POST['edit_expense']) &&
    isset($_POST['edit_price'])
) {
    include '../connection.php';
    include '../image_edit.php';

    // Store input values into variables
    $primary_id = $_POST['primary_id'];
    $edit_product = $_POST['edit_product'];
    $edit_details = $_POST['edit_details'];
    $edit_category = $_POST['edit_category'];
    $edit_expense = $_POST['edit_expense'];
    $edit_price = $_POST['edit_price'];

    // Sanitize the user input to before updating record
    if ($edit_expense >= $edit_price) {
        echo "expense_handler";
    } else {
        if ($file_name == "default.jpg") {
            $stmt = mysqli_prepare($conn, "UPDATE tb_products SET product=?, category=?, details=?, expense=?, price=? WHERE product_id=?");
            mysqli_stmt_bind_param($stmt, "sssdds", $edit_product, $edit_category, $edit_details, $edit_expense, $edit_price, $primary_id);
        } else {
            $stmt = mysqli_prepare($conn, "UPDATE tb_products SET product=?, category=?, details=?, expense=?, price=?, image=? WHERE product_id=?");
            mysqli_stmt_bind_param($stmt, "sssddss", $edit_product, $edit_category, $edit_details, $edit_expense, $edit_price, $file_name, $primary_id);
        }
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
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