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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Monthly Highlights</a></li>

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

        <div class="card-header"><b>My Monthly Highlights</b>
        	 <a href="{{route('monthly.create')}}" class="btn btn-danger float-sm-right"><i class="fa fa-plus"> </i> New Highlight</a> 
        </div>
        <div class="card-body">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Draft Highlights</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Submited Highlights</button>
                      </li>
                    
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <br>
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
                          <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Region</th>
                              <th>Month</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Date Created</th>
                              <th>Status</th>
                              <th>Created by</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($highlights as $highlight)
                           @if($highlight->status == 'draft')
                          <tr>
                            <td>{{$highlight->id}}</td>
                            <td>{{$highlight->region}}</td>
                            <td>{{$highlight->created_at->format('F Y')}}</td>
                            <td>{{$highlight->start_date}}</td>
                            <td>{{$highlight->end_date}}</td>
                            <td>{{$highlight->created_at}}</td>
                            @if($highlight->status=='draft')
                            <td><span class="badge badge-info">{{$highlight->status}}</span> </td>
                            @else
                            <td><span class="badge badge-success">{{$highlight->status}}</span> </td>
                            @endif

                            <td>{{$highlight->user->name ?? ''}}</td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                            @if($highlight->status === 'draft')
                                              @can('Edit')
                                              <a type="button" class="btn btn-info" href="{{route('monthly.edit',$highlight->id)}}"><i class="fa fa-edit"></i></a>
                                              @endcan
                                              @endif
                                              <a type="button" class="btn btn-warning" href="{{route('monthly.show',$highlight->id)}}"><i class="fa fa-eye"></i></a>
                                              @if($highlight->status === 'draft')
                                              @can('Delete')
                                              <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#highlight{{$highlight->id}}"><i class="fa fa-trash"></i></button>
                                              @endcan
                                              @endif
                                            </div>
                            </td>
                          </tr>
                          @endif
                           @include('highlights.deleteModal')
                          @endforeach
                           
                          </tbody>


                        </table>

                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                         <table id="example2" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Region</th>
                              <th>Month</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Date Created</th>
                              <th>Status</th>
                              <th>Created by</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($highlights as $highlight)
                           @if($highlight->status == 'submitted')
                          <tr>
                            <td>{{$highlight->id}}</td>
                            <td>{{$highlight->region}}</td>
                            <td>{{$highlight->created_at->format('F Y')}}</td>
                            <td>{{$highlight->start_date}}</td>
                            <td>{{$highlight->end_date}}</td>
                            <td>{{$highlight->created_at}}</td>
                            @if($highlight->status=='draft')
                            <td><span class="badge badge-info">{{$highlight->status}}</span> </td>
                            @else
                            <td><span class="badge badge-success">{{$highlight->status}}</span> </td>
                            @endif

                            <td>{{$highlight->user->name ?? ''}}</td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                            @if($highlight->status === 'draft')
                                              @can('Edit')
                                              <a type="button" class="btn btn-info" href="{{route('monthly.edit',$highlight->id)}}"><i class="fa fa-edit"></i></a>
                                              @endcan
                                              @endif
                                              <a type="button" class="btn btn-warning" href="{{route('monthly.show',$highlight->id)}}"><i class="fa fa-eye"></i></a>
                                              @if($highlight->status === 'draft')
                                              @can('Delete')
                                              <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                              @endcan
                                              @endif
                                            </div>
                            </td>
                          </tr>
                          @endif
                          @endforeach
                            
                          </tbo
                      </div>
                    </div>
        
        </div>
      </div>
    </div>
  </section>

  @endsection