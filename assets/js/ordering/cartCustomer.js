// Initialize the customer cart
let customerCart = [];
let deliveryFee = null;

// Add a product to the customer cart
const addToCart = (productName, quantity, price, expense, image) => {
    let existingProductIndex = customerCart.findIndex(item => item.name === productName);

    if (existingProductIndex !== -1) {
        // If the product already exists in the cart, update its quantity and price
        customerCart[existingProductIndex].qty += quantity;
        customerCart[existingProductIndex].price += price;
        customerCart[existingProductIndex].expense += expense;
    } else {
        // If the product does not exist in the cart, add it as a new item
        let product = {
            name: productName,
            qty: quantity,
            price: price,
            expense: expense,
            image: image,
        };

        customerCart.push(product);
    }
    customAlert("success", "Added to cart!", "The product has been added to your orders.")
    updateCart();
}

const updateCart = async () => {
    let cartHTML = '';
    let totalPrice = 0;

    customerCart.forEach((item, index) => {
        cartHTML += `
        <div class="cart-item">
          <div class="d-flex justify-content-center align-items-center">
            <i class="fa-solid fa-times fa-xl pe-2" aria-hidden="true" data-index="${index}"></i>
          </div>
          <div class="history-cart-img">
            <img src="/assets/images/products/${item.image}" alt="">
          </div>
          <div class="history-cart-details">
            <h5>${item.name}</h5>
            <div class="price-quantity">
              <span>₱${item.price}</span>
              <div>Qty: ${item.qty}</div>
            </div>
          </div>
        </div>
      `;
        totalPrice += item.price * item.qty;
    });

    const subTotal = totalPrice;
    const customer = JSON.parse(customerDetails);

    if (deliveryFee === null) {
        deliveryFee = Math.round(await calculateDeliveryFee('1 Woodlands Drive, Malanday, Valenzuela', customer.address));
    }

    const total = totalPrice + deliveryFee;

    const cartContainer = document.querySelector('#cart-conn');
    cartContainer.innerHTML = cartHTML;

    const priceDetails = `
      <div class="sub-right">
        <h6>Sub Total:</h6>
        <h6>Delivery Fee:</h6>
        <h6>Total Price:</h6>
      </div>
      <div class="sub-left">
        <h6>₱${subTotal}</h6>
        <h6>₱${deliveryFee}</h6>
        <h6>₱${total}</h6>
      </div>
    `;

    const cartDetails = document.querySelector('#cart-details');
    cartDetails.innerHTML = priceDetails;

    const closeIcons = document.querySelectorAll('.fa-times');
    closeIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const index = parseInt(icon.dataset.index);
            customerCart.splice(index, 1);
            updateCart();
        });
    });
};
