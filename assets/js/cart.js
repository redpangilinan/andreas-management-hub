// Change the product quantity
$(document).ready(function () {
    $('.count').prop('disabled', true);
    $(document).on('click', '.plus', function () {
        $('.count').val(parseInt($('.count').val()) + 1);
    });
    $(document).on('click', '.minus', function () {
        $('.count').val(parseInt($('.count').val()) - 1);
        if ($('.count').val() == 0) {
            $('.count').val(1);
        }
    });
});

// Initialize the shopping cart
let cart = [];

// Define a function to add a product to the cart
const addToCart = (productName, quantity, price) => {
    let product = {
        name: productName,
        qty: quantity,
        price: price
    };
    cart.push(product);
}

// Define a function to checkout the cart as JSON
const checkout = () => {
    let order = {
        cart: cart,
        total: getTotal()
    };
    let orderData = JSON.stringify(order);
    return orderData;
}

// Define a function to calculate the total price of the cart
const getTotal = () => {
    let total = 0;
    for (let i = 0; i < cart.length; i++) {
        total += cart[i].qty * cart[i].price;
    }
    return total;
}