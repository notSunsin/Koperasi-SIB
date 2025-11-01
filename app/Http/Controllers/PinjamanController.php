<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    /**
     * Tampilkan daftar pinjaman sesuai role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // 👑 Admin melihat semua data pinjaman
            $pinjamans = Pinjaman::with('user')->latest()->get();
            return view('dashboard.pinjaman', compact('pinjamans'));
        } else {
            // 👤 Nasabah hanya melihat pinjaman miliknya
            $pinjamans = Pinjaman::where('user_id', $user->id)->latest()->get();
            return view('nasabah.pinjaman', compact('pinjamans'));
        }
    }

    /**
     * Form tambah pinjaman (hanya admin)
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('dashboard.pinjaman-create');
    }

    /**
     * Simpan data pinjaman baru (hanya admin)
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kode' => 'required|unique:pinjamans,kode',
            'uraian' => 'required|string|max:255',
            'kredit' => 'required|numeric|min:0',
            'saldo' => 'required|numeric|min:0',
        ]);

        Pinjaman::create($validated);

        return redirect()->route('dashboard.pinjaman')->with('success', 'Data pinjaman berhasil ditambahkan!');
    }
}
