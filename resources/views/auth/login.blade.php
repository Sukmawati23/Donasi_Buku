<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    @if (session('error'))
        <div style="color: red">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <p><a href="{{ route('password.request') }}">Lupa password?</a></p>

    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
</body>
</html>
