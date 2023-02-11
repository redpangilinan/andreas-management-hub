<?php
// Unsets all of the sessions and cookies before destroying the session and logging out
if (isset($_GET['logout'])) {
    unset($_SESSION['email']);
    unset($_SESSION['fullname']);
    unset($_SESSION['password']);
    unset($_SESSION['account_id']);
    unset($_SESSION['account_type']);
    if (isset($_COOKIE['ID']) && isset($_COOKIE['Email']) && isset($_COOKIE['Password'])) {
        // Change the cookies names and link accordingly
        setcookie("ID", null, 1, "/", "https://andreasfreshandgreens.elementfx.com/");
        setcookie("Email", null, 1, "/", "https://andreasfreshandgreens.elementfx.com/");
        setcookie("Password", null, 1, "/", "https://andreasfreshandgreens.elementfx.com/");
        unset($_COOKIE['ID']);
        unset($_COOKIE['Email']);
        unset($_COOKIE['Password']);
    }
    session_destroy();
    header('location: admin.php');
    exit();
}
