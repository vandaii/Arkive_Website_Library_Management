<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Peminjaman</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            padding: 30px;
            font-size: 13px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #4a70a9;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h1 {
            color: #4a70a9;
            font-size: 22px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 12px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 25px;
        }

        .info-table td {
            padding: 6px 10px;
            vertical-align: top;
        }

        .info-table .label {
            font-weight: bold;
            width: 200px;
            color: #555;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
            background-color: #0043ce;
        }

        .divider {
            border-top: 1px dashed #ccc;
            margin: 20px 0;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #999;
            font-size: 11px;
        }

        .signature-area {
            margin-top: 50px;
            width: 100%;
        }

        .signature-area td {
            text-align: center;
            padding: 10px 20px;
            vertical-align: top;
        }

        .signature-line {
            border-top: 1px solid #333;
            display: inline-block;
            width: 150px;
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>BUKTI PEMINJAMAN BUKU</h1>
        <p>Sistem Manajemen Perpustakaan</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">No. Peminjaman</td>
            <td>: #{{ str_pad($peminjaman->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Cetak</td>
            <td>: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <h3 style="color: #4a70a9; margin-bottom: 10px;">Data Peminjam</h3>
    <table class="info-table">
        <tr>
            <td class="label">Nama Lengkap</td>
            <td>: {{ $peminjaman->user->nama_lengkap ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Username</td>
            <td>: {{ $peminjaman->user->username ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Email</td>
            <td>: {{ $peminjaman->user->email ?? '-' }}</td>
        </tr>
    </table>

    <h3 style="color: #4a70a9; margin-bottom: 10px;">Data Buku</h3>
    <table class="info-table">
        <tr>
            <td class="label">Judul Buku</td>
            <td>: {{ $peminjaman->buku->judul }}</td>
        </tr>
        <tr>
            <td class="label">Penulis</td>
            <td>: {{ $peminjaman->buku->penulis }}</td>
        </tr>
        <tr>
            <td class="label">Penerbit</td>
            <td>: {{ $peminjaman->buku->penerbit }}</td>
        </tr>
        <tr>
            <td class="label">Jumlah Buku</td>
            <td>: {{ $peminjaman->stok }} eksemplar</td>
        </tr>
    </table>

    <h3 style="color: #4a70a9; margin-bottom: 10px;">Detail Peminjaman</h3>
    <table class="info-table">
        <tr>
            <td class="label">Tanggal Peminjaman</td>
            <td>: {{ date('d/m/Y', strtotime($peminjaman->tanggal_peminjaman)) }}</td>
        </tr>
        <tr>
            <td class="label">Estimasi Tanggal Kembali</td>
            <td>: {{ date('d/m/Y', strtotime($peminjaman->tanggal_pengembalian)) }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>: <span class="status-badge">{{ $peminjaman->status_peminjaman }}</span></td>
        </tr>
        @if ($peminjaman->approver)
            <tr>
                <td class="label">Disetujui Oleh</td>
                <td>: {{ $peminjaman->approver->nama_lengkap }}</td>
            </tr>
        @endif
    </table>

    <table class="signature-area">
        <tr>
            <td>
                <p>Peminjam</p>
                <div class="signature-line"></div>
                <p>{{ $peminjaman->user->nama_lengkap ?? '-' }}</p>
            </td>
            <td>
                <p>Petugas</p>
                <div class="signature-line"></div>
                <p>{{ $peminjaman->approver->nama_lengkap ?? '________________' }}</p>
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Sistem Manajemen Perpustakaan</p>
    </div>
</body>

</html>
