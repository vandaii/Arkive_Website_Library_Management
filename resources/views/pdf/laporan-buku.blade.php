<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Buku - Arkive</title>
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
        .text-right { text-align: right; }
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
                <div class="doc-type">Laporan Data Buku</div>
                <div class="doc-date">Dicetak: {{ $tanggal }}</div>
                <div class="doc-date">Total: {{ $books->count() }} buku</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $i => $book)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td><strong>{{ $book->judul }}</strong></td>
                        <td>{{ $book->penulis }}</td>
                        <td>{{ $book->penerbit }}</td>
                        <td>{{ $book->kategoriBukuRelasi->pluck('kategori.nama_kategori')->filter()->implode(', ') ?: '-' }}</td>
                        <td class="text-center">{{ $book->tahun_terbit }}</td>
                        <td class="text-center">{{ $book->stok }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <p>Total Koleksi Buku: <strong>{{ $books->count() }}</strong> | Total Stok: <strong>{{ $books->sum('stok') }}</strong></p>
        </div>

        <div class="footer">
            <p>Dokumen ini digenerate secara otomatis oleh sistem Arkive.</p>
            <p>© {{ date('Y') }} Arkive — Sistem Manajemen Perpustakaan</p>
        </div>
    </div>
</body>
</html>
