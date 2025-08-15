<!DOCTYPE html>
<html lang="id"> {{-- Ganti ke "id" karena situs berbahasa Indonesia --}}
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap & Font Awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between align-items-center py-2">
            <div class="d-flex align-items-center">
                <img src="{{ asset('logo-sdb.png') }}" alt="Logo" height="40" class="me-3">
                <strong class="text-white">Donasi Buku</strong>
            </div>
            <div class="d-flex align-items-center">
                @auth
                    <span class="me-3 text-white"><i class="fa fa-user"></i> {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-light" type="submit">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Konten --}}
    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
