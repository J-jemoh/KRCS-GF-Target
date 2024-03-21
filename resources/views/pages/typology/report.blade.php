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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Typology</a></li>
               <li class="breadcrumb-item active"><a href="{{route('admin.fsw.index')}}" class="text-white">FSW</a></li>
                <li class="breadcrumb-item active"><a href="#" class="text-white">CONSOLIDATED</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <a href="{{route('admin.fsw.consolidated')}}" class="btn btn-info btn-block">Download/Export to CSV</a>
        </div>
         <div class="col-4">
             <a href="{{route('fsw.download-demographics-excel')}}" class="btn btn-info btn-block">Download/Export to Excel</a>
         </div>
      </div>
      <br>
      <div class="row">
     
         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total No of SR'S</span>
                <span class="info-box-number">
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
                <span class="info-box-number">{{$counties}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bars"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No of Regions</span>
                <span class="info-box-number">{{$region}}</span>
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
                <span class="info-box-number">{{$enrolled}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>
      <br>
      <div class="card card-info">
        <div class="card-header">Visualizations by Age</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                          <th>Age Range</th>
                          <th>Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($results as $range => $count)
                      <tr>
                          <td>{{ $range }}</td>
                          <td>{{ $count }}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              </div>
              <div class="col-sm-6">
                <div style="width: 100%;">
                  <canvas id="agePieChart"></canvas>
              </div>
              </div>
            </div>
          </div>
        </div>
          <div class="card card-info">
        <div class="card-header">HIV status at enrollment</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                          <th>HIV Status at enrollment</th>
                          <th>Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($hivstatus as $status)
                      <tr>
                          <td>{{ $status->hiv_status_enrol }}</td>
                          <td>{{ $status->count }}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              </div>
              <div class="col-sm-6">
                <div style="width: 100%;">
                  <canvas id="hivStatusPieChart" height="500"></canvas>
              </div>
              </div>
            </div>
          </div>
        </div>
      <div class="card card-info">
        <div class="card-header">Indicators</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                          <th>Coverage Indicator</th>
                          <th>Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>#of sex workers reached with HIV prevention programs - defined package</td>
                          <td>{{ $definedPackage }}</td>
                      </tr>
                      <tr>
                          <td># of eligible sex workers who initiated oral antiretroviral PrEP during the reporting period</td>
                          <td>{{$prepInitiated }}</td>
                        </tr>
                      <tr>
                          <td># of sex workers that have received an HIV test during the reporting period and know their results</td>
                          <td>{{$hivTested }}</td>
                        </tr>
                  </tbody>
              </table>
              </div>
              <div class="col-sm-6">
                <div style="width: 100%;">
                  <canvas id="pieChart"></canvas>
              </div>
              </div>
            </div>
          </div>
        </div>
      <div class="card card-info">
        <div class="card-header">Other visualizations</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b>HIV tested frequency</b></p>
                <div style="width: 100%;">
                  <canvas id="hivFreqPieChart"></canvas>
              </div>
            </div>
              </div>
              <div class="col-lg-4">
                <div class="card card-body bg-light">
                <p><b>Reported Potential HIV Exposure within 72 hrs</b></p>
                <div style="width: 100%;">
                  <canvas id="hivExpPieChart"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Provided with PEP within 72 hours</b></p>
                <div style="width: 100%;">
                  <canvas id="hivPepPieChart"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-6">
                 <div class="card card-body bg-light">
                <p><b>HIV Care Outcome</b></p>
                <div style="width: 100%;">
                  <canvas id="hivCareBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-6">
                 <div class="card card-body bg-light">
                <p><b>ART Outcome</b></p>
                <div style="width: 100%;">
                  <canvas id="ArtBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Due for Viral Load</b></p>
                <div style="width: 100%;">
                  <canvas id="dueBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
               <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Viral Load Done</b></p>
                <div style="width: 100%;">
                  <canvas id="VlDoneBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
              <div class="col-lg-4">
                 <div class="card card-body bg-light">
                <p><b>Received Viral Load Result</b></p>
                <div style="width: 100%;">
                  <canvas id="VlRBarChart" height="500"></canvas>
              </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
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
                type: 'pie',
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
            type: 'pie',
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
            type: 'pie',
            data: data,
            options: options
        });
        });
    </script>
    <!-- HIV EXPOSURE WITHIN 72HR -->
     <<script>
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
            type: 'pie',
            data: data,
            options: options
        });
    });
</script>
<!-- PEP WITHIN 72HR -->
     <<script>
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
            type: 'pie',
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



