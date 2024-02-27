const areaTableChartCtx = document.getElementById("areaTableChart").getContext("2d");

const colorPrimary = "#8f44fd", colorBorder = "rgba(255, 255, 255, 0.08)";

var gradient = areaTableChartCtx.createLinearGradient(0, 0, 0, 200);
gradient.addColorStop(0, "rgba(255, 255, 255, 0.2)");
gradient.addColorStop(0.8, "rgba(255, 255, 255, 0)");

const sales2023 = [12, 19, 10, 26, 15, 17, 10, 27, 10, 20, 11, 30];

const sales2024 = [17, 15,];

const areaTableChart =
    new Chart(areaTableChartCtx, {
        type: "line",
        data: {
            labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            datasets: [
                {
                    backgroundColor: gradient,
                    borderColor: colorPrimary,
                    label: "Ventas",
                    fill: true,
                    data: sales2024,
                    borderWidth: 2,
                },
            ],
        },
        options: {
            elements: {
                point: {
                    radius: 8,
                    hoverRadius: 8,
                    borderWidth: 0,
                },
            },
        },
        scales: {
            x: { display: false, },
            y: {
                suggestedMax: 40,
                suggestedMin: 0,
                grid: {
                    display: true,
                    drawBorder: true,
                    drawnOnChartArea: true,
                    drawTicks: true,
                    color: colorBorder,
                    borderColor: "transparent",
                    borderDash: [5, 5],
                    borderDashOffset: 2,
                    tickColor: "transparent",
                },
            },
            tension: 0.3,
        },
    });

const selectYear = (element, year) => {
    const buttons = document
        .querySelectorAll(".card-chart-header button");

    buttons.forEach((button) =>
        button.classList.remove("active"));

    element.classList.add("active");

    areaTableChart
        .data
        .datasets[0]
        .data = year === 2024
            ? sales2024
            : sales2023;

    areaTableChart.update();
}