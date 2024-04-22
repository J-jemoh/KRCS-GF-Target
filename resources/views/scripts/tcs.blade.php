<script>
        // Wrap JavaScript code in DOMContentLoaded event listener
        document.addEventListener("DOMContentLoaded", function() {
            // Data
            var data = {
                labels: @json(array_keys($results)),
                datasets: [{
                    data: @json(array_values($results)),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Options
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Age Distribution'
                }
            };

            // Get context with jQuery - using jQuery's .get() method.
            var ctx = document.getElementById('agePieChart').getContext('2d');

            // Create pie chart
            var agePieChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options
            });
        });
    </script>
    <!-- gender disribution -->
   <script>
        // Wrap JavaScript code in DOMContentLoaded event listener
        document.addEventListener("DOMContentLoaded", function() {
            // Data
            var data = {
                labels: {!! $Gender->pluck('sex') !!},
                datasets: [{
                    data: {!! $Gender->pluck('count') !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Options
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Gender Distribution'
                }
            };

            // Get context with jQuery - using jQuery's .get() method.
            var ctx = document.getElementById('genderPieChart').getContext('2d');

            // Create pie chart
            var agePieChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options
            });
        });
    </script>
    <!-- Region -->
       <script>
        // Wrap JavaScript code in DOMContentLoaded event listener
        document.addEventListener("DOMContentLoaded", function() {
            // Data
            var data = {
                labels: {!! $region->pluck('region') !!},
                datasets: [{
                    data: {!! $region->pluck('count') !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Options
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Region Distribution'
                }
            };

            // Get context with jQuery - using jQuery's .get() method.
            var ctx = document.getElementById('regionPieChart').getContext('2d');

            // Create pie chart
            var agePieChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options
            });
        });
    </script>
        <!-- County -->
      <script>
    // Wrap JavaScript code in DOMContentLoaded event listener
document.addEventListener("DOMContentLoaded", function() {
    // Data
    var data = {
        labels: {!! $county->pluck('county') !!},
        datasets: [{
            data: {!! $county->pluck('count') !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Options
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            title: {
                display: true,
                text: 'County Distribution'
            }
        },
        indexAxis: 'y',
        scales: {
            xAxes: [{ // Use xAxes instead of x
                            ticks: {
                                beginAtZero: true
                            }
                        }]
        },
         // barThickness: 20
    };

    // Get context with jQuery - using jQuery's .get() method.
    var ctx = document.getElementById('countyPieChart').getContext('2d');

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: data.datasets
        },
        options: options
    });
});

</script>
        <!-- Tracig outcome -->
      <script>
    // Wrap JavaScript code in DOMContentLoaded event listener
document.addEventListener("DOMContentLoaded", function() {
    // Data
    var data = {
        labels: {!! $tracingOutcome->pluck('tracing_outcome_3') !!},
        datasets: [{
            data: {!! $tracingOutcome->pluck('count') !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Options
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            title: {
                display: true,
                text: 'Tracing outcome Distribution'
            }
        },
        indexAxis: 'y',
        scales: {
            xAxes: [{ // Use xAxes instead of x
                            ticks: {
                                beginAtZero: true
                            }
                        }]
        },
         // barThickness: 20
    };

    // Get context with jQuery - using jQuery's .get() method.
    var ctx = document.getElementById('tracingChart').getContext('2d');

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: data.datasets
        },
        options: options
    });
});

</script>