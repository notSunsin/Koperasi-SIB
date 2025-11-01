<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
        .footer { text-align: right; margin-top: 20px; font-size: 11px; }
    </style>
</head>
<body>
    <h2>Laporan Keuangan Koperasi</h2>
    <p><strong>Periode:</strong> 
        @if($filter === 'bulan_ini')
            Bulan Ini
        @else
            1 Bulan Terakhir
        @endif
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Nasabah</th>
                <th>Uraian</th>
                <th>Debit (Rp)</th>
                <th>Kredit (Rp)</th>
                <th>Saldo (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $index => $l)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $l->kode }}</td>
                    <td>{{ $l->user->name ?? '-' }}</td>
                    <td>{{ $l->uraian }}</td>
                    <td>Rp {{ number_format($l->debit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($l->kredit, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($l->saldo, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dibuat pada: {{ $tanggal }}</p>
    </div>
</body>
</html>
