<?php
session_start();
// Displays the data table with enabled search functionality
if (isset($_POST['profile_info'])) {
    include '../connection.php';
    $primary_id = $_SESSION['account_id'];
    $fullname = $_SESSION['fullname'];
    $sql =
        "SELECT firstname, lastname, email, creation_date FROM tb_accounts WHERE account_id = $primary_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
        <div class="mt-3 mb-4">
            <i class="fa-solid fa-user fa-5x"></i>
        </div>
        <h4 class="mb-2"><?php echo $fullname ?></h4>
        <p class="text-muted mb-1"><?php echo $row["email"] ?></p>
        <p class="text-muted mb-4"><?php echo $row["creation_date"] ?></p>
        <button data-id="<?php echo $primary_id ?>" class="edit-data btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profile</button>
<?php
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
    && isset($_POST['edit_confirm_password'])
) {
    include '../connection.php';
    $primary_id = $_POST['primary_id'];
    $edit_firstname = $_POST['edit_firstname'];
    $edit_lastname = $_POST['edit_lastname'];
    $edit_email = $_POST['edit_email'];
    $edit_contact_no = $_POST['edit_contact_no'];
    $edit_password = $_POST['edit_password'];
    $edit_confirm_password = $_POST['edit_confirm_password'];
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
                $_SESSION['email'] = $edit_email;
                $_SESSION['fullname'] = "$edit_firstname $edit_lastname";
                $_SESSION['password'] = $edit_password;
                echo "success";
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
        } else {
            echo "weak_password";
        }
    } else {
        echo "error_confirm";
    }
    mysqli_close($conn);
}
?>