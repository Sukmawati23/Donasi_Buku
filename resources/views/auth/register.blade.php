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
    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        {{-- Pilih Peran --}}
        <label for="role">Daftar sebagai:</label><br>
        <select name="role" required>
            <option value="">-- Pilih Peran --</option>
            <option value="donatur" {{ old('role') == 'donatur' ? 'selected' : '' }}>Donatur</option>
            <option value="penerima" {{ old('role') == 'penerima' ? 'selected' : '' }}>Penerima</option>
        </select><br>
        @error('role')
            <small style="color: red">{{ $message }}</small><br>
        @enderror

        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required><br>
        @error('name')
            <small style="color: red">{{ $message }}</small><br>
        @enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
        @error('email')
            <small style="color: red">{{ $message }}</small><br>
        @enderror

        <input type="text" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}" required><br>
        @error('alamat')
            <small style="color: red">{{ $message }}</small><br>
        @enderror

        <input type="text" name="telepon" placeholder="Nomor Telepon" value="{{ old('telepon') }}" required><br>
        @error('telepon')
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
