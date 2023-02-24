<?php
session_start();
include '../connection.php';
$primary_id = $_SESSION["account_id"];
$sql =
    "SELECT firstname, lastname, email, contact_no
    FROM tb_accounts
    WHERE account_id = $primary_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
    <input type="hidden" id="primary_id" value="<?php echo $primary_id ?>">
    <div class="mb-3 d-flex">
        <div class="w-100">
            <label for="edit_firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="edit_firstname" placeholder="First Name" value="<?php echo $row['firstname'] ?>" required>
        </div>
        <div class="w-100 ms-2">
            <label for="edit_lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="edit_lastname" placeholder="Last Name" value="<?php echo $row['lastname'] ?>" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="edit_email" class="form-label">Email</label>
        <input type="email" class="form-control" id="edit_email" placeholder="Email" value="<?php echo $row['email'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="edit_contact_no" class="form-label">Contact No.</label>
        <input type="number" class="form-control" id="edit_contact_no" placeholder="Contact No." value="<?php echo $row['contact_no'] ?>">
    </div>
    <div class="mb-3 d-flex">
        <div class="w-100">
            <label for="edit_password" class="form-label">Password</label>
            <input type="password" class="form-control" id="edit_password" placeholder="Password" required>
        </div>
        <div class="w-100 ms-2">
            <label for="edit_confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="edit_confirm_password" placeholder="Confirm Password">
        </div>
    </div>
<?php
}
?>