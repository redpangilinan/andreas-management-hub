$(document).ready(function () {
    // Calls the respective constants when necessary
    displayProfile();
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

    $("#form_edit").submit(function (e) {
        e.preventDefault();
        updateData();
    });
});

// ========== Functions ==========
// Displays information about the user currently signed in
const displayProfile = () => {
    let profile_info = "";
    $.ajax({
        url: "../assets/php/crud/profile_crud.php",
        method: "POST",
        data: {
            profile_info: profile_info
        },
        success: function (data) {
            $("#profile_info").html(data);
        }
    });
}

// Displays data in edit modal
const displayEdit = (primary_id) => {
    $.ajax({
        url: "../assets/php/modals/profile_modal.php",
        method: "POST",
        data: {
            primary_id: primary_id
        },
        success: function (data) {
            $(".modal-body").html(data);
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
        url: "../assets/php/crud/profile_crud.php",
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
            displayProfile();
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