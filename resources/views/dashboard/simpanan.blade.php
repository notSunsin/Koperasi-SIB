@extends('layouts.dashboard')

@section('content')
    <h2>💰 Data Simpanan</h2>
    <a href="{{ route('simpanan.create') }}" class="btn btn-add">+ Tambah Simpanan</a>

    @if(session('success'))
        <div style="background:#d1e7dd; color:#0f5132; padding:10px; margin-top:10px; border-radius:5px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Nasabah</th>
                <th>Uraian</th>
                <th>Debit (Rp)</th>
                <th>Saldo (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($simpanans as $index => $s)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $s->kode }}</td>
                    <td>{{ $s->user->name ?? '-' }}</td>
                    <td>{{ $s->uraian }}</td>
                    <td>Rp {{ number_format($s->debit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($s->saldo, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('simpanan.edit', $s->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('simpanan.destroy', $s->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete" onclick="return confirm('Hapus simpanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;">Belum ada data simpanan.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
