@extends('layouts.dashboard')

@section('content')
    <h2>💰 Laporan Pinjaman Saya</h2>
    <p>Berikut adalah daftar pinjaman Anda di Koperasi Simpan Pinjam.</p>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Kredit (Rp)</th>
                <th>Saldo (Rp)</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pinjamans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->kode }}</td>
                    <td>{{ $p->uraian }}</td>
                    <td>Rp {{ number_format($p->kredit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($p->saldo, 0, ',', '.') }}</td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">Belum ada data pinjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tampilkan total keseluruhan --}}
    @if($pinjamans->count() > 0)
        <div style="margin-top:15px; background:#f2f2f2; padding:10px; border-radius:5px;">
            <strong>Total Pinjaman:</strong>
            Rp {{ number_format($pinjamans->sum('kredit'), 0, ',', '.') }}
        </div>
    @endif
@endsection
