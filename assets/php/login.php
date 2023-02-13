<?php
include "connection.php";

// Login process
if (isset($_POST['login'])) {
    include "./connection.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Check if there is a matching password
    $sql = "SELECT account_id, firstname, lastname, password, account_type FROM tb_accounts WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $account_id = $row['account_id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $hashed_password = $row["password"];
        $account_type = $row['account_type'];
    } else {
        echo 'Your Email or Password is incorrect!';
    }

    // Verify hashed password for login then set every session and cookies if data is correct
    if (password_verify($password, $hashed_password)) {
        // Set session values
        $_SESSION['email'] = $email;
        $_SESSION['fullname'] = "$firstname $lastname";
        $_SESSION['password'] = $hashed_password;
        $_SESSION['account_id'] = $account_id;
        $_SESSION['account_type'] = $account_type;

        // Change the cookies names and link accordingly
        setcookie("ID", $_SESSION['account_id'], time() + 86400, "/", "https://andreasfreshandgreens.elementfx.com/");
        setcookie("Email", $_SESSION['email'], time() + 86400, "/", "https://andreasfreshandgreens.elementfx.com/");
        setcookie("Password", $_SESSION['password'], time() + 86400, "/", "https://andreasfreshandgreens.elementfx.com/");

        header("Location: dashboard.php");
    } else {
        echo 'Your Email or Password is incorrect!';
    }

    mysqli_close($conn);
}
