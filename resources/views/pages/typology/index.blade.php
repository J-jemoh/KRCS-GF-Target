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
        <div class="card-header">Upload  file for [FSW,MSM,TG,PWID,FF,TRUCKERS]</div>
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
          		<form method="post" action="{{route('admin.fsw.fsw.post')}}" enctype="multipart/form-data">
          			@csrf
          		<label>Typology data</label>
          		<div class="input-group mb-3">
						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" name="fswF" required>
						  <button class="btn btn-outline-info" type="submit" id="button-addon2">Upload</button>
						</div>
					</form>
          	</div>
          </div>
        </div>
        <div class="card-footer">
        </div>
      </div>
        <div class="card card-info">
        <div class="card-header">Upload  file for [PMTCT]</div>
        <div class="card-body">
          <div class="row">
          	<div class="col-12">
          		<form></form>
          		<form method="post" action="{{route('admin.pmtct.post')}}" enctype="multipart/form-data">
          			@csrf
          		<label>PMCT Integrated data</label>
          		<div class="input-group mb-3">

						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" 
						  name="pmctF" required>
						  <button class="btn btn-outline-info" type="submit">Upload</button>
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
			              <a href="{{route('admin.region.index')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-warning">
			              <div class="inner">
			                <h3>Download Data</h3>

			                <p>FSW Consolidated</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.fsw.consolidated')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-primary">
			              <div class="inner">
			                <h3>Demographic Template</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.fsw.template.demo')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-dark">
			              <div class="inner">
			                <h3>Typology Template</h3>

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
    				<div class="col-4">
    					<!-- small card -->
			            <div class="small-box bg-danger">
			              <div class="inner">
			                <h3>PMTCT Template</h3>

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.pmtct.index')}}" class="small-box-footer">
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