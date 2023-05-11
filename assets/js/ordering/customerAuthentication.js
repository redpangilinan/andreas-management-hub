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
                })
                .catch((error) => {
                    console.error(error);
                    localStorage.removeItem("customerDetails");
                    customAlert("error", "There are invalid info in your details!", "Your details are invalid and has been cleared. Please reinput your details.");
                });
            customAlert("success", "Success!", "Your details have been saved.");
            customerInfoModal.hide();
        } else {
            customAlert("error", "Address not found!", "Please enter a proper address.");
            customerInfoModal.hide();
        }
    } catch (error) {
        localStorage.setItem('customerDetails', JSON.stringify(customerDetails));
        customAlert("error", "API Error!", "An error occured while API is being called. Your details have been saved anyways.");
        customerInfoModal.hide();
    }
}

const isAuthenticated = () => {
    if (localStorage.getItem('customerDetails') !== null || JSON.parse(localStorage.getItem('customerDetails')).deliveryFee !== undefined) {
        return true;
    } else {
        return false;
    }

}

// Enables customer form to be submitted
$("#customer-form").submit(function (e) {
    e.preventDefault();
    customerSubmit.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Loading...`;
    customerSubmit.disabled = true;

    const form = document.getElementById('customer-form');
    const firstName = form.firstname.value;
    const lastName = form.lastname.value;
    const address = form.address.value;
    const contactNo = form.contact_no.value;

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
});