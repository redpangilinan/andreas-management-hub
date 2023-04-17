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
                        <a class="category-tab" href="#home" data-category="All" data-count="<?php echo $product_count ?>">
                            <div class="prod-navi-img">
                                <div class="circle-bg"><img src="./assets/images/all.png" alt=""></div>
                            </div>All
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

            <div class="cart-cont" id="cart-contt">
                <div class="d-flex justify-content-between">
                    <h4><span class="fas fa-cart-plus"></span> My Cart</h4>
                    <div><input type="checkbox" id="all" name="all" value="all"><label for="all">ALL</label></div>
                </div>
                <div class="pad-bot">
                    <div class="cart-item">
                        <input type="checkbox">
                        <div class="cart-img">
                            <img src="./assets/images/andreas background.jpg" alt="">
                        </div>
                        <div class="cart-details">
                            <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                            <div class="price-quantity">
                                <span>₱260</span>
                                <div class="quantity">
                                    <span class="minus">-</span>
                                    <input type="number" class="count" name="quantity" value="1">
                                    <span class="plus">+</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-item">
                        <input type="checkbox">
                        <div class="cart-img">
                            <img src="./assets/images/andreas background.jpg" alt="">
                        </div>
                        <div class="cart-details">
                            <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                            <div class="price-quantity">
                                <span>₱260</span>
                                <div class="quantity">
                                    <span class="minus">-</span>
                                    <input type="number" class="count" name="quantity" value="1">
                                    <span class="plus">+</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="summ-con">
                    <hr>
                    <h3>Summary <span class="fa fa-trash"></span></h3>
                    <center>
                        <hr size="20px" width="98%">
                    </center>

                    <div class="sub-total-con">
                        <div class="sub-right">
                            <h6>Sub Total:</h6>
                            <h6>Delivery Type:</h6>
                            <h6>Total Price:</h6>
                        </div>
                        <div class="sub-left">
                            <h6>123</h6>
                            <h6>123</h6>
                            <h6>123</h6>
                        </div>
                    </div>
                    <button type="button">Check Out</button>
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
                <div class="modal-body" id="product-info"></div>
                <div class="modal-footer">
                    <button type="button" class="ordr-butn">Buy Now</button>
                    <button type="button" class="ordr-butn">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade cart" id="customerInfoModal" tabindex="-1" aria-labelledby="customerInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content customerInfoModal">
                <div class="modal-header">
                    <h5 class="modal-title">Enter details before ordering</h5>
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
                        <button type="submit" class="btn btn-primary" id="customer-submit" style="width: rem;">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "./assets/php/extensions/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="./assets/js/alerts.js"></script>
    <script src="./assets/js/cart.js"></script>
    <script src="./assets/js/ordering/customerAuthentication.js"></script>
    <script src="./assets/js/ordering/productData.js"></script>
</body>

</html>