@extends('layouts.dashboard')

@section('content')
    <h2>Data Nasabah</h2>
    <a href="{{ route('nasabah.create') }}" class="btn btn-add">+ Tambah Nasabah</a>

    @if(session('success'))
        <div style="background: #d1e7dd; color:#0f5132; padding:10px; margin-top:10px; border-radius:5px;">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nasabah as $n)
                <tr>
                    <td>{{ $n->name }}</td>
                    <td>{{ $n->jenis_kelamin ?? '-' }}</td>
                    <td>
                        {{ $n->tempat_lahir ?? '-' }},
                        {{ \Carbon\Carbon::parse($n->tanggal_lahir)->format('d M Y') ?? '-' }}
                    </td>
                    <td>{{ $n->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Belum ada data nasabah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
