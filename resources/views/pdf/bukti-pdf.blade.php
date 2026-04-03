<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bukti {{ $tipe }} - Arkive</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a1a1a;
            font-size: 13px;
            line-height: 1.6;
        }
        .container {
            padding: 40px 50px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #4a70a9;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header-left {
            float: left;
        }
        .header-right {
            float: right;
            text-align: right;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #3b5d8d;
            letter-spacing: 1px;
        }
        .logo-img {
            height: 35px;
            width: auto;
            vertical-align: middle;
            margin-top: -5px;
            margin-right: 10px;
        }
        .subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }
        .doc-type {
            font-size: 20px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 4px;
        }
        .doc-date {
            font-size: 11px;
            color: #6b7280;
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
        .section {
            margin-bottom: 28px;
        }
        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #4a70a9;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 4px;
            padding-bottom: 4px;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-grid {
            width: 100%;
        }
        .info-grid td {
            padding: 5px 0;
            vertical-align: top;
        }
        .info-label {
            color: #6b7280;
            font-size: 12px;
            width: 200px;
        }
        .info-value {
            font-weight: 600;
            font-size: 13px;
            color: #1a1a1a;
        }
        .book-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 6px 20px;
        }
        .book-title {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 4px;
        }
        .book-author {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        .book-meta {
            font-size: 11px;
            color: #9ca3af;
        }
        .status-badge {
            display: inline-block;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }
        .status-pending { color: #f59e0b; }
        .status-dipinjam { color: #3b82f6; }
        .status-pending-kembali { color: #8b5cf6; }
        .status-dikembalikan { color: #10b981; }
        .status-terlambat { color: #ef4444; }
        .status-ditolak { color: #6b7280; }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #9ca3af;
            font-size: 10px;
        }
        .two-col {
            width: 100%;
        }
        .two-col td {
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <div class="header clearfix">
            <div class="header-left">
                <div class="logo">
                    <img class="logo-img" src="{{ public_path('img/logo-arkive.png') }}">
                    <span style="display: inline-block; vertical-align: middle;">Arkive</span>
                </div>
                <div class="subtitle">Sistem Manajemen Perpustakaan</div>
            </div>
            <div class="header-right">
                <div class="doc-type">Bukti {{ $tipe }}</div>
                <div class="doc-date">Dicetak: {{ $tanggal_cetak }}</div>
                <div class="doc-date">No: #{{ str_pad($peminjaman->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        {{-- Info Peminjam & Pinjaman --}}
        <table class="two-col">
            <tr>
                <td>
                    <div class="section">
                        <div class="section-title">Informasi Peminjam</div>
                        <table class="info-grid">
                            <tr>
                                <td class="info-label">Nama Lengkap</td>
                                <td class="info-value">{{ $peminjaman->user->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="info-label">Email</td>
                                <td class="info-value">{{ $peminjaman->user->email }}</td>
                            </tr>
                            <tr>
                                <td class="info-label">No. Handphone</td>
                                <td class="info-value">{{ $peminjaman->user->phone_number }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td>
                    <div class="section">
                        <div class="section-title">Informasi {{ $tipe }}</div>
                        <table class="info-grid">
                            <tr>
                                <td class="info-label">Tanggal Peminjaman</td>
                                <td class="info-value">{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="info-label">Est. Pengembalian</td>
                                <td class="info-value">{{ \Carbon\Carbon::parse($peminjaman->estimasi_tanggal_pengembalian)->format('d F Y') }}</td>
                            </tr>
                            @if ($peminjaman->tanggal_pengembalian)
                            <tr>
                                <td class="info-label">Tanggal Pengembalian</td>
                                <td class="info-value">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d F Y') }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td class="info-label">Status</td>
                                <td class="info-value">
                                    @php
                                        $statusClass = match($peminjaman->status_peminjaman) {
                                            'Pending' => 'status-pending',
                                            'Dipinjam' => 'status-dipinjam',
                                            'Pending Dikembalikan' => 'status-pending-kembali',
                                            'Dikembalikan' => 'status-dikembalikan',
                                            'Terlambat' => 'status-terlambat',
                                            'Ditolak' => 'status-ditolak',
                                            default => 'status-pending'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">{{ $peminjaman->status_peminjaman }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Detail Buku --}}
        <div class="section">
            <div class="section-title">Detail Buku</div>
            <div class="book-card">
                <div class="book-title">{{ $peminjaman->buku->judul }}</div>
                <div class="book-author">{{ $peminjaman->buku->penulis }}</div>
                <div class="book-meta">
                    Penerbit: {{ $peminjaman->buku->penerbit }} &bull;
                    ISBN: {{ $peminjaman->buku->isbn_number }} &bull;
                    Tahun: {{ $peminjaman->buku->tahun_terbit }}
                </div>
            </div>
        </div>

        @if ($peminjaman->notes)
        <div class="section">
            <div class="section-title">Catatan</div>
            <p>{{ $peminjaman->notes }}</p>
        </div>
        @endif

        {{-- Footer --}}
        <div class="footer">
            <p>Dokumen ini digenerate secara otomatis oleh sistem Arkive.</p>
            <p>© {{ date('Y') }} Arkive — Sistem Manajemen Perpustakaan</p>
        </div>
    </div>
</body>
</html>
