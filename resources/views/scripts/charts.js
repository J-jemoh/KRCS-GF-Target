  <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extracting data from PHP to JavaScript
            var data = @json($barData);

            // Processing data for Chart.js
            var chartData = {};
            data.forEach(function(item) {
                if (!chartData[item.reqion]) {
                    chartData[item.reqion] = {};
                }
                chartData[item.reqion][item.module] = item.avg_performance;
            });

            // Creating dataset for Chart.js
            var datasets = [];
            for (var region in chartData) {
                var moduleData = chartData[region];
                var dataset = {
                    label: region,
                    data: Object.values(moduleData),
                    backgroundColor: 'rgba(' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',0.6)',
                };
                datasets.push(dataset);
            }

            // Drawing chart with Chart.js
            var ctx = document.getElementById('myChart');
            if (ctx) {
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(chartData[Object.keys(chartData)[0]]),
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            } else {
                console.error("Canvas element with ID 'myChart' not found.");
            }
        });
    </script>