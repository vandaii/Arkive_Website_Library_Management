<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Peminjaman</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; color: #333; line-height: 1.5; padding: 25px; font-size: 11px; }
        .header { text-align: center; border-bottom: 3px solid #4a70a9; padding-bottom: 12px; margin-bottom: 20px; }
        .header h1 { color: #4a70a9; font-size: 22px; margin-bottom: 3px; }
        .header p { color: #666; font-size: 11px; }
        .print-info { text-align: right; font-size: 10px; color: #999; margin-bottom: 15px; }
        .filter-info { background-color: #f5f5f5; padding: 8px; margin-bottom: 15px; font-size: 11px; }
        .stats-row { width: 100%; margin-bottom: 20px; }
        .stats-row td { padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #f9f9f9; }
        .stats-row .label { font-size: 10px; color: #4a70a9; text-transform: uppercase; font-weight: bold; }
        .stats-row .value { font-size: 20px; font-weight: bold; }
        .section h2 { color: #4a70a9; font-size: 15px; margin-bottom: 10px; border-bottom: 2px solid #8fabd4; padding-bottom: 5px; }
        table.data { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table.data thead { background-color: #4a70a9; color: white; }
        table.data th { padding: 6px; text-align: left; font-weight: 600; font-size: 10px; }
        table.data td { padding: 5px 6px; border-bottom: 1px solid #eee; font-size: 10px; }
        table.data tbody tr:nth-child(even) { background-color: #f5f5f5; }
        .status-badge { display: inline-block; padding: 2px 6px; border-radius: 3px; font-size: 9px; font-weight: bold; color: white; }
        .status-pending { background-color: #f1c21b; color: #000; }
        .status-borrowed { background-color: #0043ce; }
        .status-waiting { background-color: #ff832b; }
        .status-returned { background-color: #24a148; }
        .footer { margin-top: 30px; text-align: center; color: #999; font-size: 10px; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="print-info">Dicetak pada: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}</div>
    <div class="header">
        <h1>Laporan Data Peminjaman</h1>
        <p>Data lengkap semua peminjaman buku</p>
    </div>
    @if ($startDate || $endDate)
        <div class="filter-info">
            <strong>Filter Tanggal:</strong>
            @if ($startDate) Dari {{ date('d/m/Y', strtotime($startDate)) }} @endif
            @if ($startDate && $endDate) hingga @endif
            @if ($endDate) {{ date('d/m/Y', strtotime($endDate)) }} @endif
        </div>
    @endif
    <table class="stats-row">
        <tr>
            <td><div class="label">Total</div><div class="value">{{ $peminjamans->count() }}</div></td>
            <td><div class="label">Pending</div><div class="value" style="color:#f1c21b">{{ $peminjamans->where('status_peminjaman', 'Pending')->count() }}</div></td>
            <td><div class="label">Dipinjam</div><div class="value" style="color:#0043ce">{{ $peminjamans->where('status_peminjaman', 'Dipinjam')->count() }}</div></td>
            <td><div class="label">Menunggu</div><div class="value" style="color:#ff832b">{{ $peminjamans->where('status_peminjaman', 'Pending Dikembalikan')->count() }}</div></td>
        </tr>
    </table>
    <div class="section">
        <h2>Daftar Peminjaman</h2>
        @if ($peminjamans->count() > 0)
            <table class="data">
                <thead><tr><th>No</th><th>Peminjam</th><th>Judul Buku</th><th>Jml</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Disetujui Oleh</th></tr></thead>
                <tbody>
                    @foreach ($peminjamans as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->user->nama_lengkap ?? 'N/A' }}</td>
                            <td>{{ $p->buku->judul }}</td>
                            <td style="text-align:center">{{ $p->stok }}</td>
                            <td>{{ date('d/m/Y', strtotime($p->tanggal_peminjaman)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($p->tanggal_pengembalian)) }}</td>
                            <td>
                                @switch($p->status_peminjaman)
                                    @case('Pending') <span class="status-badge status-pending">Pending</span> @break
                                    @case('Dipinjam') <span class="status-badge status-borrowed">Dipinjam</span> @break
                                    @case('Pending Dikembalikan') <span class="status-badge status-waiting">Menunggu</span> @break
                                    @default <span class="status-badge" style="background-color:#666">{{ $p->status_peminjaman }}</span>
                                @endswitch
                            </td>
                            <td>{{ $p->approver->nama_lengkap ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color:#999;font-style:italic;">Belum ada data peminjaman.</p>
        @endif
    </div>
    <div class="footer"><p>&copy; {{ date('Y') }} Sistem Manajemen Perpustakaan</p></div>
</body>
</html>
