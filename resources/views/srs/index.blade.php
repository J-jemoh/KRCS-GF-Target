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
              <li class="breadcrumb-item active"><a href="#" class="text-white">SRS</a></li>

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
        <div class="card-header"><b>ALL SRS</b>
          @can('Create SR')
        	 <a href="{{route('sr.create')}}" class="btn btn-danger float-sm-right"><i class="fa fa-plus"> </i> New SR</a> 
           @endcan
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Region</th>
                <th>SR Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            	@foreach($srs as $sr)
            	<tr>
            		<td>{{$sr->id}}</td>
            		<td>{{$sr->region}}</td>
            		<td>{{$sr->sr_name}}</td>
            		<td>
            			<div class="btn-group" role="group" aria-label="Basic example">
                                @can('Edit')
                                @role('Super Admin')
                                <a type="button" class="btn btn-info" href="#"><i class="fa fa-edit"></i></a>
                                @endrole
                                @endcan
            
                                <a type="button" class="btn btn-warning" href="#"><i class="fa fa-eye"></i></a>
                                @can('Delete')
                                @role('Super Admin')
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                @endrole
                                @endcan
                             
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