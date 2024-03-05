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
              <li class="breadcrumb-item active"><a href="{{route('admin.gc7')}}" class="text-white">User Management</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
  <section class="content">
  	@include('messages.flash_messages')
    <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header"><b>All Users</b>
    			<a href="{{route('admin.users.new')}}" class="btn btn-danger float-sm-right">Add  New User</a>
    		</div>
    		<div class="card-body">
    			 <table id="example1" class="table table-bordered table-striped">
    			 	<thead>
    			 		<tr>
    			 			<th>#</th>
    			 			<th>Name</th>
    			 			<th>Email</th>
    			 			<th>Designation</th>
    			 			<th>Region</th>
    			 			<th>Action</th>
    			 		</tr>
    			 	</thead>
    			 	<tbody>
    			 		@foreach($users as $user)
    			 		<tr>
    			 			<td>{{$user->id}}</td>
    			 			<td>{{$user->name}}</td>
    			 			<td>{{$user->email}}</td>
    			 			<td>{{$user->destination}}</td>
    			 			<td>{{$user->region}}</td>
    			 			<td>
    			 				<div class="btn-group" role="group" aria-label="Basic example">
				                    <button type="button" class="btn btn-info"><i class="fa fa-edit"></i></button>
				                    <button type="button" class="btn btn-warning"><i class="fa fa-eye"></i></button>
				                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
				                  </div>
    			 			</td>
    			 		</tr>
    			 		@endforeach
    			 	</tbody>
    			 </table>
    		</div>
    	</div>
    </div>
</section>
@endsection