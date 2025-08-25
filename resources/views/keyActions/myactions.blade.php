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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pending Actions</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ongoing actions</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Closed/Resolved</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <br>
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('keyActions.pending')
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              @include('keyActions.ongoing')
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              @include('keyActions.closed')
            </div>
          </div>
       
        </div>
      </div>
    </div>
  </section>

  @endsection