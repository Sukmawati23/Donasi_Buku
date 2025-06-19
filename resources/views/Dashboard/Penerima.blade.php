@extends('layouts.app')

@section('content')
<div style="background-color: #000080; min-height: 100vh;" class="text-white px-3 pt-4 pb-5">
    {{-- Logo --}}
    <div class="text-start mb-4">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo" style="width: 45px;">
    </div>

    {{-- Sapaan --}}
    <h5 class="fw-bold">Halo, {{ Auth::user()->name }}</h5>

    {{-- Kartu Daftar Buku --}}
    <div class="mt-4 text-center">
        <div class="bg-primary bg-opacity-75 rounded-4 p-4 d-inline-block">
            <i class="fas fa-book fa-3x mb-3"></i>
            <p class="mb-2">Daftar Buku</p>
            <a href="{{ route('penerima.daftarBuku') }}" class="btn btn-primary px-4 py-1">Daftar Buku</a>
        </div>
    </div>

    {{-- Status Permintaan --}}
    <div class="mt-5">
        <h6 class="fw-bold mb-3">Status Permintaan</h6>
        <div class="table-responsive">
            <table class="table text-white" style="background-color: #191970;">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggapan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuan as $pengajuan)
                        <tr>
                            <td>{{ $pengajuan->buku->judul ?? 'Tidak diketahui' }}</td>
                            <td>{{ $pengajuan->status }}</td>
                            <td>
                                @if($pengajuan->status === 'Disetujui')
                                    <span class="badge bg-success">Sukses</span>
                                @elseif($pengajuan->status === 'Ditolak')
                                    <span class="badge bg-danger">Gagal</span>
                                @else
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada permintaan buku</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Navigasi bawah --}}
<nav class="navbar fixed-bottom bg-light border-top">
    <div class="container d-flex justify-content-around py-2">
        <a href="{{ route('dashboard.penerima') }}" class="text-primary">
            <i class="fas fa-home fa-lg"></i>
        </a>
        <a href="#" class="text-secondary">
            <i class="fas fa-bell fa-lg"></i>
        </a>
        <a href="#" class="text-secondary">
            <i class="fas fa-user fa-lg"></i>
        </a>
    </div>
</nav>
@endsection
