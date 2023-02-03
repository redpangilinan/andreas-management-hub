<?php
// Redirect the user to the login page if a session does not exist
function validateSession() {
    if (!isset($_SESSION['account_id'])) {
        header("Location: index.php");
        exit();
    }
}

// Logs the user automatically if a session exists
function autoLogin() {
    if (isset($_SESSION['account_id'])) {
        header("Location: dashboard.php");
        exit();
    }
}

// Prevents access if the account is not an admin
function privateAccess() {
    if ($_SESSION['account_type'] != "Admin") {
        header('Location: dashboard.php');
    }
}
?>