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
      		  <div class="row">
      			<div class="col-lg-4">
      				<p><b>HIV Status</b></p>
      				<div class="card card-body bg-light">
      				  <canvas id="hivStatusChart" width="400" height="400"></canvas>
      				</div>
      			</div>
      			<div class="col-lg-4">
      				<p><b>Currently on ART</b></p>
      				<div class="card card-body bg-light">
      				  <canvas id="hivChart" width="400" height="400"></canvas>
      				</div>
      			</div>
      			<div class="col-lg-4">
      				<p><b>HIV Care Outcome</b></p>
      				<div class="card card-body bg-light">
      				  <canvas id="htsChart" width="400" height="400"></canvas>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
    </div>

  </section>
  @include('scripts.regions')
@endsection
