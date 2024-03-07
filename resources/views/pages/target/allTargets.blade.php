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
              <li class="breadcrumb-item active text-white">All Targets</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
    	<div class="card">
    		<div class="card-header bg-info">All Targets
    			<a href="{{route('admin.target')}}" class="btn btn-info float-sm-right">Upload new Target</a>
    		</div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
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
              @foreach($targets as $target)
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
              <td>{{$target->defined_performance}}</td>
              <td>{{$target->hts_q1}}</td>
              <td>{{$target->hts_q2}}</td>
              <td>{{$target->hts_target}}</td>
              <td>{{$target->hts_sem}}</td>
              <td>{{$target->hts_performance}}</td>
              <td>{{$target->prep_q1}}</td>
              <td>{{$target->prep_q2}}</td>
              <td>{{$target->prep_target}}</td>
              <td>{{$target->prep_total}}</td>
              <td>{{$target->prep_performance}}</td>

              </tr>
              @endforeach
            </tbody>
    				
    			</table>
    		</div>
    	</div>
    </div>
    <div class="container-fluid">
          <div class="row">
              <div class="col-lg-5">
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

@endsection
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extracting data from PHP to JavaScript
            var data = @json($barALL);

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