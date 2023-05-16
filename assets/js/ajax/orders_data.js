$(document).ready(function () {
    // Calls the respective constants when necessary
    displayTable();
    $("#search_records").keyup(function () {
        displayTable();
    });
    $('#filter_status').on('change', function () {
        displayTable();
    });

    $("#form_add").submit(function (e) {
        e.preventDefault();
        addBtnDisable();

        // Get the input elements
        const deliveryFeeInput = document.querySelector("#deliveryfee");
        const orderTypeInput = document.querySelector("#order_type");
        const mopInput = document.querySelector("#mode_of_payment");
        const addressInput = document.querySelector("#address");

        if ($("#order_type").val() == "Pick Up") {
            deliveryFeeInput.value = 0;
            if (orderTypeInput.value == "Pick Up") {
                mopInput.querySelectorAll("option").forEach((option) => {
                    if (option.textContent.includes("Cash on Delivery/Pickup")) {
                        option.value = "Cash on Pickup";
                        option.selected = true;
                    }
                });
            } else if (orderTypeInput.value == "Delivery") {
                mopInput.querySelectorAll("option").forEach((option) => {
                    if (option.textContent.includes("Cash on Delivery/Pickup")) {
                        option.value = "Cash on Delivery";
                        option.selected = true;
                    }
                });
            }
            const formData = new FormData(this);
            insertData(formData);
        } else {
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
        }
    });

    // Show confirmation first before deleting data
    $(document).on("click", ".delete-data", function () {
        let delete_id = $(this).data('id');
        deleteConfirmation(delete_id);
    });

    // View order details
    $(document).on("click", ".view-data", function () {
        $("#order-details-content").html(`
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>`);

        const primary_id = $(this).data('id');
        $.ajax({
            url: "../assets/php/ordering/order_details.php",
            method: "POST",
            data: {
                primary_id: primary_id,
            },
            success: function (data) {
                $("#order-details-content").html(data);
            }
        });
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
            } else if (data == "empty_cart") {
                addBtnEnable();
                customAlert("error", "Empty cart!", "You haven't selected any products!");
            } else {
                console.log(data);
                addBtnEnable();
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