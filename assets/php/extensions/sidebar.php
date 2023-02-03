<?php
// Changes the content of the sidebar depending on the type of the account that signs in
$account_type = $_SESSION["account_type"];
//Sidebar for users
if ($account_type == "User") {
?>
    <div class="sidebar bg-dark text-white">
        <ul class="list-unstyled">
            <li><a href="./dashboard.php" title="Dashboard"><i class="fa-solid fa-desktop fa-lg"></i></a></li>
            <li><a href="./profile.php" title="Profile"><i class="fa-solid fa-user fa-lg"></i></a></li>
            <li><a href="?logout" title="Sign out"><i class="fa-solid fa-sign-out-alt fa-lg"></i></a></li>
        </ul>
    </div>
<?php
//Sidebar for admins
} else {
?>
    <div class="sidebar bg-dark text-white">
        <ul class="list-unstyled">
            <li><a href="./dashboard.php" title="Dashboard"><i class="fa-solid fa-desktop fa-lg"></i></a></li>
            <li><a href="./profile.php" title="Profile"><i class="fa-solid fa-user fa-lg"></i></a></li>
            <li><a href="./accounts.php" title="Users"><i class="fa-solid fa-users fa-lg"></i></a></li>
            <li><a href="./records.php" title="Records"><i class="fa-solid fa-table-list fa-lg"></i></a></li>
            <li><a href="?logout" title="Sign out"><i class="fa-solid fa-sign-out-alt fa-lg"></i></a></li>
        </ul>
    </div>
<?php
}
?>