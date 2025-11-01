@extends('layouts.dashboard')

@section('content')
    <h2>Data Anggota</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Rina Salsabila</td>
                <td>Perempuan</td>
                <td>Jakarta, 10 Maret 1998</td>
            </tr>
            <tr>
                <td>Andi Saputra</td>
                <td>Laki-laki</td>
                <td>Bandung, 2 Juli 1995</td>
            </tr>
        </tbody>
    </table>
@endsection
