<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Total Donasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporanGabung as $laporan)
        <tr>
            <td>{{ $laporan->bulan }}</td>
            <td>{{ $laporan->total_donasi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>