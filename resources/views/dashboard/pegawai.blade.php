@extends('layouts.dashboard')

@section('content')
    <h2>Data Pegawai</h2>
    <a href="{{ route('pegawai.create') }}" class="btn btn-add">+ Tambah Pegawai</a>

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
                <th>Jabatan</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pegawai as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $p->jabatan ?? '-' }}</td>
                    <td>{{ $p->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Belum ada data pegawai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
