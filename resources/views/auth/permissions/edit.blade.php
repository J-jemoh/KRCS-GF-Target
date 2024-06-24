@extends('layouts.admin')

@section('title', 'Edit Permissions')

@section('orientation', 'hk-vertical-nav')

@push('css')
<!-- Toggles CSS -->
<link href="{{ asset('vendors/jquery-toggles/css/toggles.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('vendors/jquery-toggles/css/themes/toggles-light.css') }}" rel="stylesheet" type="text/css">

<!-- ION CSS -->
<link href="{{ asset('vendors/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('vendors/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css') }}" rel="stylesheet" type="text/css">

<!-- select2 CSS -->
<link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Pickr CSS -->
<link href="{{ asset('vendors/pickr-widget/dist/pickr.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Daterangepicker CSS -->
<link href="{{ asset('vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<!-- Jasny-bootstrap  JavaScript -->
<script src="{{ asset('vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>

<!-- Ion JavaScript -->
<script src="{{ asset('vendors/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('js/rangeslider-data.js') }}"></script>

<!-- Select2 JavaScript -->
<script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2-data.js') }}"></script>

<!-- Bootstrap Tagsinput JavaScript -->
<script src="{{ asset('vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

<!-- Bootstrap Input spinner JavaScript -->
<script src="{{ asset('vendors/bootstrap-input-spinner/src/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('js/inputspinner-data.js') }}"></script>

<!-- Pickr JavaScript -->
<script src="{{ asset('vendors/pickr-widget/dist/pickr.min.js') }}"></script>
<script src="{{ asset('js/pickr-data.js') }}"></script>

<!-- Daterangepicker JavaScript -->
<script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('js/daterangepicker-data.js') }}"></script>

@endpush


@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Permissions </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Users</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.users.permission.index') }}">Permissions</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
      </div><!-- /.col -->
    </div>
    <hr style="border: solid 2px #000;">
  </div>
</div>
<!-- Breadcrumb -->
<!-- /Breadcrumb -->
<section class="content">
    <div class="container-fluid">
<!-- Container -->
    <!-- Title -->
    <div class="card">
        <div class="card-header bg-info">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="plus"></i></span></span>Edit Role</h4>
        </div>

    <!-- /Title -->

    @include('messages.flash_messages')
<div class="card-body">
    <!-- Row -->
    <div class="row">
        <div class="col-md-6">
            <section class="hk-sec-wrapper">
                <h5 class="hk-sec-title">Edit Permissions Details</h5>
                <form method="POST" action="{{route('admin.users.permission.update', $permission->id)}}" role="form">
                    @method('PUT')
                    @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $permission->name }}" required=""  placeholder="Enter name">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                   

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </section>

        </div>
    </div>
</div>
</div>
    <!-- /Row -->
</div>
</section>
<!-- /Container -->

@endsection