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
               <li class="breadcrumb-item active text-white">TCS</li>
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
        <div class="card-header">Upload TCS Data</div>
        <div class="card-body">
          <div class="row">
          	<div class="col-12">
          		<form></form>
          		<form method="post" action="{{route('admin.tcs.data.upload')}}" enctype="multipart/form-data">
          			@csrf
          		<label>TCS data upload</label>
          		<div class="input-group mb-3">

						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" 
						  name="tcsF" required>
						  <button class="btn btn-outline-info btn-info text-white " type="submit">Upload</button>
						</div>
						</form>
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
			                Visualizations

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.tcs.data.visualize')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                All
			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.tcs.reports')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-primary">
			              <div class="inner">
			                TCS
			                <p>Template</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.tcs.template')}}" class="small-box-footer">
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