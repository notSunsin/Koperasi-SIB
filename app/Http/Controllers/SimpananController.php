<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = $user->role === 'admin' ? Simpanan::all() : $user->simpanan;
        return view('simpanan.index', compact('data'));
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

