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
        <div class="card-header"><b>My  Key Management Actions</b>
          @can('Create Action')
        	 <a href="{{route('keyActions.create')}}" class="btn btn-danger float-sm-right"><i class="fa fa-plus"> </i> New Key action</a> 
           @endcan
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Region</th>
                <th>Department</th>
                <th>SR Name</th>
                <th>Key Issues</th>
                <th>Root Cause</th>
                <th>Timeline</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($keyActions as $action)
            <tr>
            	<td>{{$action->id}}</td>
            	<td>{{$action->region}}</td>
            	<td>{{$action->category}}</td>
              <td>{{$action->sr_name}}</td>
            	<td>{!! Str::limit($action->key_issues, 50)!!}</td>
            	<td>{!! Str::limit($action->root_cause, 50)!!}</td>
            	<td>{{$action->date}}</td>
            	<td>{{$action->status_update}}</td>
            	<td>
            		<div class="btn-group" role="group" aria-label="Basic example">
                              @if($action->status === 'draft')
                                @can('Edit')
                                <a type="button" class="btn btn-info" href="{{route('keyActions.edit',$action->id)}}"><i class="fa fa-edit"></i></a>
                                @endcan
                                @endif
                                <a type="button" class="btn btn-warning" href="{{route('keyActions.show', $action->id)}}"><i class="fa fa-eye"></i></a>
                                @if($action->status === 'draft')
                                @can('Delete')
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                @endcan
                                @endif
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