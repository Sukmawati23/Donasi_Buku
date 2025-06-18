@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Logo dan sambutan --}}
        <div class="text-center my-4">
            <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo" class="mb-2" style="width: 50px;">
            <h4><strong>Selamat Datang</strong></h4>
            <h5><strong><br>({{ Auth::user()->name }})</strong></h5>
        </div>

        {{-- Form Donasi Buku --}}
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h5 class="card-title">Tambah Donasi Buku</h5>
                <form method="POST" action="#" enctype="multipart/form-data"> {{-- Tambah enctype --}}
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="judul" class="form-control" placeholder="Judul Buku">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="kategori">
                            <option disabled selected>Pilih Kategori</option>
                            <option value="fiksi">Fiksi</option>
                            <option value="non-fiksi">Non-fiksi</option>
                            <option value="pendidikan">Pendidikan</option>
                            <option value="anak">Anak-anak</option>
                            <option value="remaja">Remaja</option>
                            <option value="biografi">Biografi</option>
                            <option value="agama">Agama</option>
                            <option value="komik">Komik</option>
                            <option value="novel">Novel</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="kondisi" rows="2" placeholder="Kondisi Buku"></textarea>
                    </div>

                    {{-- Input jumlah buku --}}
                    <div class="mb-3">
                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Buku" min="1">
                    </div>


                    {{-- Input tanggal donasi --}}
                    <div class="mb-3">
                         <label for="tanggal" class="form-label">Tanggal Donasi</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                     </div>
                     
                    {{-- Pilih Foto --}}
                    <div class="mb-3">
                        <label for="foto" class="form-label">Pilih Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control bg-light text-dark">
                    </div>

                    <button type="submit" class="btn btn-light w-100">Donasikan Buku</button>
                </form>
            </div>
        </div>

        {{-- Riwayat & Status Pengiriman --}}
        <div class="row">
            {{-- Riwayat Donasi --}}
            <div class="col-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Riwayat Donasi</h6>
                        @forelse($donasi as $item)
                            <p class="card-text mb-1">
                                <strong>{{ $item->judul_buku }}</strong><br>
                                <span class="text-white-50">{{ ucfirst($item->status) }}</span>
                            </p>
                        @empty
                            <p class="card-text">Belum ada donasi</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Status Pengiriman --}}
            <div class="col-6">
                <div class="card text-white bg-secondary mb-2" style="font-size: 0.85rem;">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-2" style="font-size: 0.9rem;">Status Pengiriman</h6>
                        <p class="card-text mb-1">Menunggu: <strong>{{ $statusCount['menunggu'] ?? 0 }}</strong></p>
                        <p class="card-text">Diterima: <strong>{{ $statusCount['diterima'] ?? 0 }}</strong></p>
                    </div>
                </div>
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
