<?php
session_start();
include '../connection.php';
$primary_id = $_SESSION["account_id"];
$sql =
    "SELECT username, email
    FROM tb_accounts
    WHERE account_id = $primary_id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
?>
    <input type="hidden" id="primary_id" value="<?php echo $primary_id ?>">
    <div class="mb-3">
        <label for="edit_username" class="form-label">Username</label>
        <input type="text" class="form-control" id="edit_username" placeholder="Username" value="<?php echo $row['username'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="edit_email" class="form-label">Email</label>
        <input type="email" class="form-control" id="edit_email" placeholder="Email" value="<?php echo $row['email'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="edit_password" class="form-label">Password</label>
        <input type="password" class="form-control" id="edit_password" placeholder="Password" required>
    </div>
    <div class="mb-3">
        <label for="edit_confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="edit_confirm_password" placeholder="Confirm Password">
    </div>
<?php
}
?>