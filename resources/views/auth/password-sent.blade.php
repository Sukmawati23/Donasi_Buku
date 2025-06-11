<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Email Terkirim</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #00008B;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #1a1a1a;
    }

    .container {
      background-color: #ffffff;
      padding: 30px 20px;
      border-radius: 20px;
      text-align: center;
      width: 320px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
    }

    .container img {
      width: 60px;
      margin-bottom: 20px;
    }

    h2 {
      color: #00008B;
      margin-bottom: 10px;
      font-size: 20px;
    }

    p {
      font-size: 14px;
      margin: 6px 0;
      color: #333;
    }

    a.button {
      display: inline-block;
      margin-top: 20px;
      background-color: #00008B;
      color: #fff;
      padding: 10px 20px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    a.button:hover {
      background-color: #000070;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="{{ asset('img/email-icon.png') }}" alt="Email Icon">
    <h2>Email Terkirim</h2>
    <p>Silakan periksa email Anda!</p>
    <p>Kami telah mengirimkan tautan untuk mengatur ulang kata sandi ke alamat email Anda.</p>
    <p><strong>Tautan berlaku selama 15 menit.</strong></p>
    <a href="{{ route('login') }}" class="button">Kembali ke Masuk</a>
  </div>
</body>
</html>
