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
              <li class="breadcrumb-item active"><a href="{{route('assets.index')}}" class="text-white">Assets</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">Edit</a></li>

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
  		<div class="card-header">Asset: {{$asset->serial_no}}</div>
        <div class="card-body">
        	<form></form>
        	<form method="post" action="{{route('assets.update',$asset->id)}}">
        		@csrf
        		<div class="row">
        			<div class="col-12">
        				<input type="text" class="form-control" name="user_id" value="{{auth()->user()->id}}" hidden>
        			</div>
				    <div class="col-4">
				    	<label>Asset Tag ID</label>
				      <input type="text" class="form-control" placeholder="Tag ID" name="tag_id" required value="{{$asset->asset_tag_id}}">
				    </div>
				    <div class="col-4">
				    	<label>Description</label>
				      <input type="text" class="form-control" placeholder="Description" name="description" required value="{{$asset->description}}">
				    </div>
				    <div class="col-4">
				    	<label>Serial Number</label>
				      <input type="text" class="form-control" placeholder="serial number" name="sno" required value="{{$asset->serial_no}}">
				    </div>
				  </div>
				  <br>
				  <div class="row">
				    <div class="col-4">
				    	<label>Purchase Date</label>
				      <input type="date" class="form-control" placeholder="Tag ID" name="purchase_date" required value="{{$asset->purchase_date}}">
				    </div>
				    <div class="col-4">
				    	<label>Cost</label>
				      <input type="text" class="form-control" placeholder="cost" name="cost" required value="{{$asset->cost}}">
				    </div>
				    <div class="col-4">
				    	<label>Purchased From</label>
				      <input type="text" class="form-control" placeholder="purchase_from" name="purchase_from" required value="{{$asset->purchased_from}}">
				    </div>
				  </div>
				  <br>
				  <div class="row">
				    <div class="col-3">
				    	<label>Brand</label>
				      <input type="text" class="form-control" placeholder="Brand" name="brand" required value="{{$asset->brand}}">
				    </div>
				    <div class="col-3">
				    	<label>Model</label>
				      <input type="text" class="form-control" placeholder="model" name="model" required value="{{$asset->model}}">
				    </div>
				    <div class="col-3">
				    <label>Category</label>
				      <select class="form-control" name="category" required>
				      	<option>{{$asset->category}}</option>
				      	<option>Computer Equipement</option>
				      	<option>Software</option>
				      	<option>Mobile Phones</option>
				      	
				      </select>
				    </div>
				     <div class="col-3">
				    <label>Status</label>
				      <select class="form-control" name="status" required>
				      	<option>{{$asset->status}}</option>
				      	<option>In store</option>
				      	<option>Issued</option>
				      	
				      </select>
				    </div>
				  </div>
				  <br>
				  <div class="row">
				  	<div></div>
				  	<div></div>
				  	 <div>
				  	 	<button class="btn btn-danger float-sm-right" type="Submit">Submit</button>
				  	 </div>
				  </div>
        		
        	</form>
          
        </div>
      </div>
    </div>
  </section>

  @endsection