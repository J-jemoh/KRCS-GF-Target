<script>
    document.addEventListener('DOMContentLoaded', function() {
        var defaultRegion = "LER"; // Initialize default region

        function updateChart(selectedRegion) {
            // Make an AJAX call to the server to fetch counts based on the selected region
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '{{ route("get-counts") }}?region=' + selectedRegion, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    // Update HTML to display updated values
                    document.getElementById('srCount').innerText = data.srCount;
                    document.getElementById('counties').innerText = data.counties;
                    document.getElementById('pe').innerText = data.pe;
                    document.getElementById('enrolled').innerText = data.enrolled;
                    // Your chart update logic goes here...
                } else {
                    console.error('Request failed. Status: ' + xhr.status);
                }
            };
            xhr.send();
        }

        // Initial chart rendering
        updateChart(defaultRegion);

        // Update chart and values based on selected region
        document.getElementById('regionSelect').addEventListener('change', function() {
            var selectedRegion = this.value;
            updateChart(selectedRegion);
        });
    });

var ageChart;
var defaultRegion = "LER";

function updateChart(selectedRegion) {
    fetch('{{ route("agechart.fetch") }}?region=' + selectedRegion, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        ageChart.data.labels = Object.keys(data); // Update chart labels
        ageChart.data.datasets[0].data = Object.values(data); // Update chart data

        // Generate dynamic colors for the datasets
        var dynamicColors = [];
        for (var i = 0; i < Object.keys(data).length; i++) {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            dynamicColors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
        }
        ageChart.data.datasets[0].backgroundColor = dynamicColors;

        ageChart.update(); // Update the chart
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
}


document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('ageChart').getContext('2d');
    ageChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_keys($results)),
            datasets: [{
                label: 'Age Distribution',
                data: @json(array_values($results)),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    grid: {
                        display: true // Remove gridlines from x-axis
                    }
                },
                y: {
                    grid: {
                        display: true // Remove gridlines from y-axis
                    },
                    beginAtZero: true
                }
            }
        }
    });
    updateChart(defaultRegion);
    // Add event listener to dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updateChart(selectedRegion);
    });
});


document.addEventListener("DOMContentLoaded", function(){
    // Function to update the pie chart based on the selected region
    var defaultRegion = "LER";
    function updatePieChart(selectedRegion) {
        // Fetch data for the selected region
        fetch('{{ route("regionchart.fetch") }}?region=' + selectedRegion, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update pie chart data
            hivStatusPieChart.data.labels = data.labels;
            hivStatusPieChart.data.datasets[0].data = data.values;
            hivStatusPieChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Get the initial data for the pie chart
    var initialData = {
        labels: {!! $hivstatus->pluck('hiv_status_enrol') !!},
        values: {!! $hivstatus->pluck('count') !!}
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
    var ctx = document.getElementById('hivChart').getContext('2d');

    // Create the pie chart
    var hivStatusPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: initialData.labels,
            datasets: [{
                data: initialData.values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
      updatePieChart(defaultRegion);
    // Event listener for the dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updatePieChart(selectedRegion);
    });
});


document.addEventListener("DOMContentLoaded", function(){
    // Function to update the pie chart based on the selected region
    var defaultRegion = "LER";
    function updatePieChart(selectedRegion) {
        // Fetch data for the selected region
        fetch('{{ route("hivfreqchart.fetch") }}?region=' + selectedRegion, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update pie chart data
            hivStatusPieChart.data.labels = data.labels;
            hivStatusPieChart.data.datasets[0].data = data.values;

            // Generate dynamic colors for the pie chart
            var dynamicColors = [];
            for (var i = 0; i < data.labels.length; i++) {
                dynamicColors.push('rgba(' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ', 0.6)');
            }
            hivStatusPieChart.data.datasets[0].backgroundColor = dynamicColors;

            hivStatusPieChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Get the initial data for the pie chart
    var initialData = {
        labels: {!! $hivFreq->pluck('hiv_status_enrol') !!},
        values: {!! $hivFreq->pluck('count') !!}
    };

    // Options for the pie chart
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'HIV Frequency Distribution'
        }
    };

    // Get the canvas element
    var ctx = document.getElementById('htsChart').getContext('2d');

    // Create the pie chart
    var hivStatusPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: initialData.labels,
            datasets: [{
                data: initialData.values,
                backgroundColor: [], // Will be filled dynamically
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
      updatePieChart(defaultRegion);
    // Event listener for the dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updatePieChart(selectedRegion);
    });
});

document.addEventListener("DOMContentLoaded", function(){
    // Function to update the bar chart based on the selected region
    var defaultRegion = "LER";
    function updateBarChart(selectedRegion) {
        // Fetch data for the selected region
        fetch('{{ route("hivStatuschart.fetch") }}?region=' + selectedRegion, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update bar chart data
            hivStatusBarChart.data.labels = data.labels;
            hivStatusBarChart.data.datasets[0].data = data.values;

            // Generate dynamic colors for the bar chart
            var dynamicColors = [];
            for (var i = 0; i < data.labels.length; i++) {
                dynamicColors.push('rgba(' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ', 0.6)');
            }
            hivStatusBarChart.data.datasets[0].backgroundColor = dynamicColors;

            hivStatusBarChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Get the initial data for the bar chart
    var initialData = {
        labels: {!! $hivStatus->pluck('hiv_status_enrol') !!},
        values: {!! $hivStatus->pluck('count') !!}
    };

    // Options for the bar chart
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'HIV Status'
        }
    };

    // Get the canvas element
    var ctx = document.getElementById('hivStatusChart').getContext('2d');

    // Create the bar chart
    var hivStatusBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: initialData.labels,
            datasets: [{
                label: 'HIV Status',
                data: initialData.values,
                backgroundColor: [], // Will be filled dynamically
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
      updateBarChart(defaultRegion);
    // Event listener for the dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updateBarChart(selectedRegion);
    });
});


document.addEventListener("DOMContentLoaded", function(){
    // Function to update the pie chart based on the selected region
    var defaultRegion = "LER";
    function updatePieChart(selectedRegion) {
        // Fetch data for the selected region
        fetch('{{ route("cartchart.fetch") }}?region=' + selectedRegion, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update pie chart data
            hivStatusPieChart.data.labels = data.labels;
            hivStatusPieChart.data.datasets[0].data = data.values;
            hivStatusPieChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Get the initial data for the pie chart
    var initialData = {
        labels: {!! $Cart->pluck('currently_art') !!},
        values: {!! $Cart->pluck('count') !!}
    };

    // Options for the pie chart
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Currently on ART'
        }
    };

    // Get the canvas element
    var ctx = document.getElementById('CARTChart').getContext('2d');

    // Create the pie chart
    var hivStatusPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: initialData.labels,
            datasets: [{
                data: initialData.values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
      updatePieChart(defaultRegion);
    // Event listener for the dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updatePieChart(selectedRegion);
    });
});
document.addEventListener("DOMContentLoaded", function(){
    // Function to update the pie chart based on the selected region
    var defaultRegion = "LER";
    function updatePieChart(selectedRegion) {
        // Fetch data for the selected region
        fetch('{{ route("carechart.fetch") }}?region=' + selectedRegion, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update pie chart data
            hivStatusPieChart.data.labels = data.labels;
            hivStatusPieChart.data.datasets[0].data = data.values;
            hivStatusPieChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Get the initial data for the pie chart
    var initialData = {
        labels: {!! $Careoutcome->pluck('hiv_care_outcome') !!},
        values: {!! $Careoutcome->pluck('count') !!}
    };

    // Options for the pie chart
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'HIV Care Outcome'
        }
    };

    // Get the canvas element
    var ctx = document.getElementById('careOutcomeChart').getContext('2d');

    // Create the pie chart
    var hivStatusPieChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: initialData.labels,
            datasets: [{
                data: initialData.values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
      updatePieChart(defaultRegion);
    // Event listener for the dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updatePieChart(selectedRegion);
    });
});
document.addEventListener("DOMContentLoaded", function(){
    // Function to update the pie chart based on the selected region
    var defaultRegion = "LER";
    function updatePieChart(selectedRegion) {
        // Fetch data for the selected region
        fetch('{{ route("peereducation.fetch") }}?region=' + selectedRegion, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update pie chart data
            hivStatusPieChart.data.labels = data.labels;
            hivStatusPieChart.data.datasets[0].data = data.values;
            hivStatusPieChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Get the initial data for the pie chart
    var initialData = {
        labels: {!! $PeEd->pluck('received_peer_education') !!},
        values: {!! $PeEd->pluck('count') !!}
    };

    // Options for the pie chart
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Peer Education'
        }
    };

    // Get the canvas element
    var ctx = document.getElementById('PeerChart').getContext('2d');

    // Create the pie chart
    var hivStatusPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: initialData.labels,
            datasets: [{
                data: initialData.values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
      updatePieChart(defaultRegion);
    // Event listener for the dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updatePieChart(selectedRegion);
    });
});
document.addEventListener("DOMContentLoaded", function(){
    // Function to update the pie chart based on the selected region
    var defaultRegion = "LER";
    function updatePieChart(selectedRegion) {
        // Fetch data for the selected region
        fetch('{{ route("stiscreened.fetch") }}?region=' + selectedRegion, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update pie chart data
            hivStatusPieChart.data.labels = data.labels;
            hivStatusPieChart.data.datasets[0].data = data.values;
            hivStatusPieChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Get the initial data for the pie chart
    var initialData = {
        labels: {!! $StiScreened->pluck('sti_screened') !!},
        values: {!! $StiScreened->pluck('count') !!}
    };

    // Options for the pie chart
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Screened STI'
        }
    };

    // Get the canvas element
    var ctx = document.getElementById('StiChart').getContext('2d');

    // Create the pie chart
    var hivStatusPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: initialData.labels,
            datasets: [{
                data: initialData.values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
      updatePieChart(defaultRegion);
    // Event listener for the dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updatePieChart(selectedRegion);
    });
});
document.addEventListener("DOMContentLoaded", function(){
    // Function to update the pie chart based on the selected region
    var defaultRegion = "LER";
    function updatePieChart(selectedRegion) {
        // Fetch data for the selected region
        fetch('{{ route("tbscreened.fetch") }}?region=' + selectedRegion, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update pie chart data
            hivStatusPieChart.data.labels = data.labels;
            hivStatusPieChart.data.datasets[0].data = data.values;
            hivStatusPieChart.update();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    // Get the initial data for the pie chart
    var initialData = {
        labels: {!! $TbScreened->pluck('tb_screened') !!},
        values: {!! $TbScreened->pluck('count') !!}
    };

    // Options for the pie chart
    var options = {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Screened TB'
        }
    };

    // Get the canvas element
    var ctx = document.getElementById('TBChart').getContext('2d');

    // Create the pie chart
    var hivStatusPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: initialData.labels,
            datasets: [{
                data: initialData.values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: options
    });
      updatePieChart(defaultRegion);
    // Event listener for the dropdown menu
    document.getElementById('regionSelect').addEventListener('change', function() {
        var selectedRegion = this.value;
        updatePieChart(selectedRegion);
    });
});

document.addEventListener("DOMContentLoaded", function(){
$(document).ready(function(){
     $('#regionSelect').val('LER').change();
    $('#regionSelect').change(function(){
        var selectedRegion = $(this).val();
        $.ajax({
            url: '{{ route('srname.fetch') }}',
            method: 'GET',
            data: {region: selectedRegion},
            success: function(response){
                // Clear existing table rows
                $('#tbData tbody').empty();

                // Populate table with fetched data
                $.each(response, function(index, item){
                    $('#tbData tbody').append(
                        '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + item.sr_name + '</td>' +
                        '<td>' + item.count + '</td>' +
                        '</tr>'
                    );
                });
            }
        });
    });
});
});
</script>
