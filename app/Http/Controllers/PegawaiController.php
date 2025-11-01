<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = User::where('role', 'admin')->get();
        return view('dashboard.pegawai', compact('pegawai'));
    }

    public function create()
    {
        return view('dashboard.pegawai-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:8|confirmed',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan'       => 'required|in:Staff,Manager,HRD',
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan'       => $request->jabatan,
            'role'          => 'admin', // otomatis admin
        ]);

        return redirect()->route('dashboard.pegawai')->with('success', 'Pegawai berhasil ditambahkan.');
    }
}
