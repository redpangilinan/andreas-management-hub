<?php
// Changes the content of the sidebar depending on the type of the account that signs in
$account_type = $_SESSION["account_type"];
//Sidebar for users
if ($account_type == "Admin") {
?>
    <div class="sidebar bg-dark text-white">
        <ul class="list-unstyled">
            <li><a href="./dashboard.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard"><i class="fa-solid fa-desktop fa-lg"></i></a></li>
            <li><a href="./profile.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Profile"><i class="fa-solid fa-user fa-lg"></i></a></li>
            <li><a href="./products.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Products"><i class="fa-solid fa-table-list fa-lg"></i></a></li>
            <li><a href="./orders.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Orders"><i class="fa-solid fa-shipping-fast fa-lg"></i></a></li>
            <li><a href="?logout" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Sign out"><i class="fa-solid fa-sign-out-alt fa-lg"></i></a></li>
        </ul>
    </div>
<?php
    //Sidebar for admins
} else {
?>
    <div class="sidebar bg-dark text-white">
        <ul class="list-unstyled">
            <li><a href="./dashboard.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard"><i class="fa-solid fa-desktop fa-lg"></i></a></li>
            <li><a href="./profile.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Profile"><i class="fa-solid fa-user fa-lg"></i></a></li>
            <li><a href="./accounts.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Accounts"><i class="fa-solid fa-users fa-lg"></i></a></li>
            <li><a href="./products.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Products"><i class="fa-solid fa-table-list fa-lg"></i></a></li>
            <li><a href="./orders.php" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Orders"><i class="fa-solid fa-shipping-fast fa-lg"></i></a></li>
            <li><a href="?logout" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Sign out"><i class="fa-solid fa-sign-out-alt fa-lg"></i></a></li>
        </ul>
    </div>
<?php
}
?>