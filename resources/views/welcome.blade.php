<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        a {
            text-decoration: none;
            color: #3490dc;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Sistem Donasi Buku</h1>
        <p>
            <a href="{{ route('login') }}">Login</a> |
            <a href="{{ route('register') }}">Daftar</a>
        </p>
    </div>
</body>
</html>
