$(document).ready(function () {
    // Calls the respective constants when necessary
    displayTable();
    $("#search_records").keyup(function () {
        displayTable();
    });

    $(document).on("click", ".edit-data", function () {
        let primary_id = $(this).data('id');
        displayEdit(primary_id);
    });

    $("#form_add").submit(function (e) {
        e.preventDefault();
        addBtnDisable();
        var formData = new FormData(this);
        insertData(formData);
    });

    $("#form_edit").submit(function (e) {
        e.preventDefault();
        updateData();
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
        url: "../assets/php/crud/products_crud.php",
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
        url: "../assets/php/modals/products_modal.php",
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
        url: "../assets/php/crud/products_crud.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            displayTable();
            if (data == "success") {
                $('#form_add')[0].reset();
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
const updateData = () => {
    let primary_id = $("#primary_id").val();
    let edit_product = $("#edit_product").val();
    let edit_details = $("#edit_details").val();
    let edit_price = $("#edit_price").val();
    $.ajax({
        url: "../assets/php/crud/products_crud.php",
        method: "POST",
        data: {
            primary_id: primary_id,
            edit_product: edit_product,
            edit_details: edit_details,
            edit_price: edit_price
        },
        success: function (data) {
            displayTable();
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
        url: "../assets/php/crud/products_crud.php",
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
    document.querySelector("#addButton").innerHTML = "Add Product";
    document.querySelector("#addButton").disabled = false;
}