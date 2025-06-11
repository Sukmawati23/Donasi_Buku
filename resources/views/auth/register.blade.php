<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Daftar Akun</h2>

    {{-- Tampilkan pesan error dari session --}}
    @if (session('error'))
        <div style="color: red">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form registrasi --}}
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required><br>
        @error('name')
            <small style="color: red">{{ $message }}</small><br>
        @enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
        @error('email')
            <small style="color: red">{{ $message }}</small><br>
        @enderror

        <input type="password" name="password" placeholder="Password" required><br>
        @error('password')
            <small style="color: red">{{ $message }}</small><br>
        @enderror

        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>
