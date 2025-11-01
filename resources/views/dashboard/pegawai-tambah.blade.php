@extends('layouts.dashboard')

@section('content')
    <h2>Tambah Pegawai</h2>

    @if ($errors->any())
        <div style="background: #f8d7da; color:#842029; padding:10px; margin-bottom:15px; border-radius:5px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pegawai.store') }}" style="max-width:500px;">
        @csrf

        <label>Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}" required
               style="width:100%; padding:8px; margin-bottom:10px;">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               style="width:100%; padding:8px; margin-bottom:10px;">

        <label>Password</label>
        <input type="password" name="password" required
               style="width:100%; padding:8px; margin-bottom:10px;">

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required
               style="width:100%; padding:8px; margin-bottom:10px;">

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required style="width:100%; padding:8px; margin-bottom:10px;">
            <option value="">-- Pilih --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label>Jabatan</label>
        <select name="jabatan" required style="width:100%; padding:8px; margin-bottom:15px;">
            <option value="">-- Pilih Jabatan --</option>
            <option value="Staff">Staff</option>
            <option value="Manager">Manager</option>
            <option value="HRD">HRD</option>
        </select>

        <button type="submit" class="btn btn-add">Simpan</button>
        <a href="{{ route('dashboard.pegawai') }}" class="btn btn-delete" style="text-decoration:none;">Batal</a>
    </form>
@endsection
