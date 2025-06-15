<!-- resources/views/auth/halDaf-penerima.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Penerima</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #00008B;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow-x: hidden;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px 25px;
            border-radius: 20px;
            width: 90%;
            max-width: 320px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .form-container h2 {
            text-align: center;
            color: #00008B;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #00008B;
            margin-bottom: 5px;
        }

        .form-group label span {
            margin-right: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box; 
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .checkbox-group input {
            margin-right: 8px;
        }

        .btn-submit {
            background-color: #00008B;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            font-size: 15px;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #00006B;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 60px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="logo">
            <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo">
        </div>
        <h2>Daftar Sebagai Penerima</h2>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf <!-- Penting untuk mencegah error 419 -->
            <input type="hidden" name="role" value="penerima">

            <div class="form-group">
                <label><span>📧</span>Email</label>
                <input type="text" name="email" required>
            </div>

            <div class="form-group">
                <label><span>👤</span>Nama</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label><span>🆔</span>ID</label>
                <input type="text" name="id_card">
            </div>

            <div class="form-group">
                <label><span>🔒</span>Kata Sandi</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label><span>🔁</span>Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label><span>📍</span>Alamat</label>
                <input type="text" name="alamat" required>
            </div>

            <div class="form-group">
                <label><span>📞</span>No. Telepon</label>
                <input type="text" name="telepon" required>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" required>
                <label>Saya setuju dengan syarat & ketentuan</label>
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>
    </div>
</body>
</html>
