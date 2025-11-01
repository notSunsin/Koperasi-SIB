@extends('layouts.dashboard')

@section('content')
    <h2>Tambah Simpanan</h2>

    <form method="POST" action="{{ route('simpanan.store') }}" style="max-width:500px;">
        @csrf

        <p><strong>Kode Simpanan</strong>: otomatis dibuat (SP-001, SP-002, ...)</p>

        <label>Nama Nasabah</label>
        <select name="user_id" required style="width:100%;padding:8px;margin-bottom:10px;">
            <option value="">-- Pilih Nasabah --</option>
            @foreach($nasabahs as $n)
                <option value="{{ $n->id }}">{{ $n->name }}</option>
            @endforeach
        </select>

        <label>Uraian</label>
        <input type="text" name="uraian" required style="width:100%;padding:8px;margin-bottom:10px;">

        <label>Jumlah Simpanan (Rp)</label>
        <input type="number" name="debit" step="0.01" required style="width:100%;padding:8px;margin-bottom:10px;">

        <button type="submit" class="btn btn-add">Simpan</button>
        <a href="{{ route('dashboard.simpanan') }}" class="btn btn-delete">Batal</a>
    </form>
@endsection
