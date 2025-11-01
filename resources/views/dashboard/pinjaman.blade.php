@extends('layouts.dashboard')

@section('content')
    <h2>📘 Data Pinjaman</h2>
    <a href="{{ route('pinjaman.create') }}" class="btn btn-add">+ Tambah Pinjaman</a>

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
                <th>Kredit (Rp)</th>
                <th>Saldo (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pinjamans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->kode }}</td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>{{ $p->uraian }}</td>
                    <td>Rp {{ number_format($p->kredit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($p->saldo, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('pinjaman.edit', $p->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('pinjaman.destroy', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete" onclick="return confirm('Hapus pinjaman ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Belum ada data pinjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
