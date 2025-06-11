<!DOCTYPE html>
<html lang="en">
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
            margin-bottom: 15px;
        }
        .container {
            text-align: center;
            width: 50%;
        }
        .container h2 {
            font-size: 25px; 
        }
        .desc {
            font-size: 15px; 
        }
        input {
            width: 47%;
            padding: 9px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 10px;
            background-color: white;
            color: #000049;
            font-weight: bold;
            margin: 6px 0;
        }
        input::placeholder {
            color: #00004f;
            opacity: 0.9;
        }
        button {
            width: 50%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            margin-top: 10px;
            background-color: white;
            color: #00008B;
            font-weight: bold;
            cursor: pointer;
            margin: 6px 0;
        }
        button:hover {
            background-color: #ddd;
        }
        .divider {
            margin: 6px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            width: 320px; 
            margin: 10px auto; 
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: white;
            margin: 0 5px;
        }
        .forgot {
            display: block;
            width: 49%;
            text-align: left;
            font-size: 12px;
            margin: 5px auto 10px auto;
            color: white; 
            text-decoration: none; 
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
        <form autocomplete="off">
            <input type="text" name="fakeemail" placeholder="Email" autocomplete="off">
            <input type="password" name="fakepassword" placeholder="Password" autocomplete="new-password">
            <a href="#" class="forgot">Lupa kata sandi?</a>
            <button type="submit">Masuk</button>
            <div class="divider">atau</div>
            <button type="button">Daftar</button>
        </form>
    </div>
</body>
</html>
