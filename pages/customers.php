<?php
session_start();
include "../assets/php/login_validation.php";
include "../assets/php/logout.php";
validateSession();
ownerAccessOnly();
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
    <title>Customers</title>
</head>

<body>
    <?php include "../assets/php/extensions/sidebar.php" ?>
    <main>
        <!-- Main Content -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- Header -->
                <header>
                    <h1>Customers</h1>
                    <hr>
                </header>
            </div>
            <div class="container">
                <!-- Data Table w/ Search -->
                <div class="d-flex">
                    <div class="search-container w-100">
                        <input type="text" class="form-control" id="search_records" placeholder="Search">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Contact No.</th>
                                <th>Total Orders</th>
                                <th>Total Spent</th>
                            </tr>
                        </thead>
                        <tbody id="search_results">
                            <!-- Initialize Skeleton Loader for Data Table -->
                            <?php
                            include '../assets/php/connection.php';
                            $sql =
                                "SELECT 
                                    ROW_NUMBER() OVER (ORDER BY SUM(price) DESC) AS rank,
                                    CONCAT(firstname, ' ', lastname) AS customer_name,
                                    address,
                                    contact_no,
                                    COUNT(order_id) AS total_orders,
                                    SUM(price) AS total_spent
                                FROM tb_orders
                                WHERE status = 'Complete'
                                GROUP BY firstname, lastname, address, contact_no";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            for ($i = 0; $i < $count; $i++) {
                                echo "
                                <tr>
                                    <td>
                                        <div class='skeleton skeleton-text w-50'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                    <td>
                                        <div class='skeleton skeleton-text w-100'></div>
                                    </td>
                                </tr>
                                ";
                            }
                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/tooltip.js"></script>
    <script src="../assets/js/alerts.js"></script>
    <script src="../assets/js/ajax/customers_data.js"></script>
</body>

</html>