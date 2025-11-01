@extends('layouts.dashboard')

@section('content')
    <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
    <p>Anda login sebagai <strong>Nasabah</strong>.</p>
    <p>Silakan lihat data pinjaman Anda melalui menu <strong>Pinjaman</strong> di sidebar.</p>
@endsection
