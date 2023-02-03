<?php
// Displays the data table with enabled search functionality
if(isset($_POST['input'])) {
    include '../connection.php';
    $input = $_POST['input'];
    $sql =
        "SELECT account_id, username, password, email, creation_date, account_type
    FROM tb_accounts
    WHERE account_type = 'User'
    AND (account_id LIKE '{$input}%'
    OR username LIKE '{$input}%'
    OR password LIKE '{$input}%'
    OR email LIKE '{$input}%'
    OR creation_date LIKE '{$input}%'
    OR account_type LIKE '{$input}%')
    ORDER BY account_id";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        ?>
        <tr>
            <td><?php echo $row["account_id"] ?></td>
            <td><?php echo $row["username"] ?></td>
            <td><?php echo $row["password"] ?></td>
            <td><?php echo $row["email"] ?></td>
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
            <td colspan='7'>There are no records.</td>
        </tr>
        <?php
    }
    mysqli_close($conn);
}

// Inserts a new data
if (isset($_POST['username'])
&& isset($_POST['email'])
&& isset($_POST['password'])
&& isset($_POST['confirm_password'])) {
    include '../connection.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    if ($password == $confirm_password) {
        $sql = "INSERT INTO tb_accounts VALUES (null, '$username', '$password', '$email', CURDATE(), 'User')";
        if (mysqli_query($conn, $sql)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error_confirm";
    }
    mysqli_close($conn);
}

// Updates an existing data
if (isset($_POST['primary_id'])
&& isset($_POST['edit_username'])
&& isset($_POST['edit_email'])
&& isset($_POST['edit_password'])) {
    include '../connection.php';
    $primary_id = $_POST['primary_id'];
    $edit_username = $_POST['edit_username'];
    $edit_email = $_POST['edit_email'];
    $edit_password = mysqli_real_escape_string($conn, $_POST['edit_password']);
    $sql = "UPDATE tb_accounts SET username='$edit_username', password='$edit_password', email='$edit_email' WHERE account_id='$primary_id'";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
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