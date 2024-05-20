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
              <li class="breadcrumb-item active"><a href="{{route('admin.users')}}" class="text-white">User Management</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">User Profle</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
<section class="content">
    <div class="container-fluid">
    	<div class="card card-info">
    		<div class="card-header">{{auth()->user()->name}} Profile</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-md-3">
    					  <img class="profile-user-img img-responsive img-circle" src="{{asset('admin/logo/profile.png')}}" alt="User profile picture">

			              <h3 class="profile-username text-center"><b>{{auth()->user()->name}}</b></h3>

			              <p class="text-muted text-center"><b>{{auth()->user()->destination}}</b></p>

			              <ul class="list-group list-group-unbordered">
			                <li class="list-group-item">
			                  <b>Email</b> <a class="pull-right">{{auth()->user()->email}}</a>
			                </li>
			                <li class="list-group-item">
			                  <b>Region</b> <a class="pull-right">{{auth()->user()->region}}</a>
			                </li>
			                <li class="list-group-item">
			                  <b>Created on</b> <a class="pull-right">{{auth()->user()->created_at}}</a>
			                </li>
			                <li class="list-group-item">
			                  <b>Secret Key</b> <a class="pull-right"><b>{{$code}}</b></a>
			                </li>
			              </ul>

    				</div>
    				<div class="col-md-9">
    					<div class="nav-tabs-custom">
    						<ul class="nav nav-tabs">
				        
				              <li><a href="#settings" data-toggle="tab">More Information</a></li>
				            </ul>
				              <div class="tab-content">
				              	<div class="active tab-pane" id="settings">

				              		<form class="form-horizontal" method="post" action="#">
					                  <div class="form-group">
					                    <label for="inputName" class="col-sm-2 control-label">Name</label>

					                    <div class="col-sm-10">
					                      <input type="email" class="form-control" id="inputName" placeholder="Name" required value="{{auth()->user()->name}}" readonly>
					                    </div>
					                  </div>
					                  <div class="form-group">
					                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

					                    <div class="col-sm-10">
					                      <input type="email" class="form-control" id="inputEmail" placeholder="Email" required value="{{auth()->user()->email}}" readonly>
					                    </div>
					                  </div>
					                  <div class="form-group">
					                    <label for="inputName" class="col-sm-2 control-label">Region</label>

					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" id="inputName" placeholder="Name" required value="{{auth()->user()->region}}" readonly>
					                    </div>
					                  </div>
					                  <div class="form-group">
					                    <label for="inputExperience" class="col-sm-2 control-label">Role</label>

					                    <div class="col-sm-10">
					                      <input class="form-control" id="inputExperience" placeholder="Experience" required value="{{auth()->user()->destination}}" readonly>
					                    </div>
					                  </div>
					                  <div class="form-group">
					                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

					                    <div class="col-sm-10">
					                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
					                    </div>
					                  </div>
			
					                  <div class="form-group">
					                    <div class="col-sm-offset-2 col-sm-10">
					                      <button type="submit" class="btn btn-danger">Submit</button>
					                    </div>
					                  </div>
					                </form>
				              	</div>
				              </div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</section>
@endsection