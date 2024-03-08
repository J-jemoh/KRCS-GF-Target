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
              <li class="breadcrumb-item active"><a href="{{route('admin.qpmm')}}" class="text-white">QPMM</a></li>
              <li class="breadcrumb-item active"><a href="{{route('admin.reports')}}" class="text-white">REPORTS</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">TRUCKERS REPORT</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header">TRUCKERS REPORTS</div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>SNo</th>
                			<th>Region</th>
    						<th>Target Group</th>
    						<th>Indicators</th>
    						<th>Quater 1</th>
    						<th>Quater 2</th>
    						<th>Quater 3</th>
    						<th>Quater 4</th>
    						<th>Quater 5</th>
    						<th>Quater 6</th>
    						<th>Quater 7</th>
    						<th>Quater 8</th>
    						<th>Quater 9</th>
    						<th>Quater 10</th>
    						<th>Quater 11</th>
    						<th>Quater 12</th>
    						<th>Total</th>
    						<th>PA Quater 1</th>
    						<th>PA Quater 2</th>
    						<th>PA Quater 3</th>
    						<th>PA Quater 4</th>
    						<th>PA Quater 5</th>
    						<th>PA Quater 6</th>
    						<th>PA Quater 7</th>
    						<th>PA Quater 8</th>
    						<th>PA Quater 9</th>
    						<th>PA Quater 10</th>
    						<th>PA Quater 11</th>
    						<th>PA Quater 12</th>
    						<th>PATotal</th>
    						<th>%GE</th>
    						
    					</tr>
    				</thead>
            <tbody>
              @foreach($truckers as $qpmm)
              <tr>
                <td>{{$qpmm->sno}}</td>
                <td>{{$qpmm->region}}</td>
                <td>{{$qpmm->target_group}}</td>
                <td>{{Str::limit($qpmm->indicators,30)}}</td>
                <td>{{$qpmm->pt_quater_1}}</td>
                <td>{{$qpmm->pt_quater_2}}</td>
                <td>{{$qpmm->pt_quater_3}}</td>
                <td>{{$qpmm->pt_quater_4}}</td>
                <td>{{$qpmm->pt_quater_5}}</td>
                <td>{{$qpmm->pt_quater_6}}</td>
                <td>{{$qpmm->pt_quater_7}}</td>
                <td>{{$qpmm->pt_quater_8}}</td>
                <td>{{$qpmm->pt_quater_9}}</td>
                <td>{{$qpmm->pt_quater_10}}</td>
                <td>{{$qpmm->pt_quater_11}}</td>
                <td>{{$qpmm->pt_quater_12}}</td>
                <td>{{$qpmm->pt_total}}</td>
                <td>{{$qpmm->pa_quater1}}</td>
                <td>{{$qpmm->pa_quater2}}</td>
                <td>{{$qpmm->pa_quater3}}</td>
                <td>{{$qpmm->pa_quater4}}</td>
                <td>{{$qpmm->pa_quater5}}</td>
                <td>{{$qpmm->pa_quater6}}</td>
                <td>{{$qpmm->pa_quater7}}</td>
                <td>{{$qpmm->pa_quater8}}</td>
                <td>{{$qpmm->pa_quater9}}</td>
                <td>{{$qpmm->pa_quater10}}</td>
                <td>{{$qpmm->pa_quater11}}</td>
                <td>{{$qpmm->pa_quater12}}</td>
                <td>{{$qpmm->pa_total}}</td>
                <td>{{$qpmm->percent}}</td>
              </tr>
              @endforeach
            </tbody>
    			</table>
    		</div>
    	</div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
        <div class="card card-info">
        <div class="card-header"><b>Performance Target Visualization</b></div>
        <div class="card-body">
           <div style="width: 100%;">
                <canvas id="myChart_truck_pt"></canvas>
            </div>
        </div>
      </div>
        </div>
        <div class="col-lg-6">
        <div class="card card-info">
        <div class="card-header"><b>Performance Achievements Visualization</b></div>
        <div class="card-body">
           <div style="width: 100%;">
                <canvas id="myChart_truck_pa"></canvas>
            </div>
        </div>
      </div>
        </div>
        <div class="col-lg-12">
        <div class="card card-info">
        <div class="card-header"><b>Performance Achievements vs Performance Targets Visualization</b></div>
        <div class="card-body">
           <div style="width: 100%;">
                <canvas id="myChart_pcombined_truck" height="100"></canvas>
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
            var data = @json($barPt);

            // Processing data for Chart.js
            var chartData = {};
            data.forEach(function(item) {
                if (!chartData[item.region]) {
                    chartData[item.region] = {};
                }
                chartData[item.region][item.target_group] = item.avg_pt_total;
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
            var ctx = document.getElementById('myChart_truck_pt');
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
    <!-- Perfomance achievements -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extracting data from PHP to JavaScript
            var data = @json($barPa);

            // Processing data for Chart.js
            var chartData = {};
            data.forEach(function(item) {
                if (!chartData[item.region]) {
                    chartData[item.region] = {};
                }
                chartData[item.region][item.target_group] = item.avg_pa_total;
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
            var ctx = document.getElementById('myChart_truck_pa');
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
    <!-- pt vs pt combined -->
   <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extracting data from PHP to JavaScript
            var data = @json($barCombined);

            // Organize data by region
            var chartData = {};
            data.forEach(function(item) {
                if (!chartData[item.region]) {
                    chartData[item.region] = [];
                }
                chartData[item.region].push({
                    target_group: item.target_group,
                    avg_pa_total: item.avg_pa_total,
                    avg_pt_total: item.avg_pt_total
                });
            });

            // Prepare datasets for Chart.js
            var datasets = [];
            for (var region in chartData) {
                var regionData = chartData[region];
                var avg_pa_totalData = [];
                var avg_pt_totalData = [];
                var targetGroups = [];

                regionData.forEach(function(item) {
                    targetGroups.push(item.target_group);
                    avg_pa_totalData.push(item.avg_pa_total);
                    avg_pt_totalData.push(item.avg_pt_total);
                });

                datasets.push({
                    label: region + ' - Average Performance Achievements',
                    data: avg_pa_totalData,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)'
                });

                datasets.push({
                    label: region + ' - Average Performance Traget',
                    data: avg_pt_totalData,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                });
            }

            // Drawing chart with Chart.js
            var ctx = document.getElementById('myChart_pcombined_truck').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: targetGroups, // Assuming all regions have same target groups
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
        });
    </script>
