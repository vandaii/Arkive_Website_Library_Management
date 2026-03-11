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
            color: #999;
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

        .stat-card.success .value {
            color: #24a148;
        }

        .stat-card.danger .value {
            color: #d32f2f;
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
            font-size: 13px;
        }

        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        table tbody tr:hover {
            background-color: #eef3f8;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .status-available {
            background-color: #24a148;
        }

        .status-unavailable {
            background-color: #d32f2f;
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

        <a class="print-button" style="text-decoration: none;" href="{{ route('reports.cetak.buku') }}" target="_blank">📄 Cetak Laporan</a>
        <a class="print-button" style="text-decoration: none;" href="{{ route('admin.index') }}">Kembali</a>

        <div class="header">
            <h1>{{ $title }}</h1>
            <p>Data lengkap semua buku dalam sistem</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Buku</h3>
                <div class="value">{{ $bukus->count() }}</div>
            </div>
            <div class="stat-card success">
                <h3>Buku Tersedia</h3>
                <div class="value">{{ $bukus->where('stok', '>', 0)->count() }}</div>
            </div>
            <div class="stat-card danger">
                <h3>Buku Habis</h3>
                <div class="value">{{ $bukus->where('stok', '<=', 0)->count() }}</div>
            </div>
        </div>

        <div class="section">
            <h2>📚 Daftar Buku</h2>
            @if ($bukus->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
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

        <div class="footer">
            <p>© {{ date('Y') }} Sistem Manajemen Perpustakaan</p>
        </div>
    </div>
</body>

</html>
