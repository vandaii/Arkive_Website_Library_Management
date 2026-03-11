<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; color: #333; line-height: 1.6; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 3px solid #4a70a9; padding-bottom: 15px; margin-bottom: 30px; }
        .header h1 { color: #4a70a9; font-size: 28px; margin-bottom: 5px; }
        .header p { color: #666; font-size: 14px; }
        .print-info { text-align: right; font-size: 12px; color: #999; margin-bottom: 20px; }
        .stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { border: 1px solid #ddd; border-radius: 8px; padding: 15px; background-color: #f9f9f9; }
        .stat-card h3 { color: #4a70a9; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; }
        .stat-card .value { font-size: 32px; font-weight: bold; color: #333; }
        .section { margin-bottom: 30px; }
        .section h2 { color: #4a70a9; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid #8fabd4; padding-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table thead { background-color: #4a70a9; color: white; }
        table th { padding: 12px; text-align: left; font-weight: 600; font-size: 13px; }
        table td { padding: 10px 12px; border-bottom: 1px solid #eee; font-size: 13px; }
        table tbody tr:nth-child(even) { background-color: #f5f5f5; }
        table tbody tr:hover { background-color: #eef3f8; }
        .role-badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; color: white; text-transform: capitalize; }
        .role-peminjam { background-color: #0043ce; }
        .role-admin { background-color: #24a148; }
        .role-petugas { background-color: #ff832b; }
        .footer { margin-top: 40px; text-align: center; color: #999; font-size: 12px; border-top: 1px solid #ddd; padding-top: 15px; }
        .print-button { background-color: #4a70a9; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px; margin-bottom: 20px; text-decoration: none; display: inline-block; }
        .print-button:hover { background-color: #3a5a89; }
        @media print { .print-button, .print-info { display: none; } body { padding: 0; } }
    </style>
</head>

<body>
    <div class="container">
        <div class="print-info">
            Dicetak pada: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}
        </div>

        <a class="print-button" href="{{ route('reports.cetak.user') }}" target="_blank">📄 Cetak Laporan</a>
        <a class="print-button" href="{{ route('admin.index') }}">Kembali</a>

        <div class="header">
            <h1>{{ $title }}</h1>
            <p>Data lengkap semua peminjam dalam sistem</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Peminjam</h3>
                <div class="value">{{ $users->count() }}</div>
            </div>
        </div>

        <div class="section">
            <h2>👤 Daftar Peminjam</h2>
            @if ($users->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $user->nama_lengkap }}</strong></td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->alamat ?? '-' }}</td>
                                <td><span class="role-badge role-{{ $user->role }}">{{ $user->role }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #999; font-style: italic;">Belum ada data user.</p>
            @endif
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistem Manajemen Perpustakaan</p>
        </div>
    </div>
</body>

</html>
