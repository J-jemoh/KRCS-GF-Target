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
              <li class="breadcrumb-item active"><a href="{{route('assets.index')}}" class="text-white">Assets</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">Issued</a></li>

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
        <div class="card-header">All Issued Assets
          <a href="{{route('assets.create')}}" class="btn btn-info float-sm-right">Return asset</a>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Asset Tag ID</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Region</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($assets as $asset)
              <tr>
                <td>{{$asset->assets->id ?? ''}}</td>
                <td>{{$asset->assets->asset_tag_id ?? ''}}</td>
                <td>{{$asset->assets->description ?? ''}}</td>
                <td>{{$asset->assets->brand ?? ''}}</td>
                <td>{{$asset->region ?? ''}}</td>
                <td>
                	@if($asset->assets)
                	<span class="badge bg-primary">Issued</span></td>
                	@else
                	<span class="badge bg-info">Not Issued</span></td>
                	@endif
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <a type="button" class="btn btn-info" href="{{route('assets.view',$asset->id)}}"><i class="fa fa-eye"></i></a>
                  <a type="button" class="btn btn-success" href="{{route('assets.edit',$asset->id)}}"><i class="fa fa-edit"></i></a>
                  <a type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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