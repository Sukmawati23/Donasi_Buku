<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
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

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 80px;
        }

        .box {
            background-color: white;
            color: #000049;
            padding: 30px;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        input {
            width: 95%;
            padding: 12px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: none;
            background-color: #f2f2f2;
            color: #000049;
            font-weight: bold;
        }

        input::placeholder {
            color: #000049;
            opacity: 0.8;
        }

        button {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background-color: #00008B;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #00006B;
        }

        .message-error {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
            text-align: left;
        }

        .status {
            color: green;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo Donasi Buku">
    </div>

    <div class="box">
        <h2>Reset Password</h2>

        {{-- Tampilkan pesan status --}}
        @if (session('status'))
            <div class="status">
                {{ session('status') }}
            </div>
        @endif

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="message-error">
                @foreach ($errors->all() as $error)
                    • {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {{-- Form reset password --}}
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="email" name="email" placeholder="Email Anda" value="{{ old('email', request('email')) }}" required>
            <input type="password" name="password" placeholder="Password Baru" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
