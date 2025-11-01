<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Simpan Pinjam - Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        /* Sidebar */
        .sidebar {
            width: 230px;
            background-color: #0d6efd;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin-bottom: 5px;
            border-radius: 5px;
            display: block;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #0b5ed7;
        }
        .content {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 15px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f0f0f0;
        }
        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }
        .btn-add { background-color: #198754; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-delete { background-color: #dc3545; }
    </style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <h2>Koperasi</h2>
        <a href="{{ route('dashboard') }}">🏠 Beranda</a>
        <a href="{{ route('dashboard.pegawai') }}">👨‍💼 Pegawai</a>
        <a href="{{ route('dashboard.anggota') }}">👥 Anggota</a>
        <a href="{{ route('dashboard.simpanan') }}">💰 Simpanan</a>
        <a href="{{ route('dashboard.laporan') }}">📄 Laporan</a>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>
