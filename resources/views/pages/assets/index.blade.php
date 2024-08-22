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
              <li class="breadcrumb-item active"><a href="#" class="text-white">Assets</a></li>

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
        <div class="card-header">All Assets
          <a href="{{route('assets.create')}}" class="btn btn-info float-sm-right">Add new Asset</a>
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
                <th>Purchase Date</th>
                <th>Cost</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($assets as $asset)
              <tr>
                <td>{{$asset->id}}</td>
                <td>{{$asset->asset_tag_id}}</td>
                <td>{{$asset->description}}</td>
                <td>{{$asset->brand}}</td>
                <td>HQ</td>
                <td>{{$asset->purchase_date}}</td>
                <td>{{$asset->cost}}</td>
                <td><span class="badge bg-info">{{$asset->status}}</span></td>
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