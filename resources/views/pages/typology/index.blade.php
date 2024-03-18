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
               <li class="breadcrumb-item active text-white">FSW</li>
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
        <div class="card-header">Upload FSW file</div>
        <div class="card-body">
          <div class="row">
          	<div class="col-6">
          		<form></form>
          		<form method="post" action="{{route('admin.fsw.demo.post')}}" enctype="multipart/form-data">
          			@csrf
          		<label>Demographics data</label>
          		<div class="input-group mb-3">

						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" 
						  name="demoF" required>
						  <button class="btn btn-outline-info" type="submit">Upload</button>
						</div>
						</form>
          	</div>
          	<div class="col-6">
          		<label>FSW data</label>
          		<div class="input-group mb-3">
						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" name="fswF" required>
						  <button class="btn btn-outline-info" type="submit" id="button-addon2">Upload</button>
						</div>
          	</div>
          </div>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
        <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header">View All Reports</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                <h3>CONSOLIATED REPORT</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.fsw.report')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>REGIONAL REPORTS</h3>
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