$(document).ready(function () {
    // Make the AJAX request on load
    $.ajax({
        url: '../assets/php/charts/get_chart_sold.php?option=weekly',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const orderDates = data.orderDates;
            const numOrders = data.numOrders;
            console.log(data);

            // Render the chart with the retrieved data
            renderChart(orderDates, numOrders);
        }
    });

    $('#chartSoldSelect').change(function () {
        const option = $(this).val();
        let url = '';

        // Set the URL for the AJAX request based on the selected option
        switch (option) {
            case 'weekly':
                url = '../assets/php/charts/get_chart_sold.php?option=weekly';
                break;
            case 'monthly':
                url = '../assets/php/charts/get_chart_sold.php?option=monthly';
                break;
            case 'yearly':
                url = '../assets/php/charts/get_chart_sold.php?option=yearly';
                break;
            case 'all_time':
                url = '../assets/php/charts/get_chart_sold.php?option=all_time';
                break;
            default:
                return;
        }

        // Make the AJAX request to retrieve the appropriate data
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                const orderDates = data.orderDates;
                const numOrders = data.numOrders;
                console.log(data);

                // Render the chart with the retrieved data
                renderChart(orderDates, numOrders);
            }
        });
    });

    // Function to render the chart with the given data
    const renderChart = (orderDates, numOrders) => {
        const chartSold = document.querySelector('#chartSold');
        new Chart(chartSold, {
            type: 'line',
            data: {
                labels: orderDates,
                datasets: [{
                    label: 'Number of Orders',
                    data: numOrders,
                    borderWidth: 1,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(255, 99, 132, 1)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });
    }
});