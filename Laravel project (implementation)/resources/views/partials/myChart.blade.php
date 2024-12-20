
        <div class="charts">
          
        <canvas id="leadChart"></canvas>
    </div>

<script>
    let leadChart;

    function extendLabelsWithExtraDays(labels, numDays) {
        const extendedLabels = [...labels];
        const lastDate = new Date(labels[labels.length - 1]);

        for (let i = 1; i <= numDays; i++) {
            const nextDate = new Date(lastDate);
            nextDate.setDate(lastDate.getDate() + i);
            extendedLabels.push(
                nextDate.toISOString().split('T')[0]
            );
        }
        return extendedLabels;
    }

    function createIChart(labels, data) {
    const ct = document.getElementById('leadChart').getContext('2d');
    leadChart = new Chart(ct, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Leads/Time',
                data: data,
                borderColor: 'rgba(54, 162, 235, 0.8)', // Line color
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Fill color under the line
                borderWidth: 5, // Border width of the line
                pointBackgroundColor: 'rgba(54, 162, 235, 1)', // Point color
                pointBorderColor: '#fff', // Point border color
                pointBorderWidth: 5, // Point border width
                pointRadius: 5, // Point size
                pointHoverRadius: 7, // Hover point size
                pointHoverBackgroundColor: 'rgba(255, 99, 132, 1)', // Hover point color
                pointHoverBorderColor: '#fff', // Hover point border color
                pointHoverBorderWidth: 3, // Hover point border width
                tension: 0.4 // This makes the line curved. You can adjust this value to your liking
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: 20
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#666',
                        font: {
                            size: 14,
                            family: 'Arial, sans-serif'
                        },
                        padding: 20
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    padding: 10
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date',
                        color: '#666',
                        font: {
                            size: 16,
                            family: 'Arial, sans-serif'
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Recorded leads',
                        color: '#666',
                        font: {
                            size: 16,
                            family: 'Arial, sans-serif'
                        }
                    },
                    beginAtZero: true,
                    suggestedMax: Math.max(...data) + 8,
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)',
                        lineWidth: 1
                    }
                }
            }
        }
    });
}


    async function myChart(interval) {
        const response = await fetch(`/getLeadData?interval=${interval}`);
        const data = await response.json();

        let labels = data.map(item => item.date_group);
        const quantities = data.map(item => item.total_leads);

        if (interval === 'days') {
            labels = extendLabelsWithExtraDays(labels, 5);
        }

        if (leadChart) {
            leadChart.destroy();
        }
        createIChart(labels, quantities);
    }

    myChart('days');
</script> 

