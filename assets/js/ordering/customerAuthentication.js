const customerSubmit = document.querySelector("#customer-submit")
const customerDetails = localStorage.getItem('customerDetails');

const setCustomer = async (firstName, lastName, contactNo, address) => {
    const query = encodeURI(address);
    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/search?q=${query},PH&format=json&limit=1`);
        const data = await response.json();
        if (data && data.length) {
            const customerDetails = {
                firstName: firstName,
                lastName: lastName,
                contactNo: contactNo,
                address: address,
                deliveryFee: 0,
            }
            calculateDeliveryFee("1 Woodlands Drive, Malanday, Valenzuela", customerDetails.address)
                .then((data) => {
                    customerDetails.deliveryFee = data;
                    localStorage.setItem('customerDetails', JSON.stringify(customerDetails));
                    updateCart(customerDetails.deliveryFee);
                    customAlert("success", "Success!", "Your details have been saved.", true);
                })
                .catch((error) => {
                    console.error(error);
                    localStorage.removeItem("customerDetails");
                    customAlert("error", "API Error!", "You have overused the API, please try again later.");
                });
            customerInfoModal.hide();
        } else {
            customAlert("error", "Address not found!", "Please enter a proper address.");
            customerInfoModal.hide();
        }
    } catch (error) {
        customAlert("error", "API Error!", "You have overused the API, please try again later.");
        customerInfoModal.hide();
    }
}

const isAuthenticated = () => {
    if (localStorage.getItem('customerDetails') !== null) {
        return true;
    } else {
        return false;
    }

}

// Enables customer form to be submitted
$("#customer-form").submit(function (e) {
    e.preventDefault();
    if (validateForm("#customer-form")) {
        customerSubmit.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...`;
        customerSubmit.disabled = true;

        const form = document.getElementById('customer-form');
        const firstName = form.firstname.value.trim();
        const lastName = form.lastname.value.trim();
        const address = form.address.value.trim();
        const contactNo = form.contact_no.value.trim();

        setCustomer(firstName, lastName, contactNo, address)
            .then(() => {
                console.log('Customer details saved successfully');
                $("#customer-submit").html(`Save changes`);
                customerSubmit.disabled = false;
            })
            .catch((error) => {
                console.error('Error while saving customer details', error);
                $("#customer-submit").html(`Save changes`);
                customerSubmit.disabled = false;
            });
    } else {
        customAlert("error", "Invalid input!", "Please do not leave blank spaces on your input.");
    }
});

// Clear customer details
$("#clear-details").click(function () {
    const customerDetails = localStorage.getItem("customerDetails");

    if (customerDetails) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to sign out and clear your customer details?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                customerInfoModal.hide();
                localStorage.removeItem("customerDetails");
                customAlert("success", "Success!", "Your details have been cleared!", true);
            }
        });
    } else {
        customAlert("error", "No Customer Details!", "There are no customer details saved currently.");
    }
});