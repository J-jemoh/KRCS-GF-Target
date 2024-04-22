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
              <li class="breadcrumb-item active text-white">User Profile</li>
               <li class="breadcrumb-item active text-white">Change Paasword</li>
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
    		<div class="card-header"><b>Change Password</b></div>
    		<div class="card-body">
    			<form></form>
    			<form method="POST" action="{{route('admin.user.password.change')}}">
    				@csrf
    			<div class="row">
    				<div class="col">
    					<label for="current_password">Current Password</label>
   						 <input type="password" name="current_password" required class="form-control">
    				</div>
    				<div class="col">
    					<label for="current_password">New Password</label>
   						 <input type="password" name="password" required class="form-control">
    				</div>
    				<div class="col">
    					<label for="current_password">Confirm New Password</label>
   						 <input type="password" name="password_confirmation" required class="form-control">
    				</div>
    				<div class="col-12">
    					<button type="submit" class="btn btn-primary float-sm-right">Change Passwprd</button>
    				</div>
    			</div>
    			</form>
    		</div>
    	</div>
    </div>
</section>
  @endsection