<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KRCS-GF  | Verify</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page" style="overflow: hidden;">
<div class="login-box">
  @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   <div class="login-logo" style="margin-bottom:2px;">
    <img src="{{asset('admin/logo/logo.png')}}">
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a href="#" class="h3 text-danger"><b>GF-Unit</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Enter code to start your session</p>

      <form action="{{ route('2fa.verify') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Enter code" name="code" value="{{ old('code') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope text-danger"></span>
            </div>
          </div>
           @error('code')
            <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                 </span>
                @enderror
        </div>
   
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-danger btn-block">Verify Code</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
