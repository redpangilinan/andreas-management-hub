<?php
session_start();
include "./assets/php/login_validation.php";
autoLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sign in</title>
</head>

<body class="bg-secondary">
    <!-- Sign In -->
    <form action="index.php" method="post">
        <div class="login-container">
            <div class="box">
                <div class="login-content bg-white rounded-1">
                    <h1>Sign in</h1>
                    <input type="text" name="username" placeholder="Username" class="form-control">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    <span class="text-center text-danger"><?php include "./assets/php/login.php" ?></span>
                    <button type="submit" class="btn btn-dark" name="login">Sign in</button>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addModal">Sign up now!</a>
                </div>
            </div>
        </div>
    </form>

    <!-- Sign Up -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Register an Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Sign Up Form -->
                <form id="form_add">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="add-confirm btn btn-primary">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./assets/js/alerts.js"></script>
    <script src="./assets/js/ajax/accounts_data.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>