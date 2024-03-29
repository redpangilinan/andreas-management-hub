<?php
session_start();
include "../assets/php/login_validation.php";
include "../assets/php/logout.php";
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="../assets/images/icon/1x1-logo.png">
    <title>Orders</title>
</head>

<body>
    <?php include "../assets/php/extensions/sidebar.php" ?>
    <main>
        <!-- Main Content -->
        <div class="main-content">
            <div class="container-fluid">
                <!-- Header -->
                <header>
                    <h1>Orders</h1>
                    <hr>
                </header>
                <div class="datatable-container">
                    <!-- Add Form -->
                    <form class="card mb-3" id="form_add">
                        <h5>Add Orders</h5>
                        <!-- Customer Details -->
                        <input type="hidden" name="deliveryfee" id="deliveryfee">
                        <div class="mb-3 d-flex">
                            <div class="w-100">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
                            </div>
                            <div class="w-100 ms-2">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact_no" class="form-label">Contact No.</label>
                            <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No." required>
                        </div>
                        <!-- Order Details -->
                        <div class="mb-3">
                            <label for="products" class="form-label">Products</label>
                            <div class="with-button-container">
                                <select class="form-select" name="products" id="products" aria-label="Products">
                                    <?php include "../assets/php/extensions/cb_products.php" ?>
                                </select>
                                <button type="button" class="btn btn-success" id="addProduct"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <input type="hidden" name="order_details" id="order_details">
                        <div class="mb-3">
                            <div class="card">
                                <div class="card-header">
                                    Order Details
                                </div>
                                <ul class="list-group list-group-flush" id="products_list">
                                </ul>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Total Price</label>
                                        <input type="number" class="form-control" name="price" id="price" value="0" placeholder="Price" readonly>
                                        <input type="hidden" name="profit" id="profit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="order_date_time" class="form-label">Delivery Date and Time</label>
                            <input type="datetime-local" class="form-control" name="order_date_time" id="order_date_time" placeholder="Delivery Date and Time" min="<?php echo date('Y-m-d\TH:i'); ?>" required>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="w-100">
                                <label for="order_type" class="form-label">Order Type</label>
                                <select class="form-select" name="order_type" id="order_type" aria-label="Order Type" required>
                                    <option value="Delivery">Delivery</option>
                                    <option value="Pick Up">Pick Up</option>
                                </select>
                            </div>
                            <div class="w-100 ms-2">
                                <label for="mode_of_payment" class="form-label">Mode of Payment</label>
                                <select class="form-select" name="mode_of_payment" id="mode_of_payment" aria-label="Mode of Payment" required>
                                    <option value="Cash on Delivery">Cash on Delivery/Pickup</option>
                                    <option value="GCash">GCash</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="add-confirm btn btn-success" id="addButton">Add Order</button>
                    </form>
                    <!-- Data Table w/ Search -->
                    <div class="w-100">
                        <div class="search-container mb-2">
                            <input type=" text" class="form-control" id="search_records" placeholder="Search">
                            <form method="post" action="../assets/php/exports/orders_export.php" class="force-zero">
                                <button type="submit" class="btn btn-success">Export CSV</button>
                            </form>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <select class="form-select" id="filter_status" aria-label="Filter Status" style="max-width: 15rem;">
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                                <option value="Canceled">Canceled</option>
                                <option value="Approval">Approval</option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Details</th>
                                        <th>Order Details</th>
                                        <th>Date to Deliver</th>
                                        <th>Order Type</th>
                                        <th>Mode of Payment</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Modify</th>
                                    </tr>
                                </thead>
                                <tbody id="search_results">
                                    <!-- Initialize Skeleton Loader for Data Table -->
                                    <?php
                                    include '../assets/php/connection.php';
                                    $sql = "SELECT * FROM tb_orders WHERE status = 'Pending'";
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
                                                <div class='skeleton skeleton-text w-100'></div>
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
            </div>
        </div>
    </main>

    <div class="modal fade cart" id="orderHistory" tabindex="-1" aria-labelledby="orderHistoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content orderHistory">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="order-details-content">
                    <div class="modal-body">
                        <div class="history-info-con" id="order-history-info"></div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between" id="order-history-details"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/tooltip.js"></script>
    <script src="../assets/js/alerts.js"></script>
    <script src="../assets/js/deliveryFee.js"></script>
    <script src="../assets/js/cartAdmin.js"></script>
    <script src="../assets/js/ajax/orders_data.js"></script>
</body>

</html>