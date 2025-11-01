@extends('layouts.dashboard')

@section('content')
    <h2>Selamat Datang di KoPinang, {{ Auth::user()->name }}</h2>
    <p>Anda login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong>.</p>
@endsection
