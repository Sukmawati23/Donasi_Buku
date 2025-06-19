<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Donasi Buku</title>
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
            width: 60px;
            margin-bottom: 20px;
        }
        .container {
            text-align: center;
            width: 80%;
            max-width: 400px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background-color: white;
            color: #00008B;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }
        .button:hover {
            background-color: #ddd;
        }
        .icon {
            font-size: 18px;
        }
    </style>
    <!-- Font Awesome (untuk icon) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo">
    </div>
    <div class="container">
        <h2>Daftarkan sebagai</h2>
        <p>Pilih jenis akun Anda untuk membuat akun baru</p>
        <a href="{{ route('register.donatur') }}" class="button">
            <i class="fas fa-user icon"></i> Donatur
        </a>
        <a href="{{ route('register.penerima') }}" class="button">
            <i class="fas fa-hand-holding-heart icon"></i> Penerima
        </a>        
    </div>
</body>
</html>