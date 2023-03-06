$(document).ready(function () {
    // Calls the respective constants when necessary
    displayTable();
    $("#search_records").keyup(function () {
        displayTable();
    });

    $(document).on("click", ".edit-data", function () {
        // Initialize Skeleton Loader
        $(".modal-body").html(`
        <div class="modal-body">
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
            <div class="mb-3">
                <div class="skeleton skeleton-text w-50"></div>
                <div class="skeleton skeleton-input w-100"></div>
            </div>
        </div>
        `);
        let primary_id = $(this).data('id');
        displayEdit(primary_id);
    });

    $("#form_add").submit(function (e) {
        e.preventDefault();
        addBtnDisable();
        const formData = new FormData(this);
        insertData(formData);
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
});

// ========== Constants ==========
// Displays data with search function
const displayTable = () => {
    let input = $("#search_records").val();
    $.ajax({
        url: "../assets/php/crud/orders_crud.php",
        method: "POST",
        data: {
            input: input
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
                showCartItems();

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
            } else if (data == "no image success") {
                noImageAlert();
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