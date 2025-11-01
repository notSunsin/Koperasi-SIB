@extends('layouts.dashboard')

@section('content')
    <h2>Tambah Nasabah</h2>

    @if ($errors->any())
        <div style="background: #f8d7da; color:#842029; padding:10px; margin-bottom:15px; border-radius:5px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('nasabah.store') }}" style="max-width:500px;">
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

        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
               style="width:100%; padding:8px; margin-bottom:10px;">

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
               style="width:100%; padding:8px; margin-bottom:15px;">

        <button type="submit" class="btn btn-add">Simpan</button>
        <a href="{{ route('dashboard.nasabah') }}" class="btn btn-delete" style="text-decoration:none;">Batal</a>
    </form>
@endsection
