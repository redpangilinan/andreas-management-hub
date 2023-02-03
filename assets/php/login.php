<?php
include "connection.php";

// Login process
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT account_id, account_type FROM tb_accounts WHERE BINARY username='$username' AND BINARY password='$password' limit 1";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $account_id = $row['account_id'];
        $account_type = $row['account_type'];
    }
    // Set every session and cookies then login
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['account_id'] = $account_id;
        $_SESSION['account_type'] = $account_type;
        // Change the cookies names and link accordingly
        setcookie("ID", $_SESSION['account_id'], time() + 86400, "/", "http://localhost/Projects/github/php-scrud-with-login-authentication");
        setcookie("Username", $_SESSION['username'], time() + 86400, "/", "http://localhost/Projects/github/php-scrud-with-login-authentication");
        setcookie("Password", $_SESSION['password'], time() + 86400, "/", "http://localhost/Projects/github/php-scrud-with-login-authentication");
        header("Location: dashboard.php");
        
    } else {
        echo 'Your Username or Password is incorrect!';
    }
    mysqli_close($conn);
}
?>