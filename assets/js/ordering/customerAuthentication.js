const getCustomer = () => {
    let customer = localStorage.getItem('customerDetails');
    if (customer == undefined) {
        customAlert("error", "Unavailable details!", "No customer details found!");
    }
}

const setCustomer = (firstName, lastName, contactNo, address) => {
    const customerDetails = {
        firstName: firstName,
        lastName: lastName,
        contactNo: contactNo,
        address: address,
    }
    localStorage.setItem('customerDetails', JSON.stringify(customerDetails));
}