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
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-white">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('admin.target.all')}}" class="text-white">Targets</a></li>
               <li class="breadcrumb-item active"><a href="{{route('admin.target.reports')}}" class="text-white">Reports</a></li>
                <li class="breadcrumb-item active text-white">TG</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
     <section class="content">
    <div class="container-fluid">
    	    <div class="row">     
      	 <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No. of Regions</span>
                <span class="info-box-number">
                  {{$regions}}
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
           	<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No. of SRS</span>
                <span class="info-box-number">{{$sr}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No of Counties</span>
                <span class="info-box-number">{{$counties}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>
    	<div class="card card-info">
    		<div class="card-header"><b>TG TARGET INDICATOR</b></div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
               <tr class="bg-danger">
                    <th colspan="7">General Information</th>
                    <th colspan="5">Reached(Condom+HESB/RRC+STI)</th>
                    <th colspan="5">HIV Testing Service</th>

                </tr>
    					<tr>
    						<th>#</th>
    						<th>Module</th>
    						<th>Quater</th>
    						<th>Year</th>
    						<th>Region</th>
    						<th>SR</th>
    						<th>County</th>
    						<th>Defined(Q1)</th>
    						<th>Defined (Q2)</th>
    						<th>Defined(Target)</th>
    						<th>Defined(Sem)</th>
    						<th>Defined(Performance)</th>
    						<th>HTS(Q1)</th>
    						<th>HTS(Q2)</th>
    						<th>HTS(Target)</th>
    						<th>HTS(Sem)</th>
    						<th>HTS(Performance)</th>
    						<th>Prep(Q1)</th>
    						<th>Prep(Q2)</th>
    						<th>Prep(Target)</th>
    						<th>Prep(Total)</th>
    						<th>Prep(Performance)</th>
    					</tr>
    				</thead>
    				<tbody>
    					@foreach($tgdata as $target)
    					<tr>
			    		  <td>{{$target->id}}</td>
			              <td>{{$target->module}}</td>
			              <td>{{$target->quater}}</td>
			              <td>{{$target->year}}</td>
			              <td>{{$target->reqion}}</td>
			              <td>{{$target->sr}}</td>
			              <td>{{$target->county}}</td>
			              <td>{{$target->defined_q1}}</td>
			              <td>{{$target->defined_q2}}</td>
			              <td>{{$target->defined_target}}</td>
			              <td>{{$target->defined_sem}}</td>
			              <td>{{round($target->defined_performance,2)}}</td>
			              <td>{{$target->hts_q1}}</td>
			              <td>{{$target->hts_q2}}</td>
			              <td>{{$target->hts_target}}</td>
			              <td>{{$target->hts_sem}}</td>
			              <td>{{round($target->hts_performance,2)}}</td>
			              <td>{{$target->prep_q1}}</td>
			              <td>{{$target->prep_q2}}</td>
			              <td>{{$target->prep_target}}</td>
			              <td>{{$target->prep_total}}</td>
			              <td>{{round($target->prep_performance,2)}}</td>
    					</tr>
    					@endforeach
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8">
              <div class="card card-info">
            <div class="card-header"><b>Performance Visualizations by County</b></div>
            <div class="card-body">
              <div style="width: 100%;">
                <canvas id="myChartmsmCounty"></canvas>
            </div>
            </div>
          </div>
            </div>
              <div class="col-lg-4">
              <div class="card card-info">
            <div class="card-header"><b>Performance Visualizations by Region</b></div>
            <div class="card-body">
              <div style="width: 100%;">
                <canvas id="myChartmsm"></canvas>
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
            var data = @json($barTG);

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
            var ctx = document.getElementById('myChartmsm');
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
    <!-- group by county -->
       <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extracting data from PHP to JavaScript
            var data = @json($barTGCounty);

            // Processing data for Chart.js
            var chartData = {};
            data.forEach(function(item) {
                if (!chartData[item.county]) {
                    chartData[item.county] = {};
                }
                chartData[item.county][item.module] = item.avg_performance;
            });

            // Creating dataset for Chart.js
            var datasets = [];
            for (var county in chartData) {
                var moduleData = chartData[county];
                var dataset = {
                    label: county,
                    data: Object.values(moduleData),
                    backgroundColor: 'rgba(' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',0.6)',
                };
                datasets.push(dataset);
            }

            // Drawing chart with Chart.js
            var ctx = document.getElementById('myChartmsmCounty');
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