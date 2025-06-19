<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url={{ route('dashboard') }}"> {{-- Redirect otomatis ke dashboard --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Aktif</title>
    <style>
        body {
            background-color: #00008B;
            color: white;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            color: #00008B;
            padding: 30px 20px;
            border-radius: 20px;
            text-align: center;
            max-width: 340px;
            width: 90%;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        .container img {
            width: 80px;
            margin-bottom: 15px;
        }

        .btn-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #00008B;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-link:hover {
            background-color: #00006B;
        }

        p {
            font-size: 14px;
            margin: 10px 0;
        }

        h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('verified-icon.png') }}" alt="Ikon Verifikasi">
        <h3>Akun Anda Telah Aktif!</h3>
        <p>Selamat! Akun Anda sebagai Donatur telah berhasil diaktifkan.</p>
        <p>Anda akan diarahkan ke dashboard dalam 5 detik...</p>
        <a href="{{ route('login') }}" class="btn-link">Klik di sini jika tidak diarahkan otomatis</a>
    </div>
</body>
</html>