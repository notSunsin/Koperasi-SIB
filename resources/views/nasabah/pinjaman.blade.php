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

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #0b5ed7;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            background-color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Tombol Logout */
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 12px 22px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #b02a37;
        }

        /* Isi Konten */
        .content {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
        }

        /* Tabel */
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
            padding: 8px 14px;
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
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Koperasi</h2>

        {{-- Role-based menu --}}
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('dashboard') }}">🏠 Beranda</a>
            <a href="{{ route('dashboard.pegawai') }}">👨‍💼 Pegawai</a>
            <a href="{{ route('dashboard.nasabah') }}">👥 Nasabah</a>
            <a href="{{ route('dashboard.simpanan') }}">💰 Simpanan</a>
            <a href="{{ route('dashboard.laporan') }}">📄 Laporan</a>
        @elseif(Auth::user()->role === 'nasabah')
            <a href="{{ route('nasabah.home') }}">🏠 Beranda</a>
            <a href="{{ route('nasabah.pinjaman') }}" class="active">💳 Pinjaman</a>
        @endif
    </div>

    <!-- Area Konten -->
    <div class="content-wrapper">
        <!-- Header -->
        <div class="header">
            <div style="margin-right: 20px; font-weight: bold; color:#333;">
                👤 {{ Auth::user()->name }}
            </div>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="button" class="logout-btn" onclick="confirmLogout()">🚪 Logout</button>
            </form>
        </div>

        <!-- Isi Konten -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

<script>
function confirmLogout() {
    if (confirm('Yakin ingin keluar dari akun ini?')) {
        document.getElementById('logoutForm').submit();
    }
}
</script>

</body>
</html>
