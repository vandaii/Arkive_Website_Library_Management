<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Peminjaman - Arkive</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #1a1a1a; font-size: 11px; line-height: 1.5; }
        .container { padding: 30px 40px; }
        .header { border-bottom: 3px solid #4a70a9; padding-bottom: 15px; margin-bottom: 20px; }
        .header::after { content: ""; display: table; clear: both; }
        .header-left { float: left; }
        .header-right { float: right; text-align: right; }
        .logo { font-size: 24px; font-weight: bold; color: #4a70a9; letter-spacing: 1px; }
        .subtitle { font-size: 10px; color: #6b7280; margin-top: 2px; }
        .doc-type { font-size: 16px; font-weight: bold; color: #1a1a1a; margin-bottom: 2px; }
        .doc-date { font-size: 10px; color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #4a70a9; color: white; padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; }
        td { padding: 7px 10px; border-bottom: 1px solid #e5e7eb; font-size: 11px; }
        tr:nth-child(even) { background: #f9fafb; }
        .text-center { text-align: center; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 9px; font-weight: 600; }
        .badge-dipinjam { background: #dbeafe; color: #1e40af; }
        .badge-dikembalikan { background: #d1fae5; color: #065f46; }
        .badge-terlambat { background: #fee2e2; color: #991b1b; }
        .badge-ditolak { background: #f3f4f6; color: #4b5563; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; text-align: center; color: #9ca3af; font-size: 9px; }
        .summary { margin-top: 15px; font-size: 11px; color: #4b5563; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <div class="logo">Arkive</div>
                <div class="subtitle">Sistem Manajemen Perpustakaan</div>
            </div>
            <div class="header-right">
                <div class="doc-type">Laporan Data Peminjaman</div>
                <div class="doc-date">Dicetak: {{ $tanggal }}</div>
                <div class="doc-date">Total: {{ $peminjamans->count() }} data</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">No</th>
                    <th>Judul Buku</th>
                    <th>Peminjam</th>
                    <th class="text-center">Tgl Pinjam</th>
                    <th class="text-center">Est. Kembali</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $i => $p)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td><strong>{{ $p->buku->judul }}</strong></td>
                        <td>{{ $p->user->nama_lengkap }}</td>
                        <td class="text-center">{{ $p->tanggal_peminjaman }}</td>
                        <td class="text-center">{{ $p->estimasi_tanggal_pengembalian ?? $p->tanggal_pengembalian ?? '-' }}</td>
                        <td class="text-center">{{ $p->stok }}</td>
                        <td class="text-center">
                            @php
                                $cls = match($p->status_peminjaman) {
                                    'Dipinjam' => 'badge-dipinjam',
                                    'Dikembalikan' => 'badge-dikembalikan',
                                    'Terlambat' => 'badge-terlambat',
                                    'Ditolak' => 'badge-ditolak',
                                    default => 'badge-dipinjam'
                                };
                            @endphp
                            <span class="badge {{ $cls }}">{{ $p->status_peminjaman }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <p>Dipinjam: <strong>{{ $peminjamans->where('status_peminjaman', 'Dipinjam')->count() }}</strong> |
               Dikembalikan: <strong>{{ $peminjamans->where('status_peminjaman', 'Dikembalikan')->count() }}</strong> |
               Terlambat: <strong>{{ $peminjamans->where('status_peminjaman', 'Terlambat')->count() }}</strong> |
               Ditolak: <strong>{{ $peminjamans->where('status_peminjaman', 'Ditolak')->count() }}</strong>
            </p>
        </div>

        <div class="footer">
            <p>Dokumen ini digenerate secara otomatis oleh sistem Arkive.</p>
            <p>© {{ date('Y') }} Arkive — Sistem Manajemen Perpustakaan</p>
        </div>
    </div>
</body>
</html>
