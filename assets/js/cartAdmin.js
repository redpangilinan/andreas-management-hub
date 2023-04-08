const addButton = document.querySelector("#addButton");
const editButton = document.querySelector("#editButton");

// Initially disable the add button
$(document).ready(function () {
    addButton.disabled = true;
});

// Initialize the shopping cart
let cart = [];
let editCart = [];

// Enables the button to add products to the cart
let addProductBtn = document.querySelector('#addProduct');
addProductBtn.addEventListener('click', () => {
    let productValue = document.querySelector('#products').value;
    let splitProduct = productValue.split(",,,");
    let productName = splitProduct[0];
    let price = parseInt(splitProduct[1]);
    let expense = parseInt(splitProduct[2]);
    let quantity = 1;
    addToCart(productName, quantity, price, expense, "add");
    showCartItems("add");
});

// Add a product to the cart
const addToCart = (productName, quantity, price, expense, form) => {
    let existingProductIndex;
    if (form == "add") {
        existingProductIndex = cart.findIndex(item => item.name === productName);
    } else {
        existingProductIndex = editCart.findIndex(item => item.name === productName);
    }

    if (existingProductIndex !== -1) {
        // If the product already exists in the cart, update its quantity and price
        if (form == "add") {
            cart[existingProductIndex].qty += quantity;
            cart[existingProductIndex].price += price;
            cart[existingProductIndex].expense += expense;
        } else {
            editCart[existingProductIndex].qty += quantity;
            editCart[existingProductIndex].price += price;
            editCart[existingProductIndex].expense += expense;
        }
    } else {
        // If the product does not exist in the cart, add it as a new item
        let product = {
            name: productName,
            qty: quantity,
            price: price,
            expense: expense,
        };

        if (form == "add") {
            cart.push(product);
        } else {
            editCart.push(product);
        }

    }
}

// Shows every product in the cart
const showCartItems = (form) => {
    // Setup respective ID for the current form
    let cartList, totalPrice, totalProfit, orderDetails, formCart;

    if (form == "add") {
        cartList = document.querySelector('#products_list');
        totalPrice = document.querySelector('#price');
        totalProfit = document.querySelector('#profit');
        orderDetails = document.querySelector('#order_details');
        formCart = cart;
    } else {
        cartList = document.querySelector('#edit_products_list');
        totalPrice = document.querySelector('#edit_price');
        totalProfit = document.querySelector('#edit_profit');
        orderDetails = document.querySelector('#edit_order_details');
        formCart = editCart;
    }

    cartList.innerHTML = '';

    let orderPrice = 0;
    let orderExpense = 0;
    formCart.forEach((item) => {
        let listItem = document.createElement('li');
        listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between');
        if (form == "add") {
            listItem.innerHTML = `
            <div>${item.name} (${item.qty}) - ₱${item.price}</div>
            <div class="productRemove cs-pointer"><i class="fa-solid fa-xmark"></i></div>
            `;
        } else {
            listItem.innerHTML = `
            <div>${item.name} (${item.qty}) - ₱${item.price}</div>
            <div class="editProductRemove cs-pointer"><i class="fa-solid fa-xmark"></i></div>
            `;
        }
        cartList.appendChild(listItem);

        // Updates the order price
        orderPrice += item.price;
        orderExpense += item.expense;
    });

    // Set the total price and stringify JSON
    totalPrice.value = orderPrice;
    totalProfit.value = orderPrice - orderExpense;
    orderDetails.value = JSON.stringify(formCart);

    // Add click event listener to each remove button and check if cart is empty or not
    if (form == "add") {
        let removeButtons = document.querySelectorAll('.productRemove');
        removeButtons.forEach((button, index) => {
            button.addEventListener('click', e => {
                cart.splice(index, 1);
                showCartItems("add");
            });
        });

        if (formCart.length !== 0) {
            addButton.disabled = false;
        } else {
            addButton.disabled = true;
        }
    } else {
        let removeButtons = document.querySelectorAll('.editProductRemove');
        removeButtons.forEach((button, index) => {
            button.addEventListener('click', e => {
                editCart.splice(index, 1);
                showCartItems("edit");
            });
        });

        if (formCart.length !== 0) {
            editButton.disabled = false;
        } else {
            editButton.disabled = true;
        }
    }
};

// Enables Search in select box
$('#products').select2({
    theme: 'bootstrap-5'
});