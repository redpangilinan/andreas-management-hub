<?php
session_start();
include "../assets/php/login_validation.php";
include "../assets/php/logout.php";
validateSession();
privateAccess();
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
                    <form class="card" id="form_add">
                        <h1 class="fs-4">Add Orders</h1>
                        <!-- Customer Details -->
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
                                <select class="form-select" name="products" id="products" aria-label="Products" required>
                                    <option value="Test">Test</option>
                                </select>
                                <button class="btn btn-success">Add Product</button>
                            </div>
                        </div>
                        <input type="hidden" id="order_details">
                        <div id="products_list"></div>
                        <div class="mb-3">
                            <label for="order_date_time" class="form-label">Delivery Date and Time</label>
                            <input type="datetime-local" class="form-control" name="order_date_time" id="order_date_time" placeholder="Delivery Date and Time" required>
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
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="GCash">GCash</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="Price" required>
                        </div>
                        <button type="submit" class="add-confirm btn btn-success" id="addButton">Add Order</button>
                    </form>
                    <!-- Data Table w/ Search -->
                    <div class="w-100">
                        <div class="search-container">
                            <input type=" text" class="form-control" id="search_records" placeholder="Search">
                            <form method="post" action="../assets/php/exports/orders_export.php" class="force-zero">
                                <button type="submit" class="edit-confirm btn btn-success">Export CSV</button>
                            </form>
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
                                    <tr>
                                        <td colspan='9'>Loading...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <!-- Edit Modal -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Edit Form -->
                <form id="form_edit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <p>Loading...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="edit-confirm btn btn-primary" id="editButton">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/alerts.js"></script>
    <script src="../assets/js/ajax/orders_data.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>