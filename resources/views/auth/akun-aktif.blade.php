<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akun Telah Aktif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #000080; /* Navy */
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

    <div class="bg-white p-6 rounded-2xl shadow-lg text-center w-[90%] max-w-sm">
        <!-- Icon -->
        <img src="{{ asset('verified-icon.png') }}" alt="Verified Icon" class="mx-auto w-24 h-24 mb-4">

        <!-- Judul -->
        <h1 class="text-xl md:text-2xl font-bold text-[#000080] mb-2">Akun Anda Telah Aktif!</h1>

        <!-- Deskripsi -->
        <p class="text-sm text-gray-700 mb-6">
            Selamat! Akun Anda sebagai Donatur telah berhasil diaktifkan.<br>
            Silakan masuk untuk mulai menggunakan sistem.
        </p>

        <!-- Tombol -->
        <a href="{{ route('login') }}"
           class="block w-full bg-[#000080] text-white text-sm font-semibold py-2 rounded-lg hover:bg-blue-900 transition">
            Masuk ke Akun
        </a>
    </div>

</body>
</html>
