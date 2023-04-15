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
    <main>
        <div class="menu-container">
            <div class="order-prod">
                <div class="best-title">
                    <h2>Best Seller</h2>
                </div>
                <div class="best-seller-con">
                    <div class="best-left">
                        <div class="best-img"><img src="./assets/images/andreas background.jpg" alt="">
                            <h4>Sushi</h4>
                        </div>
                    </div>
                    <div class="best-mid">
                        <div class="best-img"><img src="./assets/images/andreas background.jpg" alt="">
                            <h4>12pcs Spring Rolls</h4>
                        </div>
                    </div>
                    <div class="best-right">
                        <div class="best-img"><img src="./assets/images/andreas background.jpg" alt="">
                            <h4>Maki</h4>
                        </div>
                    </div>
                </div>
				<!-- best seller mobile!-->
				<div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  </div>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <div class="best-mob">
                        <div class="best-mob-img"><img src="./assets/images/best1.png" alt="">
                            <div class="carousel-caption d-block">
                                <h5>12 pcs. Spring Rolls</h5>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item">
                      <div class="best-mob">
                        <div class="best-mob-img"><img src="./assets/images/best2.png" alt="">
                            <div class="carousel-caption d-block">
                                <h5>Sushi</h5>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="carousel-item">
                      <div class="best-mob">
                        <div class="best-mob-img"><img src="./assets/images/best1.png" alt="">
                            <div class="carousel-caption d-block">
                                <h5>Maki</h5>
                            </div>
                        </div>
                    </div>
                    </div>
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
                    <div class="prod-navi">
                        <a class="active" href="#home">
                            <div class="prod-navi-img">
                                <div class="circle-bg"><img src="./assets/images/all.png" alt=""></div>
                            </div>ALL
                        </a>
                        <a href="#home">
                            <div class="prod-navi-img">
                                <div class="circle-bg"><img src="./assets/images/maki.png" alt=""></div>
                            </div>MAKI
                        </a>
                        <a href="#home">
                            <div class="prod-navi-img">
                                <div class="circle-bg"><img src="./assets/images/rolls.png" alt=""></div>
                            </div>SPRING ROLLS
                        </a>
                        <a href="#home">
                            <div class="prod-navi-img">
                                <div class="circle-bg"><img src="./assets/images/sushi.png" alt=""></div>
                            </div>SUSHI
                        </a>
                    </div>
                    <div class="product-container">
                        <div class="product">
                            <img src="./assets/images/andreas background.jpg" alt="">
                            <div class="product-text">
                                <span>Andrea's Fresh and Greens</span>
                                <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                              	<hr>
                                <h4>₱260</h4>
                              	 <button type="button">Order</button>
                            </div>
                        </div>
                        <div class="product">
                            <img src="./assets/images/andreas background.jpg" alt="">
                            <div class="product-text">
                                <span>Andrea's Fresh and Greens</span>
                                <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                              	<hr>
                                <h4>₱260</h4>
                              	 <button type="button">Order</button>
                            </div>
                        </div>
                        <div class="product">
                            <img src="./assets/images/andreas background.jpg" alt="">
                            <div class="product-text">
                                <span>Andrea's Fresh and Greens</span>
                                <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                              	<hr>
                                <h4>₱260</h4>
                              	 <button type="button">Order</button>
                            </div>
                        </div>
						<div class="product">
                            <img src="./assets/images/andreas background.jpg" alt="">
                            <div class="product-text">
                                <span>Andrea's Fresh and Greens</span>
                                <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                              	<hr>
                                <h4>₱260</h4>
                              	 <button type="button">Order</button>
                            </div>
                        </div>
						<div class="product">
                            <img src="./assets/images/andreas background.jpg" alt="">
                            <div class="product-text">
                                <span>Andrea's Fresh and Greens</span>
                                <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                              	<hr>
                                <h4>₱260</h4>
                              	 <button type="button">Order</button>
                            </div>
                        </div>
						<div class="product">
                            <img src="./assets/images/andreas background.jpg" alt="">
                            <div class="product-text">
                                <span>Andrea's Fresh and Greens</span>
                                <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                              	<hr>
                                <h4>₱260</h4>
                              	 <button type="button">Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-cont">
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
                        <hr size="20px" width="98%" </center>
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
                    <span class="fas fa-cart-plus"></span>
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
                <div class="modal-body">
                    WIP CUSTOMER FORM
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center text-white" style="background-color: #165853;">

  <div class="container p-4 pb-0">
    <section class="mb-4">
      <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/profile.php?id=100064229854714" role="button"><i class="fab fa-facebook-f"></i></a>
      <a class="btn btn-outline-light btn-floating m-1" href="https://mail.google.com/mail/u/0/?fs=1&to=im.ice31@gmail.com&su=&body=&tf=cm" role="button"><i class="fab fa-google"></i></a>
    </section>
  </div>

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 Copyright:
    <a class="text-white" href="https://www.facebook.com/profile.php?id=100064229854714">Andrea's Fresh and Greens </a>
  </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="./assets/js/cart.js"></script>
    <script src="./assets/js/ordering/customerAuthentication.js"></script>
    <script src="./assets/js/ordering/productData.js"></script>
</body>

</html>