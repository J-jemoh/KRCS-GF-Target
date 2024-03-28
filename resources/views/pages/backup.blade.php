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
              <li class="breadcrumb-item active text-white">Backups
              </li>
               <li class="breadcrumb-item active text-white">Database Backups</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
    <div class="container-fluid">
    	@include('messages.flash_messages')
    	<div class="card card-info">
    		<div class="card-header">All Database back ups 
    			<form></form>
    			<form method="post" action="{{route('admin.db.backup.post')}}">
    				@csrf
    			<button class="btn btn-danger float-sm-right" type="submit">Backup Data</button>
    		</form>
    		</div>
    		<div class="card-body">

    			
    		</div>
    	</div>
    </div>


    @endsection