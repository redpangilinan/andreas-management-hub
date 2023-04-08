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
        <div class="menu-container">
        	<div class="order-prod">
              <div class="d-flex flex-column justify-content-center align-items-center" style="margin-top: 2rem" >
                <h2 style="color:#088178;font-family:Spartan;font-weight:700">Best Seller</h2>
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
              <div class="prod-navi">
                <a class="active" href="#home">All</a>
                <a href="#home">Maki</a>
                <a href="#home">Spring rolls</a>
                <a href="#home">Sushi</a>
              </div>
              	<h3>Maki</h3>
            	<div class="product-container">
                  <div class="product" data-bs-toggle="modal" data-bs-target="#orderModal">
                      <img src="./assets/images/andreas background.jpg" alt="">
                      <div class="product-text">
                          <span>Andrea's Fresh and Greens</span>
                          <h5>8x4.5 BAKED CALI SUSHI w/ Nori Sheet Pack</h5>
                          <h4>₱260</h4>
                      </div>
                  </div>
              </div>
          </div>
          <div class="cart-cont">
            <div class="d-flex flex-column justify-content-center align-items-left">
                <h4><span class="fas fa-cart-plus"></span> My Cart</h4>
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
                  <center><hr size = "20px" width="98%" </center></center>
					
					<div class ="sub-total-con">
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
					<button type="button" data-bs-toggle="modal" data-bs-target="#orderModal">Check Out</button>
				</div>
			</div>
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