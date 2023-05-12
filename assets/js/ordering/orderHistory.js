historyButton.addEventListener('click', () => {
    // Fetch customer orders
    $("#history-oder-con").html(`
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>`);
    $.ajax({
        url: "./assets/php/ordering/order_history.php",
        method: "POST",
        data: {
            firstName: customer.firstName,
            lastName: customer.lastName,
            contactNo: customer.contactNo,
        },
        success: function (data) {
            $("#history-oder-con").html(data);
            $(document).on("click", ".history-order", function () {
                $("#order-details-content").html(`
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>`);

                const primary_id = $(this).data('id');
                $.ajax({
                    url: "./assets/php/ordering/order_details.php",
                    method: "POST",
                    data: {
                        primary_id: primary_id,
                    },
                    success: function (data) {
                        $("#order-details-content").html(data);
                    }
                });
            });
        }
    });
});