// Alert when a record has been updated successfully
function editAlert() {
    Swal.fire({
        icon: 'success',
        title: 'Record Updated!',
        text: 'Record has been updated successfully!',
    });
}

// Alert when a record has been added to the table
function addAlert() {
    Swal.fire({
        icon: 'success',
        title: 'Record Added!',
        text: 'Record has been added successfully!',
    });
}

// Alert when a record has been deleted
function deleteAlert() {
    Swal.fire({
        icon: 'success',
        title: 'Record Deleted!',
        text: 'The record has been deleted successfully!',
    });
}

// Alert when an error occurs
function errorAlert() {
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'Your action cannot be processed! Try something else...',
    });
}

// Alert when registration is successful
function registrationAlert() {
    Swal.fire({
        icon: 'success',
        title: 'Registration Complete!',
        text: 'You have successfully created an account!',
    });
}

// Alert when password and confirm password is not the same
function passwordConfirmAlert() {
    Swal.fire({
        icon: 'error',
        title: 'Does not match!',
        text: 'Your password and confirm password do not match!',
    });
}

// Confirm first before deleting data
function deleteConfirmation(delete_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteData(delete_id);
        }
    })
}