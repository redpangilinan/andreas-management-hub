<?php
session_start();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Andrea's Fresh and Greens</title>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="header-image">
                <div class="header-text">
                    <i class="fa fa-arrow-circle-left"></i>
                    <h2>Andrea' s<br><span> Fresh & Greens</span></h2>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section id="hero">
            <h2>Andrea's</h2>
            <h1>Fresh & Greens</h1>
            <p>Explore our Products </p>
            <button>Check our menu</button>
        </section>

        <div class="best-seller-con">
            <?php include "./assets/php/ordering/best_seller.php" ?>
        </div>
        <div class="menu-container">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h2>Our Menu</h2>
                <p class="web-p">Andrea's Fresh & Greens</p>
            </div>
            <?php include "./assets/php/ordering/products_display.php" ?>
            <hr>
        </div>
        <div class="navi">
            <img src="./assets/images/icon/full-logo.png" class="logo" alt="">

            <div class="nav-item-con">
                <div class="nav-item">
                    <span class="fas fa-shopping-bag"></span>
                    <a href="#"><span>Order</span></a>
                </div>
                <div class="nav-item">
                    <span class="fas fa-cart-plus"></span>
                    <a href="#"><span>Cart</span></a>
                </div>
                <div class="nav-item">
                    <span class="fa fa-info-circle"></span>
                    <a href="#"><span>About</span></a>
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
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="ordr-butn">Buy Now</button>
                    <button type="button" class="ordr-butn">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="./assets/js/cart.js"></script>
    <script src="./assets/js/ordering/productData.js"></script>
</body>

</html>