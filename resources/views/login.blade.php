<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Donasi Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #00008B;
            color: white;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .logo img {
            width: 80px;
            margin-bottom: 20px;
        }

        .container {
            text-align: center;
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .desc {
            font-size: 14px;
            margin-bottom: 20px;
        }

        input {
            width: 96%;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: none;
            background-color: white;
            color: #000049;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
        }

        input::placeholder {
            color: #00004f;
            opacity: 0.9;
        }

        .forgot {
            text-align: left;
            font-size: 12px;
            display: block;
            margin: -8px 0 16px 4px;
            color: white;
            text-decoration: none;
        }

        button {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background-color: white;
            color: #00008B;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            margin-bottom: 12px;
        }

        button:hover {
            background-color: #ddd;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 10px 0;
            font-size: 13px;
            color: white;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: white;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo">
    </div>

    <div class="container">
        <h2>Masuk atau Daftar Akun</h2>
        <p class="desc">Silakan masuk akun Anda atau buat akun baru untuk memulai donasi buku</p>

        @if (session('error'))
            <div style="color: red; margin-bottom: 10px;">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <input type="email" name="email" placeholder="Email" autocomplete="off" required>
            <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>

            <a href="{{ route('password.request') }}" class="forgot">Lupa kata sandi?</a>

            <button type="submit">Masuk</button>

            <div class="divider">atau</div>

            <a href="{{ route('daftar') }}">
                <button type="button">Daftar</button>
            </a>
        </form>
    </div>
</body>
</html>