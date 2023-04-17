const orderModal = new bootstrap.Modal(document.querySelector("#orderModal"), {});
const customerInfoModal = new bootstrap.Modal(document.querySelector("#customerInfoModal"), {});

// Display every product on load
$(document).ready(function () {
    displayProducts("All");
});

$(document).on("click", ".product", function () {
    if (isAuthenticated()) {
        console.log(authentication);
        orderModal.show();
        // Initialize Skeleton Loader
        $("#product-info").html(`
        <div class="mb-3">
            <div class="skeleton skeleton-rich-input w-100" style="height: 7.5rem;"></div>
        </div>
        <hr>
        <div class="d-flex">
            <div class="skeleton skeleton-text w-100"></div>
            <div class="skeleton skeleton-text w-100 ms-2"></div>
        </div>
        <hr>
        <div class="d-flex">
            <div class="skeleton skeleton-text w-100"></div>
            <div class="skeleton skeleton-text w-100 ms-2"></div>
        </div>
        `);
        let primary_id = $(this).data('id');
        displayProductInfo(primary_id);
    } else {
        customerInfoModal.show();
    }
});

$(document).on("click", ".category-tab", function () {
    const category = $(this).data('category');
    const count = $(this).data('count');
    let products = '';
    for (let i = 0; i < count; i++) {
        products += '<div class="product skeleton skeleton-rich-input w-100" style="height: 20rem;"></div>';
    }
    $("#store-products").html(products);
    displayProducts(category);
});

// Displays all available products within the category
const displayProducts = (category) => {
    $.ajax({
        url: "./assets/php/ordering/products_display.php",
        method: "POST",
        data: {
            category: category,
        },
        success: function (data) {
            $("#store-products").html(data);
        }
    });
}

// Displays the product data
const displayProductInfo = (primary_id) => {
    $.ajax({
        url: "./assets/php/ordering/products_info.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $("#product-info").html(data);
        }
    });
}