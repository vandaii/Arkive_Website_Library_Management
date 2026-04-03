<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class BuktiController extends Controller
{
    private function getBuktiData($id)
    {
        $peminjaman = Peminjaman::with('buku', 'user')->findOrFail($id);

        $isReturn = in_array($peminjaman->status_peminjaman, [
            'Pending Dikembalikan',
            'Dikembalikan',
            'Terlambat'
        ]);

        return [
            'peminjaman' => $peminjaman,
            'tipe' => $isReturn ? 'Pengembalian' : 'Peminjaman',
            'tanggal_cetak' => now()->format('d F Y'),
        ];
    }

    public function cetak($id)
    {
        $data = $this->getBuktiData($id);

        $pdf = Pdf::loadView('pdf.bukti-pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream("bukti-{$data['tipe']}-{$id}.pdf");
    }

    public function download($id)
    {
        $data = $this->getBuktiData($id);

        $pdf = Pdf::loadView('pdf.bukti-pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download("bukti-{$data['tipe']}-{$id}.pdf");
    }
}
