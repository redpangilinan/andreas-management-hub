<?php
// Displays the data table with enabled search functionality
if (isset($_POST['input'])) {
    include '../connection.php';
    $input = $_POST['input'];
    $sql = "
    SELECT account_id, firstname, lastname, email, contact_no, creation_date, account_type
    FROM tb_accounts
    WHERE (account_id LIKE '{$input}%'
    OR firstname LIKE '{$input}%'
    OR lastname LIKE '{$input}%'
    OR email LIKE '{$input}%'
    OR contact_no LIKE '{$input}%'
    OR creation_date LIKE '{$input}%'
    OR account_type LIKE '{$input}%')
    ORDER BY account_id
    ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
        <tr>
            <td><?php echo $row["account_id"] ?></td>
            <td><?php echo $row["firstname"] ?></td>
            <td><?php echo $row["lastname"] ?></td>
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
            <td><?php echo $row["account_type"] ?></td>
            <td>
                <button data-id="<?php echo $row["account_id"] ?>" class="edit-data btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></button>
                <button data-id="<?php echo $row["account_id"] ?>" class="delete-data btn btn-danger"><i class="fas fa-trash"></i></button>
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

// Inserts a new data
if (
    isset($_POST['firstname'])
    && isset($_POST['lastname'])
    && isset($_POST['email'])
    && isset($_POST['contact_no'])
    && isset($_POST['password'])
    && isset($_POST['confirm_password'])
) {
    include '../connection.php';
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    if ($password == $confirm_password) {
        $sql = "INSERT INTO tb_accounts VALUES (null, '$firstname', '$lastname', '$password', '$email', '$contact_no', CURDATE(), 'User')";
        if (mysqli_query($conn, $sql)) {
            echo "success";
        } else {
            echo "Error: " . $sql . " " . mysqli_error($conn);
        }
    } else {
        echo "error_confirm";
    }
    mysqli_close($conn);
}

// Updates an existing data
if (
    isset($_POST['primary_id'])
    && isset($_POST['edit_firstname'])
    && isset($_POST['edit_lastname'])
    && isset($_POST['edit_email'])
    && isset($_POST['edit_password'])
) {
    include '../connection.php';
    $primary_id = $_POST['primary_id'];
    $edit_firstname = $_POST['edit_firstname'];
    $edit_lastname = $_POST['edit_lastname'];
    $edit_email = $_POST['edit_email'];
    $edit_contact_no = $_POST['edit_contact_no'];
    $edit_password = mysqli_real_escape_string($conn, $_POST['edit_password']);
    $sql = "UPDATE tb_accounts SET firstname='$edit_firstname', lastname='$edit_lastname', password='$edit_password', email='$edit_email', contact_no='$edit_contact_no' WHERE account_id='$primary_id'";
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
    $sql = "DELETE FROM tb_accounts WHERE account_id = $primary_id";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
    mysqli_close($conn);
}
?>