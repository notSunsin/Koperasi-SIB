@extends('layouts.dashboard')

@section('content')
    <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
    <p>Anda login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong>.</p>
@endsection
