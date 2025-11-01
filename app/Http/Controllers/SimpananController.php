<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SimpananController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // 👑 Admin: bisa melihat semua data simpanan
            $simpanans = Simpanan::with('user')->latest()->get();
            return view('dashboard.simpanan', compact('simpanans'));
        } else {
            // 👤 Nasabah: hanya melihat simpanan miliknya
            $simpanans = Simpanan::where('user_id', $user->id)->latest()->get();
            return view('nasabah.simpanan', compact('simpanans'));
        }
    }

    public function create()
    {
        return view('simpanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $validated['user_id'] = auth()->id();
        Simpanan::create($validated);

        return redirect()->route('simpanans.index')->with('success', 'Data simpanan berhasil ditambahkan!');
    }
}

