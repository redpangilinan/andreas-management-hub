const customerDetails = localStorage.getItem('customerDetails');

const setCustomer = (firstName, lastName, contactNo, address) => {
    const customerDetails = {
        firstName: firstName,
        lastName: lastName,
        contactNo: contactNo,
        address: address,
    }
    localStorage.setItem('customerDetails', JSON.stringify(customerDetails));
}

function isAuthenticated() {
    if (localStorage.getItem('customerDetails') !== null) {
        return true;
    } else {
        return false;
    }
}