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
              <li class="breadcrumb-item active"><a href="#" class="text-white">GC7 Coverae</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	@include('messages.flash_messages')
    	<div class="card card-danger">
    		<div class="card-header">View All Reports based on Module</div>
    		<div class="card-body">
    			<div class="row">

    					<div class="col-4">
    						<form></form>
    				<form method="post" action="{{route('admin.coverage.post')}}" enctype="multipart/form-data">
    					@csrf
    						<label>GC7 Coverage</label>
    					<div class="input-group mb-3">
						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" name="gc7_coverage" required>
						  <button class="btn btn-outline-info" type="submit" id="button-addon2">Upload</button>
						</div>
						</form>
    				</div>
    				<div class="col-4">
    				<form method="post" action="#">
    					@csrf
    						<label>PF targets</label>
    					<div class="input-group mb-3">
						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" name="pf_targets" required>
						  <button class="btn btn-outline-info" type="submit" id="button-addon2">Upload</button>
						</div>
						</form>
    				</div>
    				
    			</div>
    			<br>
    			<div class="row">
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>GC7 Program Coverage</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.coverage')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>PF Targets</h3>
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
			            <div class="small-box bg-warning">
			              <div class="inner">
			                <h3>Others</h3>

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