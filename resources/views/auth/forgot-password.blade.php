<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Kata Sandi</title>
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
            padding: 30px;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            text-align: center;
            background-color: white;
            color: #000049;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            margin-bottom: 20px;
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

        .back-link {
            margin-top: 16px;
            display: block;
            font-size: 12px;
            text-align: center;
            color: #000049;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .message-success {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .message-error {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo Donasi Buku">
    </div>

    <div class="box">
        <h2>Lupa Kata Sandi</h2>
        <p>Masukkan email Anda untuk mengatur ulang kata sandi</p>

        {{-- Pesan sukses jika email berhasil dikirim --}}
        @if (session('status'))
            <div class="message-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- Form lupa kata sandi --}}
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Email yang terdaftar" value="{{ old('email') }}" required>

            {{-- Tampilkan error validasi --}}
            @error('email')
                <div class="message-error">{{ $message }}</div>
            @enderror

            <button type="submit">KIRIM</button>
        </form>

        <a href="{{ route('login') }}" class="back-link">← Kembali ke Masuk</a>
    </div>
</body>
</html>