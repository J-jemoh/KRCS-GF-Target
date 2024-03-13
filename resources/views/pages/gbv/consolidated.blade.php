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
              <li class="breadcrumb-item active"><a href="#" class="text-white">CONSOLIDATED REPORT</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header">CONSOLIDATED GBV REPORTS</div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>SNo</th>
    						<th>Year</th>
    						<th>Quater</th>
                <th>Region</th>
                <th>SR Name</th>
                <th>County</th>
    						<th>Sub County</th>
    						<th>Ward</th>
    						<th>Village</th>
    						<th>Reporting Month</th>
    						<th>Attached Paralegal</th>
    						<th>Beneficiary Name</th>
    						<th>D.O.B</th>
    						<th>Age</th>
    						<th>Sex</th>
    						<th>Typology</th>
    						<th>Disability</th>
                <th>Disability Type</th>
    						<th>Phone</th>
    						<th>Confidant No</th>
    						<th>Abuse/Violation</th>
    						<th>Perpetrator</th>
    						<th>Attend Legal Aid Clinic</th>
    						<th>Litigation</th>
    						<th>Legal Counsel Offered</th>
    						<th>Referral</th>
    						<th>Case Status</th>
    						<th>Comment</th>
    					</tr>
    				</thead>
            <tbody>
              @foreach($gbvdata as $gbv)
              <tr>
                <td>{{$gbv->id}}</td>
                <td>{{$gbv->year}}</td>
                <td>{{$gbv->quater}}</td>
                <td>{{$gbv->region}}</td>
                <td>{{$gbv->sr_name}}</td>
                <td>{{$gbv->county}}</td>
                <td>{{$gbv->subcounty}}</td>
                <td>{{$gbv->ward}}</td>
                <td>{{$gbv->village}}</td>
                <td>{{$gbv->report_month}}</td>
                <td>{{$gbv->paralegal}}</td>
                <td>{{$gbv->bname}}</td>
                <td>{{$gbv->dob}}</td>
                <td>{{$gbv->age}}</td>
                <td>{{$gbv->sex}}</td>
                <td>{{$gbv->typology}}</td>
                <td>{{$gbv->disability}}</td>
                <td>{{$gbv->disability_type}}</td>
                <td>{{$gbv->phone}}</td>
                <td>{{$gbv->confidant_no}}</td>
                <td>{{$gbv->abuse}}</td>
                <td>{{$gbv->perpetrator}}</td>
                <td>{{$gbv->legal_clinic}}</td>
                <td>{{$gbv->litigation}}</td>
                <td>{{$gbv->legal_counsel}}</td>
                <td>{{$gbv->referral}}</td>
                <td>{{$gbv->care_status}}</td>
                <td>{{$gbv->comment}}</td>
              </tr>
              @endforeach
            </tbody>
    			</table>
    		</div>
    	</div>
    </div>
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
