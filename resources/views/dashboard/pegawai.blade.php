@extends('layouts.dashboard')

@section('content')
    <h2>Data Pegawai</h2>
    <button class="btn btn-add">+ Tambah Pegawai</button>

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
            <tr>
                <td>Ahmad Yusuf</td>
                <td>Laki-laki</td>
                <td>Manager</td>
                <td>ahmad@example.com</td>
            </tr>
            <tr>
                <td>Siti Aminah</td>
                <td>Perempuan</td>
                <td>Staf</td>
                <td>siti@example.com</td>
            </tr>
        </tbody>
    </table>
@endsection
