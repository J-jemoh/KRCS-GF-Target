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
      <div class="card">
        <div class="card-header"><b>All Departmental Updates</b>
          <a href="{{route('department.create')}}" class="btn btn-info float-sm-right"><i class="fa fa-plus"></i> New Report</a>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active bg-danger" id="home-tab" data-bs-toggle="tab" data-bs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="true">Draft Reports</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link bg-secondary" id="profile-tab" data-bs-toggle="tab" data-bs-target="#submitted" type="button" role="tab" aria-controls="submitted" aria-selected="false">Submitted Reports</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                  <br>
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>Week</th>
                            <th>Month</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Date submitted</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $weekly)
                        @if($weekly->status === 'draft')
                        <tr>
                          <td>{{$weekly->id}}</td>
                          <td>{{$weekly->department}}</td>
                          <td>{{$weekly->week}}</td>
                          <td>{{ \Carbon\Carbon::parse($weekly->start_date)->format('F Y') }}</td>
                          <td>{{$weekly->start_date}}</td>
                          <td>{{$weekly->end_date}}</td>
                          <th>{{ \Carbon\Carbon::parse($weekly->created_at)->format('j F Y') }}</th>
                          <td>
                             <div class="btn-group" role="group" aria-label="Basic example">
                              @if($weekly->status === 'draft')
                                @can('Edit')
                                <a type="button" class="btn btn-info" href="{{route('department.edit',$weekly->id)}}"><i class="fa fa-edit"></i></a>
                                @endcan
                                @endif
                                <a type="button" class="btn btn-warning" href="{{route('department.show',$weekly->id)}}"><i class="fa fa-eye"></i></a>
                                @if($weekly->status === 'draft')
                                @can('Delete')
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                @endcan
                                @endif
                              </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                          
                        </tbody>
                      </table>

                </div>
                <div class="tab-pane fade" id="submitted" role="tabpanel" aria-labelledby="submitted-tab">
                  <br>
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>Week</th>
                            <th>Month</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Date submitted</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $weekly)
                        @if($weekly->status === 'submitted')
                        <tr>
                          <td>{{$weekly->id}}</td>
                          <td>{{$weekly->department}}</td>
                          <td>{{$weekly->week}}</td>
                          <td>{{ \Carbon\Carbon::parse($weekly->start_date)->format('F Y') }}</td>
                          <td>{{$weekly->start_date}}</td>
                          <td>{{$weekly->end_date}}</td>
                          <th>{{ \Carbon\Carbon::parse($weekly->created_at)->format('j F Y') }}</th>
                          <td>
                             <div class="btn-group" role="group" aria-label="Basic example">
                              @if($weekly->status === 'draft')
                                @can('Edit')
                                <a type="button" class="btn btn-info" href="{{route('department.edit',$weekly->id)}}"><i class="fa fa-edit"></i></a>
                                @endcan
                                @endif
                                <a type="button" class="btn btn-warning" href="{{route('department.show',$weekly->id)}}"><i class="fa fa-eye"></i></a>
                                @if($weekly->status === 'draft')
                                @can('Delete')
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                @endcan
                                @endif
                              </div>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                          
                        </tbody>
                      </table>
                </div>

              </div>
       
        </div>
      </div>
    </div>
  </section>

  @endsection