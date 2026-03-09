<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #4a70a9;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #4a70a9;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .print-info {
            text-align: right;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .stat-card h3 {
            color: #4a70a9;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .stat-card.danger .value {
            color: #d32f2f;
        }

        .stat-card.success .value {
            color: #24a148;
        }

        .stat-card.warning .value {
            color: #f1c21b;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            color: #4a70a9;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid #8fabd4;
            padding-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table thead {
            background-color: #4a70a9;
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        table tbody tr:hover {
            background-color: #eef3f8;
        }

        .popular-books {
            list-style: none;
        }

        .popular-books li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .popular-books li:last-child {
            border-bottom: none;
        }

        .popular-books li:before {
            content: "📚 ";
            margin-right: 8px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #999;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .print-button {
            background-color: #4a70a9;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .print-button:hover {
            background-color: #3a5a89;
        }

        @media print {

            .print-button,
            .print-info {
                display: none;
            }

            body {
                padding: 0;
            }

            .header {
                page-break-after: avoid;
            }

            .section {
                page-break-inside: avoid;
            }

            table {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="print-info">
            Dicetak pada: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}
        </div>

        <button class="print-button" onclick="window.print()">📄 Cetak Laporan</button>
        <a class="print-button" style="text-decoration: none;" href="{{ route('admin.index') }}">Kembali</a>

        <div class="header">
            <h1>{{ $title }}</h1>
            <p>Ringkasan Statistik Sistem Perpustakaan</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Buku</h3>
                <div class="value">{{ $totalBuku }}</div>
            </div>
            <div class="stat-card">
                <h3>Buku Tersedia</h3>
                <div class="value success">{{ $bukuTersedia }}</div>
            </div>
            <div class="stat-card">
                <h3>Buku Habis</h3>
                <div class="value danger">{{ $bukuHabis }}</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Peminjaman</h3>
                <div class="value">{{ $totalPeminjaman }}</div>
            </div>
            <div class="stat-card">
                <h3>Peminjaman Aktif</h3>
                <div class="value warning">{{ $peminjamanAktif }}</div>
            </div>
            <div class="stat-card">
                <h3>Terlambat</h3>
                <div class="value danger">{{ $terlambat }}</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card danger">
                <h3>Total Denda</h3>
                <div class="value">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="section">
            <h2>📚 Buku Paling Banyak Dipinjam</h2>
            @if ($bukuPopuler->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Jumlah Peminjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukuPopuler as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->buku->judul }}</td>
                                <td>{{ $item->buku->penulis }}</td>
                                <td><strong>{{ $item->total }}</strong> kali</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #999; font-style: italic;">Belum ada data peminjaman.</p>
            @endif
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Sistem Manajemen Perpustakaan</p>
        </div>
    </div>
</body>

</html>
