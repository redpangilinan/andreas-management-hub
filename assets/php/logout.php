<?php
// Unsets all of the sessions and cookies before destroying the session and logging out
if (isset($_GET['logout'])) {
    unset($_SESSION['account_id']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['account_type']);
    if (isset($_COOKIE['ID']) && isset($_COOKIE['Username']) && isset($_COOKIE['Password'])) {
        // Change the cookies names and link accordingly
        setcookie("ID", null, 1, "/", "http://localhost/Projects/github/php-scrud-with-login-authentication");
        setcookie("Username", null, 1, "/", "http://localhost/Projects/github/php-scrud-with-login-authentication");
        setcookie("Password", null, 1, "/", "http://localhost/Projects/github/php-scrud-with-login-authentication");
        unset($_COOKIE['ID']);
        unset($_COOKIE['Username']);
        unset($_COOKIE['Password']);
    }
    session_destroy();
    header('location: index.php');
    exit();
}
?>