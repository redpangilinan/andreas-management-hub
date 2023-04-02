$(document).ready(function () {
    // Calls the respective constants when necessary
    displayTable();
    $("#search_records").keyup(function () {
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
        <div class="d-flex">
            <div class="skeleton skeleton-text w-100"></div>
            <div class="skeleton skeleton-text w-100 ms-2"></div>
        </div>
        <div class="mb-3 d-flex">
            <div class="skeleton skeleton-input w-100"></div>
            <div class="skeleton skeleton-input w-100 ms-2"></div>
        </div>
        `);
        let primary_id = $(this).data('id');
        displayEdit(primary_id);
    });

    $(document).on("click", ".add-data", function () {
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
            <div class="d-flex">
                <div class="skeleton skeleton-text w-100"></div>
                <div class="skeleton skeleton-text w-100 ms-2"></div>
            </div>
            <div class="mb-3 d-flex">
                <div class="skeleton skeleton-input w-100"></div>
                <div class="skeleton skeleton-input w-100 ms-2"></div>
            </div>
        </div>
        `);
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
        url: "../assets/php/crud/accounts_crud.php",
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
        url: "../assets/php/modals/accounts_modal.php",
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
    let firstname = $("#firstname").val();
    let lastname = $("#lastname").val();
    let email = $("#email").val();
    let contact_no = $("#contact_no").val();
    let password = $("#password").val();
    let confirm_password = $("#confirm_password").val();
    $.ajax({
        url: "../assets/php/crud/accounts_crud.php",
        method: "POST",
        data: {
            firstname: firstname,
            lastname: lastname,
            email: email,
            contact_no: contact_no,
            password: password,
            confirm_password: confirm_password
        },
        success: function (data) {
            displayTable();
            if (data == "success") {
                $('#addModal').modal('hide');
                $('#form_add')[0].reset();
                registrationAlert();
            } else if (data == "error_confirm") {
                $('#password').val("");
                $('#confirm_password').val("");
                passwordConfirmAlert();
            } else if (data == "weak_password") {
                $('#password').val("");
                $('#confirm_password').val("");
                passwordWeakAlert();
            } else {
                $('#form_add')[0].reset();
                console.log(data);
                errorAlert();
            }
        }
    });
}

// Updates the data
const updateData = () => {
    let primary_id = $("#primary_id").val();
    let edit_firstname = $("#edit_firstname").val();
    let edit_lastname = $("#edit_lastname").val();
    let edit_email = $("#edit_email").val();
    let edit_contact_no = $("#edit_contact_no").val();
    let edit_password = $("#edit_password").val();
    let edit_confirm_password = $("#edit_confirm_password").val();
    $.ajax({
        url: "../assets/php/crud/accounts_crud.php",
        method: "POST",
        data: {
            primary_id: primary_id,
            edit_firstname: edit_firstname,
            edit_lastname: edit_lastname,
            edit_email: edit_email,
            edit_contact_no: edit_contact_no,
            edit_password: edit_password,
            edit_confirm_password: edit_confirm_password
        },
        success: function (data) {
            displayTable();
            if (data == "success") {
                $('#editModal').modal('hide');
                $('#form_edit')[0].reset();
                editAlert();
            } else if (data == "error_confirm") {
                $('#edit_password').val("");
                $('#edit_confirm_password').val("");
                passwordConfirmAlert();
            } else if (data == "weak_password") {
                $('#edit_password').val("");
                $('#edit_confirm_password').val("");
                passwordWeakAlert();
            } else {
                console.log(data);
                $('#form_edit')[0].reset();
                errorAlert();
            }
        }
    });
}

// Deletes a data
const deleteData = (delete_id) => {
    $.ajax({
        url: "../assets/php/crud/accounts_crud.php",
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