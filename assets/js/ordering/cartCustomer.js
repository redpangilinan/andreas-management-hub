// Initialize the customer cart
let customerCart = [];

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

const updateCart = () => {
    const cartContainer = document.getElementById('cart-conn');
    let cartHTML = '';

    customerCart.forEach((item) => {
        cartHTML += `
        <div class="cart-item">
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
    });

    cartContainer.innerHTML = cartHTML;
};
