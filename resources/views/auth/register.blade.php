<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Nasabah - Koperasi Simpan Pinjam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 380px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .register-btn {
            width: 100%;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .register-btn:hover {
            background-color: #0056b3;
        }
        .extra {
            text-align: right;
            margin-top: 10px;
        }
        .extra a {
            color: #007bff;
            text-decoration: none;
        }
        .extra a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Registrasi Nasabah</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        {{-- Role otomatis sebagai nasabah --}}
        <input type="hidden" name="role" value="nasabah">

        <button type="submit" class="register-btn">Daftar</button>

        <div class="extra">
            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
        </div>
    </form>
</div>

</body>
</html>
