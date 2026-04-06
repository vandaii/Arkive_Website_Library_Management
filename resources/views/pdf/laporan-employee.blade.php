<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Petugas - Arkive</title>
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
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: 600; }
        .badge-admin { background: #dbeafe; color: #1e40af; }
        .badge-petugas { background: #d1fae5; color: #065f46; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; text-align: center; color: #9ca3af; font-size: 9px; }
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
                <div class="doc-type">Laporan Data Petugas</div>
                <div class="doc-date">Dicetak: {{ $tanggal }}</div>
                <div class="doc-date">Total: {{ $users->count() }} petugas</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="text-center" style="width: 30px;">No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. Handphone</th>
                    <th class="text-center">Posisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $i => $user)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td><strong>{{ $user->nama_lengkap }}</strong></td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge {{ $user->role == 'Admin' ? 'badge-admin' : 'badge-petugas' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>Dokumen ini digenerate secara otomatis oleh sistem Arkive.</p>
            <p>© {{ date('Y') }} Arkive — Sistem Manajemen Perpustakaan</p>
        </div>
    </div>
</body>
</html>
