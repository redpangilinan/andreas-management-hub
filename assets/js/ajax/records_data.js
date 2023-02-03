// No changes are required in this part when copying this code for other tables/pages
// The only changes required are the file names for php crud and id values for adding and updating data
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
        insertData();
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
        url: "./assets/php/crud/records_crud.php",
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
        url: "./assets/php/modals/records_modal.php",
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
const insertData = () => {
    let record = $("#record").val();
    let details = $("#details").val();
    $.ajax({
        url: "./assets/php/crud/records_crud.php",
        method: "POST",
        data: {
            record: record,
            details: details
        },
        success: function (data) {
            displayTable();
            if (data == "success") {
                $('#form_add')[0].reset();
                addAlert();
            } else {
                errorAlert();
            }
        }
    });
}

// Updates the data
const updateData = () => {
    let primary_id = $("#primary_id").val();
    let edit_record = $("#edit_record").val();
    let edit_details = $("#edit_details").val();
    $.ajax({
        url: "./assets/php/crud/records_crud.php",
        method: "POST",
        data: {
            primary_id: primary_id,
            edit_record: edit_record,
            edit_details: edit_details
        },
        success: function (data) {
            displayTable();
            $('#editModal').modal('hide');
            $('#form_edit')[0].reset();
            if (data == "success") {
                editAlert();
            } else {
                errorAlert();
            }
        }
    });
}

// Deletes a data
const deleteData = (delete_id) => {
    $.ajax({
        url: "./assets/php/crud/records_crud.php",
        method: "POST",
        data: {
            delete_id: delete_id
        },
        success: function (data) {
            displayTable();
            if (data == "success") {
                deleteAlert();
            } else {
                errorAlert();
            }
        }
    });
}