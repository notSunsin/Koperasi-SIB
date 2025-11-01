@extends('layouts.dashboard')

@section('content')
    <h2>Edit Data Pinjaman</h2>

    <form method="POST" action="{{ route('pinjaman.update', $pinjaman->id) }}" style="max-width:500px;">
        @csrf

        <label>Kode Pinjaman</label>
        <input type="text" value="{{ $pinjaman->kode }}" readonly style="width:100%;padding:8px;margin-bottom:10px;">

        <label>Nama Nasabah</label>
        <select name="user_id" required style="width:100%;padding:8px;margin-bottom:10px;">
            @foreach($nasabahs as $n)
                <option value="{{ $n->id }}" {{ $pinjaman->user_id == $n->id ? 'selected' : '' }}>{{ $n->name }}</option>
            @endforeach
        </select>

        <label>Uraian</label>
        <input type="text" name="uraian" value="{{ $pinjaman->uraian }}" required style="width:100%;padding:8px;margin-bottom:10px;">

        <label>Kredit (Rp)</label>
        <input type="number" name="kredit" value="{{ $pinjaman->kredit }}" step="0.01" required style="width:100%;padding:8px;margin-bottom:10px;">

        <button type="submit" class="btn btn-add">Update</button>
        <a href="{{ route('dashboard.pinjaman') }}" class="btn btn-delete">Batal</a>
    </form>
@endsection
