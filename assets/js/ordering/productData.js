$(document).ready(function () {
    $(document).on("click", ".product", function () {
        // Initialize Skeleton Loader
        $(".modal-body").html(`
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
        displayProduct(primary_id);
    });
});

// Displays the product data
const displayProduct = (primary_id) => {
    $.ajax({
        url: "./assets/php/ordering/products_info.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $(".modal-body").html(data);
        }
    });
}