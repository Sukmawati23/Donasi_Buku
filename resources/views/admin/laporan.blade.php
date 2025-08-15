@extends('layouts.app')
@section('content')
<h2>Laporan Donasi per Bulan</h2>
<table class="table table-striped bg-white text-dark">
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Total Donasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporanGabung as $laporan)
        <tr>
            <td>{{ $laporan->bulan }}</td>
            <td>{{ $laporan->total_donasi }}</td>
            <td>
                <a href="{{ route('admin.laporan.pdf') }}" class="btn btn-danger btn-sm">PDF</a>
                <a href="{{ route('admin.laporan.excel') }}" class="btn btn-success btn-sm">Excel</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection