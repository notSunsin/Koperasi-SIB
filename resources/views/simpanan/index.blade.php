@extends('layouts.dashboard')

@section('content')
    <h2>Data Simpanan</h2>
    <button class="btn btn-add">+ Tambah Simpanan</button>

    <table class="table">
        <thead>
            <tr>
                <th>No Transaksi</th>
                <th>Tanggal</th>
                <th>Anggota</th>
                <th>Simpanan Pokok</th>
                <th>Simpanan Wajib</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>TRX001</td>
                <td>2025-11-01</td>
                <td>Rina Salsabila</td>
                <td>Rp 1.000.000</td>
                <td>Rp 500.000</td>
                <td>
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
