$(document).ready(function () {
	const chartProducts = document.querySelector('#chartProducts');
	let chartProductsRender = null;

	// Make the AJAX request on load
	$.ajax({
		url: '../assets/php/charts/get_chart_products.php?option=weekly',
		type: 'GET',
		dataType: 'json',
		success: function (data) {
			const [productNames, productSold] = soldProducts(data);
			renderChart(productNames, productSold);
		}
	});

	$('#chartProductsSelect').change(function () {
		const optionProducts = $(this).val();
		let url = '';

		// Set the URL for the AJAX request based on the selected option
		switch (optionProducts) {
			case 'weekly':
				url = '../assets/php/charts/get_chart_products.php?option=weekly';
				break;
			case 'monthly':
				url = '../assets/php/charts/get_chart_products.php?option=monthly';
				break;
			case 'yearly':
				url = '../assets/php/charts/get_chart_products.php?option=yearly';
				break;
			case 'all_time':
				url = '../assets/php/charts/get_chart_products.php?option=all_time';
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
				const [productNames, productSold] = soldProducts(data);
				renderChart(productNames, productSold);
			}
		});
	});

	// Count how many products have been sold within the JSON data
	const soldProducts = (data) => {
		const productNames = [];
		const productSold = [];
		const orderDetails = data.orderDetails;

		for (const order of orderDetails) {
			for (const item of order) {
				const name = item.name;
				const qty = item.qty;
				const index = productNames.indexOf(name);
				if (index === -1) {
					productNames.push(name);
					productSold.push(qty);
				} else {
					productSold[index] += qty;
				}
			}
		}

		return [productNames, productSold];
	}

	// Function to render the chart with the given data
	const renderChart = (productNames, productSold) => {
		if (chartProductsRender) {
			chartProductsRender.data.labels = productNames;
			chartProductsRender.data.datasets[0].data = productSold;
			chartProductsRender.update();
		} else {
			chartProductsRender = new Chart(chartProducts, {
				type: 'bar',
				data: {
					labels: productNames,
					datasets: [{
						label: 'Sold Products',
						data: productSold,
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
	};
});