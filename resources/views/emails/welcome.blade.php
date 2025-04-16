<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KRCS-GF | EMAIL</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a href="#" class="h3 text-danger"><b>Dear {{ $user->name }}</b></a>
    </div>
    <div class="card-body">
      <p>Your account has been successfully created. Here are your login details:</p>
      <p><strong>Username:</strong> {{ $user->email }}</p>
      <p><strong>Google Authenticator Code:</strong> {{ $user->google2fa_secret }}</p>
      <p>For security reasons, we don't include your password in this email. If you forget your password, you can reset it using the "Forgot Password" link on our website.</p>

      <hr>
      <h5><strong>Instructions to Set Up Google Authenticator:</strong></h5>
      <ol>
        <li><strong>Open Google Authenticator:</strong>
          <ul>
            <li>Launch the Google Authenticator app on your phone.</li>
            <li>Tap the "+" (Add) button at the bottom right.</li>
          </ul>
        </li>
        <li><strong>Enter the Key Manually:</strong>
          <ul>
            <li>Select <em>"Enter a setup key"</em> instead of scanning a QR code.</li>
            <li>In the <em>Account name</em> field, enter a name (e.g., "My Email" or "Company Login") for easy identification.</li>
            <li>In the <em>Your key</em> field, enter the secret key above.</li>
            <li>Choose the correct type of key — usually <strong>Time-based</strong>.</li>
            <li>Tap <strong>Add</strong> to save.</li>
          </ul>
        </li>
        <li><strong>Use the Code:</strong>
          <ul>
            <li>Google Authenticator will now generate a 6-digit code that refreshes every 30 seconds.</li>
            <li>Enter this code during login to complete two-factor authentication.</li>
          </ul>
        </li>
      </ol>

      <hr>
      <p>Thank you.</p>
      <p><strong>Regards,</strong><br>KRCS-COOPERATE SERVICES<br>Nairobi, Kenya.</p>
    </div>
  </div>
</body>
</html>
