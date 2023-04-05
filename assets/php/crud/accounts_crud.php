<?php
// Displays the data table with enabled search functionality
if (isset($_POST['input'])) {
    include '../connection.php';
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $sql =
        "SELECT account_id, firstname, lastname, email, contact_no, creation_date, account_type
    FROM tb_accounts
    WHERE (account_id LIKE '{$input}%'
    OR firstname LIKE '{$input}%'
    OR lastname LIKE '{$input}%'
    OR email LIKE '{$input}%'
    OR contact_no LIKE '{$input}%'
    OR creation_date LIKE '{$input}%'
    OR account_type LIKE '{$input}%')
    ORDER BY account_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
        <tr>
            <td><?php echo $row["account_id"] ?></td>
            <td><?php echo $row["firstname"] . " " . $row["lastname"] ?></td>
            <td><?php echo $row["email"] ?></td>
            <td>
                <?php
                if ($row["contact_no"] == "") {
                    echo "N/A";
                } else {
                    echo $row["contact_no"];
                }
                ?>
            </td>
            <td><?php echo $row["creation_date"] ?></td>
            <td>
                <button data-id="<?php echo $row["account_id"] ?>" class="switch-auth btn btn-secondary" style="width: 6rem;"><?php echo $row["account_type"] ?></button>
            </td>
            <td>
                <div class="btn-group" role="group" aria-label="modify">
                    <button data-id="<?php echo $row["account_id"] ?>" class="edit-data btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                    <button data-id="<?php echo $row["account_id"] ?>" class="delete-data btn btn-danger"><i class="fas fa-trash"></i></button>
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

// Inserts a new data
if (
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['email']) &&
    isset($_POST['contact_no']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm_password'])
) {
    include '../connection.php';
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password == $confirm_password) {
        // Check if the password is strong
        include "../password_validation.php";
        if (validatePassword($password)) {
            // Hash the password before inserting
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Insert the data to database using prepared statement
            $stmt = mysqli_prepare($conn, "INSERT INTO tb_accounts VALUES (null, ?, ?, ?, ?, ?, CURDATE(), 'Admin')");
            mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $hashed_password, $email, $contact_no);
            if (mysqli_stmt_execute($stmt)) {
                echo "success";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "weak_password";
        }
    } else {
        echo "error_confirm";
    }
    mysqli_close($conn);
}

// Updates an existing data
if (
    isset($_POST['primary_id']) &&
    isset($_POST['edit_firstname']) &&
    isset($_POST['edit_lastname']) &&
    isset($_POST['edit_email']) &&
    isset($_POST['edit_password']) &&
    isset($_POST['edit_confirm_password'])
) {

    $primary_id = $_POST['primary_id'];
    $edit_firstname = $_POST['edit_firstname'];
    $edit_lastname = $_POST['edit_lastname'];
    $edit_email = $_POST['edit_email'];
    $edit_contact_no = $_POST['edit_contact_no'];
    $edit_password = $_POST['edit_password'];
    $edit_confirm_password = $_POST['edit_confirm_password'];
    if ($primary_id !== "1") {
        include '../connection.php';
        if ($edit_password == $edit_confirm_password) {
            // Check if the password is strong
            include "../password_validation.php";
            if (validatePassword($edit_password)) {
                // Hash the password before updating
                $hashed_password = password_hash($edit_password, PASSWORD_DEFAULT);
                // Update the selected data
                $stmt = mysqli_prepare($conn, "UPDATE tb_accounts SET firstname=?, lastname=?, password=?, email=?, contact_no=? WHERE account_id=?");
                mysqli_stmt_bind_param($stmt, "ssssss", $edit_firstname, $edit_lastname, $hashed_password, $edit_email, $edit_contact_no, $primary_id);
                if (mysqli_stmt_execute($stmt)) {
                    echo "success";
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "weak_password";
            }
        } else {
            echo "error_confirm";
        }
        mysqli_close($conn);
    } else {
        echo "owner_account";
    }
}

// Deletes an existing data
if (isset($_POST['delete_id'])) {
    $primary_id = $_POST['delete_id'];
    if ($primary_id !== "1") {
        include '../connection.php';
        $stmt = mysqli_prepare($conn, "DELETE FROM tb_accounts WHERE account_id = ?");
        mysqli_stmt_bind_param($stmt, 's', $primary_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "owner_account";
    }
}
?>