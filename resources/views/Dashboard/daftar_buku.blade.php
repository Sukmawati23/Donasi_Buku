@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #000080;
        color: white;
        font-family: sans-serif;
    }

    .container-custom {
        padding: 20px;
        min-height: 100vh;
    }

    .title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .search-bar {
        width: 100%;
        padding: 8px 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
    }

    table {
        width: 100%;
        background-color: #2e2eec;
        border-radius: 10px;
        overflow: hidden;
        font-size: 14px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        color: white;
    }

    th {
        font-weight: bold;
        font-size: 13px;
    }

    .btn-kembali {
        margin-top: 20px;
        padding: 10px 16px;
        background-color: #0000ff;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .bottom-nav {
        margin-top: 40px;
        background-color: #dcdcdc;
        padding: 12px;
        display: flex;
        justify-content: space-around;
        border-radius: 0 0 10px 10px;
    }

    .bottom-nav a {
        font-size: 20px;
        color: black;
    }
</style>

<div class="container container-custom">
    <div class="title">Daftar Buku</div>

    {{-- Search Bar (belum aktif fungsinya) --}}
    <input type="text" class="search-bar" placeholder="Cari ...">

    {{-- Table --}}
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>id_buku</th>
                    <th>judul</th>
                    <th>penulis</th>
                    <th>kategori</th>
                    <th>statusBuku</th>
                    <th>penerbit</th>
                    <th>tahunTerbit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donasis as $buku)
                    <tr>
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->judul_buku }}</td>
                        <td>-</td> {{-- Penulis belum tersedia --}}
                        <td>{{ $buku->kategori }}</td>
                        <td>{{ ucfirst($buku->status) }}</td>
                        <td>-</td> {{-- Penerbit belum tersedia --}}
                        <td>{{ \Carbon\Carbon::parse($buku->tanggal)->format('Y') }}</td>
                    </tr>
                @endforeach

                @if($donasis->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">Belum ada buku yang tersedia.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Tombol Kembali --}}
    <a href="{{ route('dashboard.penerima') }}">
        <button class="btn-kembali">Kembali</button>
    </a>

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
</div>
@endsection
