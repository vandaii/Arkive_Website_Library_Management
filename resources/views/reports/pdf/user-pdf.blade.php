<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data User</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; color: #333; line-height: 1.5; padding: 25px; font-size: 12px; }
        .header { text-align: center; border-bottom: 3px solid #4a70a9; padding-bottom: 12px; margin-bottom: 20px; }
        .header h1 { color: #4a70a9; font-size: 22px; margin-bottom: 3px; }
        .header p { color: #666; font-size: 11px; }
        .print-info { text-align: right; font-size: 10px; color: #999; margin-bottom: 15px; }
        .stats-row { width: 100%; margin-bottom: 20px; }
        .stats-row td { padding: 10px; border: 1px solid #ddd; text-align: center; background-color: #f9f9f9; }
        .stats-row .label { font-size: 11px; color: #4a70a9; text-transform: uppercase; font-weight: bold; }
        .stats-row .value { font-size: 22px; font-weight: bold; }
        .section h2 { color: #4a70a9; font-size: 15px; margin-bottom: 10px; border-bottom: 2px solid #8fabd4; padding-bottom: 5px; }
        table.data { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table.data thead { background-color: #4a70a9; color: white; }
        table.data th { padding: 8px; text-align: left; font-weight: 600; font-size: 11px; }
        table.data td { padding: 6px 8px; border-bottom: 1px solid #eee; font-size: 11px; }
        table.data tbody tr:nth-child(even) { background-color: #f5f5f5; }
        .role-badge { display: inline-block; padding: 2px 8px; border-radius: 3px; font-size: 10px; font-weight: bold; color: white; text-transform: capitalize; }
        .role-peminjam { background-color: #0043ce; }
        .role-admin { background-color: #24a148; }
        .role-petugas { background-color: #ff832b; }
        .footer { margin-top: 30px; text-align: center; color: #999; font-size: 10px; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="print-info">Dicetak pada: {{ now('Asia/Jakarta')->format('d/m/Y H:i') }}</div>
    <div class="header">
        <h1>Laporan Data Peminjam</h1>
        <p>Data lengkap semua peminjam dalam sistem</p>
    </div>
    <table class="stats-row">
        <tr>
            <td><div class="label">Total Peminjam</div><div class="value">{{ $users->count() }}</div></td>
        </tr>
    </table>
    <div class="section">
        <h2>Daftar Peminjam</h2>
        @if ($users->count() > 0)
            <table class="data">
                <thead><tr><th>No</th><th>Nama Lengkap</th><th>Username</th><th>Email</th><th>Alamat</th><th>Role</th></tr></thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $user->nama_lengkap }}</strong></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->alamat ?? '-' }}</td>
                            <td>
                                <span class="role-badge role-{{ $user->role }}">{{ $user->role }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color:#999;font-style:italic;">Belum ada data user.</p>
        @endif
    </div>
    <div class="footer"><p>&copy; {{ date('Y') }} Sistem Manajemen Perpustakaan</p></div>
</body>
</html>
