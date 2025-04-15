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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Weekly Updates</a></li>

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
        <div class="card-header">All Departmental Updates
          <a href="{{route('department.create')}}" class="btn btn-info float-sm-right">Add new weekly report</a>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Department</th>
                <th>Week</th>
                <th>Month</th>
                <th>Region</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($reports as $weekly)
            <tr>
              <td>{{$weekly->id}}</td>
              <td>{{$weekly->department}}</td>
              <td>{{$weekly->week}}</td>
              <td>{{ \Carbon\Carbon::parse($weekly->start_date)->format('F Y') }}</td>
              <td>{{$weekly->region}}</td>
              <td>{{$weekly->start_date}}</td>
              <td>{{$weekly->end_date}}</td>
              <td>
                 <div class="btn-group" role="group" aria-label="Basic example">
                    <a type="button" class="btn btn-info" href="{{route('department.edit',$weekly->id)}}"><i class="fa fa-edit"></i></a>
                    <a type="button" class="btn btn-warning" href="{{route('department.show',$weekly->id)}}"><i class="fa fa-eye"></i></a>
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