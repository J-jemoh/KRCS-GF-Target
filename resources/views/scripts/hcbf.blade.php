<script>
        // Wrap JavaScript code in DOMContentLoaded event listener
        // Wrap JavaScript code in DOMContentLoaded event listener
document.addEventListener("DOMContentLoaded", function() {
    // Data
    var data = {
        labels: @json(array_keys($results)),
        datasets: [
            @foreach($results as $range => $counts)
            {
                label: '{{ $range }}',
                data: [{{ $counts['hcbfd'] }}],
                backgroundColor: [
                    'rgba(0, 0, 139, 0.5)',
                    'rgba(0, 150, 255, 0.8)',
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
            },
            @endforeach
        ]
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
    var ctx = document.getElementById('ageePieChart').getContext('2d');

    // Create pie chart
    var agePieChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: options
    });
});

    </script>
    <!-- #sex count -->
    <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $genderhcbf->pluck('sex') !!},
            datasets: [{
                data: {!! $genderhcbf->pluck('count') !!},
                backgroundColor: [
                	 'rgba(0, 255, 255,0.5)',
                     'rgba(0, 71, 171, 0.8)',
                     
                   
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

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Gender'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('genderrPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
        });
    </script>
     <!-- #sex complete sessons -->
    <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $completeSessionshcbf->pluck('complete_sessions') !!},
            datasets: [{
                data: {!! $completeSessionshcbf->pluck('count') !!},
                backgroundColor: [
                    'rgba(0, 71, 171, 0.8)',
                    'rgba(0, 255, 255,0.5)',
                 
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

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Gender'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('CsessionssPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
        });
    </script>
    <!-- HIV TESTED FREQUENCY -->
     <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $attendedOutreach->pluck('attended_outreach') !!},
            datasets: [{
                data: {!! $attendedOutreach->pluck('count') !!},
                backgroundColor: [
                    'rgba(0, 71, 171, 0.8)',
                    'rgba(0, 255, 255,0.5)',
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

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Completed sessions'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('outreachPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
        });
    </script>
    <!-- HIV EXPOSURE WITHIN 72HR -->
     <script>
    // Data for the pie chart
    document.addEventListener("DOMContentLoaded", function(){
        var labels = {!! $ebiStatus->pluck('attended_ebi') !!};
        var counts = {!! $ebiStatus->pluck('count') !!};

        var dynamicColors = [];
        for (var i = 0; i < counts.length; i++) {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            dynamicColors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
        }

        var data = {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: dynamicColors,
                borderColor: dynamicColors.map(color => color.replace(/,\s*0\.8\)/, ', 1)')), // Adjust alpha to 1 for border color
                borderWidth: 1
            }]
        };

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Attended EBI'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('ebiPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
    });
</script>
<!-- PEP WITHIN 72HR -->
     <script>
    // Data for the pie chart
    document.addEventListener("DOMContentLoaded", function(){
        var labels = {!! $Countycounthcbf->pluck('county') !!};
        var counts = {!! $Countycounthcbf->pluck('count') !!};

        var dynamicColors = [];
        for (var i = 0; i < counts.length; i++) {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            dynamicColors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
        }

        var data = {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: dynamicColors,
                borderColor: dynamicColors.map(color => color.replace(/,\s*0\.5\)/, ', 1)')), // Adjust alpha to 1 for border color
                borderWidth: 1
            }]
        };

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'No by Counties'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('countyhPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>

<!-- SR DISTRIBUTION -->
<script>
    // Data for the pie chart
    document.addEventListener("DOMContentLoaded", function(){
        var labels = {!! $SRcounthcbf->pluck('implementing_partner') !!};
        var counts = {!! $SRcounthcbf->pluck('count') !!};

        var dynamicColors = [];
        for (var i = 0; i < counts.length; i++) {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            dynamicColors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
        }

        var data = {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: dynamicColors,
                borderColor: dynamicColors.map(color => color.replace(/,\s*0\.5\)/, ', 1)')), // Adjust alpha to 1 for border color
                borderWidth: 1
            }]
        };

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'No by SR'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('SRhdistributionChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>

<!-- Due for Viral Load -->
<script>
    // Data for the bar chart
    document.addEventListener("DOMContentLoaded", function(){
        var labels = {!! $vlDue->pluck('due_vl') !!};
        var counts = {!! $vlDue->pluck('count') !!};

        var dynamicColors = [];
        for (var i = 0; i < counts.length; i++) {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            dynamicColors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
        }

        var data = {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: dynamicColors,
                borderColor: dynamicColors.map(color => color.replace(/,\s*0\.5\)/, ', 1)')), // Adjust alpha to 1 for border color
                borderWidth: 1
            }]
        };

        // Options for the bar chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Due VL'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('dueBarChart').getContext('2d');

        // Create the bar chart
        var hivStatusBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>
<!-- Viral  load done -->
<script>
    // Data for the bar chart
    document.addEventListener("DOMContentLoaded", function(){
        var labels = {!! $vlDone->pluck('vl_done') !!};
        var counts = {!! $vlDone->pluck('count') !!};

        var dynamicColors = [];
        for (var i = 0; i < counts.length; i++) {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            dynamicColors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
        }

        var data = {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: dynamicColors,
                borderColor: dynamicColors.map(color => color.replace(/,\s*0\.5\)/, ', 1)')), // Adjust alpha to 1 for border color
                borderWidth: 1
            }]
        };

        // Options for the bar chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'VL Done'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('VlDoneBarChart').getContext('2d');

        // Create the bar chart
        var hivStatusBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>
<!-- Received Viral load -->
<script>
    // Data for the bar chart
    document.addEventListener("DOMContentLoaded", function(){
        var labels = {!! $ReceivedVl->pluck('vl_result_received') !!};
        var counts = {!! $ReceivedVl->pluck('count') !!};

        var dynamicColors = [];
        for (var i = 0; i < counts.length; i++) {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            dynamicColors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
        }

        var data = {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: dynamicColors,
                borderColor: dynamicColors.map(color => color.replace(/,\s*0\.5\)/, ', 1)')), // Adjust alpha to 1 for border color
                borderWidth: 1
            }]
        };

        // Options for the bar chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'VL Received'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('VlRBarChart').getContext('2d');

        // Create the bar chart
        var hivStatusBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>
<script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $hivStatus->pluck('hiv_status') !!},
            datasets: [{
                data: {!! $hivStatus->pluck('count') !!},
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

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'HIV Status Distribution'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('hivStatusBarChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
        });
    </script>
    <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $Cart->pluck('currently_art') !!},
            datasets: [{
                data: {!! $Cart->pluck('count') !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.7)'
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

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Currently on ART Distribution'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('ArtcBarChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
        });
    </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
       const gaugeOptions = {
        chart: {
            type: 'solidgauge'
        },
        title: null,
        pane: {
            center: ['50%', '85%'],
            size: '80%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },
        exporting: {
            enabled: false
        },
        tooltip: {
            enabled: false
        },
        // the value axis
        yAxis: {
            stops: [
                [0.1, '#55BF3B'], // green
                [0.6, '#DDDF0D'], // yellow
                [0.8, '#DF5353'] // red
            ],
            lineWidth: 0,
            tickWidth: 0,
            minorTickInterval: null,
            tickAmount: 2,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },
        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

    </script>


