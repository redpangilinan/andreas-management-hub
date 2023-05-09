// Initialize the customer cart
let customerCart = [];

// Add a product to the customer cart
const addToCart = (productName, quantity, price, expense) => {
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
        };

        customerCart.push(product);
    }
    console.log(customerCart);
}
