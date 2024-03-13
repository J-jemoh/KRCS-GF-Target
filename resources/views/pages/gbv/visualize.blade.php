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
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('admin.gbv.index')}}" class="text-white">GBV</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">REPORTS</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">GBV VISUALIZATION</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
        <div class="card card-info">
        <div class="card-header"><b>Count by Region by Typology</b></div>
        <div class="card-body">
           <div style="width: 100%;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
      </div>
        </div>
        <div class="col-lg-12">
        <div class="card card-info">
        <div class="card-header"><b>Count by SR by Typology</b></div>
        <div class="card-body">
        	<label>Region</label>
        	<select name="region" class="form-control" id="regionSelect">
        		@foreach($regions as $region)
        		<option value="{{$region}}">{{$region}}</option>
        		@endforeach
        	</select>
           <div style="width: 100%;">
                <canvas id="myChartsr" width="100%"></canvas>
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
            // Extracting data from PHP to JavaScript
            var data = @json($barData);

            // Processing data for Chart.js
            var chartData = {};
            data.forEach(function(item) {
                if (!chartData[item.region]) {
                    chartData[item.region] = {};
                }
                chartData[item.region][item.typology] = item.count_topology;
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
    <!-- group by sr and region -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Extracting data from PHP to JavaScript
    var data = @json($barSR);
    var myChart = null;
    var defaultRegion="LER"; // Initialize chart variable

    function updateChart(selectedRegion) {
        var filteredData = data.filter(function(item) {
            return item.region === selectedRegion;
        });

        // Processing data for Chart.js
        var chartData = {};
        filteredData.forEach(function(item) {
            if (!chartData[item.sr_name]) {
                chartData[item.sr_name] = {};
            }
            chartData[item.sr_name][item.typology] = item.count_topology;
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
        
        // Destroy existing chart if it exists
        if (myChart) {
            myChart.destroy();
        }

        // Drawing chart with Chart.js
        var ctx = document.getElementById('myChartsr');
        if (ctx) {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(chartData[Object.keys(chartData)[0]]),
                    datasets: datasets
                },
                options: {
                    indexAxis: 'y', // Set index axis to y
                    scales: {
                        xAxes: [{ // Use xAxes instead of x
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    barThickness: 20,
                }
            });
        } else {
            console.error("Canvas element with ID 'myChartsr' not found.");
        }
    }
	updateChart(defaultRegion);
    // Initial chart rendering
    document.getElementById('regionSelect').addEventListener('change', function() {
        console.log('Selected region changed:', this.value);
        var selectedRegion = this.value;
        updateChart(selectedRegion);
    });
});

</script>
