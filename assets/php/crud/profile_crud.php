<?php
session_start();
// Displays the data table with enabled search functionality
if (isset($_POST['profile_info'])) {
    include '../connection.php';
    $primary_id = $_SESSION['account_id'];
    $sql =
        "SELECT username, email, creation_date FROM tb_accounts WHERE account_id = $primary_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        ?>
        <div class="mt-3 mb-4">
            <i class="fa-solid fa-user fa-5x"></i>
        </div>
        <h4 class="mb-2"><?php echo $row["username"] ?></h4>
        <p class="text-muted mb-1"><?php echo $row["email"] ?></p>
        <p class="text-muted mb-4"><?php echo $row["creation_date"] ?></p>
        <button data-id="<?php echo $primary_id ?>" class="edit-data btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#editModal">Edit Profile</button>
        <?php
    }
    mysqli_close($conn);
}

// Updates an existing data
if (isset($_POST['primary_id'])
&& isset($_POST['edit_username'])
&& isset($_POST['edit_email'])
&& isset($_POST['edit_password'])
&& isset($_POST['edit_confirm_password'])) {
    include '../connection.php';
    $primary_id = $_POST['primary_id'];
    $edit_username = $_POST['edit_username'];
    $edit_email = $_POST['edit_email'];
    $edit_password = mysqli_real_escape_string($conn, $_POST['edit_password']);
    $edit_confirm_password = mysqli_real_escape_string($conn, $_POST['edit_confirm_password']);
    if ($edit_password == $edit_confirm_password) {
        $sql = "UPDATE tb_accounts SET username='$edit_username', password='$edit_password', email='$edit_email' WHERE account_id='$primary_id'";
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
?>