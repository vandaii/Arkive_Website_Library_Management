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
            grid-template-columns: repeat(4, 1fr);
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

        .stat-card.pending .value {
            color: #f1c21b;
        }

        .stat-card.borrowed .value {
            color: #0043ce;
        }

        .stat-card.waiting .value {
            color: #ff832b;
        }

        .stat-card.returned .value {
            color: #24a148;
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
            min-width: 60px;
        }

        .status-pending {
            background-color: #f1c21b;
            color: #000;
        }

        .status-borrowed {
            background-color: #0043ce;
        }

        .status-waiting {
            background-color: #ff832b;
        }

        .status-returned {
            background-color: #24a148;
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

        <a class="print-button" style="text-decoration: none;" href="{{ route('reports.cetak.peminjaman', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank">📄 Cetak Laporan</a>
        <a class="print-button" style="text-decoration: none;" href="{{ route('admin.index') }}">Kembali</a>

        <div class="header">
            <h1>{{ $title }}</h1>
            <p>Data lengkap semua peminjaman buku</p>
        </div>

        @if ($startDate || $endDate)
            <div class="filter-info">
                <strong>Filter Tanggal:</strong>
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
                <h3>Total Peminjaman</h3>
                <div class="value">{{ $peminjamans->count() }}</div>
            </div>
            <div class="stat-card pending">
                <h3>Pending</h3>
                <div class="value">{{ $peminjamans->where('status_peminjaman', 'Pending')->count() }}</div>
            </div>
            <div class="stat-card borrowed">
                <h3>Dipinjam</h3>
                <div class="value">{{ $peminjamans->where('status_peminjaman', 'Dipinjam')->count() }}</div>
            </div>
            <div class="stat-card waiting">
                <h3>Pending Dikembalikan</h3>
                <div class="value">{{ $peminjamans->where('status_peminjaman', 'Pending Dikembalikan')->count() }}
                </div>
            </div>
        </div>

        <div class="section">
            <h2>📚 Daftar Peminjaman</h2>
            @if ($peminjamans->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Jumlah</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Disetujui Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamans as $index => $peminjaman)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $peminjaman->user->name ?? 'N/A' }}</td>
                                <td>{{ $peminjaman->buku->judul }}</td>
                                <td style="text-align: center;">{{ $peminjaman->stok }}</td>
                                <td>{{ date('d/m/Y', strtotime($peminjaman->tanggal_peminjaman)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($peminjaman->tanggal_pengembalian)) }}</td>
                                <td>
                                    @switch($peminjaman->status_peminjaman)
                                        @case('Pending')
                                            <span class="status-badge status-pending">Pending</span>
                                        @break

                                        @case('Dipinjam')
                                            <span class="status-badge status-borrowed">Dipinjam</span>
                                        @break

                                        @case('Pending Dikembalikan')
                                            <span class="status-badge status-waiting">Menunggu</span>
                                        @break

                                        @default
                                            <span class="status-badge"
                                                style="background-color: #666;">{{ $peminjaman->status_peminjaman }}</span>
                                    @endswitch
                                </td>
                                <td>{{ $peminjaman->approver->name ?? '-' }}</td>
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
