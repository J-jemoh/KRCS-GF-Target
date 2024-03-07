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
              <li class="breadcrumb-item active"><a href="#" class="text-white">{{$user->name}}</a></li>
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
    		<div class="card-header">You are updating user {{$user->name}}</div>
    		<div class="card-body">
    			<form></form>
    			<form method="post" action="{{route('admin.user.update',$user->id)}}">
    				@csrf
    				<div class="row">
    					<div class="col-6">
    						<div class="input-group mb-3">
					          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full name" name="name" required value="{{$user->name}}">
					          <div class="input-group-append">
					            <div class="input-group-text">
					              <span class="fas fa-user"></span>
					            </div>
					          </div>
					             @error('name')
					                                    <span class="invalid-feedback" role="alert">
					                                        <strong>{{ $message }}</strong>
					                                    </span>
					                                @enderror
					        </div>
    					</div>
    					<div class="col-6">
    						<div class="input-group mb-3">
					          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" required value="{{$user->email }}" autocomplete="email">
					          <div class="input-group-append">
					            <div class="input-group-text">
					              <span class="fas fa-envelope"></span>
					            </div>
					          </div>
					           @error('email')
					                                    <span class="invalid-feedback" role="alert">
					                                        <strong>{{ $message }}</strong>
					                                    </span>
					                                @enderror
					        </div>
    					</div>
    					<div class="col-6">   						
					          <div class="input-group mb-3">
					          	<select class="form-control" name="destination" required>
					          		<option>{{$user->destination}}</option>
					          		<option>M & E Manager</option>
					          		<option>NMO</option>
					          		<option>DMO</option>
					          		<option>RMEO</option>
					          	</select>
					          <div class="input-group-append">
					            <div class="input-group-text">
					              <span class="fas fa-user"></span>
					            </div>
					          </div>
					        </div>
    					</div>
    					<div class="col-6">
    					<div class="input-group mb-3">
				          <select name="region" class="form-control" required>
				          	<option>{{$user->region}}</option>
				          	@foreach($regions as $region)
				          	<option>{{$region->regionName}}</option>
				          	@endforeach
				          </select>
				          <div class="input-group-append">
				            <div class="input-group-text">
				              <span class="fas fa-user"></span>
				            </div>
				          </div>
				        </div>

    					</div>
    					<div class="col-12">
    					<div class="form-group">
                        <label for="roles">Assign Roles</label>
                        @foreach ($roles as $role)
                        <div class="checkbox">
                            <input name="roles[]" id="checkbox{{ $role->id }}" type="checkbox" value="{{ $role->id }}"
                                   {{$user->hasRole($role->name)?'checked="checked"':''}}>
                            <label for="checkbox{{ $role->id }}">
                                {{ ucfirst($role->name) }}
                            </label>
                        </div>
                        @endforeach
                    </div>

    					</div>
    					<div class="col-6">	
					        <div class="input-group mb-3">
					          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password"  autocomplete="new-password">
					          <div class="input-group-append">
					            <div class="input-group-text">
					              <span class="fas fa-lock"></span>
					            </div>
					          </div>
					          @error('password')
					                                    <span class="invalid-feedback" role="alert">
					                                        <strong>{{ $message }}</strong>
					                                    </span>
					                                @enderror
					        </div>
    					</div>

    					<div class="col-6">
    						<div class="input-group mb-3">
					          <input type="password" class="form-control" placeholder="Retype password" id="password-confirm" name="password_confirmation" autocomplete="new-password">
					          <div class="input-group-append">
					            <div class="input-group-text">
					              <span class="fas fa-lock"></span>
					            </div>
					          </div>
					        </div>

    					</div>
    					<div class="col-6">
    						   <div class="icheck-primary">
				              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
				              <label for="agreeTerms">
				               I agree to the <a href="#">terms</a>
				              </label>
				            </div>
    					</div>
    					<div class="col-6">
    						<button type="submit" class="btn btn-info float-sm-right">Register</button>
    					</div>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
</section>
@endsection
