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
              <li class="breadcrumb-item active text-white">TYPOLOGY</li>
               <li class="breadcrumb-item active text-white"><a href="{{route('admin.tcs.index')}}" class="text-white">TCS</a></li>
               <li class="breadcrumb-item active text-white">Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
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
                <span class="info-box-number">{{$regions}}</span>
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
    	<div class="card card-info">
    		<div class="card-header">TCS Table visualizations</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-4">
    					<b>Disegregation based on Age</b>
    					<br>
    					<table class="table table-bordered table-striped table-condensed">
    						<thead>
    							<tr>
    								<th>Age Group</th>
    								<th>Count</th>
    							</tr>
    							<tbody>
    								@foreach($results as $range => $count)
    								 <tr>
			                          <td>{{ $range }}</td>
			                          <td>{{ $count }}</td>
			                      </tr>
    								@endforeach
    							</tbody>
    						</thead>
    					</table>
    				</div>
    				<div class="col-4">
    					<b>Disegregation based on Gender</b>
    					<br>
    					<table class="table table-bordered table-striped table-condensed">
    						<thead>
    							<tr>
    								<th>Gender</th>
    								<th>Count</th>
    							</tr>
    							<tbody>
    								@foreach($Gender as $sex)
    								<tr>
    									<td>{{$sex->sex}}</td>
    									<td>{{$sex->count}}</td>
    								</tr>
    								@endforeach
    							</tbody>
    						</thead>
    					</table>
    				</div>
    				<div class="col-4">
    					<b>Disegregation based on Region</b>
    					<br>
    					<table class="table table-bordered table-striped table-condensed">
    						<thead>
    							<tr>
    								<th>Gender</th>
    								<th>Count</th>
    							</tr>
    							<tbody>
    								@foreach($region as $reg)
    								<tr>
    									<td>{{$reg->region}}</td>
    									<td>{{$reg->count}}</td>
    								</tr>
    								@endforeach
    							</tbody>
    						</thead>
    					</table>
    				</div>
    			</div>

    		</div>
    	</div>
    	<div class="card card-info">
    		<div class="card-header">TCS CHART visualizations</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-4">
    					<div class="card card-body bg-light">
		                <p><b>Age Distribution</b></p>
		                <div style="width: 100%;">
		                  <canvas id="agePieChart"></canvas>
		              </div>
		            </div>
    				</div>
    				<div class="col-4">
    					<div class="card card-body bg-light">
		                <p><b> Distribution by Gender</b></p>
		                <div style="width: 100%;">
		                  <canvas id="genderPieChart"></canvas>
		              </div>
		            </div>
    				</div>
    				<div class="col-4">
    					<div class="card card-body bg-light">
		                <p><b> Distribution by Region</b></p>
		                <div style="width: 100%;">
		                  <canvas id="regionPieChart"></canvas>
		              </div>
		            </div>
    				</div>
    				<div class="col-6">
    					<div class="card card-body bg-light">
		                <p><b>Tracing outcome(Overall)</b></p>
		                <div style="width: 100%;height: 250px;">
		                  <canvas id="tracingChart"></canvas>
		              </div>
		            </div>
    				</div>
    				<div class="col-12">
    					<div class="card card-body bg-light">
		                <p><b> Distribution by County</b></p>
		                <div style="width: 100%; height: 400px;">
		                  <canvas id="countyPieChart"></canvas>
		              </div>
		            </div>
    				</div>
    			</div>

    		</div>
    	</div>
    </div>
</section>
@include('scripts.tcs')
 @endsection