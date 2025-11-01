@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Daftar Simpanan</h2>
    <a href="{{ route('simpanans.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Simpanan</a>

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Nasabah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $s)
            <tr>
                <td>{{ $s->jenis }}</td>
                <td>Rp {{ number_format($s->jumlah, 2) }}</td>
                <td>{{ $s->tanggal }}</td>
                <td>{{ $s->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
