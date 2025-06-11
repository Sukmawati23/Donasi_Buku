<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
  <h2>Reset Password</h2>

@if ($errors->any())
    <div style="color: red">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password Baru" required><br>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br>
    <button type="submit">Reset Password</button>
</form>

</body>
</html>
