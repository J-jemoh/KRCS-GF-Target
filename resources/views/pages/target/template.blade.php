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
                <li class="breadcrumb-item active text-white">TEMPLATE</li>
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
                  0
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
                <span class="info-box-number">0</span>
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
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>
    	<div class="card card-info">
    		<div class="card-header"><b>Template</b></div>
    		<div class="card-body">
    			<table id="example1" class="table table-bordered table-striped">
    				<thead>

    					<tr>
    						<th>SNo</th>
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
    					
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>

</section>
 @endsection
   