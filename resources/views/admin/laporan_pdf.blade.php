<!DOCTYPE html>
<html>
<head><title>Laporan PDF</title></head>
<body>
    <h3>Laporan Donasi per Bulan</h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead><tr><th>Bulan</th><th>Total Donasi</th></tr></thead>
        <tbody>
        @foreach($laporanGabung as $laporan)
            <tr>
                <td>{{ $laporan->bulan }}</td>
                <td>{{ $laporan->total_donasi }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>