const checkOutModal = new bootstrap.Modal(document.querySelector("#checkOutModal"), {});

$("#check-out-details").submit(function (e) {
    e.preventDefault();
    addBtnDisable();

    const customerCartNoImage = customerCart.map(product => {
        const { image, ...productNoImage } = product;
        return productNoImage;
    });

    const customerCartJSON = JSON.stringify(customerCartNoImage);

    $.ajax({
        url: "./assets/php/crud/orders_crud.php",
        method: "POST",
        data: {
            firstname: customer.firstName,
            lastname: customer.lastName,
            address: customer.address,
            contact_no: customer.contactNo,
            order_details: customerCartJSON,
            order_date_time: document.querySelector("#order_date_time").value,
            order_type: document.querySelector("#order_type").value,
            mode_of_payment: document.querySelector("#mode_of_payment").value,
            price: subTotal,
            profit: totalProfit,
            deliveryfee: deliveryFee,
        },
        success: function (data) {
            if (data == "success") {
                // Clear the form and cart
                $('#check-out-details')[0].reset();
                customerCart = [];
                updateCart(deliveryFee);

                addBtnEnable();
                showQRCodeAlert();
            } else if (data == "empty_cart") {
                addBtnEnable();
                customAlert("error", "Empty cart!", "You haven't selected any products!");
            } else {
                addBtnEnable();
                errorAlert();
            }
        }
    });
});

const showQRCodeAlert = () => {
    checkOutModal.hide();

    // Get QR data from qr_data.php using AJAX
    $.ajax({
        url: "./assets/php/ordering/qr_data.php",
        type: "GET",
        dataType: "text",
        success: function (qrData) {
            checkOutModal.hide();

            // Create SweetAlert2 popup with QR code as content
            Swal.fire({
                title: "Order confirmed!",
                html: '<div class="d-flex flex-column align-items-center gap-3"><div id="qrcode-container"></div><div class="lead">Scan the QR code to contact us or pay for your order.</div></div>',
            }).then(() => {
                location.reload();
            });

            // Generate QR code using qrcode.js
            var qrcode = new QRCode(document.getElementById("qrcode-container"), {
                text: qrData,
                width: 256,
                height: 256,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

            qrcode.makeCode(qrData);
        },
        error: function () {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Failed to fetch QR data from server"
            });
        }
    });
}

// Button modification
const addBtnDisable = () => {
    document.querySelector("#confirmOrderBtn").innerHTML = "Confirming...";
    document.querySelector("#confirmOrderBtn").disabled = true;
}

const addBtnEnable = () => {
    document.querySelector("#confirmOrderBtn").innerHTML = "Confirm Order";
    document.querySelector("#confirmOrderBtn").disabled = false;
}