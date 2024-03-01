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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
      <section class="content">
      <div class="container-fluid">
      	<div class="row">
     
      	 <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Targets</span>
                <span class="info-box-number">
                  0
                  <small>%</small>
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
                <span class="info-box-text">QPMM</span>
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">GBV</span>
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">HRG</span>
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>
         <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                    	@php
            						    use Carbon\Carbon;
            						    $startDate = Carbon::create(2024, 1, 1);
            						    $endDate = Carbon::create(2024, 2, 29); // Assuming it's a leap year

            						    // Format the dates
            						    $formattedStartDate = $startDate->format('M Y');
            						    $formattedEndDate = $endDate->format('M Y');
            						@endphp
                     <strong>Data: {{ $formattedStartDate }} - {{ $formattedEndDate }}</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>

                    <div class="progress-group">
                      Targets reached
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      GBV reported
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">QPMM </span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      HRG
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer bg-info">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 0</span>
                      <h5 class="description-header">0</h5>
                      <span class="description-text">HRG</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">0</h5>
                      <span class="description-text">QPMM</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 0%</span>
                      <h5 class="description-header">00</h5>
                      <span class="description-text">GBV</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 0</span>
                      <h5 class="description-header">0</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
       	</div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4">
              <div class="card card-danger">
            <div class="card-header"><b>Performance Visualizations for Defined Packaged</b></div>
            <div class="card-body">
              <div style="width: 100%;">
                <canvas id="myChart"></canvas>
            </div>
            </div>
          </div>
            </div>
            <div class="col-lg-4">
              <div class="card card-danger">
            <div class="card-header"><b>Perfomance Visualization for HTS</b></div>
            <div class="card-body">
              <div style="width: 100%;">
                <canvas id="myChart_hts"></canvas>
            </div>
            </div>
          </div>
            </div>
            <div class="col-lg-4">
              <div class="card card-danger">
            <div class="card-header"><b>Perfomance Visualization for Prep</b></div>
            <div class="card-body">
              <div style="width: 100%;">
                <canvas id="myChart_prep"></canvas>
            </div>
            </div>
          </div>
            </div>
          </div>
          
        </div>
  </section>
@endsection
<!-- for defined package -->
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
    <!-- for hts -->
  <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extracting data from PHP to JavaScript
            var data = @json($barDataHts);

            // Processing data for Chart.js
            var chartData = {};
            data.forEach(function(item) {
                if (!chartData[item.reqion]) {
                    chartData[item.reqion] = {};
                }
                chartData[item.reqion][item.module] = item.avg_performance_hts;
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
            var ctx = document.getElementById('myChart_hts');
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
      <!-- for prep -->
  <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extracting data from PHP to JavaScript
            var data = @json($barDataPrep);

            // Processing data for Chart.js
            var chartData = {};
            data.forEach(function(item) {
                if (!chartData[item.reqion]) {
                    chartData[item.reqion] = {};
                }
                chartData[item.reqion][item.module] = item.avg_performance_hts;
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
            var ctx = document.getElementById('myChart_prep');
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