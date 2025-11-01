<x-app-layout>
    <div class="p-6 bg-white shadow-sm sm:rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>
        <p>Selamat datang di KoPinang, {{ Auth::user()->name }}!</p>
        <p>Role: <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
        @if(Auth::user()->jabatan)
            <p>Jabatan: <strong>{{ Auth::user()->jabatan }}</strong></p>
        @endif
    </div>
</x-app-layout>
