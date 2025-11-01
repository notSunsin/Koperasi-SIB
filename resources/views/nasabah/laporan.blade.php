@extends('layouts.dashboard')

@section('content')
    <h2>📊 Laporan Keuangan Saya</h2>
    <p>Berikut adalah laporan seluruh aktivitas keuangan Anda di koperasi (Simpanan & Pinjaman).</p>

    <a href="{{ route('nasabah.laporan.download') }}" class="btn btn-add" style="float:right; margin-bottom:10px;">⬇️ Download PDF</a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Debit (Rp)</th>
                <th>Kredit (Rp)</th>
                <th>Saldo (Rp)</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporans as $index => $l)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $l->kode }}</td>
                    <td>{{ $l->uraian }}</td>
                    <td>Rp {{ number_format($l->debit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($l->kredit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($l->saldo, 0, ',', '.') }}</td>
                    <td>{{ $l->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;">Belum ada transaksi keuangan.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($laporans->count() > 0)
        <div style="margin-top:15px; background:#f2f2f2; padding:10px; border-radius:5px;">
            <strong>Total Debit:</strong> Rp {{ number_format($laporans->sum('debit'), 0, ',', '.') }}<br>
            <strong>Total Kredit:</strong> Rp {{ number_format($laporans->sum('kredit'), 0, ',', '.') }}<br>
            <strong>Saldo Akhir:</strong> Rp {{ number_format($laporans->last()->saldo ?? 0, 0, ',', '.') }}
        </div>
    @endif
@endsection
