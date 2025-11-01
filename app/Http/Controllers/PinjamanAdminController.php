<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class PinjamanAdminController extends Controller
{
    public function index()
    {
        $pinjamans = Pinjaman::with('user')->orderBy('created_at', 'desc')->get();
        return view('dashboard.pinjaman', compact('pinjamans'));
    }

    public function create()
    {
        $nasabahs = User::where('role', 'nasabah')->get();
        return view('dashboard.pinjaman-tambah', compact('nasabahs'));
    }

public function store(Request $request)
{
    $request->validate([
        'uraian' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
        'kredit' => 'required|numeric|min:0',
    ]);

    // ✅ Buat kode otomatis (PJ-001, PJ-002, dst)
    $lastPinjaman = \App\Models\Pinjaman::orderBy('id', 'desc')->first();
    if ($lastPinjaman && preg_match('/PJ-(\d+)/', $lastPinjaman->kode, $matches)) {
        $nextNumber = (int)$matches[1] + 1;
    } else {
        $nextNumber = 1;
    }
    $kodeBaru = 'PJ-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    // ✅ Ambil saldo terakhir laporan
    $saldoSebelumnya = \App\Models\Laporan::latest('id')->value('saldo') ?? 0;
    $saldoBaru = $saldoSebelumnya + $request->kredit;

    // ✅ Simpan ke tabel pinjamans
    $pinjaman = \App\Models\Pinjaman::create([
        'kode' => $kodeBaru,
        'user_id' => $request->user_id,
        'uraian' => $request->uraian,
        'kredit' => $request->kredit,
        'saldo' => $saldoBaru,
    ]);

    // ✅ Buat juga laporan otomatis dengan saldo yang sama
    \App\Models\Laporan::create([
        'kode' => $kodeBaru,
        'uraian' => 'Pinjaman: ' . $request->uraian,
        'debit' => 0,
        'kredit' => $request->kredit,
        'saldo' => $saldoBaru,
        'user_id' => $request->user_id,
    ]);

    return redirect()->route('dashboard.pinjaman')->with('success', "Pinjaman {$kodeBaru} berhasil ditambahkan dan dicatat di laporan.");
}



    public function edit(Pinjaman $pinjaman)
    {
        $nasabahs = User::where('role', 'nasabah')->get();
        return view('dashboard.pinjaman-edit', compact('pinjaman', 'nasabahs'));
    }

 public function update(Request $request, Pinjaman $pinjaman)
{
    $request->validate([
        'uraian' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
        'kredit' => 'required|numeric|min:0',
    ]);

    $pinjaman->update([
        'user_id' => $request->user_id,
        'uraian' => $request->uraian,
        'kredit' => $request->kredit,
    ]);

    // ✅ Update laporan agar tetap sinkron
    $laporan = Laporan::where('kode', $pinjaman->kode)->first();
    if ($laporan) {
        $laporan->update([
            'uraian' => 'Pinjaman: ' . $request->uraian,
            'kredit' => $request->kredit,
            'user_id' => $request->user_id,
        ]);
    }

    return redirect()->route('dashboard.pinjaman')->with('success', 'Data pinjaman & laporan berhasil diperbarui.');
}


 public function destroy(Pinjaman $pinjaman)
{
    // Hapus laporan yang memiliki kode sama
    Laporan::where('kode', $pinjaman->kode)->delete();

    $pinjaman->delete();

    return redirect()->route('dashboard.pinjaman')->with('success', 'Data pinjaman & laporan berhasil dihapus.');
}

}
