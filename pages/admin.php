<?php
session_start();
include "../assets/php/login_validation.php";
autoLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="../assets/images/icon/1x1-logo.png">
    <title>Sign in</title>
</head>

<body class="bg-secondary">
    <!-- Sign In -->
    <form action="admin.php" method="post">
        <div class="login-container">
            <div class="box">
                <div class="login-content bg-white rounded-1">
                    <h1>Sign in</h1>
                    <input type="text" name="email" placeholder="Email" class="form-control">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    <span class="text-center text-danger"><?php include "../assets/php/login.php" ?></span>
                    <button type="submit" class="btn btn-dark" name="login">Sign in</button>
                </div>
            </div>
        </div>
    </form>

    <script src="../assets/js/alerts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>