<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class SimpananAdminController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::with('user')->latest()->get();
        return view('dashboard.simpanan', compact('simpanans'));
    }

    public function create()
    {
        $nasabahs = User::where('role', 'nasabah')->get();
        return view('dashboard.simpanan-tambah', compact('nasabahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uraian' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'debit' => 'required|numeric|min:0',
        ]);

        // ✅ Buat kode otomatis
        $lastSimpanan = Simpanan::orderBy('id', 'desc')->first();
        if ($lastSimpanan && preg_match('/SP-(\d+)/', $lastSimpanan->kode, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
        } else {
            $nextNumber = 1;
        }
        $kodeBaru = 'SP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // ✅ Ambil saldo terakhir dari laporan
        $saldoSebelumnya = Laporan::latest('id')->value('saldo') ?? 0;
        $saldoBaru = $saldoSebelumnya + $request->debit;

        // ✅ Simpan ke tabel simpanans
        $simpanan = Simpanan::create([
            'kode' => $kodeBaru,
            'user_id' => $request->user_id,
            'uraian' => $request->uraian,
            'debit' => $request->debit,
            'saldo' => $saldoBaru,
        ]);

        // ✅ Buat entri di laporan
        Laporan::create([
            'kode' => $kodeBaru,
            'user_id' => $request->user_id,
            'uraian' => 'Simpanan: ' . $request->uraian,
            'debit' => $request->debit,
            'kredit' => 0,
            'saldo' => $saldoBaru,
        ]);

        return redirect()->route('dashboard.simpanan')->with('success', "Simpanan {$kodeBaru} berhasil ditambahkan.");
    }

    public function edit(Simpanan $simpanan)
    {
        $nasabahs = User::where('role', 'nasabah')->get();
        return view('dashboard.simpanan-edit', compact('simpanan', 'nasabahs'));
    }

    public function update(Request $request, Simpanan $simpanan)
    {
        $request->validate([
            'uraian' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'debit' => 'required|numeric|min:0',
        ]);

        $simpanan->update([
            'user_id' => $request->user_id,
            'uraian' => $request->uraian,
            'debit' => $request->debit,
        ]);

        // ✅ update laporan
        $laporan = Laporan::where('kode', $simpanan->kode)->first();
        if ($laporan) {
            $laporan->update([
                'uraian' => 'Simpanan: ' . $request->uraian,
                'debit' => $request->debit,
                'user_id' => $request->user_id,
            ]);
        }

        return redirect()->route('dashboard.simpanan')->with('success', 'Data simpanan berhasil diperbarui.');
    }

    public function destroy(Simpanan $simpanan)
    {
        Laporan::where('kode', $simpanan->kode)->delete();
        $simpanan->delete();

        return redirect()->route('dashboard.simpanan')->with('success', 'Data simpanan berhasil dihapus.');
    }
}
