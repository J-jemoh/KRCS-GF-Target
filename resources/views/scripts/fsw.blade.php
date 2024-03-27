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
    <!-- #hiv status at enrollment -->
    <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $hivstatus->pluck('hiv_status_enrol') !!},
            datasets: [{
                data: {!! $hivstatus->pluck('count') !!},
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
        var ctx = document.getElementById('hivStatusPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
        });
    </script>
    <script>
         document.addEventListener("DOMContentLoaded", function(){
        // Data for the chart
        var pieData = {
            labels: ['Defined Package', 'Prep Initiated', 'HIV Tested'],
            datasets: [{
                data: [{!! $definedPackage !!}, {!! $prepInitiated !!}, {!! $hivTested !!}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Get the canvas context
        var ctx = document.getElementById('pieChart').getContext('2d');

        // Create the pie chart
        var pieChart = new Chart(ctx, {
            type: 'doughnut',
            data: pieData,
            options: {
                responsive: false
            }
              });
        });
    </script>
    <!-- HIV TESTED FREQUENCY -->
     <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $hivFreq->pluck('hiv_test_freq') !!},
            datasets: [{
                data: {!! $hivFreq->pluck('count') !!},
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
                text: 'HIV Tested Frequency'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('hivFreqPieChart').getContext('2d');

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
        var labels = {!! $hivExposure72->pluck('hiv_exposure_72hr') !!};
        var counts = {!! $hivExposure72->pluck('count') !!};

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
                text: 'HIV Exposure within 72hrs'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('hivExpPieChart').getContext('2d');

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
        var labels = {!! $Pep72->pluck('pep_72') !!};
        var counts = {!! $Pep72->pluck('count') !!};

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
                text: 'HIV Exposure within 72hrs'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('hivPepPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
    });
</script>
<!-- HIV CARE OUTCOME -->
<script>
    // Data for the bar chart
    document.addEventListener("DOMContentLoaded", function(){
        var labels = {!! $CareOutcome->pluck('hiv_care_outcome') !!};
        var counts = {!! $CareOutcome->pluck('count') !!};

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
                text: 'HIV Care Outcome'
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
        var ctx = document.getElementById('hivCareBarChart').getContext('2d');

        // Create the bar chart
        var hivStatusBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>
<!-- ART OUTCOME -->
<script>
    // Data for the bar chart
    document.addEventListener("DOMContentLoaded", function(){
        var labels = {!! $ArtOutcome->pluck('art_outcome') !!};
        var counts = {!! $ArtOutcome->pluck('count') !!};

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
                text: 'ART Outcome'
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
        var ctx = document.getElementById('ArtBarChart').getContext('2d');

        // Create the bar chart
        var hivStatusBarChart = new Chart(ctx, {
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

    // The gauge chart
    const chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 29000,
            title: {
                text: 'defined package'
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Speed',
            data: [{{ $definedPackage }}], // Dynamic value from Laravel query
            dataLabels: {
                format: '<div style="text-align:center">' +
                    '<span style="font-size:25px">{y}</span><br/>' +
                    '<span style="font-size:12px;opacity:0.4">{point.percentage:.1f}%</span>' +
                    '</div>'
            },
            tooltip: {
                valueSuffix: ''
            }
        }]
    }));
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

    // The gauge chart
    const chartSpeed = Highcharts.chart('container-prep', Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 6591,
            title: {
                text: 'Initiated on prep'
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Speed',
            data: [{{ $prepInitiated }}], // Dynamic value from Laravel query
            dataLabels: {
                format: '<div style="text-align:center">' +
                    '<span style="font-size:25px">{y}</span><br/>' +
                    '<span style="font-size:12px;opacity:0.4">{point.percentage:.1f}%</span>' +
                    '</div>'
            },
            tooltip: {
                valueSuffix: ''
            }
        }]
    }));
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

    // The gauge chart
    const chartSpeed = Highcharts.chart('container-hts', Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 83503,
            title: {
                text: 'Reached with HTS'
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Speed',
            data: [{{ $hivTested }}], // Dynamic value from Laravel query
            dataLabels: {
                format: '<div style="text-align:center">' +
                    '<span style="font-size:25px">{y}</span><br/>' +
                    '<span style="font-size:12px;opacity:0.4">{point.percentage:.1f}%</span>' +
                    '</div>'
            },
            tooltip: {
                valueSuffix: ''
            }
        }]
    }));
    });
</script>






