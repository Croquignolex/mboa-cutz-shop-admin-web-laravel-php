$(function() {
    // Global data
    const emptyWeek = [0, 0, 0, 0, 0, 0, 0];
    const weekLabels = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

    // ============= Start Register customer card ============= //
    // Data
    const registerCustomerLoader = $("#register-customer-loader");
    const registerCustomerReload = $("#register-customer-reload");
    const registerCustomerValue = $("#register-customer-value");
    const registerCustomerChart = $("#register-customer-chart");
    const url = registerCustomerChart.data("url");

    // Manage
    registerCustomer();
    registerCustomerReload.click(function () {
        registerCustomer();
    });

    // Request
    function registerCustomer() {
        registerCustomerValue.hide();
        registerCustomerLoader.show();
        let registerCustomerChartCanvas = registerCustomerChart.get(0).getContext("2d");
        ajaxRequest({}, url, 'GET')
            .then((response) => {
                registerCustomerLoader.hide();
                registerCustomerValue.show();
                registerCustomerValue.text(response.value);

                const {data, options} = registerCustomerChartData(response.data);
                new Chart(registerCustomerChartCanvas, { type: 'bar', data, options});
            })
            .catch(() => {
                registerCustomerLoader.hide();
                registerCustomerValue.show();
                registerCustomerValue.text("Erreur");
                const {data, options} = registerCustomerChartData(emptyWeek);
                new Chart(registerCustomerChartCanvas, { type: 'bar', data, options});
            });
    }
    // Extract register customer char data
    function registerCustomerChartData(chartData) {
        return {
            data: {
                labels: weekLabels,
                datasets : [{data: chartData, backgroundColor: "#ffffff"}]
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: { beginAtZero: true, display: false},
                            gridLines: {drawBorder: false, display: false}
                        }
                    ],
                    xAxes: [
                        {
                            barPercentage: 1.8,
                            categoryPercentage: 0.2,
                            ticks: { beginAtZero: true, display: false},
                            gridLines: {drawBorder: false, display: false}
                        }
                    ]
                },
                responsive: true,
                legend: { display: false },
                tooltips: {enabled: false},
                maintainAspectRatio: false,
            }
        }
    }
    // ============= End Register customer card ============= //
});