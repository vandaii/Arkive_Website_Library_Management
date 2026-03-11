<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Buku</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; color: #333; line-height: 1.5; padding: 25px; font-size: 12px; }
        .header { text-align: center; border-bottom: 3px solid #4a70a9; padding-bottom: 12px; margin-bottom: 20px; }
        .header h1 { color: #4a70a9; font-size: 22px; margin-bottom: 3px; }
        .header p { color: #666; font-size: 11px; }
        .print-info { text-align: right; font-size: 10px; color: #999; margin-bottom: 15px; }
        .stats-row { width: 100%; margin-bottom: 20px; }
        .stats-row td { padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #f9f9f9; }
        .stats-row .label { font-size: 11px; color: #4a70a9; text-transform: uppercase; font-weight: bold; }
        .stats-row .value { font-size: 22px; font-weight: bold; }
        .section h2 { color: #4a70a9; font-size: 15px; margin-bottom: 10px; border-bottom: 2px solid #8fabd4; padding-bottom: 5px; }
        table.data { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table.data thead { background-color: #4a70a9; color: white; }
        table.data th { padding: 8px; text-align: left; font-weight: 600; font-size: 11px; }
        table.data td { padding: 6px 8px; border-bottom: 1px solid #eee; font-size: 11px; }
        table.data tbody tr:nth-child(even) { background-color: #f5f5f5; }
        .status-badge { display: inline-block; padding: 2px 8px; border-radius: 3px; font-size: 10px; font-weight: bold; color: white; }
        .status-available { background-color: #24a148; }
        .status-unavailable { background-color: #d32f2f; }
        .footer { margin-top: 30px; text-align: center; color: #999; font-size: 10px; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="print-info">Dicetak pada: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}</div>
    <div class="header">
        <h1>Laporan Data Buku</h1>
        <p>Data lengkap semua buku dalam sistem</p>
    </div>
    <table class="stats-row">
        <tr>
            <td><div class="label">Total Buku</div><div class="value">{{ $bukus->count() }}</div></td>
            <td><div class="label">Buku Tersedia</div><div class="value" style="color:#24a148">{{ $bukus->where('stok', '>', 0)->count() }}</div></td>
            <td><div class="label">Buku Habis</div><div class="value" style="color:#d32f2f">{{ $bukus->where('stok', '<=', 0)->count() }}</div></td>
        </tr>
    </table>
    <div class="section">
        <h2>Daftar Buku</h2>
        @if ($bukus->count() > 0)
            <table class="data">
                <thead><tr><th>No</th><th>Judul</th><th>Penulis</th><th>Penerbit</th><th>Tahun</th><th>Stok</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach ($bukus as $index => $buku)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $buku->judul }}</strong></td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td><strong>{{ $buku->stok }}</strong></td>
                            <td>
                                @if ($buku->stok > 0)
                                    <span class="status-badge status-available">Tersedia</span>
                                @else
                                    <span class="status-badge status-unavailable">Habis</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #999; font-style: italic;">Belum ada data buku.</p>
        @endif
    </div>
    <div class="footer"><p>&copy; {{ date('Y') }} Sistem Manajemen Perpustakaan</p></div>
</body>
</html>
