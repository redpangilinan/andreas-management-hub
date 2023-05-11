$(document).ready(function () {
    addBtnEnable();
    // Calls the respective constants when necessary
    displayTable();
    $("#search_records").keyup(function () {
        displayTable();
    });
    $('#filter_status').on('change', function () {
        displayTable();
    });

    $(document).on("click", ".edit-data", function () {
        // Initialize Skeleton Loader
        $(".modal-body").html(`
        <div class="d-flex">
            <div class="skeleton skeleton-text w-100"></div>
            <div class="skeleton skeleton-text w-100 ms-2"></div>
        </div>
        <div class="mb-3 d-flex">
            <div class="skeleton skeleton-input w-100"></div>
            <div class="skeleton skeleton-input w-100 ms-2"></div>
        </div>
        <div class="mb-3">
            <div class="skeleton skeleton-text w-50"></div>
            <div class="skeleton skeleton-input w-100"></div>
        </div>
        <div class="mb-3">
            <div class="skeleton skeleton-text w-50"></div>
            <div class="skeleton skeleton-input w-100"></div>
        </div>
        <div class="mb-3">
            <div class="skeleton skeleton-text w-50"></div>
            <div class="skeleton skeleton-input w-100"></div>
        </div>
        <div class="mb-3">
            <div class="skeleton skeleton-input w-100"></div>
            <div class="skeleton skeleton-rich-input w-100"></div>
        </div>
        <div class="mb-3">
            <div class="skeleton skeleton-text w-50"></div>
            <div class="skeleton skeleton-input w-100"></div>
        </div>
        <div class="d-flex">
            <div class="skeleton skeleton-text w-100"></div>
            <div class="skeleton skeleton-text w-100 ms-2"></div>
        </div>
        <div class="mb-3 d-flex">
            <div class="skeleton skeleton-input w-100"></div>
            <div class="skeleton skeleton-input w-100 ms-2"></div>
        </div>
        <div class="mb-3">
            <div class="skeleton skeleton-text w-50"></div>
            <div class="skeleton skeleton-input w-100"></div>
        </div>
        `);

        let primary_id = $(this).data('id');
        displayEdit(primary_id);
    });

    $("#form_add").submit(function (e) {
        e.preventDefault();
        addBtnDisable();

        // Get the input elements
        const deliveryFeeInput = document.getElementById("deliveryfee");
        const addressInput = document.getElementById("address");

        // Call the calculateDeliveryFee function with start and end addresses
        calculateDeliveryFee("1 Woodlands Drive, Malanday, Valenzuela", addressInput.value)
            .then((deliveryFee) => {
                deliveryFeeInput.value = deliveryFee;
                const formData = new FormData(this);
                insertData(formData);
            })
            .catch((error) => {
                console.error(error);
                addBtnEnable();
                customAlert("error", "Invalid address!", "The address you input does not exist!");
            });
    });

    $("#form_edit").submit(function (e) {
        e.preventDefault();
        editBtnDisable();
        const formData = new FormData(this);
        updateData(formData);
    });

    // Show confirmation first before deleting data
    $(document).on("click", ".delete-data", function () {
        let delete_id = $(this).data('id');
        deleteConfirmation(delete_id);
    });

    // Update order status
    $(document).on("change", ".status-select", function () {
        let primary_id = $(this).data('id');
        let status = $(this).val();
        console.log(primary_id + " " + status);
        $.ajax({
            url: '../assets/php/crud/update_order_status.php',
            method: 'POST',
            data: {
                primary_id: primary_id,
                status: status
            },
            success: function (data) {
                displayTable();
                if (data == "success") {
                    editAlert();
                } else {
                    errorAlert();
                }
            }
        });
    });
});

// ========== Functions ==========
// Displays data with search function
const displayTable = () => {
    let input = $("#search_records").val();
    let filter_status = $("#filter_status").val();
    $.ajax({
        url: "../assets/php/crud/orders_crud.php",
        method: "POST",
        data: {
            input: input,
            filter_status: filter_status
        },
        success: function (data) {
            $("#search_results").html(data);
        }
    });
}

// Displays data in edit modal
const displayEdit = (primary_id) => {
    $.ajax({
        url: "../assets/php/modals/orders_modal.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $(".modal-body").html(data);

            // Load Order Details
            editCart = JSON.parse(document.querySelector('#edit_order_details').value);
            showCartItems("edit");

            // Enables the button to add products to the cart
            let editAddProductBtn = document.querySelector('#editAddProduct');
            editAddProductBtn.addEventListener('click', () => {
                let productValue = document.querySelector('#edit_products').value;
                let splitProduct = productValue.split(",,,");
                let productName = splitProduct[0];
                let price = parseInt(splitProduct[1]);
                let expense = parseInt(splitProduct[2]);
                let quantity = 1;
                addToCart(productName, quantity, price, expense, "edit");
                showCartItems("edit");
            });
        }
    });
}

// Adds a new data
const insertData = (formData) => {
    $.ajax({
        url: "../assets/php/crud/orders_crud.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            displayTable();
            if (data == "success") {
                // Clear the form and cart
                $('#form_add')[0].reset();
                cart = [];
                showCartItems("add");

                addBtnEnable();
                addAlert();
            } else {
                console.log(data);
                addBtnEnable();
                errorAlert();
            }
        }
    });
}

// Updates the data
const updateData = (formData) => {
    $.ajax({
        url: "../assets/php/crud/orders_crud.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            displayTable();
            editBtnEnable();
            $('#editModal').modal('hide');
            $('#form_edit')[0].reset();
            if (data == "success") {
                editAlert();
            } else {
                console.log(data);
                errorAlert();
            }
        }
    });
}

// Deletes a data
const deleteData = (delete_id) => {
    $.ajax({
        url: "../assets/php/crud/orders_crud.php",
        method: "POST",
        data: {
            delete_id: delete_id
        },
        success: function (data) {
            displayTable();
            if (data == "success") {
                deleteAlert();
            }
            else if (data == "owner_account") {
                customAlert("error", "Owner Account!", "You can't delete the owner account!");
            } else {
                console.log(data);
                errorAlert();
            }
        }
    });
}

// Button modification
const addBtnDisable = () => {
    document.querySelector("#addButton").innerHTML = "Uploading...";
    document.querySelector("#addButton").disabled = true;
}

const addBtnEnable = () => {
    document.querySelector("#addButton").innerHTML = "Add Order";
    document.querySelector("#addButton").disabled = false;
}

const editBtnDisable = () => {
    document.querySelector("#editButton").innerHTML = "Uploading...";
    document.querySelector("#editButton").disabled = true;
}

const editBtnEnable = () => {
    document.querySelector("#editButton").innerHTML = "Save changes";
    document.querySelector("#editButton").disabled = false;
}