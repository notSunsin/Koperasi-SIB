@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Daftar Pinjaman</h2>
    <a href="{{ route('pinjamen.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Ajukan Pinjaman</a>

    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th>Jumlah</th>
                <th>Bunga (%)</th>
                <th>Jangka Waktu (bulan)</th>
                <th>Status</th>
                <th>Nasabah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $p)
            <tr>
                <td>Rp {{ number_format($p->jumlah, 2) }}</td>
                <td>{{ $p->bunga }}</td>
                <td>{{ $p->jangka_waktu }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>{{ $p->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
