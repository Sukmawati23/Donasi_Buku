<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pengajuan, Donasi, User, Buku};
use Illuminate\Support\Facades\{DB, Auth};
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $totalDonasi = Donasi::count();
        $totalPengajuan = Pengajuan::count();
        $totalBuku = Buku::count();
        $totalUser = User::count();

        $laporan = DB::table('donasis')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as total_donasi')
            )
            ->groupBy('bulan')
            ->get();

        $pengajuan = DB::table('pengajuans')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as total_pengajuan')
            )
            ->groupBy('bulan')
            ->get();

        $laporanGabung = $laporan->map(function ($item) use ($pengajuan) {
            $bulanPengajuan = $pengajuan->firstWhere('bulan', $item->bulan);
            $item->total_pengajuan = $bulanPengajuan ? $bulanPengajuan->total_pengajuan : 0;
            return $item;
        });

        $recentPengajuan = Pengajuan::with(['user', 'buku'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalDonasi',
            'totalPengajuan',
            'totalBuku',
            'totalUser',
            'laporanGabung',
            'recentPengajuan'
        ));
    }

    public function laporan()
    {
        $laporanGabung = DB::table('donasis')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as total_donasi')
            )
            ->groupBy('bulan')
            ->get();

        return view('admin.laporan', compact('laporanGabung'));
    }

    public function exportPDF()
    {
        $laporanGabung = DB::table('donasis')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as total_donasi')
            )
            ->groupBy('bulan')
            ->get();

        $pdf = Pdf::loadView('admin.laporan_pdf', compact('laporanGabung'));
        return $pdf->download('laporan-donasi.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanExport, 'laporan-donasi.xlsx');
    }

    public function pengajuan()
    {
        $pengajuan = Pengajuan::with(['user', 'buku'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengajuan', compact('pengajuan'));
    }

    public function verifikasi($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'disetujui';
        $pengajuan->save();

        return redirect()->route('admin.pengajuan')
            ->with('success', 'Pengajuan berhasil diverifikasi.');
    }
}
