// Initialize the customer cart
let customerCart = [];
const customer = JSON.parse(customerDetails);
let deliveryFee = null;
let subTotal = null;
let totalProfit = null;

// Add a product to the customer cart
const addToCart = (productName, quantity, price, expense, image, alert = false) => {
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
    if (alert) {
        customAlert("success", "Added to cart!", "The product has been added to your orders.");
    }
    updateCart(deliveryFee);
}

// Refreshes the customer cart display
const updateCart = (deliveryFee) => {
    // Set the cart to local storage
    localStorage.setItem('customerCart', JSON.stringify(customerCart));

    // Reset values
    let cartHTML = '';
    let totalPrice = 0;
    let totalExpense = 0;

    customerCart.forEach((item, index) => {
        cartHTML += `
        <div class="cart-item border">
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
        totalPrice += item.price;
        totalExpense += item.expense;
    });

    subTotal = totalPrice;
    totalProfit = totalPrice - totalExpense;
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
    const checkoutPrice = document.querySelector('#checkout-price');
    cartDetails.innerHTML = priceDetails;
    checkoutPrice.innerHTML = priceDetails;

    const closeIcons = document.querySelectorAll('.fa-times');
    closeIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const index = parseInt(icon.dataset.index);
            customerCart.splice(index, 1);
            updateCart(deliveryFee);
        });
    });
};

// Set delivery fee and customer cart
if (customer !== null) {
    deliveryFee = customer.deliveryFee;
    document.querySelector("#firstname").value = customer.firstName;
    document.querySelector("#lastname").value = customer.lastName;
    document.querySelector("#contact_no").value = customer.contactNo;
    document.querySelector("#address").value = customer.address;
    if (localStorage.getItem('customerCart')) {
        customerCart = JSON.parse(localStorage.getItem('customerCart'));
    }
    updateCart(deliveryFee);
} else {
    customerInfoModal.show();
}