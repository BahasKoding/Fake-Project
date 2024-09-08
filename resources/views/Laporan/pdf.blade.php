<!DOCTYPE html>
<html>
<head>
    <title>Laporan PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan</h1>
    <table>
        <thead>
            <tr>
                <th>ID Laporan</th>
                <th>Tanggal Laporan</th>
                <th>ID Monitoring</th>
                <th>Jumlah Bantuan</th>
                <th>Status Bantuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendataan as $p)
                @php
                    $monitoring = $p->monitoring->first();
                @endphp
                <tr>
                    <td>{{ $monitoring->formatLaporan() }}</td>
                    <td>@if($monitoring && $monitoring->created_at) {{ $monitoring->created_at->format('d/m/Y') }} @else - @endif</td>
                    <td>{{ $p->formatMonitoring() }}</td>
                    <td>@if($monitoring && $monitoring->Jumlah_bantuan !== null) Rp {{ number_format($monitoring->Jumlah_bantuan, 0, ',', '.') }} @else - @endif</td>
                    <td>@if($p->status == 1) diterima @endif</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
