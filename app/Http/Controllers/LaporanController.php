<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter bulan (default: bulan ini)
        $filter = $request->get('filter', 'bulan_ini');
        $query = Laporan::with('user')->orderBy('created_at', 'desc');

        if ($filter === 'bulan_ini') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter === '1_bulan_terakhir') {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        }

        $laporans = $query->get();

        return view('dashboard.laporan', compact('laporans', 'filter'));
    }

    public function download(Request $request)
    {
        $filter = $request->get('filter', 'bulan_ini');
        $query = Laporan::with('user')->orderBy('created_at', 'desc');

        if ($filter === 'bulan_ini') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter === '1_bulan_terakhir') {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        }

        $laporans = $query->get();

        $pdf = Pdf::loadView('dashboard.laporan-pdf', [
            'laporans' => $laporans,
            'filter' => $filter,
            'tanggal' => now()->translatedFormat('d F Y'),
        ]);

        return $pdf->download('laporan_keuangan_' . now()->format('Ymd_His') . '.pdf');
    }
}
