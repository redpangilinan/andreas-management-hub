<?php
include "connection.php";

// Login process
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the query
    $stmt = mysqli_prepare($conn, "SELECT account_id, firstname, lastname, password, account_type FROM tb_accounts WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    // Bind the results
    mysqli_stmt_bind_result($stmt, $account_id, $firstname, $lastname, $hashed_password, $account_type);

    // Fetch the row
    if (mysqli_stmt_fetch($stmt)) {
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
    } else {
        echo 'Your Email or Password is incorrect!';
    }

    // Clean up the statement and close the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
