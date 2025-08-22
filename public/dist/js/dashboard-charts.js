// Data for barChart canvas
const barChartData = {
    labels: window.chartData.labels,
    datasets: [
        {
            label: 'Registered VAs',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: window.monthlyRegister,
        },
        {
            label: 'Onboarded VAs',
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1,
            data: window.monthlyCounts,
        },
    ],
};
// console.log('Bar Chart Data:', window.monthlyCounts);

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
