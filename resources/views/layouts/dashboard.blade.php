<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koperasi Simpan Pinjam</title>
    <style>
        * {
            box-sizing: border-box;
        }
        /* === Tombol Umum === */
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

        /* Tombol logout (sudah ada, kita rapikan saja) */
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .logout-btn:hover {
            background: #b02a37;
        }

        /* Tombol toggle sidebar */
        .toggle-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 18px;
            transition: background 0.2s;
        }
        .toggle-btn:hover {
            background: #0056b3;
        }


        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            background: #f4f6f8;
            overflow: hidden;
        }

        /* === Sidebar === */
        .sidebar {
            width: 220px;
            background-color: #007bff;
            color: #fff;
            transition: width 0.3s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .sidebar.hidden {
            width: 70px;
        }

        .sidebar h2 {
            text-align: center;
            margin: 15px 0;
            font-size: 18px;
            transition: opacity 0.3s ease;
        }

        .sidebar.hidden h2 {
            opacity: 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .sidebar-menu li a:hover {
            background-color: #0056b3;
        }

        .sidebar.hidden .sidebar-menu li a {
            justify-content: center;
        }

        .sidebar.hidden .sidebar-menu li a span {
            display: none;
        }

        /* === Main Content === */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            flex-shrink: 0;
        }

        .toggle-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 18px;
        }

        .toggle-btn:hover {
            background: #0056b3;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #b02a37;
        }

        /* === Content Area (scrollable) === */
        .content-area {
            padding: 20px;
            overflow-y: auto; /* ✅ biar tabel tidak ketutup */
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        table th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>

    {{-- === Sidebar === --}}
    <div class="sidebar" id="sidebar">
        <h2>{{ Auth::user()->role === 'admin' ? 'Admin' : 'Nasabah' }}</h2>
        <ul class="sidebar-menu">
            @if(Auth::user()->role === 'admin')
                <li><a href="{{ route('dashboard') }}">🏠 <span>Beranda</span></a></li>
                <li><a href="{{ route('dashboard.pegawai') }}">👨‍💼 <span>Pegawai</span></a></li>
                <li><a href="{{ route('dashboard.nasabah') }}">👥 <span>Nasabah</span></a></li>
                <li><a href="{{ route('dashboard.simpanan') }}">🏦 <span>Simpanan</span></a></li>
                <li><a href="{{ route('dashboard.pinjaman') }}">💰 <span>Pinjaman</span></a></li>
                <li><a href="{{ route('dashboard.laporan') }}">📊 <span>Laporan</span></a></li>
            @else
                <li><a href="{{ route('nasabah.home') }}">🏠 <span>Beranda</span></a></li>
                <li><a href="{{ route('nasabah.simpanan') }}">🏦 <span>Simpanan Saya</span></a></li>
                <li><a href="{{ route('nasabah.pinjaman') }}">💰 <span>Pinjaman Saya</span></a></li>
                <li><a href="{{ route('nasabah.laporan') }}">📊 <span>Laporan Saya</span></a></li>
            @endif
        </ul>
    </div>

    {{-- === Main Content === --}}
    <div class="main-content" id="mainContent">
        <div class="topbar">
            <button class="toggle-btn" id="toggleBtn">☰</button>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="button" id="logoutBtn" class="logout-btn">Logout</button>
            </form>

        </div>

        <div class="content-area">
            {{-- ✅ Pesan sukses global --}}
            @if(session('status'))
                <div style="background:#d1e7dd;color:#0f5132;padding:10px;margin-bottom:10px;border-radius:5px;">
                    {{ session('status') }}
                </div>
            @endif

            {{-- ✅ Semua tabel & konten tetap tampil di sini --}}
            @yield('content')
        </div>
    </div>

    {{-- === SCRIPT Hide/Show Sidebar === --}}
        <script>
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleBtn');
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutForm = document.getElementById('logoutForm');

            // === Sidebar hide/show ===
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                localStorage.setItem('sidebarHidden', sidebar.classList.contains('hidden'));
            });

            document.addEventListener('DOMContentLoaded', () => {
                const hidden = localStorage.getItem('sidebarHidden') === 'true';
                if (hidden) sidebar.classList.add('hidden');
            });

            // === Konfirmasi logout ===
            logoutBtn.addEventListener('click', () => {
                if (confirm('Ente yakin mau logout?')) {
                    logoutForm.submit();
                }
            });
        </script>



</body>
</html>
