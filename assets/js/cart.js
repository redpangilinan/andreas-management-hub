const addButton = document.querySelector("#addButton");

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
    addButton.disabled = true;
});

// Initialize the shopping cart
let cart = [];

// Enables the button to add products to the cart
let addProductBtn = document.querySelector('#addProduct');
addProductBtn.addEventListener('click', () => {
    let productValue = document.querySelector('#products').value;
    let splitProduct = productValue.split(",,,");
    let productName = splitProduct[0];
    let price = parseInt(splitProduct[1]);
    let quantity = 1;
    addToCart(productName, quantity, price);
    showCartItems();
});

// Add a product to the cart
const addToCart = (productName, quantity, price) => {
    let existingProductIndex = cart.findIndex(item => item.name === productName);
    if (existingProductIndex !== -1) {
        // If the product already exists in the cart, update its quantity and price
        cart[existingProductIndex].qty += quantity;
        cart[existingProductIndex].price += price;
    } else {
        // If the product does not exist in the cart, add it as a new item
        let product = {
            name: productName,
            qty: quantity,
            price: price
        };
        cart.push(product);
    }
}

// Checkout the cart as JSON
const checkout = () => {
    let order = {
        cart: cart,
        total: getTotal()
    };
    let orderData = JSON.stringify(order);
    return orderData;
}

// Calculate the total price of the cart
const getTotal = () => {
    let total = 0;
    for (let i = 0; i < cart.length; i++) {
        total += cart[i].qty * cart[i].price;
    }
    return total;
}

// Shows every product in the cart
const showCartItems = () => {
    let cartList = document.querySelector('#products_list');
    cartList.innerHTML = '';

    let orderPrice = 0;
    cart.forEach((item, index) => {
        let listItem = document.createElement('li');
        listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between');
        listItem.innerHTML = `
            <div>${item.name} (${item.qty}) - ₱${item.price}</div>
            <div class="productRemove cs-pointer" data-index="${index}"><i class="fa-solid fa-xmark"></i></div>
        `;
        cartList.appendChild(listItem);

        // Updates the order price
        orderPrice += item.price;
    });

    // Update the total with the calculated order price
    let totalPrice = document.querySelector('#price');
    totalPrice.value = orderPrice;

    // Update order details with cart array as a JSON string
    let orderDetails = document.querySelector('#order_details');
    orderDetails.value = JSON.stringify(cart);

    // Add click event listener to each remove button
    let removeButtons = document.querySelectorAll('.productRemove');
    removeButtons.forEach(button => {
        button.addEventListener('click', e => {
            let index = parseInt(e.currentTarget.dataset.index);
            cart.splice(index, 1);
            showCartItems();
        });
    });

    // Check if cart is empty or not
    if (cart.length !== 0) {
        addButton.disabled = false;
    } else {
        addButton.disabled = true;
    }
};

// Enables Search in select box
$('#products').select2({
    theme: 'bootstrap-5'
});