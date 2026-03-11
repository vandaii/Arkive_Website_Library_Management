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
            max-width: 1400px;
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

        .filter-info {
            background-color: #f5f5f5;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
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
            font-size: 13px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .stat-card .value {
            font-size: 28px;
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
            font-size: 12px;
        }

        table thead {
            background-color: #4a70a9;
            color: white;
        }

        table th {
            padding: 10px;
            text-align: left;
            font-weight: 600;
        }

        table td {
            padding: 8px 10px;
            border-bottom: 1px solid #eee;
        }

        table tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        table tbody tr:hover {
            background-color: #eef3f8;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
            color: white;
            text-align: center;
            min-width: 70px;
        }

        .status-returned {
            background-color: #24a148;
        }

        .status-late {
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

        .no-data {
            color: #999;
            font-style: italic;
            text-align: center;
            padding: 20px;
        }

        @media print {

            .print-button,
            .print-info,
            .filter-info {
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
                page-break-inside: auto;
            }

            table tr {
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

        <a class="print-button" style="text-decoration: none;" href="{{ route('reports.cetak.pengembalian', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank">📄 Cetak Laporan</a>
        <a class="print-button" style="text-decoration: none;" href="{{ route('admin.index') }}">Kembali</a>

        <div class="header">
            <h1>{{ $title }}</h1>
            <p>Data lengkap semua pengembalian buku</p>
        </div>

        @if ($startDate || $endDate)
            <div class="filter-info">
                <strong>Filter Tanggal Pengembalian:</strong>
                @if ($startDate)
                    Dari {{ date('d/m/Y', strtotime($startDate)) }}
                @endif
                @if ($startDate && $endDate)
                    hingga
                @endif
                @if ($endDate)
                    {{ date('d/m/Y', strtotime($endDate)) }}
                @endif
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Pengembalian</h3>
                <div class="value">{{ $pengembalians->count() }}</div>
            </div>
            <div class="stat-card success">
                <h3>Tepat Waktu</h3>
                <div class="value">{{ $pengembalians->where('status_peminjaman', 'Dikembalikan')->count() }}</div>
            </div>
            <div class="stat-card danger">
                <h3>Terlambat</h3>
                <div class="value">{{ $terlambatCount }}</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card danger">
                <h3>Total Denda</h3>
                <div class="value">{{ 'Rp ' . number_format($totalDenda, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="section">
            <h2>📚 Daftar Pengembalian Buku</h2>
            @if ($pengembalians->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Jumlah</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tgl Kembali (Estimasi)</th>
                            <th>Tgl Kembali (Aktual)</th>
                            <th>Status</th>
                            <th>Denda (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalians as $index => $pengembalian)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pengembalian->user->name ?? 'N/A' }}</td>
                                <td>{{ $pengembalian->buku->judul }}</td>
                                <td style="text-align: center;">{{ $pengembalian->stok }}</td>
                                <td>{{ date('d/m/Y', strtotime($pengembalian->tanggal_peminjaman)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($pengembalian->tanggal_pengembalian)) }}</td>
                                <td>{{ $pengembalian->tanggal_pengembalian_aktual ? date('d/m/Y', strtotime($pengembalian->tanggal_pengembalian_aktual)) : '-' }}
                                </td>
                                <td>
                                    @if ($pengembalian->status_peminjaman === 'Dikembalikan')
                                        <span class="status-badge status-returned">Dikembalikan</span>
                                    @elseif($pengembalian->status_peminjaman === 'Terlambat')
                                        <span class="status-badge status-late">Terlambat</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    @if ($pengembalian->denda > 0)
                                        <strong>{{ number_format($pengembalian->denda, 0, ',', '.') }}</strong>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="no-data">Belum ada data pengembalian.</p>
            @endif
        </div>

        <div class="section">
            <h2>💰 Ringkasan Denda</h2>
            <table>
                <tr>
                    <td style="padding: 15px; width: 70%;">
                        <strong style="font-size: 14px;">Total Denda dari {{ $pengembalians->count() }}
                            Pengembalian:</strong>
                    </td>
                    <td style="text-align: right; padding: 15px; font-size: 18px; font-weight: bold; color: #d32f2f;">
                        Rp {{ number_format($totalDenda, 0, ',', '.') }}
                    </td>
                </tr>
                <tr style="background-color: #f5f5f5;">
                    <td style="padding: 15px; width: 70%;">
                        <strong style="font-size: 14px;">Jumlah Pengembalian Terlambat:</strong>
                    </td>
                    <td style="text-align: right; padding: 15px; font-size: 18px; font-weight: bold; color: #d32f2f;">
                        {{ $terlambatCount }} Buku
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Sistem Manajemen Perpustakaan</p>
        </div>
    </div>
</body>

</html>
