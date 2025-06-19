<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akun Anda Telah Aktif</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #000080;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: white;
            color: #000080;
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
            color: #000080;
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
        }

        .btn-primary {
            background-color: #000080;
            color: white;
        }

        .btn-primary:hover {
            background-color: #00006B;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="{{ asset('verified-icon.png') }}" alt="Verified Icon">
        <h2>Akun Anda Telah Aktif!</h2>
        <p>Selamat! Akun Anda telah berhasil diaktifkan. Silakan login untuk mulai menggunakan sistem.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Masuk ke Akun</a>
    </div>
</body>
</html>
