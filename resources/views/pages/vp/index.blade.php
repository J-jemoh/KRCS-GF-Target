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
               <li class="breadcrumb-item active text-white">VP</li>
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
        <div class="card-header">Upload  file</div>
        <div class="card-body">
          <div class="row">
          	<div class="col-12">
          		<form></form>
          		<form method="post" action="{{route('admin.vp.dc.upload')}}" enctype="multipart/form-data">
          			@csrf
          		<label>DC Data upload(Use this to upload DC data)</label>
          		<div class="input-group mb-3">

						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" 
						  name="dcF" required>
						  <button class="btn btn-outline-info" type="submit">Upload</button>
						</div>
						</form>
          	</div>
          	<div class="col-6">
          		<form method="post" action="{{route('admin.vp.eban.demo.upload')}}" enctype="multipart/form-data">
          			@csrf
          		<label>EBAN Demographic Upload(For EBAN only)</label>
          		<div class="input-group mb-3">
						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" name="ebandF" required>
						  <button class="btn btn-outline-info" type="submit" id="button-addon2">Upload</button>
						</div>
					</form>
          	</div>
          	<div class="col-6">
          		<form method="post" action="{{route('admin.vp.eban.service.upload')}}" enctype="multipart/form-data">
          			@csrf
          		<label>EBAN Services  Upload(For EBAN only)</label>
          		<div class="input-group mb-3">
						  <input type="file" class="form-control" placeholder="upload file" aria-label="Recipient's username" aria-describedby="button-addon2" name="ebanSF" required>
						  <button class="btn btn-outline-info" type="submit" id="button-addon2">Upload</button>
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
    		<div class="card-header">DC templates & Reports</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-3">
    					<!-- small card -->
			            <div class="small-box bg-info">
			              <div class="inner">
			                Visualizations

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
    				<div class="col-3">
    					<!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                REGIONAL REPORTS
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
    				<div class="col-3">
    					<!-- small card -->
			            <div class="small-box bg-warning">
			              <div class="inner">
			                Download Data<

			                <p>VP consolidated</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="#" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-3">
    					<!-- small card -->
			            <div class="small-box bg-dark">
			              <div class="inner">
			                VP Template(DC only)

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.vp.dc.template')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    			</div>
 
    		</div>
    	</div>
    	<div class="card card-info">
    		   <div class="card-header bg-info">EBAN Templates</div>
    		   <div class="card-body">
    		   	<div class="row">
    		   		<div class="col-6">
    					<!-- small card -->
			            <div class="small-box bg-primary">
			              <div class="inner">
			                Demographic Template(EBAN only)

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.vp.eban.demo')}}" class="small-box-footer">
			                More info <i class="fas fa-arrow-circle-right"></i>
			              </a>
			            </div>
    				</div>
    				<div class="col-6">
    					<!-- small card -->
			            <div class="small-box bg-success">
			              <div class="inner">
			                Service Template(EBAN only)

			                <p>Reports</p>
			              </div>
			              <div class="icon">
			                <i class="fas fa-shopping-cart"></i>
			              </div>
			              <a href="{{route('admin.vp.eban.service')}}" class="small-box-footer">
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