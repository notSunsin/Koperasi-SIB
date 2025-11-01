@extends('layouts.dashboard')

@section('content')
    <h2>Tambah Data Pinjaman</h2>

    <form method="POST" action="{{ route('pinjaman.store') }}" style="max-width:500px;">
        @csrf

        <p><strong>Kode Pinjaman</strong>: akan dibuat otomatis (misal: PJ-001)</p>

        <label>Nama Nasabah</label>
        <select name="user_id" required style="width:100%;padding:8px;margin-bottom:10px;">
            <option value="">-- Pilih Nasabah --</option>
            @foreach($nasabahs as $n)
                <option value="{{ $n->id }}">{{ $n->name }}</option>
            @endforeach
        </select>

        <label>Uraian</label>
        <input type="text" name="uraian" required style="width:100%;padding:8px;margin-bottom:10px;">

        <label>Kredit (Rp)</label>
        <input type="number" name="kredit" step="0.01" required style="width:100%;padding:8px;margin-bottom:10px;">

        <button type="submit" class="btn btn-add">Simpan</button>
        <a href="{{ route('dashboard.pinjaman') }}" class="btn btn-delete">Batal</a>
    </form>
@endsection
