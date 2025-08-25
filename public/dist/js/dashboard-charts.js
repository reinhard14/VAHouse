// Data for barChart canvas
const barChartData = {
    labels: window.chartData.labels,
    datasets: [
        {
            label: 'Registered VAs',
            backgroundColor: 'rgba(250, 106, 3, 0.2)',
            borderColor: 'rgba(234, 132, 30, 1)',
            borderWidth: 1,
            data: window.monthlyRegister,
        },
        {
            label: 'Onboarded VAs',
            backgroundColor: 'rgba(6, 6, 249, 0.2)',
            borderColor: 'rgba(35, 35, 157, 1)',
            borderWidth: 1,
            data: window.monthlyCounts,
        },
    ],
};

// Ensure the chart is responsive
const barChartConfig = {
    type: 'bar',
    data: barChartData,
    options: {
        responsive: true,
        maintainAspectRatio: false, // Allow the chart to adjust its aspect ratio
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Bar Chart Example',
            },
        },
    },
};

// Render the bar chart
const barChartCanvas = document.getElementById('barChart').getContext('2d');
new Chart(barChartCanvas, barChartConfig);
