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
               <li class="breadcrumb-item active text-white">AYP</li>
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
        <div class="card-header">Upload AYP Data</div>
        <div class="card-body">
          <div class="row">
          	<div class="col-4">
          		<form></form>
          		<form method="post" action="#" enctype="multipart/form-data">
          			@csrf
          		<label>HCBF Data</label>
          		<div class="input-group mb-3">

						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" 
						  name="hcbfF" required>
						  <button class="btn btn-outline-info btn-info text-white" type="submit">Upload</button>
						</div>
						</form>
          	</div>
          	<div class="col-4">
          		<form method="post" action="#" enctype="multipart/form-data">
          			@csrf
          		<label>MHMC Data</label>
          		<div class="input-group mb-3">
						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" name="mhmcF" required>
						  <button class="btn btn-outline-info btn-info text-white" type="submit" id="button-addon2">Upload</button>
						</div>
					</form>
          	</div>
          	<div class="col-4">
          		<form method="post" action="{{route('admin.ayp.post.demo')}}" enctype="multipart/form-data">
          			@csrf
          		<label>AYP  Integrated Tracker data</label>
          		<div class="input-group mb-3">
						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" name="aypF" required>
						  <button class="btn btn-outline-info btn-info text-white" type="submit" id="button-addon2">Upload</button>
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
			                <h3>Visualizations</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.ayp.reports')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                <h3>HCBF</h3>
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
			                <h3>MHMC</h3>

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
    				<div class="col-6">
    					<!-- small card -->
			            <div class="small-box bg-primary">
			              <div class="inner">
			                <h3>Intergrated</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.ayp.template')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-6">
    					<!-- small card -->
			            <div class="small-box bg-dark">
			              <div class="inner">
			                <h3>Consolidated</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.fsw.template.fsw')}}" class="small-box-footer">
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