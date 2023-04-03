$(document).ready(function () {
    // Calls the respective constants when necessary
    displayTable();
    $("#search_records").keyup(function () {
        displayTable();
    });

    $(document).on("click", ".edit-data", function () {
        // Initialize Skeleton Loader
        $("#edit-body").html(`
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
        // Initialize Add Account Modal
        displayAdd();
    });

    $("#form_add").submit(function (e) {
        e.preventDefault();
        insertData();
    });

    $("#form_edit").submit(function (e) {
        e.preventDefault();
        updateData();
    });

    // Check if the ID is from the owner then if it's not an owner, show confirmation before deleting data
    $(document).on("click", ".delete-data", function () {
        let delete_id = $(this).data('id');
        if (delete_id !== 1) {
            deleteConfirmation(delete_id);
        } else {
            customAlert("error", "Owner Account!", "You can't delete the owner account!")
        }
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
            $("#edit-body").html(data);
        }
    });
}

// Displays add account form modal
const displayAdd = () => {
    $("#add-body").html(`
    <div class="mb-3 d-flex">
        <div class="w-100">
            <label for=" firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" placeholder="First Name" required>
        </div>
        <div class="w-100 ms-2">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" placeholder="Last Name" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <label for="contact_no" class="form-label">Contact No.</label>
        <input type="number" class="form-control" id="contact_no" placeholder="Contact No.">
    </div>
    <div class="mb-3 d-flex">
        <div class="w-100">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" required>
        </div>
        <div class="w-100 ms-2">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
        </div>
    </div>
    `);
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
                console.log(data);
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