<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    public function index()
    {
        // ambil semua user yang rolenya nasabah
        $nasabah = User::where('role', 'nasabah')->get();
        return view('dashboard.nasabah', compact('nasabah'));
    }

    public function create()
    {
        return view('dashboard.nasabah-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|min:8|confirmed',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'role'          => 'nasabah',
        ]);

        return redirect()->route('dashboard.nasabah')->with('success', 'Nasabah berhasil ditambahkan.');
    }
}
