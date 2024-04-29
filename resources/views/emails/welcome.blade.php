<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KRCS-GF  | EMAIL</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
	<div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a href="#" class="h3 text-danger"><b>Dear {{$user->name}}</b></a>
    </div>
     <div class="card-body">
     	<p>
     		Your account has been successfully created. Here are your login details</p>
     		<p>Username: {{$user->email}}</p>
     		<p>Google Aunthenticor Code: {{ $user->google2fa_secret}}</p>
     		<p>For security reasons, we don't include your password in this email. If you forget your password, you can reset it using the "Forgot Password" link on our website.</p>
     		<p>Thank you for using our system.</p>

     		<p>Regards</p>
     		<p>KRCS-GF-data management System team</p>
     		<p>Nairobi Kenya.</p>
     </div>
</div>
</body>
</html>
