@extends('layouts.app')

@section('content')
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center mt-5">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h2 class="mb-3">Donasi Berhasil!</h2>
                        <p class="lead mb-4">Terima kasih telah berdonasi buku.</p>
                        
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('dashboard.donatur') }}" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-plus-circle me-2"></i> Donasikan Lagi
                            </a>
                            <a href="{{ route('dashboard.donatur') }}" class="btn btn-outline-secondary px-4 py-2">
                                <i class="fas fa-home me-2"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigasi bawah --}}
    <nav class="navbar fixed-bottom navbar-light bg-light border-top">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('dashboard.donatur') }}" class="text-primary">
                <i class="fas fa-home fa-lg"></i>
            </a>
            <a href="#" onclick="event.preventDefault(); alert('Fitur notifikasi akan datang!')">
                <i class="fas fa-bell fa-lg text-secondary"></i>
            </a>
            <a href="#" onclick="event.preventDefault(); alert('Fitur profil akan datang!')">
                <i class="fas fa-user fa-lg text-secondary"></i>
            </a>
        </div>
    </nav>
@endsection