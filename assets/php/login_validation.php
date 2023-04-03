<?php
// Redirect the user to the login page if a session does not exist
function validateSession()
{
    if (!isset($_SESSION['account_id'])) {
        header("Location: admin.php");
        exit();
    }
}

// Logs the user automatically if a session exists
function autoLogin()
{
    if (isset($_SESSION['account_id'])) {
        header("Location: dashboard.php");
        exit();
    }
}

// Only allows access to owner accounts
function ownerAccessOnly()
{
    $allowed_account_types = array("Owner", "Co-owner");
    if (!in_array($_SESSION['account_type'], $allowed_account_types)) {
        header('Location: dashboard.php');
    }
}
