$(document).ready(function () {
    const chartSold = document.querySelector('#chartSold');
    let chartSoldRender = null;

    // Make the AJAX request on load
    $.ajax({
        url: '../assets/php/charts/get_chart_sold.php?option=last7',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const orderDates = data.orderDates;
            const numOrders = data.numOrders;

            // Render the chart with the retrieved data
            renderChart(orderDates, numOrders);
        }
    });

    $('#chartSoldSelect').change(function () {
        const option = $(this).val();
        let url = '';

        // Set the URL for the AJAX request based on the selected option
        switch (option) {
            case 'last7':
                url = '../assets/php/charts/get_chart_sold.php?option=last7';
                break;
            case 'last30':
                url = '../assets/php/charts/get_chart_sold.php?option=last30';
                break;
            case 'last60':
                url = '../assets/php/charts/get_chart_sold.php?option=last60';
                break;
            case 'this_year':
                url = '../assets/php/charts/get_chart_sold.php?option=this_year';
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

                // Render the chart with the retrieved data
                renderChart(orderDates, numOrders);
            }
        });
    });

    // Function to render the chart with the given data
    const renderChart = (orderDates, numOrders) => {
        if (chartSoldRender) {
            chartSoldRender.data.labels = orderDates;
            chartSoldRender.data.datasets[0].data = numOrders;
            chartSoldRender.update();
        } else {
            chartSoldRender = new Chart(chartSold, {
                type: 'line',
                data: {
                    labels: orderDates,
                    datasets: [{
                        label: 'Completed Orders',
                        data: numOrders,
                        borderWidth: 1,
                        backgroundColor: 'rgba(102, 204, 153, 0.2)',
                        borderColor: 'rgba(102, 204, 153, 1)',
                        pointBackgroundColor: 'rgba(102, 204, 153, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(102, 204, 153, 1)'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                },
            });
        }
    }
});