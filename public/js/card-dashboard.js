$(function() {
    // Global data
    const emptyWeek = [0, 0, 0, 0, 0, 0, 0];
    const weekLabels = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

    // ============= Start Register customer card ============= //
    // Data
    const registerCustomerLoader = $("#register-customer-loader");
    const registerCustomerValue = $("#register-customer-value");
    const registerCustomerChart = $("#register-customer-chart");
    const url = registerCustomerChart.data("url");

    // Request
    let registerCustomerChartCanvas = registerCustomerChart.get(0).getContext("2d");
    ajaxRequest({}, url, 'GET')
        .then((response) => {
            registerCustomerLoader.hide();
            registerCustomerValue.show();
            registerCustomerValue.text(response.value);
            // Init char
            const {data, options} = registerCustomerChartData(response.data);
            new Chart(registerCustomerChartCanvas, { type: 'line', data, options});
        })
        .catch(() => {
            registerCustomerLoader.hide();
            registerCustomerValue.show();
            registerCustomerValue.text("Erreur");
            // Init char
            const {data, options} = registerCustomerChartData(emptyWeek);
            new Chart(registerCustomerChartCanvas, { type: 'line', data, options});
        });

    // Extract register customer char data
    function registerCustomerChartData(chartData) {
        return {
            data: {
                labels: weekLabels,
                datasets : [{
                    lineTension: 0,
                    data: chartData,
                    pointRadius: 0.1,
                    borderColor: "rgba(255, 255, 255, 0.7)",
                    backgroundColor: "rgba(255, 255, 255, 0.4)"
                }]
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {beginAtZero: true, display: false},
                            gridLines: {drawBorder: false, display: false}
                        }
                    ],
                    xAxes: [
                        {
                            ticks: {beginAtZero: true, display: false},
                            gridLines: {drawBorder: false, display: false}
                        }
                    ]
                },
                responsive: true,
                legend: { display: false },
                tooltips: {enabled: false},
                maintainAspectRatio: false,
                elements: {point: {radius: 0}}
            }
        }
    }
    // ============= End Register customer card ============= //
});