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
                new Chart(registerCustomerChartCanvas, { type: 'line', data, options});
            })
            .catch(() => {
                registerCustomerLoader.hide();
                registerCustomerValue.show();
                registerCustomerValue.text("Erreur");
                const {data, options} = registerCustomerChartData({previous: emptyWeek, current: emptyWeek});
                new Chart(registerCustomerChartCanvas, { type: 'line', data, options});
            });
    }
    // Extract register customer char data
    function registerCustomerChartData(chartData) {
        return {
            data: {
                labels: weekLabels,
                datasets : [
                    {
                        borderWidth: 1,
                        label: "Semaine passé",
                        data: chartData.previous,
                        borderColor: "rgba(255, 99, 132, 1)",
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        hoverBackgroundColor: "rgba(255, 99, 132, 0.5)"
                    },
                    {
                        borderWidth: 1,
                        data: chartData.current,
                        label: "Semaine actuelle",
                        borderColor: "rgba(54, 162, 235, 1)",
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        hoverBackgroundColor: "rgba(54, 162, 235, 0.5)"
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: { beginAtZero: true, display: false},
                        gridLines: {drawBorder: false, display: false} },
                    ],
                    xAxes: [{
                        barPercentage: 1.8,
                        categoryPercentage: 0.2,
                        ticks: { beginAtZero: true, display: false},
                        gridLines: {drawBorder: false, display: false} },
                    ]
                },
                responsive: true,
                maintainAspectRatio: false,
                legend: { display: false },
                elements: { point: { radius: 0 } }
            }
        }
    }
    // ============= End Register customer card ============= //
});