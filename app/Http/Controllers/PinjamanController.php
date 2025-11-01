<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = $user->role === 'admin' ? Pinjaman::all() : $user->pinjaman;
        return view('pinjaman.index', compact('data'));

        $pinjaman = Pinjaman::where('user_id', auth()->id())->get();
        return view('nasabah.pinjaman', compact('pinjaman'));
    }

    public function create()
    {
        return view('pinjaman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah' => 'required|numeric',
            'bunga' => 'required|numeric',
            'jangka_waktu' => 'required|integer',
        ]);

        $validated['user_id'] = auth()->id();
        Pinjaman::create($validated);

        return redirect()->route('pinjamen.index')->with('success', 'Data pinjaman berhasil diajukan!');
    }
}
