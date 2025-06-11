<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
</head>
<body>
    <h2>Lupa Password</h2>

@if (session('status'))
    <div style="color: green">{{ session('status') }}</div>
@endif

@if ($errors->any())
    <div style="color: red">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" placeholder="Masukkan email yang terdaftar" required>
    <button type="submit">Kirim Link Reset</button>
</form>


    <p><a href="{{ route('login') }}">Kembali ke Login</a></p>
</body>
</html>
