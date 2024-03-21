@extends('layouts.admin')
@section('content')
 <div class="content-header bg-info">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
              <li class="breadcrumb-item active text-white">Regions
              </li>
               <li class="breadcrumb-item active text-white">Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
    <section class="content">
    <div class="container-fluid">
      @include('messages.flash_messages')
      <div class="card card-info">
      	<div class="card-header">All regional Reports
      	</div>
      	<div class="card-body">
      	<div class="row">
		    <div class="col-md-6">
		        <select name="region" class="form-control" id="regionSelect">

		            @foreach($regions as $region)
		            <option value="{{$region}}">{{$region}}</option>
		            @endforeach
		            <!-- Add more options here -->
		        </select>
		    </div>
		      <div class="col-md-6">
		        <select name="region" class="form-control">
		            <option>Select Typology</option>
		            @foreach($typology as $kp_type)
		            <option value="{{$kp_type}}">{{$kp_type}}</option>
		            @endforeach
		            <!-- Add more options here -->
		        </select>
		    </div>
		</div>

      	</div>
      	<div class="card-body bg-light">
      <div class="row"  id="infoBoxContainer">
     
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total No of SR'S</span>
                <span class="info-box-number" id="srCount">
                  {{$srCount}}
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No of Counties</span>
                <span class="info-box-number" id="counties">{{$counties}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No of PE</span>
                <span class="info-box-number" id="pe">{{$pe}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Enrolled</span>
                <span class="info-box-number" id="enrolled">{{$enrolled}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>
      	</div>
      	<div class="card card-body">
      		<div class="row">
      			<div class="col-lg-4">
      				<p><b>Age distribution Chart</b></p>
      				<div class="card card-body bg-light">
      				  <canvas id="ageChart" width="400" height="400"></canvas>
      				</div>
      			</div>
      			<div class="col-lg-4">
      				<p><b>HIV Status at enrolment</b></p>
      				<div class="card card-body bg-light">
      				  <canvas id="hivChart" width="400" height="400"></canvas>
      				</div>
      			</div>
      			<div class="col-lg-4">
      				<p><b>Frequency of HIV tests</b></p>
      				<div class="card card-body bg-light">
      				  <canvas id="htsChart" width="400" height="400"></canvas>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
    </div>

  </section>
@endsection
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
</script>
<script>
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
                        display: false // Remove gridlines from x-axis
                    }
                },
                y: {
                    grid: {
                        display: false // Remove gridlines from y-axis
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

   </script>
   <!-- HIV STATUS AT ENROLMENT -->
    <script>
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

    </script>
    <!-- HIV FREQUENCY -->
<script>
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
        type: 'pie',
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

</script>
