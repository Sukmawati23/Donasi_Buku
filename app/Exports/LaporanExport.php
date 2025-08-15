<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('donasis')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
                DB::raw('COUNT(*) as total_donasi')
            )
            ->groupBy('bulan')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Bulan',
            'Total Donasi'
        ];
    }
}
