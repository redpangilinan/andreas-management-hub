$(document).ready(function () {
    // Calls the respective constants when necessary
    displayTable();
    $("#search_records").keyup(function () {
        displayTable();
    });
});

// ========== Functions ==========
// Displays data with search function
const displayTable = () => {
    let input = $("#search_records").val();
    $.ajax({
        url: "../assets/php/crud/customers_read.php",
        method: "POST",
        data: {
            input: input
        },
        success: function (data) {
            $("#search_results").html(data);
        }
    });
}