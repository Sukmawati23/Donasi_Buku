<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Buku</title>
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
        body {
            margin: 0;
            padding: 0;
            background-color: #00008B; 
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .logo {
            width: 200px;
            height: 200px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 150px;
        }
        .tagline {
            font-size: 18px;
            font-style: 'Pacifico', cursive;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .start-btn {
            background: transparent;
            border: 2px solid white; 
            border-radius: 30px;    
            padding: 8px 16px;      
            color: white;
            font-size: 18px;
            cursor: pointer;
            text-decoration: none;  
            display: inline-block;
            align-items: center;
            transition: all 0.3s ease;
        }
        .start-btn:hover {
            background-color: white; 
            color: #00008B;         
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo Donasi Buku">
    </div>
    <div class="tagline">“Satu Buku, Sejuta Manfaat”</div>
    <button class="start-btn" onclick="location.href='{{ url('/login') }}'">Mulai →</button>
</body>
</html>
