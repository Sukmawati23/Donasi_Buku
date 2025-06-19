<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Anda</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #00008B;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: white;
            color: #00008B;
            padding: 30px 25px;
            border-radius: 20px;
            width: 100%;
            max-width: 360px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .card img {
            width: 80px;
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 20px;
            margin-bottom: 12px;
        }

        .card p {
            font-size: 14px;
            margin-bottom: 20px;
            color: #333;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #00008B;
            color: white;
        }

        .btn-primary:hover {
            background-color: #00006B;
        }

        .btn-secondary {
            background-color: #808080;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #666666;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ asset('email-icon.png') }}" alt="Email Icon">
        <h2>Verifikasi Email Anda</h2>
        <p>Silakan cek email Anda dan klik tautan verifikasi untuk melanjutkan.</p>

        @if (session('status') == 'verification-link-sent')
            <p><strong>Email verifikasi baru</strong> telah dikirim ke alamat email Anda.</p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
        </form>

        <a href="{{ route('login') }}" class="btn btn-secondary">Kembali ke Halaman Login</a>
    </div>
</body>
</html>