@extends('layouts.dashboard')

@section('content')
@if(session('status'))
    <div style="background:#d1e7dd;color:#0f5132;padding:10px;margin-bottom:10px;border-radius:5px;">
        {{ session('status') }}
    </div>
@endif

    <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
    <p>Anda login sebagai <strong>Nasabah</strong>.</p>
    <p>Silakan lihat data pinjaman Anda melalui menu <strong>Pinjaman</strong> di sidebar.</p>
@endsection
