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
              <li class="breadcrumb-item active text-white" >Targets</li>
              <li class="breadcrumb-item active text-white">QPMM</li>
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
        <div class="card-header">Upload QPMM file</div>
        <form></form>
        <form method="POST" action="{{route('admin.qpmm.upload')}}" enctype="multipart/form-data">
          @csrf
        <div class="card-body">
          <div class="row">
            <label>Upload your quater QPMM</label>
            <input type="file" name="qpmmF" class="form-control" required>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-danger" class="form-control" type="submit">Upload File</button>
        </div>
      </form>
      </div>
    </div>
  </section>
@endsection