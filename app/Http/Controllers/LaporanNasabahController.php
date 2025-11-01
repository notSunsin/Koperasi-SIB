<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanNasabahController extends Controller
{
    /**
     * Menampilkan laporan milik nasabah yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua laporan milik nasabah
        $laporans = Laporan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('nasabah.laporan', compact('laporans'));
    }

    /**
     * Download laporan pribadi nasabah sebagai PDF.
     */
    public function download()
    {
        $user = Auth::user();

        $laporans = Laporan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('nasabah.laporan-pdf', [
            'laporans' => $laporans,
            'user' => $user,
            'tanggal' => now()->translatedFormat('d F Y'),
        ]);

        return $pdf->download('laporan_keuangan_' . $user->name . '.pdf');
    }
}
