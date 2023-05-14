<?php
session_start();
include "./assets/php/ordering/best_seller.php"
?>

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
    <script src="./assets/js/qrcode.min.js"></script>
    <link rel="icon" type="image/png" href="./assets/images/icon/1x1-logo.png">
    <title>Andrea's Fresh and Greens</title>
</head>

<body>
    <main>
        <div class="menu-container">
            <div class="order-prod">
                <div class="best-title">
                    <h2>Best Seller</h2>
                </div>
                <div class="best-seller-con">
                    <?php bestSeller($productNames, $productImages) ?>
                </div>
                <!-- best seller mobile!-->
                <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <?php bestSellerM($productNames, $productImages) ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <div class="margin-space">
                    <h4>Categories</h4>
                    <?php
                    include "./assets/php/connection.php";

                    $sql = "SELECT COUNT(*) AS product_count FROM tb_products";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $product_count = $row['product_count'];
                    ?>
                    <div class="prod-navi">
                        <a class="category-tab w-100" href="#" data-category="All" data-count="<?php echo $product_count ?>">
                            <div class="prod-navi-img">
                                <div class="circle-bg"><img src="./assets/images/all.png" alt=""></div>
                            </div>
                            <span class="d-inline-block text-truncate" style="max-width: 100px;">All</span>
                        </a>
                        <?php include "./assets/php/ordering/show_categories.php" ?>
                    </div>
                    <div class="product-container mb-4 m-md-0" id="store-products">
                        <?php
                        for ($i = 0; $i < $product_count; $i++) {
                            echo '<div class="product skeleton skeleton-rich-input w-100" style="height: 20rem;"></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="cart-cont shadow" id="cart-contt">
                <div class="cart-header-con">
                    <div class="cart-header1">
                        <h4><span class="fas fa-cart-plus"></span> Your Order</h4>
                        <div class="btn text-white" data-bs-toggle="modal" data-bs-target="#customerInfoModal" style="background-color: #165853"><i class="fa-solid fa-user"></i></div>
                    </div>
                    <div class="cart-header2">
                        <button type="button" class="history-button" id="history-buttonn">History</button>
                        <button type="button" class="cart-button" id="cart-buttonn">Cart</button>
                    </div>
                </div>
                <div class="cart-con h-100" id="cart-conn"></div>
                <div class="history-con h-100" id="history-conn">
                    <div class="history-oder-con" id="history-oder-con"></div>
                </div>
                <div class="summ-con" id="summ-con">
                    <hr>
                    <h3>Summary</h3>
                    <hr size="20px">
                    <div class="sub-total-con" id="cart-details">
                        <div class="sub-right">
                            <h6>Sub Total:</h6>
                            <h6>Delivery Fee:</h6>
                            <h6>Total Price:</h6>
                        </div>
                        <div class="sub-left">
                            <h6>₱0</h6>
                            <h6>₱0</h6>
                            <h6>₱0</h6>
                        </div>
                    </div>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#checkOutModal">Check Out</button>
                </div>
            </div>
        </div>
        <div class="navi">
            <img src="./assets/images/icon/full-logo.png" class="logo" alt="">
            <div class="nav-item-con">
                <div class="nav-item">
                    <button id="popup-cart"><span class="fas fa-cart-plus"></span></button>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade cart" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content orderModal">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="product-info"></div>
            </div>
        </div>
    </div>

    <div class="modal fade cart" id="checkOutModal" tabindex="-1" aria-labelledby="checkOutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content checkOutModal">
                <div class="modal-header">
                    <h5 class="modal-title">Check Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="check-out-details">
                    <div class="modal-body">
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
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="GCash">GCash</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Summary</label>
                            <div class="card">
                                <div class="card-body d-flex justify-content-center" id="checkout-price"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="confirmOrderBtn">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade cart" id="customerInfoModal" tabindex="-1" aria-labelledby="customerInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content customerInfoModal">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="customer-form">
                    <div class="modal-body">
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
                            <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="customer-submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    <div class="modal-footer d-flex justify-content-between" id="order-history-details">
                        <div>
                            <h6>Sub Total:</h6>
                            <h6>Delivery Fee:</h6>
                            <h6>Total Price:</h6>
                        </div>
                        <div>
                            <h6>300.00</h6>
                            <h6>50.00</h6>
                            <h6>350.00</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "./assets/php/extensions/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="./assets/js/alerts.js"></script>
    <script src="./assets/js/cart.js"></script>
    <script src="./assets/js/deliveryFee.js"></script>
    <script src="./assets/js/ordering/customerAuthentication.js"></script>
    <script src="./assets/js/ordering/productData.js"></script>
    <script src="./assets/js/ordering/cartCustomer.js"></script>
    <script src="./assets/js/ordering/orderHistory.js"></script>
    <script src="./assets/js/ordering/checkOut.js"></script>
</body>

</html>