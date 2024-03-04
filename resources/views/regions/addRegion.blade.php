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
              <li class="breadcrumb-item active"><a href="{{route('admin.target.all')}}" class="text-white">Regions</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
    <div class="container-fluid">
    	<div class="card card-danger">
    		<div class="card-header">Add Region</div>
    		<div class="card-body">
    			<form></form>
    			<form method="POST" action="{{route('admin.regions.save')}}">
    				@csrf
    				<div class="row">
					  <div class="col">
					  	<label>Region Code</label>
					    <input type="text" class="form-control" placeholder="region code" aria-label="region code" name="region_code" required value="{{$regionNumber}}">
					  </div>
					  <div class="col">
					  	<label>Region Name</label>
					    <input type="text" class="form-control" placeholder="Region Name" aria-label="Region name" name="regionName" required>
					  </div>
					</div>
					<br>
					<div class="row">
						<div class="col">
							<button class="btn btn-info float-sm-right" type="submit">Save Region</button>
						</div>
					</div>
    			</form>
    		</div>
    	</div>
    </div>
</section>

  @endsection