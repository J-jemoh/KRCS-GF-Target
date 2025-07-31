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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Management Actions</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">Summary</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
  	<div class="container-fluid">
  		@include('messages.flash_messages')
  		<div class="card">
  			<div class="card-header">Add an SR</div>
  			<div class="card-body">
  				<form method="post" action="{{route('sr.import')}}" enctype="multipart/form-data">
  					@csrf

  					<div class="row">
  						<div class="col-9">
  							<input type="file" name="upload_sr" class="form-control">
  						</div>
  						<div class="col-3">
  							<button class="btn btn-info" type="submit"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
  						</div>
  					</div>

  					
  				</form>
  				<hr style="border: solid 2px;color: black;">
  				<form method="post" action="#">
  					@csrf
  					<div class="row">
  						<div class="col-6">
		  					<div class="mb-3">
							  <label for="exampleFormControlInput1" class="form-label">Region</label>
							  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="region">
							</div>
					</div>
					<div class="col-6">
		  					<div class="mb-3">
							  <label for="exampleFormControlInput1" class="form-label">SR Name</label>
							  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="sr_name">
							</div>
					</div>
					<div class="row">
						<div class="col-3">

  							<button class="btn btn-info" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
  						</div>
  					</div>

					</div>
  					
  				</form>
  			</div>
  		</div>
  	</div>
  </section>
  @endsection