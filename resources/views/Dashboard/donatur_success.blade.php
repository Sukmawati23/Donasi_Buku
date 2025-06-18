@extends('layouts.app')

@section('content')
    <div class="text-center mt-5">
        <h2>Donasi Berhasil!</h2>
        <p>Terima kasih telah berdonasi buku.</p>
        {{-- Tombol Donasikan Lagi --}}
        <a href="{{ route('dashboard.donatur') }}" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
            Donasikan Lagi
        </a>
        <a href="{{ route('dashboard.donatur') }}">Kembali ke Dashboard</a>
    </div>
    {{-- Navigasi bawah --}}
            <nav class="navbar fixed-bottom navbar-light bg-light border-top">
                <div class="container d-flex justify-content-around">
                    <a href="#" class="text-primary"><i class="fas fa-home fa-lg"></i></a>
                    <a href="#"><i class="fas fa-bell fa-lg text-secondary"></i></a>
                    <a href="#"><i class="fas fa-user fa-lg text-secondary"></i></a>
                </div>
            </nav>
@endsection
