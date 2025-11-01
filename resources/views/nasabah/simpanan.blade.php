@extends('layouts.dashboard')

@section('content')
    <h2>🏦 Laporan Simpanan Saya</h2>
    <p>Berikut adalah data simpanan Anda di Koperasi Simpan Pinjam.</p>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Debit (Rp)</th>
                <th>Saldo (Rp)</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($simpanans as $index => $s)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $s->kode }}</td>
                    <td>{{ $s->uraian }}</td>
                    <td>Rp {{ number_format($s->debit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($s->saldo, 0, ',', '.') }}</td>
                    <td>{{ $s->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">Belum ada data simpanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tampilkan total keseluruhan --}}
    @if($simpanans->count() > 0)
        <div style="margin-top:15px; background:#f2f2f2; padding:10px; border-radius:5px;">
            <strong>Total Simpanan:</strong>
            Rp {{ number_format($simpanans->sum('debit'), 0, ',', '.') }}
        </div>
    @endif
@endsection
