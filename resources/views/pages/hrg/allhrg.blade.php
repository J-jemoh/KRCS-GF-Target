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
              <li class="breadcrumb-item active"><a href="{{route('admin.hrg.index')}}" class="text-white">HRG</a></li>
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
    		<div class="card-header">CONSOLIDATED HRG REPORTS</div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>SNo</th>
    						<th>Year</th>
    						<th>Quater</th>
                			<th>Region</th>
                			<th>Indicator</th>
    						<th>KVP M(<10)</th>
    						<th>KVP F(<10)</th>
    						<th>AYP M(<10)</th>
    						<th>AYP F(<10)</th>
    						<th>TCS M(<10)</th>
    						<th>TCS F(<10)</th>
    						<th>PMTCT M(<10)</th>
    						<th>PMTCT F(<10)</th>
    						<th>KVP M(<14)</th>
    						<th>KVP F(<14)</th>
    						<th>AYP M(<14)</th>
    						<th>AYP F(<14)</th>
    						<th>TCS M(<14)</th>
    						<th>TCS F(<14)</th>
    						<th>PMTCT M(<14)</th>
    						<th>PMTCT F(<14)</th>
    						<th>KVP M(<19)</th>
    						<th>KVP F(<19)</th>
    						<th>AYP M(<19)</th>
    						<th>AYP F(<19)</th>
    						<th>TCS M(<19)</th>
    						<th>TCS F(<19)</th>
    						<th>PMTCT M(<19)</th>
    						<th>PMTCT F(<10)</th>
    						<th>KVP M(<24)</th>
    						<th>KVP F(<24)</th>
    						<th>AYP M(<24)</th>
    						<th>AYP F(<24)</th>
    						<th>TCS M(<24)</th>
    						<th>TCS F(<24)</th>
    						<th>PMTCT M(<24)</th>
    						<th>PMTCT F(<24)</th>
    						<th>KVP M(>24)</th>
    						<th>KVP F(>24)</th>
    						<th>AYP M(>24)</th>
    						<th>AYP F(>24)</th>
    						<th>TCS M(>24)</th>
    						<th>TCS F(>24)</th>
    						<th>PMTCT M(>24)</th>
    						<th>PMTCT F(>24)</th>
    						<th>Total M</th>
    						<th>Total F</th>
    						<th>Cumulative Total</th>
    					</tr>
    				</thead>
            <tbody>
              
    			</table>
    		</div>
    	</div>
    </div>
<!--     <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
        <div class="card card-info">
        <div class="card-header"><b>Performance Target Visualization</b></div>
        <div class="card-body">
           <div style="width: 100%;">
                <canvas id="myChart_pt"></canvas>
            </div>
        </div>
      </div>
        </div>
        <div class="col-lg-6">
        <div class="card card-info">
        <div class="card-header"><b>Performance Achievements Visualization</b></div>
        <div class="card-body">
           <div style="width: 100%;">
                <canvas id="myChart_pa"></canvas>
            </div>
        </div>
      </div>
        </div>
        <div class="col-lg-12">
        <div class="card card-info">
        <div class="card-header"><b>Performance Achievements vs Performance Targets Visualization</b></div>
        <div class="card-body">
           <div style="width: 100%;">
                <canvas id="myChart_pcombined" height="90"></canvas>
            </div>
        </div>
      </div>
        </div>
    </div>
    </div> -->
</section>
@endsection
