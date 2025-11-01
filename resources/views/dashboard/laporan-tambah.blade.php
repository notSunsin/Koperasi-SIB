@extends('layouts.dashboard')

@section('content')
<h2>Tambah Laporan Keuangan</h2>

<form method="POST" action="{{ route('laporan.store') }}" style="max-width:600px;">
    @csrf

    <label for="kode">Kode Transaksi</label>
    <select id="kode" name="kode" required onchange="handleKodeChange()" style="width:100%;padding:8px;margin-bottom:10px;">
        <option value="">-- Pilih Kode Transaksi --</option>

        <optgroup label="Simpanan">
            @foreach($simpanans as $s)
                <option value="{{ $s->kode }}">{{ $s->kode }} - {{ $s->user->name }}</option>
            @endforeach
        </optgroup>

        <optgroup label="Pinjaman">
            @foreach($pinjamans as $p)
                <option value="{{ $p->kode }}">{{ $p->kode }} - {{ $p->user->name }}</option>
            @endforeach
        </optgroup>
    </select>

    <label for="uraian">Uraian</label>
    <input type="text" name="uraian" id="uraian" required style="width:100%;padding:8px;margin-bottom:10px;">

    {{-- Input Debit --}}
    <div id="debit-field">
        <label for="debit">Debit (Rp)</label>
        <input type="number" step="0.01" name="debit" id="debit" class="form-control" style="width:100%;padding:8px;margin-bottom:10px;">
    </div>

    {{-- Input Kredit --}}
    <div id="kredit-field">
        <label for="kredit">Kredit (Rp)</label>
        <input type="number" step="0.01" name="kredit" id="kredit" class="form-control" style="width:100%;padding:8px;margin-bottom:10px;">
    </div>

    <button type="submit" class="btn btn-add">Simpan</button>
    <a href="{{ route('dashboard.laporan') }}" class="btn btn-delete">Batal</a>
</form>

{{-- SCRIPT untuk toggle field --}}
<script>
function handleKodeChange() {
    const kode = document.getElementById('kode').value;
    const debitField = document.getElementById('debit-field');
    const kreditField = document.getElementById('kredit-field');

    // Reset visibilitas
    debitField.style.display = 'block';
    kreditField.style.display = 'block';

    if (kode.startsWith('PJ-')) {
        debitField.style.display = 'none'; // Pinjaman → hanya kredit
        document.getElementById('debit').value = '';
    } else if (kode.startsWith('SP-')) {
        kreditField.style.display = 'none'; // Simpanan → hanya debit
        document.getElementById('kredit').value = '';
    } else {
        debitField.style.display = 'block';
        kreditField.style.display = 'block';
    }
}
</script>

@endsection
