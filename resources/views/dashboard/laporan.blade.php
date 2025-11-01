@extends('layouts.dashboard')

@section('content')
    <h2>📊 Laporan Keuangan</h2>

    <form method="GET" action="{{ route('dashboard.laporan') }}" style="margin-bottom:15px;">
        <label for="filter">Filter Waktu:</label>
        <select name="filter" id="filter" onchange="this.form.submit()" style="padding:5px 10px;">
            <option value="bulan_ini" {{ $filter === 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
            <option value="1_bulan_terakhir" {{ $filter === '1_bulan_terakhir' ? 'selected' : '' }}>1 Bulan Terakhir</option>
        </select>

        <a href="{{ route('laporan.download', ['filter' => $filter]) }}" class="btn btn-add" style="float:right;">⬇️ Download PDF</a>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Uraian</th>
                <th>Debit (Rp)</th>
                <th>Kredit (Rp)</th>
                <th>Saldo (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporans as $index => $l)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $l->kode }}</td>
                    <td>{{ $l->user->name ?? '-' }}</td>
                    <td>{{ $l->uraian }}</td>
                    <td>Rp {{ number_format($l->debit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($l->kredit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($l->saldo, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;">Tidak ada data laporan untuk periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
