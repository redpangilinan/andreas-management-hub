<?php
session_start();
include "../assets/php/login_validation.php";
include "../assets/php/logout.php";
include "../assets/php/dashboard_counter.php";
include "../assets/php/charts/chart_sold.php";
validateSession();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <?php include "../assets/php/extensions/sidebar.php" ?>
    <main>
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="container-fluid">
                <header>
                    <h1>Dashboard</h1>
                    <hr>
                </header>
            </div>
            <div class="container">
                <h5 class="mb-2">Welcome, <?php echo $_SESSION["fullname"] ?>!</h5>
                <table class="table table-hover table-bordered d-lg-none">
                    <tbody>
                        <tr>
                            <th><i class="fa-solid fa-users"></i> Admins</th>
                            <td><?php userCount() ?></td>
                        </tr>
                        <tr>

                            <th><i class="fa-solid fa-table-list"></i> Products</th>
                            <td><?php productCount() ?></td>

                        </tr>
                        <tr>
                            <th><i class="fa-solid fa-shipping-fast"></i> Orders</th>
                            <td><?php orderCount() ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="grid-ish d-none d-lg-flex">
                    <!-- Shows total users -->
                    <div class="grid-box">
                        <div class="content">
                            <p style="font-size: 2rem;"><?php userCount() ?></p>
                            <p>Users</p>
                        </div>
                        <div class="content">
                            <i class="fa-solid fa-users fa-4x"></i>
                        </div>
                    </div>
                    <!-- Shows total records -->
                    <div class="grid-box">
                        <div class="content">
                            <p style="font-size: 2rem;"><?php productCount() ?></p>
                            <p>Products</p>
                        </div>
                        <div class="content">
                            <i class="fa-solid fa-table-list fa-4x"></i>
                        </div>
                    </div>
                    <!-- These are just filler boxes ahead -->
                    <div class="grid-box">
                        <div class="content">
                            <p style="font-size: 2rem;"><?php orderCount() ?></p>
                            <p>Orders</p>
                        </div>
                        <div class="content">
                            <i class="fa-solid fa-shipping-fast fa-4x"></i>
                        </div>
                    </div>
                </div>
                <!-- Data Visualization -->
                <div class="d-flex flex-column flex-lg-row my-2 gap-lg-3">
                    <div class="card my-2 p-3 w-100">
                        <h5>Completed Orders</h5>
                        <select id="chartSoldSelect" class="form-select">
                            <option value="weekly">This Week</option>
                            <option value="monthly">This Month</option>
                            <option value="yearly">This Year</option>
                            <option value="all_time">All Time</option>
                        </select>
                        <div id="chartSoldContainer">
                            <canvas id="chartSold" style="width: 100%; max-width: 55rem;"></canvas>
                        </div>
                    </div>
                    <div class="card my-2 p-3 w-100">
                        <h5>Most Sold Products</h5>
                        <select id="chartProductsSelect" class="form-select">
                            <option value="weekly">This Week</option>
                            <option value="monthly">This Month</option>
                            <option value="yearly">This Year</option>
                            <option value="all_time">All Time</option>
                        </select>
                        <div id="chartProductsContainer">
                            <canvas id="chartProducts" style="width: 100%; max-width: 55rem;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Profit -->
                <div class="card my-2 p-3 w-100 d-flex">
                    <div class="d-flex flex-row gap-lg-2 justify-content-around pt-2 flex-column flex-lg-row">
                        <div class="d-flex flex-row-reverse flex-lg-column text-center gap-2 gap-lg-0 justify-content-between">
                            <h5 class="text-success">₱500</h5>
                            <p>Today's Income</p>
                        </div>
                        <div class="d-flex flex-row-reverse flex-lg-column text-center gap-2 gap-lg-0 justify-content-between">
                            <h5 class="text-success">₱5000</h5>
                            <p>This Week's Income</p>
                        </div>
                        <div class="d-flex flex-row-reverse flex-lg-column text-center gap-2 gap-lg-0 justify-content-between">
                            <h5 class="text-success">₱25000</h5>
                            <p>This Month's Income</p>
                        </div>
                        <div class="d-flex flex-row-reverse flex-lg-column text-center gap-2 gap-lg-0 justify-content-between">
                            <h5 class="text-success">₱500000</h5>
                            <p>This Year's Income</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/charts/chartSold.js"></script>
    <script src="../assets/js/charts/chartProducts.js"></script>
</body>

</html>