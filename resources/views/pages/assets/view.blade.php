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
              <li class="breadcrumb-item active"><a href="#" class="text-white">{{$asset->serial_no}}</a></li>

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
        <div class="card-header">You are viewing Asset {{$asset->serial_no}} 
          @if($asset->assetsIssued)
        	<a class="btn btn-primary float-sm-right" href="#" data-toggle="modal" data-target="#return-{{$asset->id}}">Return Asset</a>
          @else
          <a class="btn btn-info float-sm-right" href="#" data-toggle="modal" data-target="#issue-{{$asset->id}}">Issue This Asset</a>
          @endif
        </div>
        <div class="card-body">
         <div class="row">
         	<div class="col-4">
         		<p>Tag ID: {{$asset->asset_tag_id}}</p>
         		<p>Serial No: {{$asset->serial_no}}</p>
         		<p>Description: {{$asset->description}}</p>
         	</div>
         	<div class="col-4">
         		<p>Brand: {{$asset->brand}}</p>
         		<p>Model: {{$asset->model}}</p>
         		<p>Cost: {{$asset->cost}}</p>
         	</div>
         	<div class="col-4">
         		<p>Purchased From: {{$asset->purchase_from}}</p>
         		<p>Purchase Date: {{$asset->purchase_date}}</p>
         		<p>Status: {{$asset->status}}</p>
         	</div>
         </div>
         @include('pages.assets.issueModal')
         @include('pages.assets.return')
        </div>
      </div>
    </div>
  </section>

  @endsection