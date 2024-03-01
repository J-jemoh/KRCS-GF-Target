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
              <li class="breadcrumb-item active"><a href="{{route('admin.target.all')}}" class="text-white">Targets</a></li>
              <li class="breadcrumb-item active"><a href="{{route('admin.target.reports')}}" class="text-white">Reports</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<div class="card card-danger">
    		<div class="card-header">View All Reports based on Module</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>MSM</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.target.reports.msm')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>FSW</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.target.reports.fsw')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-warning">
			              <div class="inner">
			                <h3>PWID</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="#" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    			</div>
    			    			<div class="row">
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-secondary">
			              <div class="inner">
			                <h3>TG</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="#" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-danger">
			              <div class="inner">
			                <h3>TCS</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="#" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-light">
			              <div class="inner">
			                <h3>CONSOLIDATED</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="#" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</section>
@endsection